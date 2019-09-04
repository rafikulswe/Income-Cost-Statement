<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Expense;
use App\Income;
use App\ExpenseCategory;
use Auth;
use Validator;
use DB;
use DateTime;
use Session;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $data['all_expenses'] = Expense::join('expense_categories','expenses.expense_category_id','=', 'expense_categories.id')
                ->select('expenses.*', 'expense_categories.category_name')
                ->where('expenses.valid', 1)
                ->where('expenses.user_id', $user_id)
                ->orderBy('expenses.id', 'DESC')
                ->get();
        return view('web.expense.dataList', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        $data['expense_categories'] = ExpenseCategory::where('user_id', $user_id)->where('valid', 1)->get();
        return view('web.expense.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $user_id = Auth::user()->id;
        $expense_amount = $request->expense_amount;

        $validator = Validator::make($input, [
            'expense_category_id' => 'required',
            'expense_name'        => 'required',
            'expense_amount'      => 'required',
            'expense_date'        => 'required'
        ]);

        $totalIncome = Income::where('valid', 1)->where('user_id', $user_id)->sum('income_amount');
        $totalExpense = Expense::where('valid', 1)->where('user_id', $user_id)->sum('expense_amount');
        $saving_amount = $totalIncome - $totalExpense;

        if ($validator->passes()) {
            if ($saving_amount > 0 && $saving_amount >= $expense_amount) {
                Expense::create([
                    "expense_category_id" => $request->expense_category_id,
                    "expense_name"        => $request->expense_name,
                    "expense_amount"      => $expense_amount,
                    "expense_details"     => $request->expense_details,
                    "expense_date"        => $request->expense_date,
                    "user_id"             => $user_id
                ]);
                return redirect()->route('expense.create')->with('message', 'Expense has been Inserted');
            } else {
                return redirect()->route('expense.create')->with('error', 'You have not sufficient Amount!');                
            }
        } else {
            return redirect()->route('expense.create')->with('error', 'Please fill up the required field');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['expense'] = Expense::join('expense_categories', 'expense_categories.id', '=', 'expenses.expense_category_id')
            ->select('expenses.*', 'expense_categories.category_name')
            ->where('expenses.id', $id)
            ->first();
        return view('web.expense.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::user()->id;
        $data['expense'] = Expense::where('valid', 1)->where('user_id', $user_id)->find($id);
        $data['expense_categories'] = ExpenseCategory::where('user_id', $user_id)->where('valid', 1)->get();
        return view('web.expense.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $user_id = Auth::user()->id;
        $expense_amount = $request->expense_amount;

        $validator = Validator::make($input, [
            'expense_category_id' => 'required',
            'expense_name'        => 'required',
            'expense_amount'      => 'required',
            'expense_date'        => 'required'
        ]);

        $totalIncome = Income::where('valid',1)->where('user_id', $user_id)->sum('income_amount');
        $totalExpense = Expense::where('valid',1)->where('user_id', $user_id)->sum('expense_amount');
        $saving_amount = $totalIncome - $totalExpense;

        if ($validator->passes()) {
            if ($saving_amount < 0 && $saving_amount >= $expense_amount) {
                Expense::where('id', $id)->update([
                    "expense_category_id" => $request->expense_category_id,
                    "expense_name"        => $request->expense_name,
                    "expense_amount"      => $request->expense_amount,
                    "expense_details"     => $request->expense_details,
                    "expense_date"        => $request->expense_date
                ]);
                return redirect()->route('expense.edit', [$id])->with('message', 'Expense has been Updated');
            } else {
                return redirect()->route('expense.edit', [$id])->with('error', 'You have not sufficient Amount!');                
            }
        } else {
            return redirect()->route('expense.edit', [$id])->with('error', 'Please fill up the required field');     
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $softDelete = Expense::where('id', $id)->update(['valid' => 0]);
        if($softDelete){
            Session::flash('message','value');
            return redirect()->route('expense')->with('message', 'Expense has been Deleted');
        }else{
            Session::flash('error','value');
            return redirect()->route('expense')->with('message', 'Expense has not been Deleted');
        }
    }
}
