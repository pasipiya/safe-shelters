@extends('admin.layouts.admin_app')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Update Main page wording</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Update Main page wording</li>
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

  @foreach ($data as $item)

  @endforeach


  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{url('/update_content')}}">
          @csrf
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                {{$item->content_name}} -:
                <small>{{$item->content_code}}</small>
              </h3>
              <!-- tools box -->
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
                  <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                  title="Remove">
                  <i class="fas fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.card-header -->
            <input type="hidden" value="{{$item->id}}" name="id">
            <div class="card-body pad">
              <div class="mb-3">
                <textarea name="content" class="textarea" placeholder="Place some text here"
                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$item->content}}</textarea>
              </div>

            </div>
          </div>
          <input type="submit" value="Update Content" class="btn btn-success float-right">
        </form>
      </div>
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
  <!-- /.content -->


</div>
<!-- /.content-wrapper -->

@endsection


@section('script')
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

@endsection