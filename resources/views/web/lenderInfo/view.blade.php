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
                                    Loaner Information
                                </div>
                                <div class="col-md-6 text-right padnone">
                                    <a href="{{route('lender')}}" class="btn btn-info btn-fill btn-sm btnu"><i class="fa fa-th"></i> All Loaner</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-1"></div>
                                <div class="col-md-2 details_pic_part">
                                    <img class="img-responsive img-thumbnail" src="{{asset('public/contents/img/avatar.png')}}" alt=""/>
                                </div>
                                <div class="col-md-7 details_part">
                                    <table class="table table-striped table-bordered view_table details_table">
                                        <tr>
                                            <th colspan="3"><i class="fa fa-user-circle"></i> Personal Information</th>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td>:</td>
                                            <td>
                                                {{$lender->lender_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>:</td>
                                            <td>
                                                {{$lender->lender_phone}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td>
                                                {{$lender->lender_email}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Remarks</td>
                                            <td>:</td>
                                            <td>
                                                {{$lender->lender_remarks}}
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="table table-striped table-bordered view_table details_table">
                                        <tr>
                                            <th colspan="3"><i class="fa fa-gg-circle"></i> Payment Information</th>
                                        </tr>
                                        <tr>
                                            <td>Total Received Amount</td>
                                            <td>:</td>
                                            <td>
                                                @if(@$total_received_amount > 0)
                                                ৳ {{@$total_received_amount}}/=  
                                                @else 
                                                ৳ {{@$total_received_amount}}/=  
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total Payment Amount</td>
                                            <td>:</td>
                                            <td>
                                                @if(@$total_payment_amount > 0)
                                                ৳ {{@$total_payment_amount}}/=  
                                                @else 
                                                ৳ {{@$total_payment_amount}}/=  
                                                @endif
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Total Payable/ Total Due</td>
                                            <td>:</td>
                                            <td>@if(@$total_due_amount > 0)
                                                ৳ {{@$total_due_amount}}/=  (I have to pay)
                                                @else 
                                                ৳ {{@$total_due_amount}}/=  (He/She have to pay)
                                                @endif
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td>Last Payment Date</td>
                                            <td>:</td>
                                            <td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Last Received Date</td>
                                            <td>:</td>
                                            <td>
                                            </td>
                                        </tr> --}}
                                    </table>
                                    
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
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
                                    <div class="col-md-6">
                                        <table id="" class="table table-striped table-bordered details_table">
                                            <tr>
                                                <th colspan="7"><i class="fa fa-gg-circle"></i> Payment Status (Taken Loan)</th>
                                            </tr>
                                        </table>
                                        <table id="loanerstatus" class="table table-striped table-responsive table-bordered details_table details_status">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th class="xs-hidden">Next Transaction Date</th>
                                                    <th>Category</th>
                                                    <th>Credit</th>
                                                    <th>Debit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($all_received_loans) > 0 || count($all_paid_loans) > 0)
                                                <?php $total_credit_amount = 0; ?>
                                                @foreach ($all_received_loans as $received_loan)
                                                <tr>
                                                    <td>{{$received_loan->transaction_date}}</td>
                                                    <td class="xs-hidden">{{$received_loan->return_date}}</td>
                                                    <td>Received</td>
                                                    <td align="right">{{$received_loan->amount}}</td>
                                                    <td>---</td>
                                                </tr>
                                                <?php $total_credit_amount += $received_loan->amount; ?>
                                                @endforeach

                                                @foreach ($all_paid_loans as $paid_loan)
                                                <?php $total_debit_amount = 0; ?>
                                                <tr>
                                                    <td>{{$paid_loan->transaction_date}}</td>
                                                    <td class="xs-hidden">{{$paid_loan->return_date}}</td>
                                                    <td>Paid</td>
                                                    <td>---</td>
                                                    <td align="right">{{$paid_loan->amount}}</td>
                                                </tr>
                                                <?php $total_debit_amount += $paid_loan->amount; ?>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3" style="text-align:right;">Total:</th>
                                                    <th colspan="1" style="text-align:right;">৳ {{@$total_credit_amount}}</th>
                                                    <th colspan="1" style="text-align:right;">৳ {{@$total_debit_amount}}</th>
                                                </tr>
                                            </tfoot>
                                            @endif
                                        </table>
                                        <a href="#" class="btn btn-sm btn-fill btnu btn-primary" data-toggle="modal" data-target=".loan_received_part">Loan Received</a>
                                        <a href="#" class="btn btn-sm btn-fill btnu btn-info" data-toggle="modal" data-target=".loan_paid_part">Loan Paid</a>
                                    </div>
                                    <div class="col-md-6">
                                        <table id="" class="table table-striped table-bordered details_table">
                                            <tr>
                                                <th colspan="7"><i class="fa fa-gg-circle"></i> Payment Status (Given Loan)</th>
                                            </tr>
                                        </table>
                                        <table id="loanerstatus" class="table table-striped table-responsive table-bordered details_table details_status">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th class="xs-hidden">Next Transaction Date</th>
                                                        <th>Category</th>
                                                        <th>Credit</th>
                                                        <th>Debit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($all_given_loans) > 0 || count($all_payment_loans) > 0)
                                                    <?php $total_given_credit_amount = 0; ?>
                                                    @foreach ($all_given_loans as $given_loan)
                                                    <tr>
                                                        <td>{{$given_loan->transaction_date}}</td>
                                                        <td class="xs-hidden">{{$given_loan->return_date}}</td>
                                                        <td>Given</td>
                                                        <td>{{$given_loan->amount}}</td>
                                                        <td>---</td>
                                                    </tr>
                                                    <?php $total_given_credit_amount += $given_loan->amount; ?>
                                                    @endforeach
    
                                                    @foreach ($all_payment_loans as $payment_loan)
                                                    <?php $total_payment_credit_amount = 0; ?>
                                                    <tr>
                                                        <td>{{$payment_loan->transaction_date}}</td>
                                                        <td class="xs-hidden">{{$payment_loan->return_date}}</td>
                                                        <td>Payment</td>
                                                        <td>---</td>
                                                        <td>{{$payment_loan->amount}}</td>
                                                    </tr>
                                                    <?php $total_payment_credit_amount += $payment_loan->amount; ?>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3" style="text-align:right;">Total:</th>
                                                        <th colspan="1" style="text-align:right;">৳ {{@$total_given_credit_amount}}</th>
                                                        <th colspan="1" style="text-align:right;">৳ {{@$total_payment_credit_amount}}</th>
                                                    </tr>
                                                </tfoot>
                                                @else 
                                                <tbody>
                                                    <tr>
                                                        <td colspan="5" align="center">No Transaction are available.</td>
                                                    </tr>
                                                </tbody>
                                                @endif
                                                
                                            </table>
                                        <a href="#" class="btn btn-sm btn-fill btnu btn-success" data-toggle="modal" data-target=".loan_given_part">Loan Given</a>
                                        <a href="#" class="btn btn-sm btn-fill btnu btn-default" data-toggle="modal" data-target=".loan_payment_part">Loan Payment</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <a href="#" class="btn btn-sm btn-fill btnu btn-primary">Excel</a>
                                <a href="#" class="btn btn-sm btn-fill btnu btn-warning">PDF</a>
                                <a href="{{route('lender')}}" class="btn btn-sm btn-default btnu">Back to Lender List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Loan Received modal code start-->
    <div class="modal fade loan_received_part" tabindex="-1" role="dialog" aria-labelledby="loanRecModalLabel" id="loan_received_part">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title modal_popup" id="loanRecModalLabel">Loan Receive Form</h4>
            </div>
            <form class="form-horizontal" method="post" action="{{route('lenderLoanTransaction', [1])}}">
            {{csrf_field()}}
            <div class="modal-body">
                <div class="popup_box_input">
                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                    <label for="amount" class="col-sm-3 control-label">Received Amount <span class="req_star">*</span></label>
                    <div class="col-sm-8">
                        <input type="hidden" name="lender_id" class="form-control pop_input_field" id="" value="{{$lender->id}}">
                        <input type="text" required name="amount" class="form-control pop_input_field" id="amount" value="{{old('amount')}}">
                        <span class="help-block">
                            <strong>{{ $errors->first('amount') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('transaction_date') ? ' has-error' : '' }}">
                    <label for="transaction_date" class="col-sm-3 control-label">Received Date<span class="req_star">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" required name="transaction_date" class="form-control pop_input_field datepicker_date" id="transaction_date" value="{{old('transaction_date')}}">
                        <span class="help-block">
                            <strong>{{ $errors->first('transaction_date') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('return_date') ? ' has-error' : '' }}">
                    <label for="return_date" class="col-sm-3 control-label">Loan Paid Date<span class="req_star">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" required name="return_date" class="form-control pop_input_field datepicker_redate" id="return_date" value="{{old('return_date')}}">
                        <span class="help-block">
                            <strong>{{ $errors->first('return_date') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="remarks" class="col-sm-3 control-label">Remarks</label>
                    <div class="col-sm-8">
                        <input type="text" name="remarks" class="form-control pop_input_field" id="remarks" value="{{old('remarks')}}">
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary btn-fill btnu">Save</button>
            <button type="button" class="btn btn-sm btn-default btn-fill btnu" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    <!--Loan Paid modal code start-->
    <div class="modal fade loan_paid_part" tabindex="-1" role="dialog" aria-labelledby="loanPaidModalLabel" id="loan_paid_part">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title modal_popup" id="loanPaidModalLabel">Loan Paid Form</h4>
            </div>
            <form class="form-horizontal" method="post" action="{{route('lenderLoanTransaction', [2])}}">
            {{csrf_field()}}
            <div class="modal-body">
                <div class="popup_box_input">
                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                    <label for="amount" class="col-sm-3 control-label">Paid Amount <span class="req_star">*</span></label>
                    <div class="col-sm-8">
                        <input type="hidden" name="lender_id" class="form-control pop_input_field" id="" value="{{$lender->id}}">
                        <input type="text" required name="amount" class="form-control pop_input_field" id="amount" value="{{old('amount')}}">
                        <span class="help-block">
                            <strong>{{ $errors->first('amount') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('transaction_date') ? ' has-error' : '' }}">
                    <label for="transaction_date" class="col-sm-3 control-label">Paid Date<span class="req_star">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" required name="transaction_date" class="form-control pop_input_field datepicker_date" id="transaction_date" value="{{old('transaction_date')}}">
                        <span class="help-block">
                            <strong>{{ $errors->first('transaction_date') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('return_date') ? ' has-error' : '' }}">
                    <label for="return_date" class="col-sm-3 control-label">Next Paid Date</label>
                    <div class="col-sm-8">
                        <input type="text" name="return_date" class="form-control pop_input_field datepicker_redate" id="return_date" value="{{old('return_date')}}">
                        <span class="help-block">
                            <strong>{{ $errors->first('return_date') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="remarks" class="col-sm-3 control-label">Remarks</label>
                    <div class="col-sm-8">
                        <input type="text" name="remarks" class="form-control pop_input_field" id="remarks" value="{{old('remarks')}}">
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary btn-fill btnu">Save</button>
            <button type="button" class="btn btn-sm btn-default btn-fill btnu" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    <!--Loan Given modal code start-->
    <div class="modal fade loan_given_part" tabindex="-1" role="dialog" aria-labelledby="loanGivenModalLabel" id="loan_given_part">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title modal_popup" id="loanGivenModalLabel">Loan Given Form</h4>
            </div>
            <form class="form-horizontal" method="post" action="{{route('lenderLoanTransaction', [3])}}">
            {{csrf_field()}}
            <div class="modal-body">
                <div class="popup_box_input">
                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                    <label for="amount" class="col-sm-3 control-label">Given Amount <span class="req_star">*</span></label>
                    <div class="col-sm-8">
                        <input type="hidden" name="lender_id" class="form-control pop_input_field" id="" value="{{$lender->id}}">
                        <input type="text" required name="amount" class="form-control pop_input_field" id="amount" value="{{old('amount')}}">
                        <span class="help-block">
                            <strong>{{ $errors->first('amount') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('transaction_date') ? ' has-error' : '' }}">
                    <label for="transaction_date" class="col-sm-3 control-label">Given Date<span class="req_star">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" required name="transaction_date" class="form-control pop_input_field datepicker_date" id="transaction_date" value="{{old('transaction_date')}}">
                        <span class="help-block">
                            <strong>{{ $errors->first('transaction_date') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('return_date') ? ' has-error' : '' }}">
                    <label for="return_date" class="col-sm-3 control-label">Payment Date<span class="req_star">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" required name="return_date" class="form-control pop_input_field datepicker_redate" id="return_date" value="{{old('return_date')}}">
                        <span class="help-block">
                            <strong>{{ $errors->first('return_date') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="remarks" class="col-sm-3 control-label">Remarks</label>
                    <div class="col-sm-8">
                        <input type="text" name="remarks" class="form-control pop_input_field" id="remarks" value="{{old('remarks')}}">
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary btn-fill btnu">Save</button>
            <button type="button" class="btn btn-sm btn-default btn-fill btnu" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    <!--Loan Payment modal code start-->
    <div class="modal fade loan_payment_part" tabindex="-1" role="dialog" aria-labelledby="loanPaymentModalLabel" id="loan_payment_part">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title modal_popup" id="loanPaymentModalLabel">Loan Payment Form</h4>
            </div>
            <form class="form-horizontal" method="post" action="{{route('lenderLoanTransaction', [4])}}">
            {{csrf_field()}}
            <div class="modal-body">
                <div class="popup_box_input">
                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                    <label for="amount" class="col-sm-3 control-label">Payment Amount <span class="req_star">*</span></label>
                    <div class="col-sm-8">
                        <input type="hidden" name="lender_id" class="form-control pop_input_field" id="" value="{{$lender->id}}">
                        <input type="text" required name="amount" class="form-control pop_input_field" id="amount" value="{{old('amount')}}">
                        <span class="help-block">
                            <strong>{{ $errors->first('amount') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('transaction_date') ? ' has-error' : '' }}">
                    <label for="transaction_date" class="col-sm-3 control-label">Payment Date<span class="req_star">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" required name="transaction_date" class="form-control pop_input_field datepicker_date" id="transaction_date" value="{{old('transaction_date')}}">
                        <span class="help-block">
                            <strong>{{ $errors->first('transaction_date') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('return_date') ? ' has-error' : '' }}">
                    <label for="return_date" class="col-sm-3 control-label">Next Payment Date<span class="req_star">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" name="return_date" class="form-control pop_input_field datepicker_redate" id="return_date" value="{{old('return_date')}}">
                        <span class="help-block">
                            <strong>{{ $errors->first('return_date') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="remarks" class="col-sm-3 control-label">Remarks</label>
                    <div class="col-sm-8">
                        <input type="text" name="remarks" class="form-control pop_input_field" id="remarks" value="{{old('remarks')}}">
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary btn-fill btnu">Save</button>
            <button type="button" class="btn btn-sm btn-default btn-fill btnu" data-dismiss="modal">Close</button>
            </div>
            </form>
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