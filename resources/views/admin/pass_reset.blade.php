@extends('admin.layouts.admin_app')


@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Users Profile</li>
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


      <section class="col-lg-12 connectedSortable ui-sortable">
    
    <div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
          <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">Update Password</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="{{ url('/update_password') }}" id="invoice" role="form" enctype="multipart/form-data">
          {{ csrf_field() }}
            <div class="card-body">

              <div class="form-group">
                    <label>New Password</label>
                    <input required name="password" type="password" class="form-control" value="" placeholder="New Password">
              </div> 
              
              <div class="form-group">
                <label>Verify Password</label>
                <input required name="re_password" type="password" class="form-control" value="" placeholder="Verify Password">
          </div>  
          
                 
          
          
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>  
      </div>
      <!-- /.col -->
    </div>

      </section>


      </div>
  <!-- /.content-wrapper -->

@endsection