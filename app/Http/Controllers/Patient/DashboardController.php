<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use Dompdf\Dompdf;
use App\Report;
use App\TestParaReport;
use App\TestReport;
use App\User;
use App\Doctor;
use Auth;

class DashboardController extends Controller
{
    public function index(){
        
    $id = Auth::user()->id;
        $reports=Report::where('user_id','=',$id)->with('gender','branch')->get();
        return view('patient.index')->with(compact('reports'));

    }


    public function reportPdf(){
    set_time_limit(300);
    $id = Auth::user()->id;
    $reports=Report::where('user_id','=',$id)->with('gender','user')->get();
    $report=Report::where('user_id','=',$id)->first();
    $reportnames=TestReport::where('report_id',$report->id)->with('testsetup')->get();
    $reportparas=TestParaReport::where('report_id',$report->id)->with('testpara','report')->get();
     
    // $dompdf = new Dompdf();
    // $dompdf->loadHtml(view('patient.pdf.report')->with(compact('reports','reportnames','reportparas')));
    // $dompdf->setPaper('A4', 'portrait');
    // $dompdf->render();
    // $dompdf->stream('report');
    return view('patient.pdf.report')->with(compact('reports','reportnames','reportparas'));


}
}