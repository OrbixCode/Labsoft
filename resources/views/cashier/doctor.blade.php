@extends('cashierlayouts.master')


@section('title')
Labsoft Doctors
@endsection

@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-lg-10">
                                <h1 class="h3 mb-2 text-gray-800">Lab Doctors</h1>
                                </div>
                                <div class="col-lg-2">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adddoctormodal">Add Doctor</a>
                                </div>
                            </div>
                            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <button class="btn btn-primary">Add doctor</button> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered doctor-datatable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Doctor Id</th>
                                            <th>Doctor Name</th>
                                            <th>Doctor Phone</th>
                                            <th>Doctor Information</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                               
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>


<!-- Add doctor Modal -->
<div class="modal fade" id="adddoctormodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Doctor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="adddoctorform" action="{{route('add.cdoctor')}}" method="post" enctype="multipart/form-data">
          @csrf

      <div class="row">
                <div class="col-lg-7 mb-3">
                    <label  class="form-label">Doctor Name</label>
                    <input type="text" class="form-control name"  name="doctor_name"  placeholder="Doctor Name"  />
                    <span class="text-center error-text doctor_name_error"></span>
                 </div>
                 <div class="col-lg-5 mb-3">
                    <label  class="form-label">Doctor Phone</label>
                    <input type="text" class="form-control name"  name="doctor_phone"  placeholder="Doctor Phone"  />
                    <span class="text-center error-text doctor_phone_error"></span>
                 </div>
       </div>
       <input type="hidden" value="{{$branchadd->id}}" name="branch_id" />
       <div class="row">
                <div class="col-lg-7 mb-3">
                    <label  class="form-label">Hospital/Clinic</label>
                    <input type="text" class="form-control type"  name="doctor_clinic"  placeholder="Doctor Hospital/Clinic"  />
                    <span class="text-center error-text doctor_clinic_error"></span>
                 </div>
                 <div class="col-lg-5 mb-3">
                    <label  class="form-label">Shortcode</label>
                    <input type="text" class="form-control type"  name="doctor_shortcode"  placeholder="Doctor Shortcode"  />
                    <span class="text-center error-text doctor_shortcode_error"></span>
                 </div>

       </div>

       <div class="row">
                <div class="col-lg-12 mb-3">
                    <label  class="form-label">Doctor Information</label>
                    <textarea class="form-control" placeholder="Doctor Information" name="doctor_information" id="" rows="3"></textarea>
                    <span class="text-center error-text doctor_information_error"></span>
                 </div>

       </div>

        <button type="submit" class="btn btn-primary">Save</button>
       
       </form>
      </div>

    </div>
  </div>
</div>

<!--End Add doctor Modal -->


<!-- Add Edit Modal -->
<div class="modal fade" id="editdoctormodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Doctor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="editDoctorform" action="{{route('update.cdoctor.details')}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" class="form-control name"  name="bid"  />
          <div class="row">
                <div class="col-lg-7 mb-3">
                    <label  class="form-label">Doctor Name</label>
                    <input type="text" class="form-control name"  name="doctor_name"  placeholder="Doctor Name"  />
                    <span class="text-center error-text doctor_name_error"></span>
                 </div>
                 <div class="col-lg-5 mb-3">
                    <label  class="form-label">Doctor Phone</label>
                    <input type="text" class="form-control name"  name="doctor_phone"  placeholder="Doctor Phone"  />
                    <span class="text-center error-text doctor_phone_error"></span>
                 </div>
       </div>

       <div class="row">
                <div class="col-lg-7 mb-3">
                    <label  class="form-label">Hospital/Clinic</label>
                    <input type="text" class="form-control type"  name="doctor_clinic"  placeholder="Doctor Hospital/Clinic"  />
                    <span class="text-center error-text doctor_clinic_error"></span>
                 </div>
                 <div class="col-lg-5 mb-3">
                    <label  class="form-label">Shortcode</label>
                    <input type="text" class="form-control type"  name="doctor_shortcode"  placeholder="Doctor Shortcode"  />
                    <span class="text-center error-text doctor_shortcode_error"></span>
                 </div>

       </div>

       <div class="row">
                <div class="col-lg-12 mb-3">
                    <label  class="form-label">Doctor Information</label>
                    <textarea class="form-control" placeholder="Doctor Information" name="doctor_information" id="" rows="3"></textarea>
                    <span class="text-center error-text doctor_information_error"></span>
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

            //ADD Doctor
            $('#adddoctorform').on('submit',function(e){
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
                    $("#adddoctormodal").modal('hide');
                    $(".doctor-datatable").DataTable().ajax.reload(null,false)
                    alertify.success(data.msg);
                 }
                }
            })
            });

         //END ADD Doctor

        /// GET ALL DoctorES IN LIST

        var table = $('.doctor-datatable').DataTable({
        "order": [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: "{{ route('get.cdoctors.list') }}",

        columns: [
            {data: 'id', name: 'id'},
            {data: 'doctor_name', name: 'doctor_name'},
            {data: 'doctor_phone', name: 'doctor_phone'},
            {data: 'doctor_information', name: 'doctor_information'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });

    /// END GET ALL DoctorES IN LIST



    /// GET Doctor IN POPUP

    $(document).on('click',"#EditDoctor",function(){
        var doctor_id=$(this).data('id');
        $.post('<?= route('get.cdoctor.details') ?>',{doctor_id:doctor_id},function(data){
            $("#editdoctormodal").find('input[name="bid"]').val(data.details.id);
            $("#editdoctormodal").find('input[name="doctor_name"]').val(data.details.doctor_name);
            $("#editdoctormodal").find('textarea[name="doctor_information"]').val(data.details.doctor_information);
            $("#editdoctormodal").find('input[name="doctor_phone"]').val(data.details.doctor_phone);
            $("#editdoctormodal").find('input[name="doctor_clinic"]').val(data.details.doctor_clinic);
            $("#editdoctormodal").find('input[name="doctor_shortcode"]').val(data.details.doctor_shortcode);
            $("#editdoctormodal").modal('show');

        },'json');
    });

        /// END GET Doctor IN POPUP

        /// UPDATE Doctor IN POPUP
        $('#editDoctorform').on('submit',function(e){
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
                    $("#editdoctormodal").modal('hide');
                    $(".doctor-datatable").DataTable().ajax.reload(null,false)
                    alertify.success(data.msg);
                 }
                }
            })
            });
        /// END UPDATE Doctor IN POPUP

        /// DELETE Doctor
        $(document).on('click',"#DeleteDoctor",function(){
        var doctor_id=$(this).data('id');
        var url='<?= route('delete.cdoctor') ?>';


        $.post(url,{doctor_id:doctor_id},function(data){
                            if(data.code == 1){
                                $(".doctor-datatable").DataTable().ajax.reload(null,false)
                                alertify.set('notifier','position', 'top-right');
                                alertify.success(data.msg);
                            }
                    },'json');

  

        });
        /// END DELETE Doctor
        });


</script>


@endsection