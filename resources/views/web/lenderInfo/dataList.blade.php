@extends('web.layouts.master')

@section('content')
    <!--Start Income list-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="col-md-6 text_panel_head padnone">
                                    All Lender Information
                                </div>
                                <div class="col-md-6 text-right padnone">
                                    <a href="{{route('lender.create')}}" class="btn btn-info btn-fill btn-sm btnu"><i class="fa fa-plus-circle"></i> Add Lender</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <div class="content table-responsive table-full-width">
                                    @if(Session::has('message'))
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong>Success!</strong> {{Session::get('message')}}
                                        </div>
                                    @endif
                                    <table id="alltableinfo" class="table table-striped table-bordered table_customize">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($all_lenders)>0)
                                            @foreach($all_lenders as $key => $lender)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$lender->lender_name}}</td>
                                                <td>{{$lender->lender_phone}}</td>
                                                <td>{{$lender->lender_email}}</td>
                                                <td>@if($lender->total_due_amount == 0) Deactive @else Active @endif</td>
                                                <td>
                                                    <a href="{{route('lender.show', [$lender->id])}}"><i class="fa fa-universal-access fa-lg man_view"></i></a>
                                                    <a href="{{route('lender.edit', [$lender->id])}}"><i class="fa fa-edit fa-lg man_edit"></i></a>
                                                    <a id="softDelete" data-toggle="modal" data-target="#mySoftDelete" data-id="{{$lender->id}}" href="#"><i class="fa fa-trash fa-lg man_delete"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else 
                                            <tr>
                                                <td colspan="6" align="center">No data available in table</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <a href="#" class="btn btn-sm btn-fill btnu btn-primary">Excel</a>
                                <a href="#" class="btn btn-sm btn-fill btnu btn-warning">PDF</a>
                                @php
                                    $previous_url = $_SERVER['HTTP_REFERER'];
                                @endphp
                                <a href="{{url($previous_url)}}" class="btn btn-sm btn-fill btn-default btnu">Back to Previous</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="mySoftDelete" tabindex="-1" role="dialog" aria-labelledby="mySoftDeleteLabel">
        <div class="modal-dialog" role="document">
        <form method="post" action="{{route('lender.destroy', [@$lender->id])}}">
            @method('DELETE')
            {{csrf_field()}}
            <div class="modal-content primary">
            <div class="modal-header">
                <h4 class="modal-title modal_popup" id="myModalLabel">Confirm Message</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to delete?
                <input type="hidden" id="modal_id" name="modal_id">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnm btn-fill btn-sm">Confirm</button>
                <button type="button" class="btn btn-default btnm btn-fill btn-sm" data-dismiss="modal">Close</button>
            </div>
            </div>
        </form>
        </div>
    </div>
    <!-- end Income list -->         
@endsection
