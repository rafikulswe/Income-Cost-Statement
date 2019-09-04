<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;
use DateTime;
use Session;
use App\User;
use App\Lender;
use App\Loan;
use App\Income;
use App\Expense;
use App\ExpenseCategory;
use App\IncomeCategory;

class LenderInfoController extends Controller
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
        $data['all_lenders'] = $all_lenders = Lender::where('valid', 1)
                ->where('user_id', $user_id)
                ->orderBy('id', 'DESC')
                ->get();
        foreach ($all_lenders as $key => $lender) {
            $all_received_loans = Loan::where('valid', 1)
                    ->where('user_id', $user_id)
                    ->where('lender_id', $lender->id)
                    ->where('loan_type', 1) //1 = Received Loan
                    ->sum('amount');

            $all_paid_loans = Loan::where('valid', 1)
                    ->where('user_id', $user_id)
                    ->where('lender_id', $lender->id)
                    ->where('loan_type', 2) //2 = Paid Loan
                    ->sum('amount');

            $all_given_loans = Loan::where('valid', 1)
                    ->where('user_id', $user_id)
                    ->where('lender_id', $lender->id)
                    ->where('loan_type', 3) //3 = Given Loan
                    ->sum('amount');

            $all_payment_loans = Loan::where('valid', 1)
                    ->where('user_id', $user_id)
                    ->where('lender_id', $lender->id)
                    ->where('loan_type', 4) //4 = Payment Loan
                    ->sum('amount');
            
            $total_received_amount = $all_received_loans + $all_payment_loans;
            $total_payment_amount = $all_paid_loans + $all_given_loans;
            $lender->total_due_amount = $total_received_amount - $total_payment_amount;
        }
        return view('web.lenderInfo.dataList', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.lenderInfo.create');
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
            'lender_name'    => 'required',
            'lender_phone'   => 'required',
            'lender_email'   => 'required'
        ]);
        if ($validator->passes()) {
            Lender::create([
                "lender_name"    => $request->lender_name,
                "lender_phone"   => $request->lender_phone,
                "lender_email"   => $request->lender_email,
                "lender_remarks" => $request->lender_remarks,
                "user_id"        => $user_id
            ]);
            return redirect()->route('lender.create')->with('message', 'Lender has been Created');
        } else {
            return redirect()->route('lender.create')->with('error', 'Please fill up the required field');
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
        $user_id = Auth::user()->id;
        $data['lender'] = Lender::find($id);
        
        $data['all_received_loans'] = $all_received_loans = Loan::where('valid', 1)
                ->where('user_id', $user_id)
                ->where('lender_id', $id)
                ->where('loan_type', 1) //1 = Received Loan
                ->orderBy('id', 'ASC')
                ->get();

        $data['all_paid_loans'] = $all_paid_loans = Loan::where('valid', 1)
                ->where('user_id', $user_id)
                ->where('lender_id', $id)
                ->where('loan_type', 2) //2 = Paid Loan
                ->orderBy('id', 'ASC')
                ->get();

        $data['all_given_loans'] = $all_given_loans = Loan::where('valid', 1)
                ->where('user_id', $user_id)
                ->where('lender_id', $id)
                ->where('loan_type', 3) //3 = Given Loan
                ->orderBy('id', 'ASC')
                ->get();

        $data['all_payment_loans'] = $all_payment_loans = Loan::where('valid', 1)
                ->where('user_id', $user_id)
                ->where('lender_id', $id)
                ->where('loan_type', 4) //4 = Payment Loan
                ->orderBy('id', 'ASC')
                ->get();
        
        $data['total_received_amount'] = $total_received_amount = $all_received_loans->sum('amount') + $all_payment_loans->sum('amount');
        $data['total_payment_amount'] = $total_payment_amount = $all_paid_loans->sum('amount') + $all_given_loans->sum('amount');
        $data['total_due_amount'] = $total_received_amount - $total_payment_amount;
        return view('web.lenderInfo.view', $data);
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
        $data['lender'] = Lender::where('valid', 1)->where('user_id', $user_id)->find($id);
        return view('web.lenderInfo.edit', $data);
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

        $validator = Validator::make($input, [
            'lender_name'  => 'required',
            'lender_phone' => 'required',
            'lender_email' => 'required'
        ]);
        if ($validator->passes()) {
            Lender::where('id', $id)->update([
                "lender_name"    => $request->lender_name,
                "lender_phone"   => $request->lender_phone,
                "lender_email"   => $request->lender_email,
                "lender_remarks" => $request->lender_remarks
            ]);
            return redirect()->route('lender.edit', [$id])->with('message', 'Lender has been Updated');
        } else {
            return redirect()->route('lender.edit', [$id])->with('error', 'Please fill up the required field');     
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
        $softDelete = Lender::where('id', $id)->update(['valid' => 0]);
        if($softDelete){
            Session::flash('message','value');
            return redirect()->route('lender')->with('message', 'Lender has been Deleted');
        }else{
            Session::flash('error','value');
            return redirect()->route('lender')->with('message', 'Lender has not been Deleted');
        }
    }

    public function loanTransaction(Request $request)
    {
        $input = $request->all();
        $user_id = Auth::user()->id;
        $lender_id = $request->lender_id;
        $modalType = $request->modalType;

        $validator = Validator::make($input, [
            'amount'           => 'required',
            'transaction_date' => 'required',
            'return_date'      => 'required'
        ]);
        if ($modalType == 1 || $modalType == 3) {
            $paid_status = 0;
        } else {
            $paid_status = 1;
        }
        if ($validator->passes()) {
            DB::beginTransaction();
            Loan::create([
                "lender_id"        => $lender_id,
                "amount"           => $request->amount,
                "transaction_date" => $request->transaction_date,
                "return_date"      => $request->return_date,
                "remarks"          => $request->remarks,
                "loan_type"        => $modalType, //1 = Loan Receive, 2 = Loan Paid, 3 = Loan Given, 4 = Loan Payment
                "paid_status"      => $paid_status, //0 = No, 1 = Yes
                "user_id"          => $user_id
            ]);
            if ($modalType == 1 || $modalType == 4) {
                $income_category = IncomeCategory::where('valid', 1)->where('user_id', $user_id)->where('category_name', 'Loan')->first();
                if(empty($income_category->id)){
                    $income_category = IncomeCategory::create([
                        "category_name"    => 'Loan',
                        "category_remarks" => 'Taking a loan or payment of a given loan.',
                        "user_id"          => $user_id
                    ]);
                }
                Income::create([
                    "income_category_id" => $income_category->id,
                    "income_name"        => $modalType == 1 ? 'Loan Received' : 'Loan Payment',
                    "income_amount"      => $request->amount,
                    "income_details"     => $modalType == 1 ? 'I have taken a loan' : 'I have received a Loan Payment',
                    "income_date"        => $request->transaction_date,
                    "user_id"            => $user_id
                ]);
            } else {
                $expense_category = ExpenseCategory::where('valid', 1)->where('user_id', $user_id)->where('category_name', 'Loan')->first();
                if(empty($expense_category->id)){
                    $expense_category = ExpenseCategory::create([
                        "category_name"    => 'Loan',
                        "category_remarks" => 'Taking a loan or payment of a given loan.',
                        "user_id"          => $user_id
                    ]);
                }
                Expense::create([
                    "expense_category_id" => $expense_category->id,
                    "expense_name"        => $modalType == 2 ? 'Loan Paid' : 'Loan Given',
                    "expense_amount"      => $request->amount,
                    "expense_details"     => $modalType == 2 ? 'I have paid a loan': 'I have given a Loan',
                    "expense_date"        => $request->transaction_date,
                    "user_id"             => $user_id
                ]);
            }
            DB::commit(); 
            if ($modalType == 1) {
                return redirect()->route('lender.show', [$lender_id])->with('message', 'Loan has been Received');
            } elseif ($modalType == 2) {
                return redirect()->route('lender.show', [$lender_id])->with('message', 'Loan has been Paid');
            } elseif ($modalType == 3) {
                return redirect()->route('lender.show', [$lender_id])->with('message', 'Loan has been Given');
            } else {
                return redirect()->route('lender.show', [$lender_id])->with('message', 'Loan has been Payment');
            }
            
        } else {
            return redirect()->route('lender.show', [$lender_id])->with('error', 'Please fill up the required field');
        }
    }
}
