<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/bill', function () {
//     return view('admin.reciept');
// });


// Route::get('/admin', function () {
//     return view('admin.dashboard');
// });

// Route::get('/doctors','DoctorController@index');
// Route::post('/adddoctor','DoctorController@adddoctor');
// Route::put('/updatedoctor/{id}','DoctorController@updatedoctor');
// Route::delete('/deletedoctor/{id}','DoctorController@deletedoctor');

// // Route::get('/live_search', 'LiveSearch@index');
// Route::get('/live_search/action', 'DoctorController@action')->name('live_search.doctor');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

///admin routes
Route::group(['prefix' => 'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    // Create Report Route 
    Route::get('/reports','ReportController@index')->name('reports');
    Route::post('/get-testpara-by-testsetup','ReportController@getTestpara')->name('get.testpara-dropdown');
    Route::post('/get-testsetup-price','ReportController@getTestprice')->name('get.testprice');
    Route::post('/add-report','ReportController@addreport')->name('add.report');
    Route::post('/add-test-report-result','ReportController@addtestreportresult')->name('add.testreportresult');
    Route::post('/status-report1','ReportController@statusreport1')->name('status.report1');
    Route::post('/status-report0','ReportController@statusreport0')->name('status.report0');
    Route::get('/get-report-list','ReportController@getreportlist')->name('get.report.list');
    Route::post('/get-report-details','ReportController@getreportdetails')->name('get.report.details');
    Route::post('/get-test-view','ReportController@gettestview')->name('get.test.view');
    Route::post('/update-report-details','ReportController@updatereportdetails')->name('update.report.details');
    Route::post('/delete-report','ReportController@deletereport')->name('delete.report');
    Route::get('/bill-reciept/{id}','ReportController@bill')->name('bill.print');
    // End Create Report Route 


        // Pending & Issued Report Route 
        Route::get('/pending','PendingIssuedController@index')->name('pending');
        Route::get('/issued','PendingIssuedController@issued')->name('issued');
        Route::get('/report-print/{id}','PendingIssuedController@reportprint')->name('report.print');
        Route::post('/add-test-report-result','PendingIssuedController@addtestreportresult')->name('add.testreportresult');
        Route::get('/get-pendingreport-list','PendingIssuedController@getpendingreportlist')->name('get.pendingreport.list');
        Route::get('/get-issuedreport-list','PendingIssuedController@getissuedreportlist')->name('get.issuedreport.list');
        // End Pending & Issued Report Route 


                // Date Report Route 
                Route::get('/dated','DatedController@issued')->name('dated');
                Route::post('/reportsearch','DatedController@datesearch')->name('reportsearch');
                Route::get('/get-datedreport-list','DatedController@getdatedreportlist')->name('get.datedreport.list');
                // End Date Report Route 

    // Doctor Route 
    Route::get('/doctors','DoctorController@index')->name('doctors');
    Route::post('/add-doctor','DoctorController@adddoctor')->name('add.doctor');
    Route::get('/get-doctor-list','DoctorController@getdoctorlist')->name('get.doctors.list');
    Route::post('/get-doctor-details','DoctorController@getdoctordetails')->name('get.doctor.details');
    Route::post('/update-doctor-details','DoctorController@updatedoctordetails')->name('update.doctor.details');
    Route::post('/delete-doctor','DoctorController@deletedoctor')->name('delete.doctor');
    // End Doctor Route 


    // Branch Route 
    Route::get('/branches','BranchController@index')->name('branches');
    Route::post('/add-branch','BranchController@addbranch')->name('add.branch');
    Route::get('/get-branch-list','BranchController@getbranchlist')->name('get.branches.list');
    Route::post('/get-branch-details','BranchController@getbranchdetails')->name('get.branch.details');
    Route::post('/update-branch-details','BranchController@updatebranchdetails')->name('update.branch.details');
    Route::post('/delete-branch','BranchController@deletebranch')->name('delete.branch');
    // End Branch Route 


    // TestSetup Route 
    Route::get('/testsetup','TestSetupController@index')->name('testsetup');
    Route::post('/add-testsetup','TestSetupController@addtestsetup')->name('add.testsetup');
    Route::get('/get-testsetup-list','TestSetupController@gettestsetuplist')->name('get.testsetup.list');
    Route::post('/get-testsetup-details','TestSetupController@gettestsetupdetails')->name('get.testsetup.details');
    Route::post('/update-testsetup-details','TestSetupController@updatetestsetupdetails')->name('update.testsetup.details');
    Route::post('/delete-testsetup','TestSetupController@deletetestsetup')->name('delete.testsetup');
    // End TestSetup Route 


    // TestParameter Route 
    Route::get('/testparameter','TestParaController@index')->name('testparameter');
    Route::post('/add-testpara','TestParaController@addtestpara')->name('add.testpara');
    Route::get('/get-testpara-list','TestParaController@gettestparalist')->name('get.testpara.list');
    Route::post('/get-testpara-details','TestParaController@gettestparadetails')->name('get.testpara.details');
    Route::post('/update-testpara-details','TestParaController@updatetestparadetails')->name('update.testpara.details');
    Route::post('/delete-testpara','TestParaController@deletetestpara')->name('delete.testpara');
    // End TestParameter Route 


    // Userr Route 
    Route::get('/users','UserController@index')->name('users');
    Route::post('/add-user','UserController@adduser')->name('add.user');
    Route::get('/get-user-list','UserController@getuserlist')->name('get.user.list');
    Route::post('/get-user-details','UserController@getuserdetails')->name('get.user.details');
    Route::post('/update-user-details','UserController@updateuserdetails')->name('update.user.details');
    Route::post('/delete-user','UserController@deleteuser')->name('delete.user');
    // End User Route 

});

Route::group(['prefix' => 'patient','namespace'=>'Patient','middleware'=>['auth','patient']], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/reportpdf', 'DashboardController@reportPdf')->name('report.pdf');

});


Route::group(['prefix' => 'cashier','namespace'=>'Cashier','middleware'=>['auth','cashier']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('cdashboard');



        // Create Report Route 
        Route::get('/reports','ReportController@index')->name('creports');
        Route::post('/get-testpara-by-testsetup','ReportController@getTestpara')->name('get.ctestpara-dropdown');
        Route::post('/get-testsetup-price','ReportController@getTestprice')->name('get.ctestprice');
        Route::post('/add-report','ReportController@addreport')->name('add.creport');
        Route::post('/add-test-report-result','ReportController@addtestreportresult')->name('add.ctestreportresult');
        Route::post('/status-report1','ReportController@statusreport1')->name('status.creport1');
        Route::post('/status-report0','ReportController@statusreport0')->name('status.creport0');
        Route::get('/get-report-list','ReportController@getreportlist')->name('get.creport.list');
        Route::post('/get-report-details','ReportController@getreportdetails')->name('get.creport.details');
        Route::post('/get-test-view','ReportController@gettestview')->name('get.ctest.view');
        Route::post('/update-report-details','ReportController@updatereportdetails')->name('update.creport.details');
        Route::post('/delete-report','ReportController@deletereport')->name('delete.creport');
        Route::get('/bill-reciept/{id}','ReportController@bill')->name('bill.cprint');
        // End Create Report Route 
    
        
        // Pending & Issued Report Route 
        Route::get('/pending','PendingIssuedController@index')->name('cpending');
        Route::get('/issued','PendingIssuedController@issued')->name('cissued');
        Route::get('/report-print/{id}','PendingIssuedController@reportprint')->name('creport.print');
        Route::post('/add-test-report-result','PendingIssuedController@addtestreportresult')->name('add.ctestreportresult');
        Route::get('/get-pendingreport-list','PendingIssuedController@getpendingreportlist')->name('get.cpendingreport.list');
        Route::get('/get-issuedreport-list','PendingIssuedController@getissuedreportlist')->name('get.cissuedreport.list');
        // End Pending & Issued Report Route 

     // Doctor Route 
     Route::get('/doctors','DoctorController@index')->name('cdoctors');
     Route::post('/add-doctor','DoctorController@adddoctor')->name('add.cdoctor');
     Route::get('/get-doctor-list','DoctorController@getdoctorlist')->name('get.cdoctors.list');
     Route::post('/get-doctor-details','DoctorController@getdoctordetails')->name('get.cdoctor.details');
     Route::post('/update-doctor-details','DoctorController@updatedoctordetails')->name('update.cdoctor.details');
     Route::post('/delete-doctor','DoctorController@deletedoctor')->name('delete.cdoctor');
     // End Doctor Route 
 

      // Date Report Route 
      Route::get('/dated','DatedController@dated')->name('cdated');
      Route::post('/reportsearch','DatedController@datesearch')->name('creportsearch');
      Route::get('/get-datedreport-list','DatedController@getdatedreportlist')->name('get.cdatedreport.list');
      // End Date Report Route 

});



