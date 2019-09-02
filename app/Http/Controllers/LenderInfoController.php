<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Income;
use App\Lender;
use App\IncomeCategory;
use Auth;
use Validator;
use DB;
use DateTime;
use Session;

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
        $data['all_lenders'] = Lender::where('valid', 1)
                ->where('user_id', $user_id)
                ->orderBy('id', 'DESC')
                ->get();
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
        $data['lender'] = Lender::find($id);
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
}
