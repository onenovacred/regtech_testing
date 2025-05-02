
Route::post('pancard_new_details',[ApiController2::class,'pancard_new_details'])->name('pancard_new_details');
Route::post('corporate_cin_advancev2',[ApiController2::class,'corporate_cin_advance'])->name('corporate_cin_advancev2');
Route::post('corporate_cin_basicv2',[ApiController2::class,'corporate_cin_basic'])->name('corporate_cin_basicv2');
Route::post('bhunaksha',[ApiController2::class,'bhunaksha'])->name('bhunaksha');
Route::post('get_coordinate',[ApiController2::class,'getCoordinates'])->name('get_coordinate');
Route::post('verify_address',[ApiController2::class,'verifyAddress'])->name('verify_address');
Route::post('get_place',[ApiController2::class,'getPlace'])->name('get_place');
Route::post('create_geofence',[ApiController2::class,'create_geofence'])->name('create_geofence');
Route::post('autocomplete',[ApiController2::class,'autoComplete'])->name('autocomplete');
Route::post('experian_credit',[ApiController2::class,'digitapExperian'])->name('experian_credit');