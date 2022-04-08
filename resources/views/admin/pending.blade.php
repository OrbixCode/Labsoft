@extends('layouts.master')


@section('title')
Labsoft Pending Reports
@endsection

@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-lg-10">
                                <h1 class="h3 mb-2 text-gray-800">Pending Reports</h1>
                                </div>
                            </div>
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



<!-- Add TestResult Modal -->
<div class="modal fade" id="addtestresult" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Test Result</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="addtestreportresult" action="{{route('add.testreportresult')}}" method="post" enctype="multipart/form-data">
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


@endsection

@section('script')


<!-- <script>

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

</script> -->




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

<script  type="text/javascript">

$.ajaxSetup({
     headers:{
         'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
     }
    });
    
        $(function(){

        /// GET ALL testES IN LIST

        var table = $('.report-datatable').DataTable({
        "order": [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: "{{ route('get.pendingreport.list') }}",

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
        $.post('<?= route('get.report.details') ?>',{report_id:report_id},function(data){
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

      
        });


</script>

@endsection