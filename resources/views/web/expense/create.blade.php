@extends('web.layouts.master')

@section('content')
    <!--Start Expense Create-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bootstrap-iso">
                        <form class="form-horizontal" method="post" action="{{route('expense.store')}}">
                            {{csrf_field()}}
                            <div class="panel panel-default">
                                <div class="panel-heading panel_heading_customize">
                                    <div class="col-md-6 text_panel_head padnone padleft">
                                        Add Expense
                                    </div>
                                    <div class="col-md-6 text-right padnone padright">
                                        <a href="{{route('expense')}}" class="btn btn-info btn-fill btn-sm btnu"><i class="fa fa-th"></i> All Expense</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        @if(Session::has('message'))
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong>Success!</strong> {{Session::get('message')}}
                                        </div>
                                        @endif
                                        @if(Session::has('error'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong>Error!</strong> {{Session::get('error')}}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="add_admin_info">
                                        <div class="form-group{{ $errors->has('expense_category_id') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Expense Category <span class="req_star">*</span></label>
                                            <div class="col-sm-4">
                                                <select class="form-control selbox" name="expense_category_id">
                                                    <option value="">Select Category</option>
                                                    @foreach($expense_categories as $category)
                                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('expense_category_id') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('expense_name') ? ' has-error' : '' }}">
                                            <label for="expense_name" class="col-sm-3 control-label">Expense Name <span class="req_star">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" name="expense_name" class="form-control input_field" id="expense_name" value="{{old('expense_name')}}">
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('expense_name') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('expense_amount') ? ' has-error' : '' }}">
                                            <label for="expense_amount" class="col-sm-3 control-label">Amount <span class="req_star">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" name="expense_amount" class="form-control input_field" id="expense_amount" value="{{old('expense_amount')}}" kl_virtual_keyboard_secure_input="on" data-fv-regexp="true" data-fv-regexp-regexp="^[0-9+\s\.]+$" data-fv-regexp-message="Amount can consist of number only">
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('expense_amount') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('expense_date') ? ' has-error' : '' }}">
                                            <label for="expense_date" class="col-sm-3 control-label">Income Date <span class="req_star">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" name="expense_date" class="form-control input_field pick_date" id="expense_date" value="{{old('expense_date')}}">
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('expense_date') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('expense_details') ? ' has-error' : '' }}">
                                            <label for="expense_details" class="col-sm-3 control-label">Remarks</label>
                                            <div class="col-sm-6">
                                                <textarea name="expense_details" class="form-control input_field" id="expense_details" cols="30" rows="2"></textarea>
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('expense_details') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer text-center">
                                    <button type="submit" class="btn btn-fill btn-success btnu">SAVE</button>
                                    <a href="{{route('expense')}}" class="btn btn-fill btn-default btnu">Back to List</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end Expense Create -->         
@endsection

