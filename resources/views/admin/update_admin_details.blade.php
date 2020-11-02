@extends('admin.layout')
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



<!-- Main content -->
       @if(Session::has('error_message'))
        <div class="alert alert-warning alert-dismissable fade show" role="alert">
            {{Session::get('error_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @endif
      @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissable fade show" role="alert">
            {{Session::get('success_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @endif
      @if ($errors->any())
        <div class="alert alert-danger" style="margin-top:10px">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

           <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Account details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form enctype="multipart/form-data" method="post" role="form" action="{{url('admin/update-admin-details')}}" id="updateAdminDetails">
                <div class="card-body">@csrf 
                    <div class="form-group">
                        <label for="adminEmail">Admin Email</label>
                        <input type="text" class="form-control" name="admin_email" value="{{ $adminDetails->email}}" id="adminEmail" placeholder="Enter Admin Email" readonly>
                    </div>    
                    <div class="form-group">
                        <label for="adminName">Admin Name</label>
                        <input type="text" class="form-control" name="admin_name" value="{{ $adminDetails->name}}" id="adminName" placeholder="Enter Admin Name">
                    </div>                    
                    <div class="form-group">
                        <label for="adminType">Admin Type</label>
                        <input type="dropdown" class="form-control" name="admin_type" value="{{$adminDetails->type}}" id="adminType" placeholder="Type" readonly>
                    </div>
                    <div class="form-group">
                        <label for="adminMobile">Mobile</label>
                        <input type="text" class="form-control" name="admin_mobile"  value="{{$adminDetails->mobile}}" id="mobile" placeholder="Enter Admin Mobile">
                     </div> 
                    <div class="form-group">
                        <label for="adminImage">Image</label>
                        <input type="file" class="form-control" name="admin_image" id="admin_image" placeholder="Admin Image" accept="image/*">
                        @if(!empty(Auth::guard('admin')->user()->image))
                        <img src="{{'/images/admin_image/'.Auth::guard('admin')->user()->image}}" style="max-height:100px;margin:0 auto;" />
                        <a target="_blank" href="{{'/images/admin_image/'.Auth::guard('admin')->user()->image}}">View image</a>
                        <input type="hidden" name="admin_image" value="{{Auth::guard('admin')->user()->image}}">
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

             
 
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@endsection