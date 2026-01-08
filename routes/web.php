<?php

use App\Http\Controllers\KycController;
// use App\Http\Controllers\ApiController3;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/{any}', function () {
//     return file_get_contents('public_path('site/index.html')');

// })->where('any', '^(?!api).*$');


Route::get('/hash-form', function() {
    return view('form');
});

// Route::post('/submit-form', 'SearchDataController1@handleForm')->name('submitForm');


/*HomeController */
Route::get('/home','HomeController@index')->name('home')->middleware('auth');
/* SiteController */
#Route::get('/', 'SiteController@home');
// Route::get('/', 'Auth\LoginController@showLoginForm');

Route::match(['get', 'post'], '/contact', 'SiteController@contact')->name('contact');
Route::get('/company','SiteController@company');
// Route::contactget('/careers','SiteController@careers');
// Route::get('/contact','SiteController@');
Route::any('/enquieryform','KycController@enquieryform');
Route::any('/bank-statement-analyser','SiteController@bankstatementanalyser');
Route::get('/db_doc_collection','SiteController@db_doc_collection');
Route::get('/debt_recovery','SiteController@debt_recovery');
Route::get('/customer_verification','SiteController@customer_verification');
Route::get('/e_kyc','SiteController@e_kyc');
Route::get('/video_kyc','SiteController@video_kyc');
Route::get('/e_sign','SiteController@e_sign');
Route::get('/aadhar_masking','SiteController@aadhar_masking');
Route::get('/db_fmatch','SiteController@db_fmatch');
Route::get('/e_nach_e_mandate','SiteController@e_nach_e_mandate');
Route::get('/offline_aadhar','SiteController@offline_aadhar');
Route::get('/multitenant','SiteController@aadhar_masking');
Route::get('/blog', 'SiteController@blog');
Route::get('blog/{post}','SiteController@show')->name('blog.show');

Route::get('/upload', 'FileUploadController@showUploadForm')->name('upload.form');
Route::post('/upload', 'FileUploadController@uploadFile')->name('upload.file');

/*BillingController*/

// Route::any('/billing','BillingController@index')->name('billing.list_prepaid');
// Route::any('/billing/addwallet','BillingController@addwallet')->name('billing.add_wallet');
// Route::any('/billing/deductwallet','BillingController@deductwallet')->name('billing.deduct_wallet');
// Route::any('/billing/add_walletadmin','BillingController@add_walletadmin')->name('billing.add_walletadmin');
// Route::post('/billing/success','BillingController@successPayment');
// Route::post('/billing/failure','BillingController@failurePayment');

Route::post('/billing/addwallet', 'BillingController@addwallet')->name('billing.add_wallet');
Route::post('/billing/add_walletadmin', 'BillingController@add_walletadmin')->name('billing.add_walletadmin');
Route::any('/billing/deductwallet', 'BillingController@deductwallet')->name('billing.deduct_wallet');
Route::post('/billing/success/','BillingController@successPayment');
Route::post('/billing/failure','BillingController@failurePayment');
Route::get('/success_url/{amount}/{txnid}/{email}','BillingController@WalletSuccessPayment');
Route::get('/failure_url/{name_on_card}/{error_Message}','BillingController@WalletFailurePayment');
Route::get('/payment_success/{amount}/{txnid}','BillingController@redirectSuccessPayment')->name('payment_success');
Route::post('/billing/add_wallet_user','BillingController@addwalletuseramount')->name('billing.addwalletuseramount');

/*ApiController*/
Route::get('/apiList', 'ApiController@index')->name('api.list');
Route::get('/sitechange', 'ApiController@websitechange')->name('api.sitechange'); 
Route::post('/upload-site','ApiController@uploadsite')->name('upload.site');
Route::get('/apiAdd', 'ApiController@add')->name('api.add');
Route::post('/apiCreate','ApiController@create')->name('api.create');
Route::post('/apiUpdate','ApiController@update')->name('api.update');
Route::get('/api_docs', 'ApiController@api_docs')->name('api.api_docs');

/* SchemeTypeMasterController */
Route::get('/schemeTypeList','SchemeTypeController@index')->name('scheme_type.list');
Route::get('/schemeTypeAdd', 'SchemeTypeController@add')->name('scheme_type.add');
Route::post('/schemeTypeCreate','SchemeTypeController@create')->name('scheme_type.create');
Route::get('/schemeTypeEdit/{id}','SchemeTypeController@edit')->name('scheme_type.edit');
Route::post('/schemeTypeUpdate','SchemeTypeController@update')->name('scheme_type.update');
Route::get('/schemeTypeDelete/{id}','SchemeTypeController@delete')->name('scheme_type.delete');

/*User Scheme*/
Route::get('/userSchemeList','UserSchemeController@index')->name('user.scheme.list');
Route::get('/userSchemeAdd', 'UserSchemeController@add')->name('user.scheme.add');
Route::post('/userSchemeCreate','UserSchemeController@create')->name('user.scheme.create');

/* UsersController */
Route::get('/userList', 'UserController@index')->name('user.list');
Route::get('/userAdd', 'UserController@add')->name('user.add');
Route::get('/userEdit/{id}','UserController@edit')->name('user.edit');
Route::get('/userStatus/{id}','UserController@status')->name('user.status');
Route::get('/userDelete/{id}', 'UserController@delete')->name('user.delete');
Route::post('/userCreate', 'UserController@create')->name('user.create');
Route::post('/userUpdate','UserController@update')->name('user.update');
Route::get('/userChangePassword','UserController@changePassword')->name('user.changePassword');
Route::post('/userChangePasswordSave', 'UserController@changePasswordSave')->name('user.changePasswordSave');
Route::get('/userSetNewPassword/{id}', 'UserController@setNewPassword')->name('user.setNewPassword');
Route::post('/userSetNewPasswordSave', 'UserController@setNewPasswordSave')->name('user.setNewPasswordSave');

/* Transaction  */
Route::get('/transactionList','TransactionController@index')->name('transaction.list');
Route::get('/getTransactions','TransactionController@getTransactions')->name('getTransactions');

/* Report */
Route::any('/reportList','ReportController@index')->name('reports.list');
Route::any('/generate_bill','ReportController@generateBill')->name('reports.generate_bill');
Route::get('/reportFile/{filename}','ReportController@reportfile')->name('report.file');
Route::get('/pdf','ReportController@pdf')->name('report.pdf');
Route::get('/sendemail','ReportController@sendemail')->name('test.email');

/*User Profile */
Route::get('/userProfile', 'ProfileController@profile')->name('user.profile');
Route::post('/userProfileSubmit', 'ProfileController@submitProfileUser')->name('user.submitProfile');
Route::post('/userProfileDocument', 'ProfileController@documents')->name('user.documents');
Route::post('/usersProfileDocument', 'ProfileController@submitProfileUsers')->name('users.documents');

 /* KycController */
 Route::get('/getPlanValues','KycController@getPlanValues')->name('getPlanValues');
 /*Pancard */
Route::any('/kyc/pancard','KycController@pancard')->name('kyc.pancard');
/*Aadhar */
Route::any('/kyc/aadhaar_validation','KycController@aadhaar_validation')->name('kyc.aadhaar_validation');
Route::any('/kyc/aadhaar_upload', 'KycController@aadhaar_upload')->name('kyc.aadhaar.upload');
Route::any('/kyc/aadhaar_otp_genrate','KycController@aadhaar_otp_genrate')->name('kyc.aadhaar_otp_genrate');
Route::any('/kyc/aadhaar_otp_submit', 'KycController@aadhaar_otp_submit')->name('kyc.aadhaar_otp_submit');
Route::any('/kyc/aadhaar_masking','KycController@aadhaar_masking')->name('kyc.aadhaar_masking');
Route::any('/kyc/aadhar_ocr_masking','KycController@aadhar_ocr_masking')->name('kyc.aadhar_ocr_masking');
Route::any('/kyc/aadharcard/ocr','KycController@aadharcard_ocr')->name('kyc.aadharcard_ocr');
/*Voter Id */
Route::any('/kyc/voter_validation','KycController@voter_validation')->name('kyc.voter_validation');
Route::any('/kyc/voter_upload','KycController@voter_upload')->name('kyc.voter.upload');
Route::any('kyc/voterid/ocr','KycController@voterId_ocr')->name('kyc.voterid.ocr');
Route::any('/kyc/searchkyc_lite1','KycController@searchkyclite1')->name('kyc.searchkyc.lite1');
Route::any('/kyc/pull_kra','KycController@pull_kra')->name('kyc.pull_kra');
Route::any('/kyc/passport_get_client_details','KycController@passport_get_client_details')->name('kyc.passport_get_client_details');
//KYC (MKYCDOCS)
/*Pancard*/
Route::any('/kyc/udyam_details/search/api/v2','KycController@udyam_newdetails_api_search')->name('kyc.udyam.details.api.search.v2');
Route::any('/kyc/udyam_details/search/v2','KycController@udyam_newdetails_search')->name('kyc.udyam.details.search.v2');
Route::any('/kyc/udyam_api/v2','KycController@udyam_newapi')->name('kyc.udyam_api.v2');
Route::any('/kyc/udyam_details/v2','KycController@udyam_newdetails')->name('kyc.udyam.details.v2');
Route::any('/kyc/rccount', 'KycController@rc_count')->name('kyc.rccount');
Route::any('/kyc/registrationpay','ApiController2@paymentform')->name('kyc.paymentform');
Route::any('/kyc/payment', 'ApiController2@payment')->name('kyc.payment');
Route::any('/kyc/pancard', 'KycController@pancard')->name('kyc.pancard');
Route::any('/kyc/pancard_upload','KycController@pancard_upload')->name('kyc.pancard.upload');
Route::any('/kyc/pancard_details','KycController@pancard_details')->name('kyc.pancard.details');
Route::any('kyc/pancard/ocr','KycController@pancard_ocr')->name('kyc.pancard.ocr');
Route::any('/kyc/pancard_new_info','KycController@pancard_new_info')->name('kyc.pancard.new_info');
Route::any('/kyc/script_tracing','KycController@script_tracing')->name('kyc.pancard.script_tracing');
Route::any('kyc/pantogst','KycController@pantogst')->name('kyc.pantogst');
Route::get('kyc/pantogst_api','KycController@pantogstapi')->name('kyc.pantogst_api');

/*Passport*/
Route::any('/kyc/passport/passportverify','KycController@passportverify')->name('kyc.verify__passport');
Route::any('/kyc/passport_create_client', 'KycController@passport_create_client')->name('kyc.passport_create_client');
Route::any('/kyc/passport_upload','KycController@passport_upload')->name('kyc.passport_upload');
Route::any('/kyc/passport_verify','KycController@passport_verify')->name('kyc.passport_verify');
Route::any('/kyc/passport/ocr','KycController@passport_ocr')->name('kyc.passport_ocr');

/*Corporate */
Route::any('kyc/corporate_cin','KycController@corporate_cin')->name('kyc.corporate_cin');
Route::any('kyc/corporate_din','KycController@corporate_din')->name('kyc.corporate_din');
Route::any('kyc/corporate_gstin','KycController@corporate_gstin')->name('kyc.corporate_gstin');
Route::any('kyc/corporate_gstin_confidence','KycController@corporate_gstin_confidence')->name('kyc.corporate_gstin_confidence');
Route::any('kyc/basic/gstin','KycController@basicGstinVerification')->name('kyc.basic.gstin');
Route::get('kyc/basic/gstin_api','KycController@basicGstinVerificationApi')->name('kyc.basic.gstin_api');
Route::any('kyc/corporate/basic','KycController@corporate_basic')->name('kyc.corporate.basic');
Route::any('kyc/corporate/advanced','KycController@corporate_advanced')->name('kyc.corporate.advanced'); 
Route::get('kyc/corporate/basic/api','KycController@corporate_basic_api')->name('kyc.corporate.basic.api');
Route::get('kyc/corporate/advanced/api','KycController@corporate_advanced_api')->name('kyc.corporate.advanced.api'); 
/*Rc Validation */
Route::any('/kyc/rc_validation','KycController@rc_validation')->name('kyc.rc_validation');
Route::any('/kyc/rc_validationmp', 'KycController@rc_validationmp')->name('kyc.rc_validationmp');
Route::any('/kyc/rc_validationlite', 'KycController@rc_validationlite')->name('kyc.rc_validationlite');
Route::any('/kyc/fasttag_information','KycController@fasttag_information')->name('kyc.fasttag_information');
Route::any('/kyc/rc_full_validation', 'KycController@rc_full_validation')->name('kyc.rc_full_validation');
/*Bank Verification */
Route::any('kyc/bank_verification', 'KycController@bank_verification')->name('kyc.bank_verification');
Route::any('kyc/bank_ifsc','KycController@bank_verification_find_ifsc')->name('kyc.bank_ifsc');
Route::any('kyc/bank_statement','KycController@bank_statement')->name('kyc.bank_statement');
Route::any('kyc/bank_analyser','KycController@bank_analyser')->name('kyc.bank_analyser');


/*Driving Licences */
Route::any('/kyc/license/ocr','KycController@drivinglicense_ocr')->name('kyc.license_ocr');
Route::any('/kyc/license_validation','KycController@license_validation')->name('kyc.license_validation');
Route::any('/kyc/license_upload','KycController@license_upload')->name('kyc.license.upload');
/*API LIST */
Route::any('/kyc/pancard_api','KycController@pancard_api')->name('kyc.pancard_api');
Route::any('/kyc/aadhaar_api', 'KycController@aadhaar_api')->name('kyc.aadhaar_api');
Route::any('kyc/corporate_gstin_api','KycController@corporate_gstin_api')->name('kyc.corporate_gstin_apis');
Route::any('passport_api', 'KycController@passport_api')->name('kyc.passport_api');
Route::any('kyc/corporate_cin_apis','KycController@corporate_cin_apis')->name('kyc.corporate_cin_apis');
Route::any('kyc/corporate_din_apis','KycController@corporate_din_apis')->name('kyc.corporate_din_apis');
Route::any('kyc/corporate_gstin_confidence_api','KycController@corporate_gstin_confidence_api')->name('kyc.corporate_gstin_confidence_api');
Route::any('/kyc/rc_api','KycController@rc_api')->name('kyc.rc_api');
Route::any('/kyc/license_api','KycController@license_api')->name('kyc.license_api');
Route::any('all_apis','KycController@all_apis')->name('all_apis');
Route::any('/kyc/voter_api','KycController@voter_api')->name('kyc.voter_api');

/*Esign Old */
 Route::any('/kyc/esign_initialize','KycController@esign_initialize')->name('kyc.esign_initialize');
 Route::any('/esign/esign_docboyz','KycController@esign_docboyz')->name('esign.esign_docboyz');
/*Esign*/

Route::get('esignature','EsignController@index')->name('esignature');
Route::post('esign_generate','EsignController@GenerateEsignXml')->name('esign_generate');
Route::post('reponse_new/{id}/{sign_method}','EsignController@reponseUrl');
Route::get('getsign/document/{id}/{sign_method}','EsignController@getSignDocument')->name('getsign.document');
/*Esign Api*/
// Route::get('esign_signnature/{token}','EsignApiController@index')->name('esign_signnature');
// Route::post('esign_generatexmal','EsignApiController@GenerateEsignXml')->name('esign_generatexmal');
// Route::post('reponses/{id}/{sign_method}','EsignApiController@reponseUrl');

Route::get('esign_signnature/{token}','EsignApiController@index')->name('esign_signnature');
Route::post('esign_generatexmal','EsignApiController@GenerateEsignXml')->name('esign_generatexmal');
Route::post('reponses/{id}/{sign_method}/{user_access_token}','EsignApiController@reponseUrl');
Route::get('getsign_document/{id}/{sign_method}/{access_token}','EsignApiController@getSignDocument')->name('getsign_document');

/*Esign DocBoyz */

//ownapi
Route::any('kyc/ownapi','KycController@ownapi')->name('kyc.ownapi');

// Temp Route for route validation error
Route::any('/kyc/tempdriving','KycController@pancard')->name('temp.driving');
// esign third party

Route::any('/kyc/esign_upload_link','KycController@esign_upload_link')->name('kyc.esign_upload_link');
Route::any('/kyc/esign_get_client_link','KycController@esign_get_client_link')->name('kyc.esign_get_client_link');
Route::any('kyc/electricity_operator_code_list','KycController@electricity_operator_code_list')->name('kyc.electricity_operator_code_list');
Route::any('kyc/esign','KycController@esign')->name('kyc.esign');


/*crif */
Route::any('/creditreport','CrifController@crif')->name('other.crif');
Route::any('/creditreport_apis','CrifController@creditreport_apis')->name('other.crif_apis');

Route::any('/equifax','LiveEquifaxController@equifax')->name('other.equifax');
Route::get('/idtypes','LiveEquifaxController@idtypes')->name('idtypes');
/*ITR*/
Route::any('itr/itr_initiate','ItrController@itr_initiate')->name('itr.itr_initiate');
Route::any('itr/itr_enter_clientid','ItrController@itr_enter_clientid')->name('itr.itr_enter_clientid');
Route::any('itr/itr_download','ItrController@itr_download')->name('itr.itr_download');
Route::any('itr/itr_download_profile','ItrController@itr_download_profile')->name('itr.itr_download_profile');
Route::any('itr/itr_download_26AS', 'ItrController@itr_download_26AS')->name('itr.itr_download_26AS');
Route::any('itr/itr_forget_password','ItrController@itr_forget_password')->name('itr.itr_forget_password');
Route::any('itr/itr_submit_otp', 'ItrController@itr_submit_otp')->name('itr.itr_submit_otp');
/*Other */
Route::any('kyc/electricity','KycController@electricity')->name('kyc.electricity');
Route::any('kyc/shopestablishment','KycController@shopestablishment')->name('kyc.shopestablishment');
Route::any('kyc/telecom','KycController@telecom')->name('kyc.telecom_generate_otp');
Route::any('kyc/telecom_submit_otp','KycController@telecom_submit_otp')->name('kyc.telecom_submit_otp');
Route::any('/kyc/usage','KycController@usage')->name('kyc.usage');
Route::any('kyc/fssi','KycController@fssi_verification')->name('kyc.fssi_validation');
Route::any('/kyc/upi_validation','KycController@upi_validation')->name('kyc.upi_validation');
Route::any('telecom_apis','KycController@telecom_apis')->name('kyc.telecom_apis');
Route::any('/kyc/fssai_api','KycController@fssai_api')->name('kyc.fssai_api');
     /*EPFO*/
Route::any('kyc/pf_generete_otp','KycController@pf_generate_otp')->name('kyc.pf_generate_otp');
Route::any('kyc/pf_submit_otp', 'KycController@pf_submit_otp')->name('kyc.pf_submit_otp');
Route::any('kyc/pf_without_otp', 'KycController@pf_without_otp')->name('kyc.pf_without_otp');
Route::any('kyc/uan_details', 'KycController@uan_details')->name('kyc.uan_details');
Route::any('kyc/company_search', 'KycController@company_search')->name('kyc.company_search');
Route::any('kyc/company_details', 'KycController@company_details')->name('kyc.company_details');

// Route::any('/kyc/tempownapi', [KycController@,'pancard'])->name('temp.ownapi');
Route::any('/kyc/tempvendor', 'KycController@pancard')->name('temp.vendor');
//Route::any('/kyc/tempsmartship',[KycController@,'pancard'])->name('temp.smartship');
/*Credit Sccore */
Route::get('/equifax_score','LiveEquifaxController@scoreEquifax')->name('other.equifax_score');
Route::post('equifax_score_submit','LiveEquifaxController@scoreEquifaxSubmit')->name('equifax_score_submit');
Route::get('equifax_score_idtypes','LiveEquifaxController@equifaxScoreIdtypes')->name('other.equifax_score_idtypes');
Route::post('/verifyotp','CrifController@verifyotp');
Route::post('/sendotp','CrifController@sendOTP');

//SMARTSHIP
Route::any('smartship','SmartshipController@login')->name('temp.smartship');
Route::any('smartship/refresh_token','SmartshipController@refresh_token')->name('smartship.refresh');
Route::any('smartship/add_hub','SmartshipController@add_hub')->name('smartship.add_hub');
Route::any('smartship/register_order','SmartshipController@register_order')->name('smartship.register_order');
Route::any('smartship/get_hub','SmartshipController@get_hub_details')->name('smartship.get_hub_details');
Route::any('smartship/update_hub','SmartshipController@update_hub_details')->name('smartship.update_hub_details');
Route::any('smartship/delete_hub','SmartshipController@delete_hub_details')->name('smartship.delete_hub_details');
Route::any('smartship/create_manifest','SmartshipController@create_manifest')->name('smartship.create_manifest');
Route::any('smartship/hub_serviceability','SmartshipController@hub_serviceability')->name('smartship.hub_serviceability');
//temp_order_registration
Route::any('smartship/order',function(){
	return view('smartship.order_register');
});

Route::any('/kyc/temptest','KycController@pancard')->name('temp.test');
Route::any('/kyc/tempbluedart','KycController@pancard')->name('temp.bluedart');
Route::any('/kyc/tempvendor2','KycController@pancard')->name('temp.vendor2');
Route::any('/kyc/tempjitsi', 'KycController@pancard')->name('temp.jitsi');
Route::any('/kyc/tempvendorapi','KycController@pancard')->name('temp.vendorapi');

Route::any('/apidocs/apidocs','ApidocController@index')->name('apidocs.apidocs');

/*Fatch Match */
Route::any('kyc/face_match','KycController@face_match')->name('kyc.face_match');
Route::any('kyc/face_match_api','KycController@face_match_api')->name('kyc.face_match_api');
Route::any('/kyc/search_api', 'KycController@search_api')->name('kyc.search_api');
/*Search */
Route::any('/kyc/searchkyc','KycController@searchkyc')->name('kyc.searchkyc');
Route::any('/kyc/searchkyc_lite','KycController@searchkyclite')->name('kyc.searchkyc.lite');
Route::any('/kyc/pancard_details','KycController@pancard_details')->name('kyc.pancard.details');
Route::any('/kyc/ckycsearchadvance','KycController@ckycSearchAdvance')->name('kyc.ckycsearchadvance');
Route::any('/kyc/ckyc_production','KycController@ckycSearchAdvance_production')->name('kyc.ckyc_production');
Route::any('/kyc/ckysearch_advance_api','KycController@ckysearch_advance_api')->name('kyc.ckysearch_advance_api');
Route::post('/ckyc/sendotp','KycController@sendOtp')->name('kyc.ckycsearchproduction');;
Route::post('/ckyc/verifyotp','KycController@verifyOtp')->name('kyc.verifyOtp');
Route::any('/kyc/ckycsearchdata','KycController@ckycsearchdata')->name('kyc.ckycsearchdata.lite');
Route::any('/kyc/ckycsearch_api','KycController@ckycsearch_api')->name('kyc.ckycsearch_api');
Route::any('/kyc/ckycdownload','KycController@ckycdownload')->name('kyc.ckycdownload.lite');
Route::any('/kyc/ckycdownload_api','KycController@ckycdownload_api')->name('kyc.ckycdownload_api');
/*Udyam search and udyam udyog */
Route::any('/kyc/udyam_details','KycController@udyam_details')->name('kyc.udyam.details');
Route::any('/kyc/udyogadhar_details','KycController@udyogadhar_details')->name('kyc.udyog.details');
Route::any('/kyc/udyam_api', 'KycController@udyam_api')->name('kyc.udyam_api');
Route::any('/kyc/udyamadhar_api','KycController@udyamadhar_api')->name('kyc.udyamadhar_api');

// Vaccine  Auth
Route::any('vaccine/auth/vaccine_genrate_otp','VaccineController@vaccine_genrate_otp')->name('vaccine.vaccine_genrate_otp');
Route::any('vaccine/auth/vaccine_submit_otp', 'VaccineController@vaccine_submit_otp')->name('vaccine.vaccine_submit_otp');
Route::any('vaccine/auth/vaccine_get_details','VaccineController@vaccine_get_details')->name('vaccine.vaccine_get_details');

// Vaccine  Booking/registration
Route::any('vaccine/booking/registration/beneficiary/benefiaries_registration_api','VaccineController@benefiaries_registration_api')->name('vaccine.benefiaries_registration_api');
Route::any('vaccine/booking/registration/beneficiary/delete_benefiaries','VaccineController@delete_benefiaries')->name('vaccine.delete_benefiaries');
Route::any('vaccine/booking/registration/beneficiary/get_gender','VaccineController@get_gender')->name('vaccine.get_gender');
Route::any('vaccine/booking/registration/download_vaccination_certificates','VaccineController@download_vaccination_certificates')->name('vaccine.download_vaccination_certificates');

// Vaccine  admin & Location
Route::any('vaccine/booking/admin_location/vaccine_get_states','VaccineController@vaccine_get_states')->name('vaccine.vaccine_get_states');
Route::any('vaccine/booking/admin_location/vaccine_get_list_of_districts','VaccineController@vaccine_get_list_of_districts')->name('vaccine.vaccine_get_list_of_districts');

// Vaccine  Booking/appointment
Route::any('vaccine/booking/appointment/create_appointment_vaccine','VaccineController@create_appointment_vaccine')->name('vaccine.create_appointment_vaccine');
Route::any('vaccine/booking/appointment/cancle_appointment_vaccine','VaccineController@cancle_appointment_vaccine')->name('vaccine.cancle_appointment_vaccine');
Route::any('vaccine/booking/appointment/reschedule_appointment_vaccine','VaccineController@reschedule_appointment_vaccine')->name('vaccine.reschedule_appointment_vaccine');
Route::any('vaccine/booking/appointment/download_appointment_details_vaccine','VaccineController@download_appointment_details_vaccine')->name('vaccine.download_appointment_details_vaccine');
Route::any('vaccine/booking/appointment/get_list_benefiaries_vaccine','VaccineController@get_list_benefiaries_vaccine')->name('vaccine.get_list_benefiaries_vaccine');
Route::any('vaccine/booking/appointment/get_vaccine_center_lat_long','VaccineController@get_vaccine_center_lat_long')->name('vaccine.get_vaccine_center_lat_long');
// Vaccine  Booking/appointment/session
Route::any('vaccine/booking/appointment/session/vaccine_session_by_district','VaccineController@vaccine_session_by_district')->name('vaccine.vaccine_session_by_district');
Route::any('vaccine/booking/appointment/session/vaccine_session_by_district_for_seven_days','VaccineController@vaccine_session_by_district_for_seven_days')->name('vaccine.vaccine_session_by_district_for_seven_days');
Route::any('vaccine/booking/appointment/session/vaccine_session_by_pin', 'VaccineController@vaccine_session_by_pin')->name('vaccine.vaccine_session_by_pin');
Route::any('vaccine/booking/appointment/session/vaccine_session_by_pin_for_seven_days','VaccineController@vaccine_session_by_pin_for_seven_days')->name('vaccine.vaccine_session_by_pin_for_seven_days');
//newly api
Route::get('/consumerproduct','ConsumerProductController@index');
Route::post('/consumerproduct','ConsumerProductController@consumerproductstored')->name('consumerproduct');
Route::get('/businesstype','ConsumerProductController@businesstype')->name('businesstype');
Route::get('/businesskyc','ConsumerProductController@businesskyc')->name('businesskyc');
Route::any('/equifaxurl','ConsumerProductController@equifax')->name('consumer.equifaxurl');
Route::any('/linksend/{id}','LinkController@index')->name('linksend');
Route::any('/linkpdf/{id}','LinkController@exportdownload')->name('linkpdfdownload');
Route::get('/documentname','ConsumerProductController@documentname')->name('documentname');
Route::get('/consumerpancard','ConsumerProductController@pancardvalidation')->name('consumerpancard');
Route::get('/consumeraadhaar','ConsumerProductController@aadhaarvalidation')->name('consumeraadhaar');
Route::get('/esigninitialized','ConsumerProductController@esigninitialized')->name('esigninitialized');
Route::get('/branding','SetBrandingController@index')->name('branding');
Route::post('/branding_post','SetBrandingController@branding')->name('branding.post');
/*E-nach auto seamless in Ease buzz */
Route::get('enach_seameless','EnachAutoSeamlessPaymentController@initiateEnachSamelessPayment')->name('enach_seameless');
Route::get('enach_payment_seameless/{token}','ApiController2@initiateEnachSamelessPayment')->name('enach_seamelesss');
Route::post('enach_seameless_submit','EnachAutoSeamlessPaymentController@initiateEnachSamelessPaymentPost')->name('enach_seameless_submit');
Route::post('enach_seamless_payment_success','EnachAutoSeamlessPaymentController@successPayment');
Route::post('enach_seamless_payment_failure','EnachAutoSeamlessPaymentController@failurePayment');
Route::get('seamless_payment/{access_key}','EnachAutoSeamlessPaymentController@seamlessPayment')->name('seamless_payment');
Route::post('seamless_payment_submit','EnachAutoSeamlessPaymentController@seamlessPaymentSubmit');
Route::get('page_not_found','EnachAutoSeamlessPaymentController@pageNotFound')->name('page_not_found');

/*E-nach non-seamless Payment gateway in Ease Buzz */
Route::get('e-nach-initiate-payment','ENachPaymentController@initiatePayment')->name('e-nach-initiate-payment');
Route::get('e-nach-initiate-payments/{token}','ApiController2@initiatePayment')->name('e-nach-initiate-payments');
Route::post('e-nach-initiate-payment-post','ENachPaymentController@initiatePaymentPost')->name('e-nach-initiate-payment-post');
Route::post('e-nach-payment-success','ENachPaymentController@successPayment');
Route::post('e-nach-payment-failure','ENachPaymentController@failurePayment');
Route::post('e-nach-payment-failures/{token}','ApiController2@failurePayment');
Route::post('successResponse','PaymentController@successResponse');
Route::post('failureResponse','PaymentController@failureResponse');

/*******************Blog Route ******************************************/

Route::get('/blog_dashboard','BlogController@dashboard')->name('blog_dashboard');
Route::get('/blogs/{id}', 'SiteController@show')->name('blogs.show'); 
Route::get('/blog_list','BlogController@blog')->name('blog_list');
Route::get('/create','BlogController@createBlog')->name('create');
Route::post('create-post','BlogController@createBlogSubmit');
Route::get('edit/{id?}','BlogController@edit');
Route::post('update/{id?}','BlogController@update')->name('update');
Route::get('delete/{id?}','BlogController@delete')->name('delete');

/**************Payment Gatway **********************************/
Route::get('initiate-payment-integration','PaymentController@initiatePaymentProcess')->name('initiate-payment-integration');
Route::get('initiate-payment-integrations/{token}','ApiController2@initiatePaymentProcess')->name('initiate-payment-integrations');
Route::post('initiate-payment-integration-post','PaymentController@initiatePaymentProcessPost')->name('payment-integration-post');
Route::post('/success','BillingController@successPayment');
Route::post('/failure','BillingController@failurePayment');
//bhunaksha
Route::any('kyc/bhunakasha','KycController@bhunakasha')->name('kyc.bhunakasha');
Route::any('kyc/bhunaksha','KycController@bhunakasha_dropdown')->name('kyc.bhunaksha');

//document url
Route::any('kyc/api/bhunakasha','KycController@bhunakasha_api')->name('kyc.bhunakasha.api');
/*Video Kyc */
Route::any('/kyc/video_kyc/video_kyc_docboyzapi','VideokycController@videokyc_docboyzapi_initialize')->name('video_kyc.videokyc_docboyzapi_initialize');

/*Address API */
Route::get('kyc/autopopulate/search_all','KycController@autopopulateAddressSearch');
Route::any('kyc/verify_address','KycController@verifyAddress')->name('kyc.verify_address');
Route::any('kyc/get_place','KycController@getPlace')->name('kyc.get_place');
Route::any('kyc/getcoordinate','KycController@getCoordinate')->name('kyc.getcoordinate');
Route::any('kyc/create_geofence','KycController@createGeofence')->name('kyc.create_geofence');
Route::any('kyc/autocomplete','KycController@autoComplate')->name('kyc.autocomplete');
Route::get('kyc/autopopulate','KycController@autoFatchAddress');

/*Verify Email */
Route::any('kyc/verify_email','KycController@verify_email')->name('kyc.verify_email');
Route::any('kyc/check_verify_email_status','KycController@check_verify_email_status')->name('kyc.check_verify_email_status');
Route::any('kyc/verify_email_api','KycController@email_verify_api')->name('kyc.verify_email_api');
Route::any('kyc/check_verify_email_status_api','KycController@check_verify_email_status_api')->name('kyc.check_verify_email_status_api');
/*Dedupe Api*/
Route::get('kyc/dedupe_api','KycController@dedupe_api')->name('kyc.dedupe_api');
Route::any('kyc/dedupe','KycController@dedupe')->name('kyc.dedupe');

Route::get('search/data','SearchDataController@searchall')->name('search.data');
Route::post('search_all','SearchDataController@searchallData');
Route::post('search_all/pagination','SearchDataController@pagination');
Route::post('search_excel','SearchDataController@downloadExcel')->name('search.download.excel');
Route::any('kyc/bankstatement','KycController@bankStatementNew')->name('kyc.bankstatement');
Route::any('kyc/bankstatement/api','KycController@bankStatementNew')->name('kyc.bankstatement.api');
/* Single Search */
Route::any('/kyc/single/search','kycSingleSearchApiController@searchApi')->name('kyc.single.search');
Route::any('/kyc/single/search/api','kycSingleSearchApiController@searchApiDoc')->name('kyc.single.search.api');
Route::any('/kyc/single/search/aadhaar_otp_submit', 'kycSingleSearchApiController@aadhaar_otp_submit_search')->name('kyc.single.search.aadhaar_otp_submit');
Route::any('/kyc/single/search/telecom_submit_otp_search', 'kycSingleSearchApiController@telecom_submit_otp_search')->name('kyc.single.search.telecom_submit_otp_search');
Route::get('jhar/distracts/{jhar_district}', 'KycController@getJharkhandDistract');
Route::get('jhar/circles/{jhar_circle}','KycController@getJharkhandCircles');
Route::get('jhar/halkas/{jhar_halka}','KycController@getJharkhandHalkas');
Route::get('jhar/mauza/{jhar_mauza}','KycController@getJharkhandMauza');
//GOA
Route::get('goa/distracts/{goa_district}', 'KycController@getGoaDistract');
Route::get('goa/taluka/{goa_taluk}', 'KycController@getGoaTaluka');
Route::get('goa/village/{goa_village}','KycController@getGoaVillage');
//Lakshadweep
Route::get('lakshadweep/distract/{lakshadweep_district}', 'KycController@getLakshdaweepDistrict');
Route::get('lakshadweep/taluka/{lakshadweep_taluka}', 'KycController@getLakshdaweepTaluka');
Route::get('lakshadweep/village/{lakshadweep_village}', 'KycController@getLakshdaweepVillage');
//Chhatisgarh
Route::post('chhatisgarh/distract','KycController@getChhatisgarhDistrict');
Route::get('chhatisgarh/tehsil/{chhatisgarh_tehsil}', 'KycController@getChhatisgarhTehsil');
Route::get('chhatisgarh/ri_circle/{chhatisgarh_ri_circle}', 'KycController@getChhatisgarhRiCircle');
//Rajshthan
Route::post('rajasthan/distract','KycController@getRajasthanDistrict');
Route::get('rajasthan/tehsil/{rajasthan_tehsil}', 'KycController@getRajasthanTehsil');
Route::get('rajasthan/ri_circle/{rajasthan_ri}', 'KycController@getRajasthanRi');
Route::get('rajasthan/ri_halkas/{rajasthan_halkas}', 'KycController@getRajasthanHalkas');
Route::get('rajasthan/ri_village/{ri_village}', 'KycController@getRajasthanVillage');
//Odisha
Route::post('odisha/distract','KycController@getOdishaDistrict');
Route::get('odisha/tehsil/{odi_tehsil}', 'KycController@getOdishaTehsil');
Route::get('odisha/ri_circle/{odi_ri_circle}', 'KycController@getOdishaRi');
Route::get('odisha/village/{odi_village}', 'KycController@getOdishaVillage');
//Kerala 
Route::post('kerala/distract','KycController@getKeralaDistrict');
Route::get('kerala/taluk/{ker_taluk}','KycController@getKeralaTaluk');
Route::get('kerala/village/{ker_village}',  'KycController@getKeralaVillage');
Route::get('kerala/blockno/{ker_blockno}', 'KycController@getKeralaBlockNumber');
Route::get('kerala/surveynumber/{ker_surveyno}', 'KycController@getKeralaSurveyNumber');
/* DUNZO APIS */
Route::get('create_logistics_task','DunzoController@create_logistics_task');
Route::post('create_logistics_task_submit','DunzoController@create_logistics_task_submit');
Route::get('create_task','DunzoController@create_task');
Route::post('create_task_submit','DunzoController@create_task_submit');
Route::get('task/{task_id}/status','DunzoController@taskStatus')->name('task.status');
Route::get('generate_task_report','DunzoController@generatePDF');
Route::get('logistices_task_report','DunzoController@generatePDF2');

/* Scrapping API */
Route::any('kyc/company_product', 'KycController@company_product')->name('kyc.company_product');
Route::any('kyc/company_product_api', 'KycController@company_product_api')->name('kyc.company_product_api');
Route::any('kyc/community_area', 'KycController@community_area')->name('kyc.community_area');
Route::any('kyc/community_area_api', 'KycController@community_area_api')->name('kyc.community_area_api');
Route::any('kyc/land','KycController@land_record')->name('kyc.land');
Route::any('kyc/land_api','KycController@land_record_api')->name('kyc.land_api');
Route::any('kyc/gstin_details','KycController@gstin_details')->name('kyc.gstin_details');
Route::any('kyc/gstin_details_api','KycController@gstin_details_api')->name('kyc.gstin_details_api');
Route::any('kyc/by_pancard','KycController@ByPancard')->name('kyc.by_pancard');
Route::any('kyc/by_pancard_api','KycController@bypancard_api')->name('kyc.by_pancard_api');
Route::any('kyc/pincode','KycController@Pincode')->name('kyc.pincode');
Route::any('kyc/pincode_api','KycController@pincode_api')->name('kyc.pincode_api');
Route::any('kyc/img_scanner','KycController@image_scanner')->name('kyc.img_scanner');
Route::any('kyc/image_scanner_api','KycController@image_scanner_api')->name('kyc.image_scanner_api');
Route::any('kyc/facematch','KycController@faceMatch')->name('kyc.facematch');
Route::any('kyc/facematch_api','KycController@faceMatch')->name('kyc.facematch_api');
Route::any('kyc/detection_face','KycController@detection_face')->name('kyc.detection_face');
Route::any('kyc/detection_face_api','KycController@detection_face_api')->name('kyc.detection_face_api');
Route::any('kyc/detection_emotion','KycController@detection_emotion')->name('kyc.detection_emotion');
Route::any('kyc/detection_emotion_api','KycController@detection_emotion_api')->name('kyc.detection_emotion_api');
Route::any('kyc/bankstatement/reader','KycController@bankstatementReader')->name('kyc.bankstatement.reader');
Route::any('kyc/bankanalyser','KycController@bankAnalyser')->name('kyc.bankanalyser');
Route::get('kyc/bank_analyser_api','KycController@bank_analyser_api')->name('kyc.bank_analyser_api');

/*Extract API */
Route::any('kyc/extract_aadharcard_text','KycController@extract_aadharcard')->name('kyc.extract_aadharcard_text');
Route::any('kyc/extract_drivinglicense_text','KycController@extract_drivinglicense')->name('kyc.extract_drivinglicense_text');
Route::any('kyc/extract_pancard_text','KycController@extract_pancard')->name('kyc.extract_pancard_text');
Route::any('kyc/extract_voterId_text','KycController@extract_voterId')->name('kyc.extract_voterId_text');

Route::any('kyc/predictppl','KycController@predictPPL')->name('kyc.predictppl');
Route::any('kyc/predictppl/api','KycController@predictPPL_api')->name('kyc.predictppl.api');
Route::any('kyc/pancard_ocr_v2','KycController@pancardOcrv2')->name('kyc.pancard_ocr_v2');

//Demo
// Route::get('/demo', 'KycController@demoform')->name('demo');
Route::any('/demo/rc','KycController@demoform')->name('kyc.deom');
Route::any('/demo/pan','KycController@demopanform')->name('kyc.demo.pan');
Route::get('/aadhaar/pdf-download/{client_id}', 'KycController@downloadPdf')->name('aadhaar.pdf');

Route::any('/kyc/mobilename_info', 'KycController@mobilenamelookup')->name('kyc.mobilename_info');
Route::any('/kyc/udyam_info', 'KycController@udyam_advanced_ui')->name('kyc.udyam_authentication');
Route::any( '/kyc/email-otp', 'KycController@email_otp')  ->name('kyc.email_otp');

Route::any('/kyc/verify-email-otp', 'KycController@verify_email_otp')->name('kyc.verify_email_otp');
Route::any('/kyc/aadhar-pan-info', 'KycController@aadhar_validation')->name('kyc.aadhar_validation');
Route::any('/kyc/pan-details', 'KycController@pandetails')
    ->name('kyc.pan-details');
      
Route::any('kyc/pan-details-plus',  'KycController@pandetailsplus') ->name('kyc.pandetailsplus');
Route::any('kyc/pan-details-v4',  'KycController@pandetailsv4')->name('kyc.pandetailsv4');
Route::any('kyc/dl-validation',  'KycController@dl_validation3')->name('kyc.dl_validation');
Route::any('kyc/rc-validate',  'KycController@rc_validate')->name('kyc.rc-validate');
Route::any('kyc/dl-validate',  'KycController@dl_validate')->name('kyc.dl_validate');

Route::any('kyc/pan-compliance',  'KycController@pan_compliance') ->name('kyc.pan-compliance');
Route::any('kyc/upi-basic',  'KycController@upi_basic') ->name('kyc.upi-basic');
Route::any('kyc/upi-basic-name', [KycController::class, 'upi_basic_name'])->name('kyc.upi_basic_name');
    Route::match(['get', 'post'], '/kyc/gstin-authentication', [KycController::class, 'gstin_authentication_ui'])
    ->name('kyc.gstin_authentication');
 Route::match(['get', 'post'], '/kyc/gstin-advanced', [KycController::class, 'gstin_advanced_ui']) ->name('kyc.gstin_advanced');
   Route::match(['get','post'], '/kyc/pan-aadhaar-link', [KycController::class,'pan_aadhaar_link_ui'])->name('kyc.pan_aadhaar_link');
Route::any('/kyc/pan-to-fname', 'KycController@pan_to_fname_ui')  ->name('kyc.pan_to_fname');
   
Route::match(['get','post'], '/kyc/arm-verification', [KycController::class,'arm_verification'])->name('kyc.arm_verification');
Route::match(['get','post'], '/kyc/pan-to-name', action: [KycController::class,'pan_to_name'])->name('kyc.pan_to_name');
Route::any('kyc/upi-merchant',  'KycController@upi_merchant')->name('kyc.upi_merchant');
Route::any('kyc/address-verification',  action: 'KycController@address_verification_ui')->name('kyc.address_verification');
Route::any('kyc/upi-enhanced',  'KycController@upi_enhanced')->name('kyc.upi_enhanced');
Route::any('kyc/company-to-name',  'KycController@company_to_pan')->name('kyc.company_to_pan');
Route::any('kyc/rc-validation-three',  'KycController@rc_validationthree')->name('kyc.rc_validationthree');
Route::any('kyc/employment-uan',  'KycController@employment_uan')->name('kyc.employment_uan');
Route::any('kyc/employment-uan-v3',  'KycController@employment_uan_v3')->name('kyc.employment_uan_v3');
Route::any('kyc/employment-uan-advanced-v2',  'KycController@employment_uan_advanced_v2')->name('kyc.employment_uan_advanced_v2');
Route::any('kyc/mobile-prefill',  action: 'KycController@mobile_prefill')->name('kyc.mobile_prefill');
Route::any('kyc/employment-uan-advanced-v3',  'KycController@employment_uan_advanced_v3')->name('kyc.uan_advanced');
Route::any('kyc/whatsapp-number-check',  'KycController@whatsapp_number_check')->name('kyc.whatsapp_number_check');
Route::any('kyc/whatsapp-advanced',  'KycController@whatsapp_advanced')->name('kyc.whatsapp_advanced');
Route::any('kyc/contact-to-gst',  'KycController@contact_to_gst')->name('kyc.contact_to_gst');
Route::any('kyc/gst-to-contacts',  'KycController@gst_to_contacts')->name('kyc.gst_to_contacts');
Route::any('kyc/ecom-generate-url',  'KycController@ecom_generate_url')->name('kyc.ecom_generate_url');
Route::any('kyc/ecom-url-username',  'KycController@ecom_url_username')->name('kyc.ecom_url_username');
Route::any('kyc/ecom-generate-url-username',  'KycController@ecom_generate_url_username')->name('kyc.ecom_generate_url_username');
Route::any('kyc/tan-to-company',  'KycController@tan_to_company')->name('kyc.tan_to_company');
Route::any('/kyc/ecom-generate-url-order-duration', 'KycController@ecom_generate_url_order_duration')->name('kyc.ecom_generate_url_order_duration');
Route::any('/kyc/mobile-upi-lookup', 'KycController@mobile_upi_lookup')->name('kyc.mobile_upi_lookup');
Route::any('/kyc/mobile-upi-name', 'KycController@mobile_upi_name')->name('kyc.mobile_upi_name');
Route::any('/kyc/ecom-website-list', 'KycController@ecom_websites_list')->name('kyc.ecom_websites_list');
Route::any('/kyc/upi-basic-pan', 'KycController@upi_basic_pan')->name('kyc.upi_basic_pan');
Route::any('/kyc/mobile-number-lookup', 'KycController@mobile_number_lookup')->name('kyc.mobile_number_lookup');
Route::any('/kyc/pan-to-din', 'KycController@pan_to_din')->name('kyc.pan_to_din');
Route::any('/kyc/upi-basic-pan-v4', 'KycController@uan_basic_pan_v4')->name('kyc.upi_basic_pan_v4');
Route::any('/kyc/mobile-with-name-lookup', 'KycController@mobile_with_name_lookup')->name('kyc.mobile_name_lookup');
Route::any('/kyc/mobile-porting-history', 'KycController@mobile_porting_history')->name('kyc.mobile_porting_history');
Route::any('/kyc/mobile-customer-details', 'KycController@mobile_customer_details')->name('kyc.mobile_customer_details');
Route::any('/kyc/mobile-vintage-lookup', 'KycController@mobile_vintage_lookup')->name('kyc.mobile_vintage_lookup');
Route::any('/kyc/uan-basic-mobile-name', 'KycController@uan_basic_mobile')->name('kyc.uan_basic_mobile');
Route::any('/kyc/uan-basic', 'KycController@uan_basic')->name('kyc.uan_basic');
Route::any('/kyc/epfo-ev', 'KycController@epfo')->name('kyc.epfo');
Route::any('/kyc/company-search-vone', 'KycController@company_search_v1')->name('kyc.company_search_vone');
Route::any('/kyc/gstin-pan-search', 'KycController@gstin_pan_search')->name('kyc.gstin_pan_search');
Route::any('/kyc/bank-ocr', 'KycController@bankPassbook_ocr')->name('kyc.bankpassbook_ocr');
Route::any('/kyc/mobile-to-udyam', 'KycController@mobile_to_udyam_search')->name('kyc.mobile_to_udyam');

Auth::routes([

    'register' => false, // Register Routes...
  
    'reset' => false, // Reset Password Routes...
  
    'confirm' => false, // Email Verification Routes...
  
    'email' => false
  
]);

// URL::forceScheme('http'); 




