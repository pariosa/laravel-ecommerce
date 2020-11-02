@extends('admin.layout')

@section('content')

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add/Edit Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Categories</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- FORM START -->
        <form method="post" role="form" name="categoryForm" action="{{url('admin/add-edit-category')}}" id="CategoryForm" enctype="multipart/form=data">
          @csrf
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Add Category</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="category_name">Category Name</label>
                  <input type="text"  class="form-control" id="name" name="name" placeholder="Enter Category Name" />
                  </div>

                    <div class="form-group">
                        <label for="category_name">Select Category Level</label>
                          <select class="form-control select2" name="parent_id" style="width: 100%;">
                              <option value="0">Main Category</option>
                          </select>
                    </div>
                </div>
                <div class="col-md-6">
                  <!-- /.form-group -->
                  <div class="form-group">
                  <label for="category_name">Select Section</label>
                      <select class="form-control select2" name="section" style="width: 100%;">
                        @foreach ( $getSections as  $section)
                            <option value="{{$section->id}}">{{$section->name}}</option>
                        @endforeach
                      </select>
                  <!-- /.form-group -->
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Category Picture</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="category_image" id="category_image">
                        <label class="custom-file-label" for="category_image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>
                <!-- /.col -->
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="category_name">Category discount</label>
                    <input type="text" class="form-control" id="category_discount" name="category_discount" placeholder="Enter Category Discount" />
                  </div>
                </div>
                <div class="col-md-6">
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label for="category_url">Category Url</label>
                    <input type="text" class="form-control"  id="category_url" name="category_url" placeholder="Enter Category Url" ></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="category_description">Category Description</label>
                    <textarea type="text" class="form-control" rows="3" name="description" id="description" placeholder="Enter Category Description" ></textarea>
                  </div>
                  <div class="form-group">
                    <label for="meta_dscription">Meta Description</label>
                    <textarea type="text" class="form-control" rows="3" name="meta_description" id="meta_description" placeholder="Enter Meta Description" ></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label for="meta_dscription">Meta Title</label>
                    <textarea type="text" class="form-control" name="meta_title" id="meta_title" rows="3" placeholder="Enter Meta Title"></textarea>
                    <!-- /.form-group -->
                  </div>
                  <div class="form-group">
                    <label for="meta_dscription">Meta Keywords</label>
                    <textarea type="text" class="form-control" rows="3" name="meta_keywords" id="meta_ketwords" placeholder="Enter Meta Keywords" ></textarea>
                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
              </div>
            <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
  <!-- /.content -->
</div>
</body>
@endsection
@section('scripts')
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    //$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    //$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    //$('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>
@endsection
