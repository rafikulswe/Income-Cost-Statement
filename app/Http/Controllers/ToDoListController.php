<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;
use DateTime;
use Session;
use App\TodoList;

class ToDoListController extends Controller
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
        $data['todoLists'] = TodoList::where('user_id', $user_id)->where('valid', 1)->get();
        return view('web.todoList.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.todoList.create');
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
            'title'    => 'required'
        ]);

        if ($validator->passes()) {
            TodoList::create([
                "title"   => $request->title,
                "note"    => $request->note,
                "user_id" => $user_id
            ]);
            return redirect()->route('todoList')->with('message', 'Note has been Created');
        } else {
            return redirect()->route('todoList')->with('error', 'Please fill up the required field');
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
        //
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
        $data['todo'] = TodoList::where('user_id', $user_id)->find($id);
        return view('web.todoList.edit', $data);
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
            'title'    => 'required'
        ]);

        if ($validator->passes()) {
            TodoList::where('user_id', $user_id)->where('id', $id)->update([
                "title"   => $request->title,
                "note"    => $request->note
            ]);
            return redirect()->route('todoList')->with('message', 'Note has been Updated');
        } else {
            return redirect()->route('todoList')->with('error', 'Please fill up the required field');
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
        $softDelete = TodoList::where('id', $id)->update(['valid' => 0]);
        if($softDelete){
            Session::flash('message','value');
            return redirect()->route('todoList')->with('message', 'Note has been Deleted');
        }else{
            Session::flash('error','value');
            return redirect()->route('todoList')->with('message', 'Note has not been Deleted');
        }
    }
}
