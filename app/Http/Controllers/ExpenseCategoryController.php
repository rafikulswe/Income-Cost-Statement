<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;
use DateTime;
use Session;
use App\ExpenseCategory;

class ExpenseCategoryController extends Controller
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
        $data['all_Categories'] = ExpenseCategory::where('valid', 1)->where('user_id', $user_id)->get();
        return view('web.expenseCategory.dataList', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.expenseCategory.create');        
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
            'category_name'    => 'required',
            'category_remarks' => 'required'
        ]);

        if ($validator->passes()) {
            ExpenseCategory::create([
                "category_name"    => $request->category_name,
                "category_remarks" => $request->category_remarks,
                "user_id"          => $user_id
            ]);
            return redirect()->route('expenseCategory.create')->with('message', 'Category has been Created');
        } else {
            return redirect()->route('expenseCategory.create')->with('error', 'Please fill up the required field');
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
        $data['category'] = ExpenseCategory::find($id);
        return view('web.expenseCategory.view', $data);
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
        $data['category'] = ExpenseCategory::where('valid', 1)->where('user_id', $user_id)->find($id);
        return view('web.expenseCategory.edit', $data);
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
            'category_name'    => 'required',
            'category_remarks' => 'required'
        ]);
        if ($validator->passes()) {
            ExpenseCategory::where('id', $id)->update([
                "category_name"    => $request->category_name,
                "category_remarks" => $request->category_remarks
            ]);
            return redirect()->route('expenseCategory.edit', [$id])->with('message', 'Category has been Updated');
        } else {
            return redirect()->route('expenseCategory.edit', [$id])->with('error', 'Please fill up the required field');            
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
        $softDelete = ExpenseCategory::where('id', $id)->update(['valid' => 0]);
        if($softDelete){
            Session::flash('message','value');
            return redirect()->route('expenseCategory')->with('message', 'Category has been Deleted');
        }else{
            Session::flash('error','value');
            return redirect()->route('expenseCategory')->with('message', 'Category has not been Deleted');
        }
    }
}
