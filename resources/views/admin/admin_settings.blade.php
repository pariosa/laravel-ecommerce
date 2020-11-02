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
              <li class="breadcrumb-item active">Admin Settings</li>
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
        <div class="alert alert-danger">
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
                <h3 class="card-title">Update Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" role="form" action="{{url('admin/update-admin-password')}}" id="updateAdminForm">
                <div class="card-body">@csrf   
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" value="{{$adminDetails->email}}" id="exampleInputEmail1" placeholder="Enter email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Type</label>
                        <input type="dropdown" class="form-control" name="type" value="{{$adminDetails->type}}" id="exampleInputEmail1" placeholder="Type" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Current Password</label>
                        <input type="password" class="form-control" name="password" value="{{--Auth::guard('admin')->user()->password--}}" id="password" placeholder="Password">
                        <span id="chkCurrentPwd"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">New Password</label>
                        <input type="password" class="form-control" name="new-password" id="new-password" placeholder="Enter New Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Re-Enter Password</label>
                        <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Confirm New Password">
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