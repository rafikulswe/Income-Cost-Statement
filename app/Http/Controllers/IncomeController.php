<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Income;
use App\IncomeCategory;
use Auth;
use Validator;
use DB;
use DateTime;
use Session;

class IncomeController extends Controller
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
        $data['all_incomes'] = Income::join('income_categories','incomes.income_category_id','=', 'income_categories.id')
                ->select('incomes.*', 'income_categories.category_name')
                ->where('incomes.valid', 1)
                ->where('incomes.user_id', $user_id)
                ->orderBy('incomes.id', 'DESC')
                ->get();
        return view('web.income.dataList', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        $data['income_categories'] = IncomeCategory::where('user_id', $user_id)->where('valid', 1)->get();
        return view('web.income.create', $data);
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

        $validator = Validator::make($input, [
            'income_category_id' => 'required',
            'income_name'        => 'required',
            'income_amount'      => 'required',
            'income_date'        => 'required'
        ]);
        if ($validator->passes()) {
            Income::create([
                "income_category_id" => $request->income_category_id,
                "income_name"        => $request->income_name,
                "income_amount"      => $request->income_amount,
                "income_details"     => $request->income_details,
                "income_date"        => $request->income_date,
                "user_id"            => $user_id
            ]);
            return redirect()->route('income.create')->with('message', 'Income has been Inserted');
        } else {
            return redirect()->route('income.create')->with('error', 'Please fill up the required field');
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
        $data['income'] = Income::join('income_categories', 'income_categories.id', '=', 'incomes.income_category_id')
            ->select('incomes.*', 'income_categories.category_name')
            ->where('incomes.id', $id)
            ->first();
        return view('web.income.view', $data);
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
        $data['income'] = Income::where('valid', 1)->where('user_id', $user_id)->find($id);
        $data['income_categories'] = IncomeCategory::where('user_id', $user_id)->where('valid', 1)->get();
        return view('web.income.edit', $data);
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

        $validator = Validator::make($input, [
            'income_category_id' => 'required',
            'income_name'        => 'required',
            'income_amount'      => 'required',
            'income_date'        => 'required'
        ]);
        if ($validator->passes()) {
            Income::where('id', $id)->update([
                "income_category_id" => $request->income_category_id,
                "income_name"        => $request->income_name,
                "income_amount"      => $request->income_amount,
                "income_details"     => $request->income_details,
                "income_date"        => $request->income_date
            ]);
            return redirect()->route('income.edit', [$id])->with('message', 'Income has been Updated');
        } else {
            return redirect()->route('income.edit', [$id])->with('error', 'Please fill up the required field');     
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
        $softDelete = Income::where('id', $id)->update(['valid' => 0]);
        if($softDelete){
            Session::flash('message','value');
            return redirect()->route('income')->with('message', 'Income has been Deleted');
        }else{
            Session::flash('error','value');
            return redirect()->route('income')->with('message', 'Income has not been Deleted');
        }
    }
}
