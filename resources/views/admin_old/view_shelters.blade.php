@extends('admin.layouts.admin_app')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>View Shelters</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
            <li class="breadcrumb-item active">View Shelters</li>
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

  @if(Auth::check() && (Auth::user()->role == 2))
  <div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable ui-sortable">
      <div class="card">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
          <h3 class="card-title">Shelters</h3>

          <div class="card-tools">
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>Count</th>
                <th>Shelter Name</th>
                <th>Rooms</th>
                <th>Contact No</th>
                <th>Website</th>
                <th>Description</th>
                <th>Address</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @foreach($shel_user as $row)
              <tr>
                <td>{{$i}}</td>
                <td>{{$row->shel_name}}</td>
                <td>{{$row->shel_rooms}}</td>
                <td>{{$row->shel_contact_1}}</td>
                <td>{{$row->website}}</td>
                <td>{{$row->shel_description}}</td>
                <td>{{$row->shel_address}}</td>
                <td>{{$row->shel_city}}</td>
                <td>{{$row->shel_postal_code}}</td>
                <td>
                  @if($row->shel_status==0)
                  <span class="badge badge-danger">Deactive</span>
                  @endif
                  @if($row->shel_status==1)
                  <span class="badge badge-success">Active</span>
                  @endif
                </td>

                <td><a onclick="return confirm('Do you want to edit this shelter?')"
                    href="{{url('/edit_shelter/'.$row->id )}}" class="btn btn-block btn-success">Edit</a></td>
                <td><a onclick="return confirm('Do you want to delete this shelter?')"
                    href="{{url('/delete_shelter/'.$row->id )}}" class="btn btn-block btn-danger">Delete</a></td>
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
  @endif


  @if(Auth::check() && (Auth::user()->role == 1))
  <div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable ui-sortable">
      <div class="card">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
          <h3 class="card-title">Shelters</h3>

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
                <th>Shelter Name</th>
                <th>Rooms</th>
                <th>Contact No</th>
                <th>Website</th>
                <th>Description</th>
                <th>Address</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Status</th>
                <th>Action</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @foreach($admin_user as $row)
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
                <td>{{$row->shel_name}}</td>

                <td>{{$row->shel_rooms}}</td>
                <td>{{$row->shel_contact_1}}</td>
                <td>{{$row->website}}</td>
                <td>{{$row->shel_description}}</td>
                <td>{{$row->shel_address}}</td>
                <td>{{$row->shel_city}}</td>
                <td>{{$row->shel_postal_code}}</td>
                <td>
                  @if($row->shel_status==0)
                  <span class="badge badge-danger">Deactive</span>
                  @endif
                  @if($row->shel_status==1)
                  <span class="badge badge-success">Active</span>
                  @endif
                </td>
                <td>
                  @if($row->shel_status==0)
                  <a onclick="return confirm('Do you want to activate this shelter?')"
                    href="{{url('/active_shelter/'.$row->id )}}" class="btn btn-block btn-success">Active</a>
                  @endif
                  @if($row->shel_status==1)
                  <a onclick="return confirm('Do you want to deactivate this shelter?')"
                    href="{{url('/deactive_shelter/'.$row->id )}}" class="btn btn-block btn-danger">Deactive</a>
                  @endif
                </td>

                <td><a onclick="return confirm('Do you want to edit this shelter?')"
                    href="{{url('/edit_shelter/'.$row->id )}}" class="btn btn-block btn-success">Edit</a></td>
                <td><a onclick="return confirm('Do you want to delete this shelter?')"
                    href="{{url('/delete_shelter/'.$row->id )}}" class="btn btn-block btn-danger">Delete</a></td>
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
  @endif

</div>
<!-- /.content-wrapper -->

@endsection