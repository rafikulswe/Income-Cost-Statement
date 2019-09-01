@extends('web.layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="col-md-6 text_panel_head padnone ">
                                    View Expense Details
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <table class="table table-striped table-bordered view_table"> 
                                        <tr>
                                            <td>Category Name</td>
                                            <td>:</td>
                                            <td>
                                                {{$expense->category_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Expense Name</td>
                                            <td>:</td>
                                            <td>
                                                {{$expense->expense_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Expense Date</td>
                                            <td>:</td>
                                            <td>
                                                {{$expense->expense_date}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Expense Amount</td>
                                            <td>:</td>
                                            <td>
                                                {{$expense->expense_amount}} ৳
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Created Time</td>
                                            <td>:</td>
                                            <td>
                                                {{$expense->created_at}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Remarks</td>
                                            <td>:</td>
                                            <td>
                                                {{$expense->expense_details}}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="panel-footer">
                                <a href="#" class="btn btn-sm btn-fill btnu btn-primary printMe">Print</a>
                                <a href="{{route('expense')}}" class="btn btn-sm btn-fill btn-default btnu">Back to List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javaScript')
<script>
    $( document ).ready(function() {
        $('.printMe').click(function(){
            window.print();
        });
    });
    
</script>
@endpush