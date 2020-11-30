@extends('admin.layouts.admin_app')


@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users View</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Users View</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

      <!-- Alert Section -->
      @if(session('success'))
      <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 
                   {{session('success')}}
                </div>
      @endif

      @if(session('delete'))
      <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              
                 {{session('delete')}}
                </div>
      @endif

    <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable ui-sortable">
          <div class="card">
              <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">Users</h3>

                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Count</th>
                      <th>User Name</th>
                      <th>User Email</th>
                      <th>User Status</th>
                      <th>User Address</th>
                      <th>User Image</th>
                      <th>Contact No</th>
                      <th>Action</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>
                    @foreach($users as $row)
                      <tr>
                      <td>{{$i}}</td>
                      <td>{{$row->name}}</td>
                      <td>{{$row->email}}</td>
                      <td>
                      @if($row->status==0)
                        <span class="badge badge-danger">Deactive</span>
                      @endif
                      @if($row->status==1)
                        <span class="badge badge-success">Active</span>
                      @endif  
                      </td>
                      <td>{{$row->address}}</td>
                      <td><img class="direct-chat-img" src="Images/{{$row->profile_pic}}" alt="avatar">  </td>
                      <td>{{$row->contact_no}}</td>

                      <td>
                       
                        @if($row->status==0)
                        <a onclick="return confirm('Do you want to activate the user\'s account ?')" href="{{url('/active_user/'.$row->id )}}" class="btn btn-block btn-success">Active</a>
                        @endif
                        @if($row->status==1)
                        <a onclick="return confirm('Do you want to deactivate the user\'s account ?')" href="{{url('/deactive_user/'.$row->id )}}" class="btn btn-block btn-danger">Deactive</a>
                        @endif
                      </td>
                      
                      <td><button type="button" class="btn btn-block btn-success">Edit</button></td>
                      <td><a onclick="return confirm('Do you want to delete this shelter?')" href="{{url('/delete_user/'.$row->id )}}" class="btn btn-block btn-danger">Delete</a></td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach                                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

          </section>   
        </div>







  </div>
  <!-- /.content-wrapper -->

@endsection