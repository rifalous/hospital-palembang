<?php

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
    return redirect('dashboard');
});

Route::middleware('auth')->group(function(){

	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('/dashboard/get_chart', 'DashboardController@getChart')->name('dashboard.chart');
	Route::get('/dashboard/get_data_park', 'DashboardController@getDataPark')->name('dashboard.get_data_park');
	Route::get('/dashboard/get_data_user', 'DashboardController@getDataUser')->name('dashboard.get_data_user');
	Route::get('/dashboard/revoke/{user_id}', 'DashboardController@revoke')->name('dashboard.revoke');

	Route::post('/user/validate', 'UserController@validatePost');
	Route::get('/user/export', 'UserController@export')->name('user.export');
	Route::post('/user/import', 'UserController@import')->name('user.import');
	Route::get('/user/tes', 'UserController@tes');
	Route::resource('/user', 'UserController');
	Route::post('/menu/bulk_edit', 'MenuController@bulkEdit');
	Route::resource('menu', 'MenuController');

	// Master Division 
	Route::get('division/get_data', 'DivisionController@getData');
	Route::get('division/get_department_by_division/{division_id}', 'DivisionController@getDepartmentByDivision');
	Route::resource('division', 'DivisionController');

	// Master Department 
	Route::get('department/get_data', 'DepartmentController@getData');
	Route::resource('department', 'DepartmentController');

	// Master Pasien
	Route::get('pasien/get_data', 'PasienController@getData');
	Route::post('media/upload', 'PasienController@upload');
	Route::get('media/remove/{filename}', 'PasienController@remove');
	Route::get('pasien/details-data/{id}', 'PasienController@getDetailsData');
	Route::get('pasien/get_district/{province_id}', 'PasienController@getDistrict');
	Route::get('/pasien/export', 'PasienController@export')->name('pasien.export');
	Route::get('pasien/get_city/{city_id}', 'PasienController@getCities');
	Route::resource('pasien', 'PasienController');
	Route::get('pasien/print_data/{id}', 'PasienController@pdf')->name('pasien.print_data');

	// Master Dokter
	Route::get('doctor/get_data', 'DoctorController@getData');
	Route::get('/doctor/export', 'DoctorController@export')->name('doctor.export');
	Route::resource('doctor', 'DoctorController');

	// Master Action
	Route::get('action/get_data', 'ActionController@getData');
	Route::get('/action/export', 'ActionController@export')->name('action.export');
	Route::resource('action', 'ActionController');

	// Master Material
	Route::get('material/get_data', 'MaterialController@getData');
	Route::get('/material/export', 'MaterialController@export')->name('material.export');
	Route::resource('material', 'MaterialController');

	// Master Laboratoria
	Route::get('laboratoria/get_data', 'LaboratoriaController@getData');
	Route::get('/laboratoria/export', 'LaboratoriaController@export')->name('laboratoria.export');
	Route::resource('laboratoria', 'LaboratoriaController');

	// Master Kelas
	Route::get('level/get_data', 'LevelController@getData');
	Route::get('/level/export', 'LevelController@export')->name('level.export');
	Route::resource('level', 'LevelController');

	// Master Ruangan
	Route::get('room/get_data', 'RoomController@getData');
	Route::get('/room/export', 'RoomController@export')->name('room.export');
	Route::resource('room', 'RoomController');

	// Master Perusahaan
	Route::get('company/get_data', 'CompanyController@getData');
	Route::get('/company/export', 'CompanyController@export')->name('company.export');
	Route::resource('company', 'CompanyController');

	// Master Registrasi Rawat Inap
	Route::get('registration_inpatient/get_data', 'InpatientController@getData');
	Route::get('registration_inpatient/print_data/{id}', 'InpatientController@pdf')->name('registration_inpatient.print_data');
	Route::get('/registration_inpatient/export', 'InpatientController@export')->name('registration_inpatient.export');
	Route::delete('registration_inpatient/remove/{id}', 'InpatientController@remove')->name('registration_inpatient.remove');
	Route::resource('registration_inpatient', 'InpatientController');

	// Master Registrasi Rawat Jalan 
	Route::get('registration_outpatient/get_data', 'OutpatientController@getData');
	Route::get('registration_outpatient/print_data/{id}', 'OutpatientController@pdf')->name('registration_outpatient.print_data');
	Route::get('/registration_outpatient/export', 'OutpatientController@export')->name('registration_outpatient.export');
	Route::delete('registration_outpatient/remove/{id}', 'OutpatientController@remove')->name('registration_outpatient.remove');
	Route::resource('registration_outpatient', 'OutpatientController');

	// Master Pemeriksaan Laboratorium
	Route::get('lab_checkup/get_data', 'LabCheckupController@getData');
	Route::get('lab_checkup/print_data/{id}', 'LabCheckupController@pdf')->name('lab_checkup.print_data');
	Route::get('/lab_checkup/export', 'LabCheckupController@export')->name('lab_checkup.export');
	Route::delete('lab_checkup/remove/{id}', 'LabCheckupController@remove')->name('lab_checkup.remove');
	Route::resource('lab_checkup', 'LabCheckupController');

	// Master Pemeriksaan Rawat Inap
	Route::get('examination_inpatient/get_data', 'ExaminationInpatientController@getData');
	Route::get('examination_inpatient/get_action', 'ExaminationInpatientController@getAction');
	Route::get('examination_inpatient/get_medicine', 'ExaminationInpatientController@getMedicine');
	Route::get('examination_inpatient/get_medicine_time', 'ExaminationInpatientController@getMedicineTime');
	Route::get('examination_inpatient/get_lab', 'ExaminationInpatientController@getLab');
	Route::get('examination_inpatient/get_inpatient', 'ExaminationInpatientController@getInpatient');
	Route::get('examination_inpatient/get_data', 'ExaminationInpatientController@getData');
	Route::get('examination_inpatient/details-data/{id}', 'ExaminationInpatientController@getDetailsMaterial');
	Route::get('examination_inpatient/details-data1/{id}', 'ExaminationInpatientController@getDetailsData');
	Route::get('examination_inpatient/details-data2/{id}', 'ExaminationInpatientController@getDetailsLabolatorium');
	Route::get('examination_inpatient/get-action-id/{id}', 'ExaminationInpatientController@getActionId');
	Route::get('examination_inpatient/get-material-id/{id}', 'ExaminationInpatientController@getMaterialId');
	Route::get('examination_inpatient/get-lab-id/{id}', 'ExaminationInpatientController@getLabId');
	Route::get('examination_inpatient/get-inpatient-id/{id}', 'ExaminationInpatientController@getInpatientId');
	Route::resource('examination_inpatient', 'ExaminationInpatientController');

	// Master Pemeriksaan Rawat Jalan
	Route::get('examination_outpatient/get_action', 'ExaminationOutpatientController@getAction');
	Route::get('examination_outpatient/get_doctor', 'ExaminationOutpatientController@getDoctor');
	Route::get('examination_outpatient/get_material', 'ExaminationOutpatientController@getMaterial');
	Route::get('examination_outpatient/get_outpatient', 'ExaminationOutpatientController@getOutpatient');
	Route::get('examination_outpatient/get_data', 'ExaminationOutpatientController@getData');
	Route::get('examination_outpatient/details-data/{id}', 'ExaminationOutpatientController@getDetailsMaterial');
	Route::get('examination_outpatient/details-data1/{id}', 'ExaminationOutpatientController@getDetailsData');
	Route::get('examination_outpatient/details-data2/{id}', 'ExaminationOutpatientController@getDetailsLabolatorium');	
	Route::get('examination_outpatient/get-material-id/{id}', 'ExaminationOutpatientController@getMaterialId');
	Route::get('examination_outpatient/get-action-id/{id}', 'ExaminationOutpatientController@getActionId');
	Route::get('examination_outpatient/get-lab-id/{id}', 'ExaminationOutpatientController@getLabId');	
	Route::get('examination_outpatient/get-outpatient-id/{id}', 'ExaminationOutpatientController@getOutpatientId');
	Route::resource('examination_outpatient', 'ExaminationOutpatientController');

	// Master Period 
	Route::get('period/get_data', 'PeriodController@getData');
	Route::resource('period', 'PeriodController');

	// Master Section 
	Route::get('section/get_data', 'SectionController@getData');
	Route::resource('section', 'SectionController');

	// Master Customer 
	Route::post('/customer/import', 'CustomerController@import')->name('customer.import');
	Route::get('/customer/export/template', 'CustomerController@template_customer')->name('customer.template');
	Route::get('customer/get_data', 'CustomerController@getData');
	Route::resource('customer', 'CustomerController');

	// Master Supplier 
	Route::post('/supplier/import', 'SupplierController@import')->name('supplier.import');
	Route::get('/supplier/export', 'SupplierController@export')->name('supplier.export');
	Route::get('/supplier/export/template', 'SupplierController@template_supplier')->name('supplier.template');
	Route::get('supplier/get_data', 'SupplierController@getData');
	Route::resource('supplier', 'SupplierController');
	
	// Master System 
	Route::get('system/get_data', 'SystemController@getData');
	Route::get('/system/export', 'SystemController@export')->name('system.export');
	Route::resource('system', 'SystemController');

	// Master Pembayaran Rawat Inap
	Route::get('inpatient_payment/get_data', 'InpatientPaymentController@getData');
	Route::get('inpatient_payment/get_data/{id}', 'InpatientPaymentController@getDetailData');
	Route::resource('inpatient_payment', 'InpatientPaymentController');

	// Master Pembayaran Rawat Jalan
	Route::get('payment/get_data', 'PaymentController@getData');
	Route::get('payment/get_outpatient', 'PaymentController@getOutpatient');
	Route::get('payment/get-outpatient-id/{outpatient_id}', 'PaymentController@getOutpatientId');
	Route::resource('payment', 'PaymentController');
	
	// Master Report Per Day
	Route::get('hospitalisation_day/get_data', 'HospitalisationDayController@getData');
	Route::post('hospitalisation_day/download', 'HospitalisationDayController@download');
	Route::resource('hospitalisation_day', 'HospitalisationDayController');
	
	Route::get('inpatient_day/get_data', 'InpatientDayController@getData');
	Route::post('inpatient_day/download', 'InpatientDayController@download');
	Route::resource('inpatient_day', 'InpatientDayController');
	
	Route::get('pasien_exit_day/get_data', 'PatientExitDayController@getData');
	Route::post('pasien_exit_day/download', 'PatientExitDayController@download');
	Route::resource('pasien_exit_day', 'PatientExitDayController');

	// Master Report Per Periode
	Route::get('hospitalisation_periode/get_data', 'HospitalisationPeriodController@getData');
	Route::post('hospitalisation_periode/download', 'HospitalisationPeriodController@download');
	Route::resource('hospitalisation_periode', 'HospitalisationPeriodController');

	Route::get('inpatient_periode/get_data', 'InpatientPeriodController@getData');
	Route::post('inpatient_periode/download', 'InpatientPeriodController@download');
	Route::resource('inpatient_periode', 'InpatientPeriodController');

	Route::get('pasien_exit_list/get_data', 'PatientExitListController@getData');
	Route::post('pasien_exit_list/download', 'PatientExitListController@download');
	Route::resource('pasien_exit_list', 'PatientExitListController');

	// Master Pasien Keluar
	Route::get('patient_exits/get_data', 'PatientExitsController@getData');
	// Route::get('patient_exits/get_data/{id}', 'PatientExitsController@getDataByRegistrationNumber');
	Route::get('patient_exits/get_inpatient', 'PatientExitsController@getInpatient');
	Route::get('patient_exits/get-inpatient-id/{id}', 'PatientExitsController@getInpatientId');
	Route::get('patient_exits/details-data/{id}', 'PatientExitsController@getDetailsMaterial');
	Route::get('patient_exits/details-data1/{id}', 'PatientExitsController@getDetailsData');
	Route::get('patient_exits/details-data2/{id}', 'PatientExitsController@getDetailsLabolatorium');
	Route::resource('patient_exits', 'PatientExitsController');

	//Master Lab Check Up
	Route::get('lab_checkup/get_data', 'LabCheckupController@getData');
	Route::get('lab_checkup/get_inpatient', 'LabCheckupController@getInpatient');
	Route::get('lab_checkup/get-inpatient-id/{id}', 'LabCheckupController@getInpatientId');
	Route::get('lab_checkup/get_labo', 'LabCheckupController@getLabo');	
	Route::get('lab_checkup/get-labo-id/{id}', 'LabCheckupController@getLaboId');
	Route::get('lab_checkup/details-data/{id}', 'LabCheckupController@getDetailLab');	
	Route::resource('lab_checkup', 'LabCheckupController');


	// Settings
	Route::prefix('settings')->group(function(){
		Route::get('role/get_data', 'RoleController@getData');
		Route::resource('role', 'RoleController');

		Route::get('permission/get_data', 'PermissionController@getData');
		Route::resource('permission', 'PermissionController');
	});
	
	// Rekam Medis
	Route::get('medical_records', 'MedicalRecordsController@index');

	Route::resource('/settings', 'SettingController');

});

Auth::routes();
