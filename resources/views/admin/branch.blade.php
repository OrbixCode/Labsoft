@extends('layouts.master')


@section('title')
Labsoft Branches
@endsection

@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-lg-10">
                                <h1 class="h3 mb-2 text-gray-800">Lab Branches</h1>
                                </div>
                                <div class="col-lg-2">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addbranchmodal">Add Branch</a>
                                </div>
                            </div>
                            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <button class="btn btn-primary">Add branch</button> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered branch-datatable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Branch Id</th>
                                            <th>Branch Name</th>
                                            <th>Branch Address</th>
                                            <th>Branch Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                               
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>


<!-- Add branch Modal -->
<div class="modal fade" id="addbranchmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Branch</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="addbranchform" action="{{route('add.branch')}}" method="post" enctype="multipart/form-data">
          @csrf

      <div class="row">
                <div class="col-lg-7 mb-3">
                    <label  class="form-label">Branch Name</label>
                    <input type="text" class="form-control name"  name="branch_name"  placeholder="Branch Name"  />
                    <span class="text-center error-text branch_name_error"></span>
                 </div>
                 <div class="col-lg-5 mb-3">
                    <label  class="form-label">Branch Phone</label>
                    <input type="text" class="form-control name"  name="branch_phone"  placeholder="Branch Name"  />
                    <span class="text-center error-text branch_phone_error"></span>
                 </div>
       </div>
       <div class="row">
                <div class="col-lg-12 mb-3">
                    <label  class="form-label">Branch Address</label>
                    <input type="text" class="form-control type"  name="branch_address"  placeholder="Branch Address"  />
                    <span class="text-center error-text branch_address_error"></span>
                 </div>

       </div>

        <button type="submit" class="btn btn-primary">Save</button>
       
       </form>
      </div>

    </div>
  </div>
</div>

<!--End Add branch Modal -->


<!-- Add Edit Modal -->
<div class="modal fade" id="editbranchmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Branch</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="editbranchform" action="{{route('update.branch.details')}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" class="form-control name"  name="bid"  />
      <div class="row">
                <div class="col-lg-7 mb-3">
                    <label  class="form-label">Branch Name</label>
                    <input type="text" class="form-control name"  name="branch_name"  placeholder="Branch Name"  />
                    <span class="text-center error-text branch_name_error"></span>
                 </div>
                 <div class="col-lg-5 mb-3">
                    <label  class="form-label">Branch Phone</label>
                    <input type="text" class="form-control name"  name="branch_phone"  placeholder="Branch Name"  />
                    <span class="text-center error-text branch_phone_error"></span>
                 </div>
       </div>
       <div class="row">
                <div class="col-lg-12 mb-3">
                    <label  class="form-label">Branch Address</label>
                    <input type="text" class="form-control type"  name="branch_address"  placeholder="Branch Address"  />
                    <span class="text-center error-text branch_address_error"></span>
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

            //ADD BRANCH
            $('#addbranchform').on('submit',function(e){
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
                    $("#addbranchmodal").modal('hide');
                    $(".branch-datatable").DataTable().ajax.reload(null,false)
                    alertify.success(data.msg);
                 }
                }
            })
            });

         //END ADD BRANCH

        /// GET ALL BRANCHES IN LIST

        var table = $('.branch-datatable').DataTable({
        "order": [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: "{{ route('get.branches.list') }}",

        columns: [
            {data: 'id', name: 'id'},
            {data: 'branch_name', name: 'branch_name'},
            {data: 'branch_address', name: 'branch_address'},
            {data: 'branch_phone', name: 'branch_phone'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });

    /// END GET ALL BRANCHES IN LIST



    /// GET BRANCH IN POPUP

    $(document).on('click',"#EditBranch",function(){
        var branch_id=$(this).data('id');
        $.post('<?= route('get.branch.details') ?>',{branch_id:branch_id},function(data){
            $("#editbranchmodal").find('input[name="bid"]').val(data.details.id);
            $("#editbranchmodal").find('input[name="branch_name"]').val(data.details.branch_name);
            $("#editbranchmodal").find('input[name="branch_address"]').val(data.details.branch_address);
            $("#editbranchmodal").find('input[name="branch_phone"]').val(data.details.branch_phone);
            $("#editbranchmodal").modal('show');

        },'json');
    });

        /// END GET BRANCH IN POPUP

        /// UPDATE BRANCH IN POPUP
        $('#editbranchform').on('submit',function(e){
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
                    $("#editbranchmodal").modal('hide');
                    $(".branch-datatable").DataTable().ajax.reload(null,false)
                    alertify.success(data.msg);
                 }
                }
            })
            });
        /// END UPDATE BRANCH IN POPUP

        /// DELETE BRANCH
        $(document).on('click',"#DeleteBranch",function(){
        var branch_id=$(this).data('id');
        var url='<?= route('delete.branch') ?>';


        $.post(url,{branch_id:branch_id},function(data){
                            if(data.code == 1){
                                $(".branch-datatable").DataTable().ajax.reload(null,false)
                                alertify.set('notifier','position', 'top-right');
                                alertify.success(data.msg);
                            }
                    },'json');

        // swal.fire({
        //     title:'Are You Sure',
        //     html:'You Want To <b>Delete</b> This Branch',
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
        /// END DELETE BRANCH
        });


</script>


@endsection