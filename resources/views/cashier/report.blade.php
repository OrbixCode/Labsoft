@extends('cashierlayouts.master')


@section('title')
Labsoft Reports
@endsection

@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-lg-10">
                                <h1 class="h3 mb-2 text-gray-800">Test Reports</h1>
                                </div>
                                <div class="col-lg-2">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addreportmodal">Create Report</a>
                                </div>
                            </div>
                            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <button class="btn btn-primary">Add test</button> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered report-datatable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Report Id</th>
                                            <th>Patient Name</th>
                                            <th>Patient Age</th>
                                            <th>Patient Contact</th>
                                            <th>status</th>
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
<div class="modal fade" id="addreportmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Test Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="addreportform" action="{{route('add.creport')}}" method="post" enctype="multipart/form-data">
          @csrf

        
          <div class="row">
                <div class="col-lg-5 mb-3">
                <label class="form-label">Patient Name</label>
                    <input type="text" class="form-control type"  name="patient_name"  placeholder="Patient Full Name"  />
                    <span class="text-center error-text patient_name_error"></span>
                 </div>

                 <div class="col-lg-4 mb-3">
                <label class="form-label">Email</label>
                    <input type="email" class="form-control type"  name="email"  placeholder="Ex.name@gmail.com"  />
                    <span class="text-center error-text email_error"></span>
                 </div>

                 <div class="col-lg-3 mb-3">
                <label class="form-label">Password</label>
                    <input type="password" class="form-control type"  name="password"  placeholder="Password"  />
                    <span class="text-center error-text password_error"></span>
                 </div>

       </div>


       <div class="row">
                <div class="col-lg-3 mb-3">
                <label class="form-label">Patient Age</label>
                    <input type="number" class="form-control type"  name="patient_age"  placeholder="Patient Age"  />
                    <span class="text-center error-text patient_age_error"></span>
                 </div>
                 <div class="col-lg-3 mb-3">
                <label  class="form-label">Patient Contact #</label>
                    <input type="text" class="form-control type"  name="patient_contact"  placeholder="Patient Contact "  />
                    <span class="text-center error-text patient_contact_error"></span>
                 </div>
                <div class="col-lg-3 mb-3">
                 <label  class="form-label">Patient Gender</label>
                 <select class="form-control" name="gender_id" id="gender_selected" >
                    <option></option>
                    @foreach($genders as $gender)
                    <option value="{{$gender->id}}">{{$gender->gender_name}}</option>
                    @endforeach
                    </select>
                    <span class="text-center error-text testsetup_id_error"></span>
                 </div>

                 <div class="col-lg-3 mb-3">
                   <label for="exampleFormControlSelect1">Select Dr Reference </label>
                    <select class="form-control" name="doctor_id" id="doctor-dropdown" >
                    <option></option>
                    @foreach($doctors as $doctor)
                    <option value="{{$doctor->id}}">{{$doctor->doctor_name}}</option>
                    @endforeach
                    </select>
                    <span class="text-center error-text doctor_id_error"></span>
                   </div>
                
       </div>

       
            <input type="hidden" value="{{$branchadd->id}}" name="branch_id" />


<!-- add test and delete -->

       <div class="card">
        <div class="card-header">
                Testes
</div>
        <div class="card-body">
        <div class="row">
        <div class="col-md-8">

                            <table class="table" id="add_test_table">
                                <thead>
                                    <tr>
                                        <th>Test Name</th>
                                        <th>Test Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="product0">
                                        <td>
                                            <select name="testsetup_id[]" class="form-control" id="test_name_selected">
                                                <option value="">-- Choose Test Name--</option>
                                                @foreach ($testsetup as $test)
                                                    <option value="{{ $test->id }}">
                                                        {{ $test->test_name }} (Rs{{ number_format($test->test_charge, 2) }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                    
                                    </tr>
                                
                                    <tr id="product1"></tr>
                                </tbody>
                            </table>
             </div>
             <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <button id="add_row" class="btn btn-primary pull-left">+ Add Row</button>
                                <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                            </div>
                        </div>
            </div>
         </div>

        </div>
    </div>
<!--end test add/delete -->

    
                 
        <button type="submit" class="btn btn-primary">Save</button>
       
       </form>
      </div>

    </div>
  </div>
</div>

<!--End Add test Modal -->




<!-- Add TestResult Modal -->
<div class="modal fade" id="addtestresult" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Test Result</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="addtestreportresult" action="{{route('add.ctestreportresult')}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" class="form-control name"  name="trid"  />
        
          <div class="row">
               <div class="col-md-4">
               <h2 class="show_patient_details">Report # <span id="show_report_id"></span></h2>
               <h2 class="show_patient_details">Patient Name:<span id="show_patient_name"></span></h2>
               <h2 class="show_patient_details">Gender/Age:<span id="show_patient_gender"></span> / <span id="show_patient_age"></span></h2>
               <h2 class="show_patient_details">Contact:<span id="show_patient_contact"></span></h2>
               <h2 class="show_patient_details">Email:<span id="show_patient_email"></span></h2>
               <!-- <h2>Patient Name:<span id="show_patient_name"></span></h2>
               <h2>Patient Name:<span id="show_patient_name"></span></h2> -->

           
               <label class="form-label" for="customFile">Report Images</label>
               <input type="file"   class="form-control" name="report_image[]"/>
               <div class="form-group">
                 <label for="report_description">Report Description</label>
                 <textarea class="form-control" name="report_description" id="" rows="5"></textarea>
               </div>

               </div>
               <div class="col-md-8">
                <!-- add test and delete -->

       <div class="card">
        <div class="card-header">
                Testes
         </div>
        <div class="card-body">
        <div class="row">
        <div class="col-md-10">

                               <table>
                               <thead>
                                    <tr>
                                        <th>Your Test  Name</th>
                                    </tr>
                                </thead>
                              <tbody id="showTestName">
            

                             </tbody>
                             </table>
                            <table class="table" id="add_test_para_table">
                                <thead>
                                    <tr>
                                        <th>Test Parameter Name</th>
                                        <th>Test Result</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="testpara0">
                                        <td>
                                            <select name="testpara_id[]" class="form-control" id="test_name_selected">
                                                <option value="">-- Choose Test Parameter--</option>
                                                @foreach ($testpara as $test)
                                                    <option value="{{ $test->id }}">
                                                        {{ $test->test_parameter_name }} 
                                                    </option>
                                                @endforeach
                                            </select>
                                            
                                        </td>
                                            <td>
                                                 <input type="number" placeholder="20.35" name="test_result[]" class="form-control"  />
                                            </td>
                                    </tr>
                                
                                    <tr id="testpara1"></tr>
                                </tbody>
                            </table>
                          </div>
                            <div class="col-md-2">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button id="add_para_row" class="btn btn-primary pull-left">+</button>
                                                <button id='delete_para_row' class="pull-right btn btn-danger">-</button>
                                            </div>
                                        </div>
                            </div>
                           </div>

        </div>
    </div>
<!--end test add/delete -->
               </div>
          </div>


    
                 
        <button type="submit" class="btn btn-primary">Save</button>
       
       </form>
      </div>

    </div>
  </div>
</div>

<!--End Add TestResult Modal -->






<!-- Add TestResult Modal -->
<div class="modal fade" id="testView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-none">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="testView">
      <div class="modal-body">
               
          <div class="row">
               <div class="col-md-12">
               <h2 class="show_patient_details">Report # <span id="show_report_id"></span></h2>
               <h2 class="show_patient_details">Patient Name:<span id="show_patient_name"></span></h2>
               <h2 class="show_patient_details">Gender/Age:<span id="show_patient_gender"></span> / <span id="show_patient_age"></span></h2>
               <h2 class="show_patient_details">Contact:<span id="show_patient_contact"></span></h2>
               <h2 class="show_patient_details">Email:<span id="show_patient_email"></span></h2>
               <h2 class="show_patient_details">password:<span id="show_patient_password"></span></h2>
               <!-- <h2>Patient Name:<span id="show_patient_name"></span></h2>
               <h2>Patient Name:<span id="show_patient_name"></span></h2> -->

               </div>
           
          </div>

       
       </form>
      </div>

    </div>
  </div>
</div>

<!--End Add TestResult Modal -->





<!-- Add Edit Modal -->
<div class="modal fade" id="editreportmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update test</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="editreportform" action="{{route('update.creport.details')}}" method="post" enctype="multipart/form-data">
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
                 <div class="col-lg-5 mb-3">
                 <label  class="form-label">Test Price</label>
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
                 <label for="state">Test Parameter</label>
                    <select class="form-control" id="testpara-dropdown">
                    </select>
                    <span class="text-center error-text test_normal_range_error"></span>
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


<script>

$(document).ready(function(){
    let row_number = 1;
    $("#add_row").click(function(e){
      e.preventDefault();
      let new_row_number = row_number - 1;
      $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
      $('#add_test_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
      row_number++;
    });

    $("#delete_row").click(function(e){
      e.preventDefault();
      if(row_number > 1){
        $("#product" + (row_number - 1)).html('');
        row_number--;
      }
    });
  });

</script>




<script>

$(document).ready(function(){
    let row_number = 1;
    $("#add_para_row").click(function(e){
      e.preventDefault();
      let new_row_number = row_number - 1;
      $('#testpara' + row_number).html($('#testpara' + new_row_number).html()).find('td:first-child');
      $('#add_test_para_table').append('<tr id="testpara' + (row_number + 1) + '"></tr>');
      row_number++;
    });

    $("#delete_para_row").click(function(e){
      e.preventDefault();
      if(row_number > 1){
        $("#testpara" + (row_number - 1)).html('');
        row_number--;
      }
    });
  });

</script>



<script>
        $(document).ready(function() {
        $('#testsetup-dropdown').on('change', function() {
        var testsetup_id = this.value;
        $("#testpara-dropdown").html('');
        $.ajax({
        url:"{{ route('get.ctestpara-dropdown') }}",
        type: "POST",
        data: {
        testsetup_id: testsetup_id,
        _token: '{{csrf_token()}}' 
        },
        dataType : 'json',
        success: function(result){
        $('#testpara-dropdown').html('<option value="">Select Test Para</option>'); 
        $.each(result.testparameters,function(key,value){
        $("#testpara-dropdown").append('<option value="'+value.id+'">'+value.test_parameter_name+'</option>');
        });

        }
        });
        }); 
        
    });

</script>


<script  type="text/javascript">

$.ajaxSetup({
     headers:{
         'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
     }
    });
    
        $(function(){

            //ADD test
            $('#addreportform').on('submit',function(e){
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
                    $("#addreportmodal").modal('hide');
                    $(".report-datatable").DataTable().ajax.reload(null,false)
                    alertify.success(data.msg);
                 }
                }
            })
            });

         //END ADD test

        /// GET ALL testES IN LIST

        var table = $('.report-datatable').DataTable({
        "order": [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: "{{ route('get.creport.list') }}",

        columns: [
            {data: 'id', name: 'id'},
            {data: 'patient_name', name: 'patient_name'},
            {data: 'patient_age', name: 'patient_age'},
            {data: 'patient_contact', name: 'patient_contact'},
            {data: 'show', name: 'show'},
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

    $(document).on('click',"#TestResult",function(){
        var report_id=$(this).data('id');
        $.post('<?= route('get.creport.details') ?>',{report_id:report_id},function(data){
            $("#addtestresult").find('input[name="trid"]').val(data.details.id);
            $("#addtestresult").find('span[id="show_report_id"]').text(data.details.id);
            $("#addtestresult").find('span[id="show_patient_name"]').text(data.details.patient_name);
            $("#addtestresult").find('span[id="show_patient_age"]').text(data.details.patient_age);
            $("#addtestresult").find('span[id="show_patient_gender"]').text(data.details.gender.gender_name);
            $("#addtestresult").find('span[id="show_patient_contact"]').text(data.details.patient_contact);  
          
            var markup = '';
            $.each(data.testnames, function(key, value) {
              markup += '<tr> <td>' + value.testsetup.test_name + '</td> </tr>';
          });
          $('tbody[id="showTestName"]').html(markup);
            $("#addtestresult").modal('show');


        },'json'
        );
    });

    /// END GET test IN POPUP


        /// GET test IN POPUP

        $(document).on('click',"#TestView",function(){
        var report_id=$(this).data('id');
        $.post('<?= route('get.ctest.view') ?>',{report_id:report_id},function(data){
            $("#testView").find('input[name="trid"]').val(data.details.id);
            $("#testView").find('span[id="show_report_id"]').text(data.details.id);
            $("#testView").find('span[id="show_patient_name"]').text(data.details.patient_name);
            $("#testView").find('span[id="show_patient_age"]').text(data.details.patient_age);
            $("#testView").find('span[id="show_patient_gender"]').text(data.details.gender.gender_name);
            $("#testView").find('span[id="show_patient_contact"]').text(data.details.patient_contact);
            $("#testView").find('span[id="show_patient_email"]').text(data.details.user.email);
            $("#testView").find('span[id="show_patient_password"]').text(data.details.user.password);


            $("#testView").modal('show');

        },'json');
    });

    /// END GET test IN POPUP

        /// AddTestResult IN POPUP
        $('#addtestreportresult').on('submit',function(e){
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
                    $("#addtestresult").modal('hide');
                    $(".report-datatable").DataTable().ajax.reload(null,false)
                    alertify.success(data.msg);
                 }
                }
            })
            });
        /// END AddTestResult test IN POPUP

        /// DELETE test
        $(document).on('click',"#DeleteTestReport",function(){
        var report_id=$(this).data('id');
        var url='<?= route('delete.creport') ?>';
        $.post(url,{report_id:report_id},function(data){
                            if(data.code == 1){
                                $(".report-datatable").DataTable().ajax.reload(null,false)
                                alertify.set('notifier','position', 'top-right');
                                alertify.success(data.msg);
                            }
                    },'json');


        });
        /// END DELETE test


        //report status 1

        $(document).on('click',"#EditStatus1",function(){
        var status_id=$(this).data('id');
        var url='<?= route('status.creport1') ?>';
        // alert(test_id)
        $.post(url,{status_id:status_id},function(data){
                            if(data.code == 1){
                                $(".report-datatable").DataTable().ajax.reload(null,false)
                                alertify.set('notifier','position', 'top-right');
                                alertify.success(data.msg);
                            }
                    },'json');
        });
        //end report status1 


        //report status 1

        $(document).on('click',"#EditStatus0",function(){
        var status_id=$(this).data('id');
        var url='<?= route('status.creport0') ?>';
        // alert(test_id)
        $.post(url,{status_id:status_id},function(data){
                            if(data.code == 1){
                                $(".report-datatable").DataTable().ajax.reload(null,false)
                                alertify.set('notifier','position', 'top-right');
                                alertify.success(data.msg);
                            }
                    },'json');
        });
        //end report status1 

        });


</script>

@endsection