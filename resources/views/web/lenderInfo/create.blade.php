@extends('web.layouts.master')

@section('content')
    <!--Start Income Create-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bootstrap-iso">
                        <form class="form-horizontal" method="post" action="{{route('lender.store')}}">
                            {{csrf_field()}}
                            <div class="panel panel-default">
                                <div class="panel-heading panel_heading_customize">
                                    <div class="col-md-6 text_panel_head padnone padleft">
                                        Add Lender
                                    </div>
                                    <div class="col-md-6 text-right padnone padright">
                                        <a href="{{route('lender')}}" class="btn btn-info btn-fill btn-sm btnu"><i class="fa fa-th"></i> All Lender</a>
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
                                        <div class="form-group{{ $errors->has('lender_name') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Lender Name <span class="req_star">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" name="lender_name" class="form-control input_field" id="lender_name" value="{{old('lender_name')}}">
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('lender_name') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('lender_phone') ? ' has-error' : '' }}">
                                            <label for="lender_phone" class="col-sm-3 control-label">Phone <span class="req_star">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" name="lender_phone" class="form-control input_field" id="lender_phone" value="{{old('lender_phone')}}">
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('lender_phone') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('lender_email') ? ' has-error' : '' }}">
                                            <label for="lender_email" class="col-sm-3 control-label">Email <span class="req_star">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="email" name="lender_email" class="form-control input_field" id="lender_email" value="{{old('lender_email')}}" kl_virtual_keyboard_secure_input="on" data-fv-regexp="true" data-fv-regexp-regexp="^[0-9+\s\.]+$" data-fv-regexp-message="Amount can consist of number only">
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('lender_email') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('lender_remarks') ? ' has-error' : '' }}">
                                            <label for="lender_remarks" class="col-sm-3 control-label">Remarks</label>
                                            <div class="col-sm-6">
                                                <textarea name="lender_remarks" class="form-control input_field" id="lender_remarks" cols="30" rows="2"></textarea>
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('lender_remarks') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer text-center">
                                    <button type="submit" class="btn btn-fill btn-success btnu">SAVE</button>
                                    <a href="{{route('lender')}}" class="btn btn-fill btn-default btnu">Back to List</a>
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

