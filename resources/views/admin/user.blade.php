@extends('layouts.master')


@section('title')
Labsoft Users
@endsection

@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-lg-10">
                                <h1 class="h3 mb-2 text-gray-800">Lab User</h1>
                                </div>
                                <div class="col-lg-2">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addusermodal">Add User</a>
                                </div>
                            </div>
                            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <button class="btn btn-primary">Add test</button> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered user-datatable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>User Id</th>
                                            <th>User Name</th>
                                            <th>Role Name</th>
                                            <th>Branch</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                               
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>


<!-- Add User Modal -->
<div class="modal fade" id="addusermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="adduserform" action="{{route('add.user')}}" method="post" enctype="multipart/form-data">
          @csrf

      <div class="row">
                <div class="col-lg-7 mb-3">
                    <label  class="form-label">User Name</label>
                    <input type="text" class="form-control name"  name="name"  placeholder="Enter User Name"  />
                    <span class="text-center error-text name_error"></span>
                 </div>
                 <div class="col-lg-5 mb-3">
                 <label for="exampleFormControlSelect1">Select User Role</label>
                    <select class="form-control" name="role_id" >
                    <option></option>
                    @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->role_name}}</option>
                    @endforeach
                    </select>
                    <span class="text-center error-text role_id_error"></span>
                </div>
       </div>
       <div class="row">
                <div class="col-lg-7 mb-3">
                <label  class="form-label">Email</label>
                    <input type="email" class="form-control type"  name="email"  placeholder="Email"  />
                    <span class="text-center error-text email_error"></span>
                 </div>
                 <div class="col-lg-5 mb-3">
                 <label for="exampleFormControlSelect1">Select Branch</label>
                    <select class="form-control" name="branch_id">
                    <option></option>
                    @foreach($branches as $branch)
                    <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                    @endforeach
                    </select>
                    <span class="text-center error-text branch_id_error"></span>
                 </div>

       </div>      

       <div class="row">
                
                    <div class="col-lg-7 mb-3">
                 <label  class="form-label">Password</label>
                    <input type="text" class="form-control type"  name="password"  placeholder="Password"  />
                    <span class="text-center error-text password_error"></span>
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
<div class="modal fade" id="editusermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="edituserform" action="{{route('update.user.details')}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" class="form-control name"  name="uid"  />
          <div class="row">
                <div class="col-lg-7 mb-3">
                    <label  class="form-label">User Name</label>
                    <input type="text" class="form-control name"  name="name"  placeholder="Enter User Name"  />
                    <span class="text-center error-text name_error"></span>
                 </div>
                 <div class="col-lg-5 mb-3">
                 <label for="exampleFormControlSelect1">Select User Role</label>
                    <select class="form-control" name="role_id" id="user_role_selected">
                    <option></option>
                    @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->role_name}}</option>
                    @endforeach
                    </select>
                    <span class="text-center error-text role_id_error"></span>
                </div>
       </div>
       <div class="row">
                <div class="col-lg-7 mb-3">
                <label  class="form-label">Email</label>
                    <input type="email" class="form-control type"  name="email"  placeholder="Email"  />
                    <span class="text-center error-text email_error"></span>
                 </div>
                 <!-- <div class="col-lg-5 mb-3">
                 <label for="exampleFormControlSelect1">Select Branch</label>
                    <select class="form-control" name="branch_id" id="user_branch_selected">
                    <option></option>
                    @foreach($branches as $branch)
                    <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                    @endforeach
                    </select>
                    <span class="text-center error-text branch_id_error"></span>
                 </div> -->

                 <div class="col-lg-5 mb-3">
                 <label  class="form-label">Password</label>
                    <input type="text" class="form-control type"  name="password"  placeholder="Password"  />
                    <span class="text-center error-text password_error"></span>
                 </div>

       </div>      

       <!-- <div class="row">
                
                    <div class="col-lg-7 mb-3">
                 <label  class="form-label">Password</label>
                    <input type="text" class="form-control type"  name="password"  placeholder="Password"  />
                    <span class="text-center error-text password_error"></span>
                 </div>
              
       </div> -->

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
            $('#adduserform').on('submit',function(e){
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
                    $("#addusermodal").modal('hide');
                    $(".user-datatable").DataTable().ajax.reload(null,false)
                    alertify.success(data.msg);
                 }
                }
            })
            });

         //END ADD test

        /// GET ALL testES IN LIST

        var table = $('.user-datatable').DataTable({
        "order": [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        
        ajax: "{{ route('get.user.list') }}",

        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'role.role_name', name: 'role.role_name'},
            {data: 'branch.branch_name', name: 'branch.branch_name'},
            {data: 'created_at', name: 'created_at'},
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

    $(document).on('click',"#EditUser",function(){
        var user_id=$(this).data('id');
        // alert(test_id);
        $.post('<?= route('get.user.details') ?>',{user_id:user_id},function(data){
            $("#editusermodal").find('input[name="uid"]').val(data.details.id);
            $("#editusermodal").find('input[name="name"]').val(data.details.name);
            $("#editusermodal").find('input[name="email"]').val(data.details.email);
            $("#user_role_selected").val(data.details.role_id);
            $("#user_branch_selected").val(data.details.branch_id);
            $("#editusermodal").modal('show');

        },'json');
    });

        /// END GET test IN POPUP

        /// UPDATE test IN POPUP
        $('#edituserform').on('submit',function(e){
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
                    $("#editusermodal").modal('hide');
                    $(".user-datatable").DataTable().ajax.reload(null,false)
                    alertify.success(data.msg);
                 }
                }
            })
            });
        /// END UPDATE test IN POPUP

        /// DELETE test
        $(document).on('click',"#DeleteUser",function(){
        var user_id=$(this).data('id');
        var url='<?= route('delete.user') ?>';


        $.post(url,{user_id:user_id},function(data){
                            if(data.code == 1){
                                $(".user-datatable").DataTable().ajax.reload(null,false)
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