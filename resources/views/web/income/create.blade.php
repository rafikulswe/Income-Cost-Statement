@extends('web.layouts.master')

@section('content')
    <!--Start Income Create-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bootstrap-iso">
                        <form class="form-horizontal" method="post" action="{{route('income.store')}}">
                            {{csrf_field()}}
                            <div class="panel panel-default">
                                <div class="panel-heading panel_heading_customize">
                                    <div class="col-md-6 text_panel_head padnone padleft">
                                        Add Income
                                    </div>
                                    <div class="col-md-6 text-right padnone padright">
                                        <a href="{{route('income')}}" class="btn btn-info btn-fill btn-sm btnu"><i class="fa fa-th"></i> All Income</a>
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
                                        <div class="form-group{{ $errors->has('income_category_id') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Income Category <span class="req_star">*</span></label>
                                            <div class="col-sm-4">
                                                <select class="form-control selbox" name="income_category_id">
                                                    <option value="">Select Category</option>
                                                    @foreach($income_categories as $category)
                                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('income_category_id') }}</strong>
                                                </span>
                                            </div>
                                            <div class="col-sm-2">
                                                <a href="{{route('incomeCategory.create')}}" class="btn btn-sm btn-fill btnu btn-primary">Add Category</a>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('income_name') ? ' has-error' : '' }}">
                                            <label for="income_name" class="col-sm-3 control-label">Income Name <span class="req_star">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" name="income_name" class="form-control input_field" id="income_name" value="{{old('income_name')}}">
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('income_name') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('income_amount') ? ' has-error' : '' }}">
                                            <label for="income_amount" class="col-sm-3 control-label">Amount <span class="req_star">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" name="income_amount" class="form-control input_field" id="income_amount" value="{{old('income_amount')}}" kl_virtual_keyboard_secure_input="on" data-fv-regexp="true" data-fv-regexp-regexp="^[0-9+\s\.]+$" data-fv-regexp-message="Amount can consist of number only">
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('income_amount') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('income_date') ? ' has-error' : '' }}">
                                            <label for="income_date" class="col-sm-3 control-label">Income Date <span class="req_star">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" name="income_date" class="form-control input_field pick_date" id="income_date" value="{{old('income_date')}}">
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('income_date') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('income_details') ? ' has-error' : '' }}">
                                            <label for="income_details" class="col-sm-3 control-label">Remarks</label>
                                            <div class="col-sm-6">
                                                <textarea name="income_details" class="form-control input_field" id="income_details" cols="30" rows="2"></textarea>
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('income_details') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer text-center">
                                    <button type="submit" class="btn btn-fill btn-success btnu">SAVE</button>
                                    <a href="{{route('income')}}" class="btn btn-fill btn-default btnu">Back to List</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end Income Create -->         
@endsection

