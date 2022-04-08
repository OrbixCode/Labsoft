@extends('layouts.master')


@section('title')
LabsoftTest Parameter
@endsection

@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-lg-10">
                                <h1 class="h3 mb-2 text-gray-800">Test Parameters</h1>
                                </div>
                                <div class="col-lg-2">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addtestparamodal">Test Parameter</a>
                                </div>
                            </div>
                            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <button class="btn btn-primary">Add test</button> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered testpara-datatable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Test Id</th>
                                            <th>Test Name</th>
                                            <th>Test Parameter Name</th>
                                            <th>For Male</th>
                                            <th>For Female</th>
                                            <th>For Infant</th>
                                            <th>Unit</th>
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
<div class="modal fade" id="addtestparamodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Test Parameter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="addtestparaform" action="{{route('add.testpara')}}" method="post" enctype="multipart/form-data">
          @csrf

      <div class="row">
                <div class="col-lg-7 mb-3">
                <label for="exampleFormControlSelect1">Select Test Name</label>
                    <select class="form-control" name="testsetup_id" >
                    <option></option>
                    @foreach($testsetup as $test)
                    <option value="{{$test->id}}">{{$test->test_name}}</option>
                    @endforeach
                    </select>
                    <span class="text-center error-text testsetup_id_error"></span>
                 </div>
                 <div class="col-lg-5 mb-3">
                 <label  class="form-label">Test Parameter Name</label>
                    <input type="text" class="form-control type"  name="test_parameter_name"  placeholder="Enter Test Parameter"  />
                    <span class="text-center error-text test_normal_range_error"></span>
                 </div>
       </div>
       <div class="row">
                <div class="col-lg-4 mb-3">
                <label class="form-label">For Male Range</label>
                    <input type="text" class="form-control type"  name="normal_range_male"  placeholder="Normal Range For Male"  />
                    <span class="text-center error-text normal_range_male_error"></span>
                 </div>
                 <div class="col-lg-4 mb-3">
                 <label  class="form-label">For Female Range</label>
                    <input type="text" class="form-control type"  name="normal_range_female"  placeholder="Normal Range For Female"  />
                    <span class="text-center error-text normal_range_female_error"></span>
                 </div>
                <div class="col-lg-4 mb-3">
                 <label  class="form-label">For Infant Range</label>
                    <input type="text" class="form-control type"  name="normal_range_infant"  placeholder="Normal Range For Infant"  />
                    <span class="text-center error-text normal_range_infant_error"></span>
                 </div>
       </div>
       <div class="row">
                <div class="col-lg-7 mb-3">
                <label for="exampleFormControlSelect1">Select Unit</label>
                    <select class="form-control" name="test_unit" >
                    <option></option>
                    <option>g/dl</option>
                    <option>10^3/ul</option>
                    <option>10^6/ul</option>
                    <option>um^3</option>
                    <option>p9</option>
                    <option>%</option>
                    </select>
                    <span class="text-center error-text test_symbols_error"></span>
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
<div class="modal fade" id="edittestparamodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update test</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="edittestparaform" action="{{route('update.testpara.details')}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" class="form-control name"  name="tid"  />
          <div class="row">
                <div class="col-lg-7 mb-3">
                <label for="exampleFormControlSelect1">Select Test Name</label>
                    <select class="form-control" name="testsetup_id" id="test_name_selected">
                    <option></option>
                    @foreach($testsetup as $test)
                    <option value="{{$test->id}}">{{$test->test_name}}</option>
                    @endforeach
                    </select>
                    <span class="text-center error-text testsetup_id_error"></span>
                 </div>
                 <div class="col-lg-5 mb-3">
                 <label  class="form-label">Test Parameter Name</label>
                    <input type="text" class="form-control type"  name="test_parameter_name"  placeholder="Enter Test Parameter"  />
                    <span class="text-center error-text test_normal_range_error"></span>
                 </div>
       </div>
       <div class="row">
                <div class="col-lg-4 mb-3">
                <label class="form-label">For Male Range</label>
                    <input type="text" class="form-control type"  name="normal_range_male"  placeholder="Normal Range For Male"  />
                    <span class="text-center error-text normal_range_male_error"></span>
                 </div>
                 <div class="col-lg-4 mb-3">
                 <label  class="form-label">For Female Range</label>
                    <input type="text" class="form-control type"  name="normal_range_female"  placeholder="Normal Range For Female"  />
                    <span class="text-center error-text normal_range_female_error"></span>
                 </div>
                <div class="col-lg-4 mb-3">
                 <label  class="form-label">For Infant Range</label>
                    <input type="text" class="form-control type"  name="normal_range_infant"  placeholder="Normal Range For Infant"  />
                    <span class="text-center error-text normal_range_infant_error"></span>
                 </div>
       </div>
       <div class="row">
                <div class="col-lg-7 mb-3">
                <label for="exampleFormControlSelect1">Select Unit</label>
                    <select class="form-control" name="test_unit" id="test_unit_selected">
                    <option></option>
                    <option value="g/dl">g/dl</option>
                    <option value="10^3/ul">10^3/ul</option>
                    <option value="10^6/ul">10^6/ul</option>
                    <option value="um^3">um^3</option>
                    <option value="p9">p9</option>
                    <option value="%">%</option>
                    </select>
                    <span class="text-center error-text test_unit_error"></span>
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
            $('#addtestparaform').on('submit',function(e){
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
                    $("#addtestparamodal").modal('hide');
                    $(".testpara-datatable").DataTable().ajax.reload(null,false)
                    alertify.success(data.msg);
                 }
                }
            })
            });

         //END ADD test

        /// GET ALL testES IN LIST

        var table = $('.testpara-datatable').DataTable({
        "order": [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: "{{ route('get.testpara.list') }}",

        columns: [
            {data: 'id', name: 'id'},
            // {data: 'testsetup_name', name: 'testsetup_name'},
            {data: 'testsetup.test_name', name: 'testsetup.test_name'},
            {data: 'test_parameter_name', name: 'test_parameter_name'},
            {data: 'normal_range_male', name: 'normal_range_male'},
            {data: 'normal_range_female', name: 'normal_range_female'},
            {data: 'normal_range_infant', name: 'normal_range_infant'},
            {data: 'test_unit', name: 'test_unit'},
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
        var test_id=$(this).data('id');
        $.post('<?= route('get.testpara.details') ?>',{test_id:test_id},function(data){
            $("#edittestparamodal").find('input[name="tid"]').val(data.details.id);
            $("#test_name_selected").val(data.details.testsetup_id);
            $("#edittestparamodal").find('input[name="test_parameter_name"]').val(data.details.test_parameter_name);
            $("#edittestparamodal").find('input[name="normal_range_male"]').val(data.details.normal_range_male);
            $("#edittestparamodal").find('input[name="normal_range_female"]').val(data.details.normal_range_female);
            $("#edittestparamodal").find('input[name="normal_range_infant"]').val(data.details.normal_range_infant);
            $("#test_unit_selected").val(data.details.test_unit);
            $("#edittestparamodal").modal('show');

        },'json');
    });

        /// END GET test IN POPUP

        /// UPDATE test IN POPUP
        $('#edittestparaform').on('submit',function(e){
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
                    $("#edittestparamodal").modal('hide');
                    $(".testpara-datatable").DataTable().ajax.reload(null,false)
                    alertify.success(data.msg);
                 }
                }
            })
            });
        /// END UPDATE test IN POPUP

        /// DELETE test
        $(document).on('click',"#DeleteTest",function(){
        var test_id=$(this).data('id');
        var url='<?= route('delete.testpara') ?>';


        $.post(url,{test_id:test_id},function(data){
                            if(data.code == 1){
                                $(".testpara-datatable").DataTable().ajax.reload(null,false)
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