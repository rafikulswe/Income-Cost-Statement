@extends('web.layouts.master')

@section('content')
    <!--Start Income Create-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bootstrap-iso">
                        <form class="form-horizontal" method="post" action="{{route('expenseCategory.update', [$category->id])}}">
                            @method('PUT')
                            {{csrf_field()}}
                            <div class="panel panel-default">
                                <div class="panel-heading panel_heading_customize">
                                    <div class="col-md-6 text_panel_head padnone padleft">
                                        Update Expense Category
                                    </div>
                                    <div class="col-md-6 text-right padnone padright">
                                        <a href="{{route('expenseCategory')}}" class="btn btn-info btn-fill btn-sm btnu"><i class="fa fa-th"></i> All Expense Category</a>
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
                                        <div class="form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
                                            <label for="" class="col-sm-3 control-label">Category Name <span class="req_star">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="category_name" class="form-control input_field" id="" value="{{$category->category_name}}">
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('category_name') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('category_remarks') ? ' has-error' : '' }}">
                                            <label for="" class="col-sm-3 control-label">Remarks <span class="req_star">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="category_remarks" class="form-control input_field" id="" value="{{$category->category_remarks}}">
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('category_remarks') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer text-center">
                                    <button type="submit" class="btn btn-fill btn-success btnu">SAVE</button>
                                    <a href="{{route('expenseCategory')}}" class="btn btn-fill btn-default btnu">Back to List</a>
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

