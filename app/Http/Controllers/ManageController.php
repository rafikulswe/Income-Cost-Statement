<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Income;
use App\IncomeCategory;
use App\ExpenseCategory;
use App\Lender;
use App\Loan;

class ManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user_id = Auth::user()->id;
        $data['allincate']=IncomeCategory::where('valid','1')->where('user_id', $user_id)->count();
        $data['allexpcate']=ExpenseCategory::where('valid','1')->where('user_id', $user_id)->count();
        $data['loaner']=Lender::where('valid','1')->where('user_id', $user_id)->count();

        
        $data['all_received_loans'] = $all_received_loans = Loan::where('valid', 1)
                ->where('user_id', $user_id)
                ->where('loan_type', 1) //1 = Received Loan
                ->sum('amount');

        $data['all_paid_loans'] = $all_paid_loans = Loan::where('valid', 1)
                ->where('user_id', $user_id)
                ->where('loan_type', 2) //2 = Paid Loan
                ->sum('amount');

        $data['all_given_loans'] = $all_given_loans = Loan::where('valid', 1)
                ->where('user_id', $user_id)
                ->where('loan_type', 3) //3 = Given Loan
                ->sum('amount');

        $data['all_payment_loans'] = $all_payment_loans = Loan::where('valid', 1)
                ->where('user_id', $user_id)
                ->where('loan_type', 4) //4 = Payment Loan
                ->sum('amount');
        
        $data['total_received_amount'] = $total_received_amount = $all_received_loans + $all_payment_loans;
        $data['total_payment_amount'] = $total_payment_amount = $all_paid_loans + $all_given_loans;
        $data['total_due_amount'] = $total_received_amount - $total_payment_amount;


        // $basic=Basic::where('basic_status','1')->count();
        $data['totalRec']=Loan::where('valid','1')->where('user_id', $user_id)->sum('amount');
        $data['totalPaid']=Loan::where('valid','1')->where('user_id', $user_id)->sum('amount');
        $data['totalGiven']=Loan::where('valid','1')->where('user_id', $user_id)->sum('amount');
        $data['totalPayment']=Loan::where('valid','1')->where('user_id', $user_id)->sum('amount');

        return view('web.manage.gridList', $data);
    }
}
