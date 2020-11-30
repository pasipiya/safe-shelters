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


      @foreach($users as $row)
        @endforeach
      <section class="col-lg-12 connectedSortable ui-sortable">
      <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="Images/{{$row->profile_pic}}" alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">
            @if($row->role==1)
                Admin
            @endif

            @if($row->role==2)
                Shelter Owner
            @endif
            </h3>

            <p class="text-muted text-center"></p>

            <ul class="list-group list-group-unbordered mb-3">
                              </ul>

           
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">About Me</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fas fa-book mr-1"></i>Description</strong>

            <p class="text-muted">
              {{$row->rating}}
            </p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Contact Details</strong>
            
            <p class="text-muted"> {{$row->address}}<br>
            {{$row->contact_no}}</p>
           
            <hr>

           
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->


      


    <div class="col-md-9">
      <div class="card card-primary">
          <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">Profile Update</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="{{ url('/update_profile') }}" id="invoice" role="form" enctype="multipart/form-data">
          {{ csrf_field() }}
            <div class="card-body">

              <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control" value="{{$row->name}}" placeholder="{{$row->name}}">
              </div>  
              <div class="form-group">
                    <label>Address</label>
                    <input name="address" type="text" class="form-control" value="{{$row->address}}" placeholder="{{$row->address}}">
              </div>  

              <div class="form-group">
                    <label>Contact Number</label>
                    <input name="contact_no" type="text" class="form-control" value="{{$row->contact_no}}" placeholder="{{$row->contact_no}}">
              </div>  
                 
          


              <div class="form-group">
                <label for="Message">Description</label>
                <textarea name="description" class="form-control" rows="3" placeholder=""> {{$row->rating}}</textarea>
              </div>

             
              <div class="form-group">
                <label for="exampleInputFile">Upload Your Profile Picture</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" multiple="" name="image" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                  </div>
                </div>
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