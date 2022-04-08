@extends('layouts.master')


@section('title')
Labsoft Test Setup
@endsection

@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-lg-10">
                                <h1 class="h3 mb-2 text-gray-800">Test Setup</h1>
                                </div>
                                <div class="col-lg-2">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addtestmodal">Add Test Setup</a>
                                </div>
                            </div>
                            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <button class="btn btn-primary">Add test</button> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered test-datatable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Test Id</th>
                                            <th>Test Name</th>
                                            <th>Report Heading</th>
                                            <th>Test Charges</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                               
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>


<!-- Add test Modal -->
<div class="modal fade" id="addtestmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Test Setup</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="addtestform" action="{{route('add.testsetup')}}" method="post" enctype="multipart/form-data">
          @csrf

      <div class="row">
                <div class="col-lg-7 mb-3">
                    <label  class="form-label">Test Name</label>
                    <input type="text" class="form-control name"  name="test_name"  placeholder="Enter Test Name"  />
                    <span class="text-center error-text test_name_error"></span>
                 </div>
                 <div class="col-lg-5 mb-3">
                 <label  class="form-label">Report Heading</label>
                    <input type="text" class="form-control name"  name="report_heading"  placeholder="Enter Report Heading"  />
                    <span class="text-center error-text report_heading_error"></span>
                 </div>
       </div>
       <div class="row">
                <div class="col-lg-4 mb-3">
                <label  class="form-label">Carry Out</label>
                    <input type="text" class="form-control type"  name="carry_out"  placeholder="Carry Out"  />
                    <span class="text-center error-text carry_out_error"></span>
                 </div>
                 <div class="col-lg-4 mb-3">
                 <label  class="form-label">Test Charges</label>
                    <input type="text" class="form-control type"  name="test_charge"  placeholder="Test Charges"  />
                    <span class="text-center error-text test_charge_error"></span>
                 </div>
                 <div class="col-lg-4 mb-3">
                    <label  class="form-label">Report Completion</label>
                    <input type="text" class="form-control type"  name="report_completion"  placeholder="Report  Completion"  />
                    <span class="text-center error-text report_completion_error"></span>
                
                 </div>

       </div>      

        <button type="submit" class="btn btn-primary">Save</button>
       
       </form>
      </div>

    </div>
  </div>
</div>

<!--End Add test Modal -->


<!-- Add Edit Modal -->
<div class="modal fade" id="edittestmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update test</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="edittestform" action="{{route('update.testsetup.details')}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" class="form-control name"  name="tsid"  />
          <div class="row">
                <div class="col-lg-7 mb-3">
                    <label  class="form-label">Test Name</label>
                    <input type="text" class="form-control name"  name="test_name"  placeholder="Enter Test Name"  />
                    <span class="text-center error-text test_name_error"></span>
                 </div>
                 <div class="col-lg-5 mb-3">
                 <label  class="form-label">Report Heading</label>
                    <input type="text" class="form-control name"  name="report_heading"  placeholder="Enter Report Heading"  />
                    <span class="text-center error-text report_heading_error"></span>
                 </div>
       </div>
       <div class="row">
                <div class="col-lg-4 mb-3">
                <label  class="form-label">Carry Out</label>
                    <input type="text" class="form-control type"  name="carry_out"  placeholder="Carry Out"  />
                    <span class="text-center error-text carry_out_error"></span>
                 </div>
                 <div class="col-lg-4 mb-3">
                 <label  class="form-label">Test Charges</label>
                    <input type="text" class="form-control type"  name="test_charge"  placeholder="Test Charges"  />
                    <span class="text-center error-text test_charge_error"></span>
                 </div>
                 <div class="col-lg-4 mb-3">
                    <label  class="form-label">Report Completion</label>
                    <input type="text" class="form-control type"  name="report_completion"  placeholder="Report  Completion"  />
                    <span class="text-center error-text report_completion_error"></span>
                
                 </div>

       </div>      
        <button type="submit" class="btn btn-primary">Update</button>
       
       </form>
      </div>

    </div>
  </div>
</div>

<!--End Add Edit Modal -->


@endsection

@section('script')

<script  type="text/javascript">

$.ajaxSetup({
     headers:{
         'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
     }
    });
    
        $(function(){

            //ADD test
            $('#addtestform').on('submit',function(e){
            e.preventDefault();
            var form=this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                $(form).find('span.error-text').text();
                },
                success:function(data){
                 if(data.code == 0){
                   $.each(data.error,function(prefix,val){
                   $(form).find('span.'+prefix+'_error').text(val[0]).show("slow").delay(5000).hide("slow");
                   })
                 }else{
                    console.log(data);
                    $(form)[0].reset();
                    alertify.set('notifier','position', 'top-right');
                    $("#addtestmodal").modal('hide');
                    $(".test-datatable").DataTable().ajax.reload(null,false)
                    alertify.success(data.msg);
                 }
                }
            })
            });

         //END ADD test

        /// GET ALL testES IN LIST

        var table = $('.test-datatable').DataTable({
        "order": [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: "{{ route('get.testsetup.list') }}",

        columns: [
            {data: 'id', name: 'id'},
            {data: 'test_name', name: 'test_name'},
            {data: 'report_heading', name: 'report_heading'},
            {data: 'test_charge', name: 'test_charge'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });

    /// END GET ALL testES IN LIST
    /// GET test IN POPUP

    $(document).on('click',"#EditTest",function(){
        var testsetup_id=$(this).data('id');
        // alert(test_id);
        $.post('<?= route('get.testsetup.details') ?>',{testsetup_id:testsetup_id},function(data){
            $("#edittestmodal").find('input[name="tsid"]').val(data.details.id);
            $("#edittestmodal").find('input[name="test_name"]').val(data.details.test_name);
            $("#edittestmodal").find('input[name="report_heading"]').val(data.details.report_heading);
            $("#edittestmodal").find('input[name="carry_out"]').val(data.details.carry_out);
            $("#edittestmodal").find('input[name="test_charge"]').val(data.details.test_charge);
            $("#edittestmodal").find('input[name="report_completion"]').val(data.details.report_completion);
            $("#edittestmodal").modal('show');

        },'json');
    });

        /// END GET test IN POPUP

        /// UPDATE test IN POPUP
        $('#edittestform').on('submit',function(e){
            e.preventDefault();
            var form=this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                $(form).find('span.error-text').text();
                },
                success:function(data){
                 if(data.code == 0){
                   $.each(data.error,function(prefix,val){
                   $(form).find('span.'+prefix+'_error').text(val[0]).show("slow").delay(5000).hide("slow");
                   })
                 }else{
                    console.log(data);
                    $(form)[0].reset();
                    alertify.set('notifier','position', 'top-right');
                    $("#edittestmodal").modal('hide');
                    $(".test-datatable").DataTable().ajax.reload(null,false)
                    alertify.success(data.msg);
                 }
                }
            })
            });
        /// END UPDATE test IN POPUP

        /// DELETE test
        $(document).on('click',"#DeleteTest",function(){
        var testsetup_id=$(this).data('id');
        var url='<?= route('delete.testsetup') ?>';


        $.post(url,{testsetup_id:testsetup_id},function(data){
                            if(data.code == 1){
                                $(".test-datatable").DataTable().ajax.reload(null,false)
                                alertify.set('notifier','position', 'top-right');
                                alertify.success(data.msg);
                            }
                    },'json');

        // swal.fire({
        //     title:'Are You Sure',
        //     html:'You Want To <b>Delete</b> This test',
        //     showCancelButton:true,
        //     showCloseButton:true,
        //     cancelButtonText:'Cancel',
        //     confirmButtonText:'Yes,Delete',
        //     cancelButtonColor:'#d33',
        //     confirmButtonColor:'#556eed',
        //     width:300,
        //     allowOutsideClick:false
        // }).then(function(result){
        //  if(result.value){

        //               }
        // });

        });
        /// END DELETE test
        });


</script>


@endsection