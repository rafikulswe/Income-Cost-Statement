@extends('web.layouts.master')

@section('content')
    <!--Start todo list-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-sm-6">
                    <div class="card">
                        <div class="content">
                            <div class="row">
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
                            </div>
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="icon-big icon-primary text-center manage_icon">
                                        <i class="fa fa-address-book"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="manage_text_part">
                                        <p>Add New Note</p>
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <a href="{{route('todoList.create')}}"><i class="fa fa-share-square fa-lg"></i> Add New Note</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($todoLists as $todo)
                <div class="col-lg-12 col-sm-6">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="icon-big icon-primary text-center manage_icon">
                                        <?php 
                                        $created_at = DateTime::createFromFormat("Y-m-d H:i:s", $todo->created_at)->format('Y m d g:i A');    
                                        ?>
                                        <p style="font-size:16px;">{{$created_at}}</p>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="manage_text_part">
                                        <p style="font-size:16px;">{{$todo->title}}</p>
                                        <p style="font-size:12px;"><?php echo nl2br($todo->note); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <a href="{{route('todoList.edit', [$todo->id])}}"><i class="fa fa-edit fa-lg man_edit"></i> Edit Note</a>
                                    <a id="softDelete" data-toggle="modal" data-target="#mySoftDelete" data-id="{{$todo->id}}" href="#" style="color:red;"><i class="fa fa-trash fa-lg man_delete"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="mySoftDelete" tabindex="-1" role="dialog" aria-labelledby="mySoftDeleteLabel">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('todoList.destroy', [@$todo->id])}}">
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
    <!-- end todo list -->         
@endsection
