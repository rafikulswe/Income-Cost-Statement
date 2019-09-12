@extends('web.layouts.master')

@section('content')
    <!--Start todo list-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bootstrap-iso">
                        <form class="form-horizontal" method="post" action="{{route('todoList.store')}}">
                            {{csrf_field()}}
                            <div class="panel panel-default">
                                <div class="panel-heading panel_heading_customize">
                                    <div class="col-md-6 text_panel_head padnone padleft">
                                        Add To Do List 
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <div class="add_admin_info">
                                        <div class="form-group">
                                            <label for="title" class="col-sm-3 control-label">Title<span class="req_star">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="title" class="form-control input_field" id="" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tinytextarea" class="col-sm-3 control-label">Note</label>
                                            <div class="col-sm-8">
                                                <textarea name="note" class="form-control input_field" id="tinytextarea" cols="30" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer text-center">
                                    <button type="submit" class="btn btn-fill btn-success btnu">SAVE</button>
                                    <a href="{{route('todoList')}}" class="btn btn-fill btn-default btnu">Back to List</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end todo list -->         
@endsection
