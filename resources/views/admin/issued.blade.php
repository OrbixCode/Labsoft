@extends('layouts.master')


@section('title')
Labsoft Issued Reports
@endsection

@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-lg-10">
                                <h1 class="h3 mb-2 text-gray-800">Issued Reports</h1>
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

@endsection

@section('script')

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
        ajax: "{{ route('get.issuedreport.list') }}",

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

        });


</script>

@endsection