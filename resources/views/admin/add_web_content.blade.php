@extends('admin.layouts.admin_app')


@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Web Content <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
              Create Content
            </button></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Web Content</li>
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



  <!-- modal -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create Module </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="post" action="{{url('/create_content')}}">
            @csrf
          <div class="form-group">
            <label for="">Content Name</label>
            <input name="content_name" class="form-control" type="text" placeholder="Content Name">
          </div>
          <div class="form-group">
            <label for="">Content Code</label>
            <input name="content_code" class="form-control" type="text" placeholder="Content Code">
          </div>
          <div class="form-group">
            <label for="">Status</label>
            <select name="status" class="custom-select group-select">
              <option value="0">Deactive</option>
              <option value="1">Active</option>
          </select>
          </div>
  
          <div class="form-group">
            <label for="">Content Description</label>
            <textarea class="form-control" name="content"></textarea>
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Module</button>
        </div>
      </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


    <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable ui-sortable">
          <div class="card">
              <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">Web Content</h3>

                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Content Name</th>
                      <th>Content Code</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Edit</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>
                    @foreach($content as $row)
                      <tr>
                      <td>{{$i}}</td>
                      <td>{{$row->content_name}}</td>
                      <td>{{$row->content_code}}</td>
                      <td>{{$row->content}}</td>
                      <td>
                      @if($row->status==0)
                        <span class="badge badge-danger">Deactive</span>
                      @endif
                      @if($row->status==1)
                        <span class="badge badge-success">Active</span>
                      @endif  
                      <td>
                        @if($row->status==0)
                        <a onclick="return confirm('Do you want to active this content?')" href="{{url('/active_content/'.$row->id )}}" class="btn btn-block btn-success">Active</a>
                        @endif
                        @if($row->status==1)
                        <a onclick="return confirm('Do you want to active this content?')" href="{{url('/deactive_content/'.$row->id )}}" class="btn btn-block btn-danger">Deactive</a>
                        @endif
                      </td>
                      
                      <td><a onclick="return confirm('Do you want to edit this shelter?')" href="{{url('/edit_content/'.$row->id )}}" class="btn btn-block btn-success">Edit</a></td>
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