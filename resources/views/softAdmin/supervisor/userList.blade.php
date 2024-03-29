@extends('softAdmin.master')

@section('content')
        <!--Start Dashboard-->
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>
        
                <h2 class="panel-title">Supervisor List</h2>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6" style="float:right;">
                        <div class="mb-md" style="float:right;">
                            <a href="{{route('admin.createSupervisor')}}" class="btn btn-primary create">Add <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped mb-none">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Supervisor ID</th>
                            <th>Supervisor Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr class="gradeX">
                            <td>{{ ++$key }}</td>
                            <td>{{$user->generate_emp_id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->sort_name}}</td>
                            <td>{{$user->designation}}</td>
                            <td class="actions">
                                <a href="{{route('admin.editSupervisor',$user->id)}}" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        <!-- end Dashboard -->
    </section>            
@endsection
