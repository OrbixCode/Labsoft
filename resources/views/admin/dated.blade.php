@extends('layouts.master')


@section('title')
Labsoft Report Dates
@endsection

@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-lg-10">
                                <h1 class="h3 mb-2 text-gray-800">Reports Dates</h1>
                                </div>
                              
                            
                            </div>
                            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <button class="btn btn-primary">Add test</button> -->
                          
                        </div>
                        <div class="card-body">
                            <form id="adddatesearch" action="{{route('reportsearch')}}" method="POST">
                                @csrf
                               <div class="row input-daterange">
                                    <div class="col-lg-3 mb-3">
                                        <input type="date" class="form-control name"  name="from_date"  id="from_date" placeholder="Report From Date" />     
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <input type="date" class="form-control name"  name="to_date" id="to_date" placeholder="Report To Date" />
                                     </div>
                                    <div class="col-lg-1 mb-3">
                                        <button type="submit" name="search" id="search" class="btn btn-primary">Search</button>
                                    </div>
                                    <div class="col-lg-2 mb-3" style="display: flex; color: black;">
                                    <h5 >Total Test:</h5> <h5 id="totalsearch"></h5>
                                    </div>

                                    <div class="col-lg-3 mb-3" style="display: flex; color: black;">
                                    <h5 >Total Test:</h5> <h5 id="totalmoney"></h5>
                                    </div>
                               </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered report-datatable" id="report-datatable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Report Id</th>
                                            <th>Patient Name</th>
                                            <th>Patient Age</th>
                                            <th>Patient Contact</th>
                                            <th>Date</th>
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

@endsection

@section('script')

<script>
$(document).ready(function(){

});
</script>    

<script  type="text/javascript">

$.ajaxSetup({
     headers:{
         'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
     }
    });
    
        $(function(){

        var table = $('.report-datatable').DataTable({
        "order": [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: "{{ route('get.datedreport.list') }}",

        columns: [
            {data: 'id', name: 'id'},
            {data: 'patient_name', name: 'patient_name'},
            {data: 'patient_age', name: 'patient_age'},
            {data: 'patient_contact', name: 'patient_contact'},
            {data: 'time', name: 'time'},
            {data: 'show', name: 'show'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });


    //ADD test
    $('#adddatesearch').on('submit',function(e){
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
                success:function([data,dailyMoney]){
                 if(data.code == 0){
                   $.each(data.error,function(prefix,val){
                   $(form).find('span.'+prefix+'_error').text(val[0]).show("slow").delay(5000).hide("slow");
                   })
                 }else{
                    console.log(data);
                    var output = '';
        
                        $('#totalsearch').text(data.length);
                        $('#totalmoney').text(dailyMoney);
                        for(var count = 0; count < data.length; count++)
                        {
                        output += '<tr>';
                        output += '<td>' + data[count].id+ '</td>';
                        output += '<td>' + data[count].patient_name+ '</td>';
                        output += '<td>' + data[count].patient_age+ '</td>';
                        output += '<td>' + data[count].patient_contact+ '</td>';
                        output += '<td>' + data[count].time+ '</td>';
                        if(data[count].status == '0'){
                            output +='<td>'+'<button class="edit btn btn-danger btn-sm " disabled  id="EditStatus1">Pending</button>'+'</td>';
                         }else{
                          output +='<td>'+'<button class="edit btn btn-success btn-sm " disabled  id="EditStatus0">Issued</button>'+'</td>';
                          }
                          output +='<td>'+'<a  class="btn btn-success btn-sm"  target="_blank" >Print Report</a>'+'</td>';
                        '</tr>';
                        }
                        $('tbody').html(output);
                 }
                }
            })
            });

         //END ADD test

        });


</script>

@endsection