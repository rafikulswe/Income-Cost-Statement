<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use Auth;
use Carbon\Carbon;
use App\Income;
use App\Lender;
use App\Expense;
use App\IncomeCategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function dashboard() {
        // $donut=Charts::create('donut', 'highcharts')
        //     ->title('November')
        //     ->labels(['Income', 'Expense', 'Saving'])
        //     ->values([50,40,10])
        //     ->responsive(true);

        // $areaspline=Charts::multi('areaspline', 'highcharts')
        //     ->title('Last 7 Days')
        //     ->colors(['#ff0000', '#ffb3b3'])
        //     ->labels(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday','Saturday', 'Sunday'])
        //     ->dataset('Income', [3, 4, 3, 5, 4, 10, 12])
        //     ->dataset('Expense',  [1, 3, 4, 3, 3, 5, 4])
        //     ->responsive(true);

        // $chart = Charts::database(Income::all(), 'line', 'highcharts')
        //     ->dateColumn('income_date')
        //     ->title('Last 7 Days Income')
        //     ->elementLabel("Total")
        //     ->responsive(true)
        //     ->lastByDay(7, true);
        $user_id = Auth::user()->id;
        $data['all_lenders'] = $all_lenders = Lender::where('valid', 1)->where('user_id', $user_id)->count();
        $to = Carbon::now()->format('Y-m-d');
        $from = date('Y-m-d', strtotime('-7 days', strtotime($to)));
        // $to = date('Y-m-d');
        // dd($to);
        $data['last_7days_income'] = Income::join('income_categories', 'income_categories.id', '=', 'incomes.income_category_id')
            ->select('incomes.*', 'income_categories.category_name')
            ->whereBetween('incomes.income_date', [$from, $to])
            ->where('incomes.user_id', $user_id)
            ->where('incomes.valid', 1)
            ->get();
        $data['last_7days_expense'] = Expense::join('expense_categories', 'expense_categories.id', '=', 'expenses.expense_category_id')
            ->select('expenses.*', 'expense_categories.category_name')
            ->whereBetween('expenses.expense_date', [$from, $to])
            ->where('expenses.user_id', $user_id)
            ->where('expenses.valid', 1)
            ->get();
        $data['totalIncome'] = Income::where('valid',1)->where('user_id', $user_id)->sum('income_amount');
        $data['totalExpense'] = Expense::where('valid',1)->where('user_id', $user_id)->sum('expense_amount');
        return view('web.dashboard.home', $data);
    }
}
