<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Report</title>

    


    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>
<style>

body{
margin: 30px!important;
}

.td-10{
    width: 10%;
}

.td-25{
    width: 25%;
}
.td-30{
    width: 30%;
}
.td-35{
    width: 35%;
}
.td-40{
    width: 40%;
}
.td-50{
    width: 50%;
}


.td-45{
    width: 45%;
}
.td-100{
    width: 100%;
}

.TFtable{
		width:100%; 
		border-collapse:collapse; 
	}
	.TFtable td{ 
		padding:7px; border:none;
	}
	/* provide some minimal visual accomodation for IE8 and below */
	.TFtable tr{
		background: #b8d1f3;
	}
	/*  Define the background color for all the ODD background rows  */
    .TFtable tr:nth-child(odd) {
    background: #d1d1d1;
}
	/*  Define the background color for all the EVEN background rows  */
	.TFtable tr:nth-child(even){
		background: #fff;
	}
p{
    margin-bottom:0px!important;
}

</style>
<body>





@foreach($reports as $report)

<br/>


<table class="table-borderless">
        <tbody>
            <!-- tr represents .row and td represents .col -->
            <tr>
                <td class="td-35">
                <img src="{{ asset('website/assets/img/billlogo.png') }}" alt="" style="width: 250px; ">
</b></p>
                   
                </td>
                <td class="td-10">
                <p style="color:#fff!important;">Lab No: {{$report->branch_id}} Lab No: {{$report->branch_id}}Lab No: {{$report->branch_id}}</p>
                </td>
                <td class="td-40" >
                        @php
                            $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                        @endphp
                        
                        {!! $generator->getBarcode('$report->id', $generator::TYPE_CODE_128) !!}
                </td>
            </tr>
        </tbody>
    </table>
    <hr/>
<table class="table-borderless">
        <tbody>
            <!-- tr represents .row and td represents .col -->
            <tr>
                <td class="td-35">
                        <p><b>Report #: {{$report->id}}</b></p>
                        <p>Patient Name: {{$report->patient_name}} </p> 
                        <p>Gender/Age: {{$report->gender->gender_name}}/{{$report->patient_age}} </p>
                        <p>Email: {{$report->user->email}} </p>
                        <p>Contact: {{$report->patient_contact}} </p>
                </td>
                <td class="td-10">
                <p style="color:#fff!important;">00044444448888</p>
                </td>
                <td class="td-40" >
                <p>Lab No: {{$report->branch_id}} </p>
                <p>Receipt Date: {{\Illuminate\Support\Str::limit($report->created_at, 10)}} </p>
                <p>Issue Date: {{$report->issue_date}} </p>
                <p>Specimen: Taken In Lab </p>
                <p>Laboratory Contact: {{$report->branch->branch_phone}} </p>
                <p>Registration Location: {{$report->branch->branch_address}} </p>
                </td>
            </tr>
        </tbody>
    </table>
  
    <hr/>

    <p><b>Test Names</b></p>
    <ol>
    @foreach($reportnames as $para)
       <li> {{$para->testsetup->test_name}} </li>
    @endforeach
   </ol>

   
    <table class="TFtable">
    <tr><td><b>Test Parameter</b></td>
    <td><b>Normal Range</b></td>
    <td><b>Unit</b></td>
    <td><b>Results</b></td></tr>
    @foreach($reportparas as $para)   
	<tr>     
    <td>{{$para->testpara->test_parameter_name}}</td>
    @if($para->report->gender_id == '1')
        <td>{{$para->testpara->normal_range_male}}</td> 
    @elseif($para->report->gender_id == '2')
        <td>{{$para->testpara->normal_range_female}}</td> 
    @elseif($para->report->gender_id == '3')
        <td>{{$para->testpara->normal_range_infant}}</td> 
    
   @endif
    <td>{{$para->testpara->test_unit}}</td>
    <td>{{$para->test_result}}</td>
   </tr>
   @endforeach
	<!-- <tr><td>Text</td><td>Text</td><td>Text</td></tr>
	<tr><td>Text</td><td>Text</td><td>Text</td></tr>
	<tr><td>Text</td><td>Text</td><td>Text</td></tr>
    <tr><td>Text</td><td>Text</td><td>Text</td></tr>
    <tr><td>Text</td><td>Text</td><td>Text</td></tr> -->

    
</table>
<br/>
@if($report->report_description) 
<p><b>Report Details</b></p>
<p>{{$report->report_description}}</p>
@else

@endif
<br/>
@if($report->report_image) 
<p><b>Report Snapshot</b></p>
<p><img src="{{asset('/uploads/'.$report->report_image)}}" style="width:50%; padding:10px"/></p>
@else

@endif


@endforeach 
<hr/>
<div class="row">
@foreach($doctors as $doctor) 
    <div class="col-md-3 col-lg-3 col-sm-3 col-xsm-3 col-3">
    <p style="font-size:11.5px"><b>{{$doctor->doctor_name}}</b></p>
    <p style="font-size:11.5px">{{$doctor->doctor_information}}</p>
    </div>
@endforeach    
</div>


                   
</body>
</html>