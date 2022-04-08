@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Patient Report</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($reports as $report)
                    @if($report->status == 0)
                    <h3>Oops! Your Report Has Not Been Issue Yet.</h3>
                    @else
                  
                    <div class="row">
                        <div class="col-md-6">
                        <img src="{{asset('website/assets/img/report.webp')}}" style="width:90%;" alt="report"/>
                        </div>

                        <div class="col-md-6 pt-2">
                        <h3><b>Patient Information</b></h3>
                        @php
                            $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                        @endphp
                        
                        {!! $generator->getBarcode('$report->id', $generator::TYPE_CODE_128) !!}
                        <h5>Name: {{$report->patient_name}} </h5>
                        <h5>Gender: {{$report->gender->gender_name}} </h5>
                        <h5>Email:{{$report->user->email}} </h5>
                        <h5>Age: {{$report->patient_age}} </h5>
                        <h5>Contact: {{$report->patient_contact}} </h5>
                        <h5>Laboratory Location: {{$report->branch->branch_address}} </h5>
                        <h3 style="color:red;"><b>NOTICE</b></h3>
                        <p style="color:red;"><b>WHEN YOU SEE YOUR REPORT PRESS CTRL + P</b></p>
                        <a href="{{route('report.pdf')}}" class="btn btn-primary">Your Report </a>                        </div>
                       
                    </div>
                     
                    @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


