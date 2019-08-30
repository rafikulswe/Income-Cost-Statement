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
        $data['allexpcate']=ExpenseCategory::where('valid','1')->count();
        $data['loaner']=Lender::where('valid','1')->count();
        // $basic=Basic::where('basic_status','1')->count();
        $data['totalRec']=Loan::where('valid','1')->sum('amount');
        $data['totalPaid']=Loan::where('valid','1')->sum('amount');
        $data['totalGiven']=Loan::where('valid','1')->sum('amount');
        $data['totalPayment']=Loan::where('valid','1')->sum('amount');

        return view('web.manage.gridList', $data);
    }
}
