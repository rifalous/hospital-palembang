<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pasien;
use App\PasienData;
use App\District;
use App\City;
use App\Province;
use DataTables;
use Storage;
use Indonesia;
use App\System;

use DB;
use PDF;
use Excel;

class PasienController extends Controller
{
    public $arr_dummy = [['id' => '', 'text' => '']];
    //Function Index
    public function index(Request $request)
    {
    	
    	if ($request->wantsJson()) {
    		$pasiens= Pasien::get();
    		return response()->json($pasiens);
    	}
        return view('pages.pasien');
    }
    public function create()
    {
    	$provinces 		 = Indonesia::allProvinces();
    	$cities			 = Indonesia::allCities();
    	$districts		 = Indonesia::allDistricts();
    	$religions		 = System::configmultiply('religion');
        $educations		 = System::configmultiply('education');
        $works			 = System::configmultiply('work');
        $blood_groups	 = System::configmultiply('blood_group');
        $genders		 = System::configmultiply('gender');
        $status	 		 = System::configmultiply('marital_status');
        $getRegistration = Pasien::getRegistrationNumber();


        return view('pages.pasien.create',compact(['villages','provinces','cities','districts','religions','educations','works', 'blood_groups', 'genders', 'status','getRegistration']));
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $pasien = Pasien::find($id);
        $pasien 		 = Pasien::find($id);

        $viewData = view('pages.pasien.show-pdf', compact(['pasien','villages','provinces','cities','districts','religions','educations','works','blood_groups','genders','status']));
        $nameFile = 'Psien-'.$pasien->no_rm.'-'.$pasien->details->identification_number.'.pdf';
        $pdf = PDF::loadHtml($viewData)->setWarnings(false);
        return $pdf->download($nameFile);
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $nama_file = time()."_".$file->getClientOriginalName();
        $file->move('uploads',$nama_file);
        return $nama_file;
    }

    public function remove(Request $request, $filename)
    {
        try{
            @unlink('uploads/'.$filename);
            return 'success upload file';
        } catch (Exception  $e) {
            return 'Error: '.$e->getMessage();
        }
    }

    public function store(Request $request)
    {
    	DB::transaction(function() use ($request){

    		$pasien 				= new Pasien;
    		$pasien->no_rm 			= $request->no_rm;
            $pasien->name 			= $request->name;
            $pasien->allergy 		= $request->allergy;
            $pasien->another_note 	= $request->another_note;

            $pasien->save();

            $details 				= new PasienData;

            $details->place 		= $request->place;
            $details->date_of_birth = $request->date_of_birth;
            $details->gender 		= $request->gender;
            $details->religion 		= $request->religion;
			$details->education 	= $request->education;
            $details->age 			= $request->age;

            $details->status 		= $request->status;
            $details->blood_group 	= $request->blood_group;
            $details->address 		= $request->address;
            $details->work 	        = $request->work;
            $details->district_id 	= $request->district_id;
            $details->city_id 		= $request->city_id;
            $details->province_id 	= $request->province_id;
            $details->phone 		= $request->phone;

            $details->postal_code 	= $request->postal_code;
            $details->identification_number = $request->identification_number;
            $details->bpjs_number   = $request->bpjs_number;
            $details->phone 		= $request->phone;
            $details->father_name 	= $request->father_name;
            $details->mother_name 	= $request->mother_name;
            $details->age_father 	= $request->age_father;
            $details->age_mother 	= $request->age_mother;
            $details->guardian_name = $request->guardian_name;
            $details->guardian_address = $request->guardian_address;
            $details->family_relationship = $request->family_relationship;
            $details->photos    = (!empty($request->new_pic)) ? $request->new_pic : '';

            $pasien->details()->save($details);

    	});

    	$res = [
    				'title' => 'Sukses',
    				'type' => 'success',
    				'message' => 'Data berhasil disimpan!'
				];

    	return redirect('pasien')
    				->with($res);
    }
 
    public function edit($id)
    {
        
        $provinces 		 = Indonesia::allProvinces();
    	$cities			 = Indonesia::allCities();
    	$districts		 = Indonesia::allDistricts();
    	$religions		 = System::configmultiply('religion');
        $educations		 = System::configmultiply('education');
        $works			 = System::configmultiply('work');
        $blood_groups	 = System::configmultiply('blood_group');
        $genders		 = System::configmultiply('gender');
        $status	 		 = System::configmultiply('marital_status');
        $pasien 		 = Pasien::find($id);

        return view('pages.pasien.edit',compact(['pasien','villages','provinces','cities','districts','religions','educations','works','blood_groups','genders','status']));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function() use ($request, $id){

            $pasien 				= Pasien::find($id);
            $pasien->no_rm 			= $request->no_rm;
            $pasien->name 			= $request->name;
            $pasien->allergy 		= $request->allergy;
            $pasien->another_note 	= $request->another_note;
            $pasien->save();

            $pasien_data 				= PasienData::where('pasien_id', $id)->first();
            $pasien_data->place 		= $request->place;
            $pasien_data->date_of_birth = $request->date_of_birth;
            $pasien_data->gender 		= $request->gender;
            $pasien_data->religion 		= $request->religion;
			$pasien_data->education 	= $request->education;
            $pasien_data->age 			= $request->age;

            $pasien_data->status 		= $request->status;
            $pasien_data->blood_group 	= $request->blood_group;
            $pasien_data->address 		= $request->address;
            $pasien_data->district_id 	= $request->district_id;
            $pasien_data->city_id 		= $request->city_id;
            $pasien_data->province_id 	= $request->province_id;
            $pasien_data->phone 		= $request->phone;
            $pasien_data->work          = $request->work;
            $pasien_data->photos    = (!empty($request->new_pic)) ? $request->new_pic : $request->old_pic;

            $pasien_data->postal_code 	= $request->postal_code;
            $pasien_data->identification_number = $request->identification_number;
            $pasien_data->bpjs_number = $request->bpjs_number;
            $pasien_data->phone 		= $request->phone;
            $pasien_data->father_name 	= $request->father_name;
            $pasien_data->mother_name 	= $request->mother_name;
            $pasien_data->age_father 	= $request->age_father;
            $pasien_data->age_mother 	= $request->age_mother;
            $pasien_data->guardian_name = $request->guardian_name;
            $pasien_data->guardian_address = $request->guardian_address;
            $pasien_data->family_relationship = $request->family_relationship;

            $pasien->details()->save($pasien_data);

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect('pasien')
                    ->with($res);
    }

    public function show($id)
    {
        
        $provinces 		 = Indonesia::allProvinces();
    	$cities			 = Indonesia::allCities();
    	$districts		 = Indonesia::allDistricts();
    	$religions		 = System::configmultiply('religion');
        $educations		 = System::configmultiply('education');
        $works			 = System::configmultiply('work');
        $blood_groups	 = System::configmultiply('blood_group');
        $genders		 = System::configmultiply('gender');
        $status	 		 = System::configmultiply('marital_status');
        $pasien 		 = Pasien::find($id);

        return view('pages.pasien.show',compact(['pasien','villages','provinces','cities','districts','religions','educations','works','blood_groups','genders','status']));
    }

    public function destroy($id)
    {
        DB::transaction(function() use ($id){

            $pasien = Pasien::find($id);
            $pasien->delete();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect('pasien')
                    ->with($res);
    }


    public function getData(Request $request)
    {
        $pasiens = Pasien::get();

        return DataTables::of($pasiens)

        ->rawColumns(['options'])

        ->addColumn('options', function($pasien){
            return '
                <a href="'.route('pasien.show', $pasien->id).'" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Lihat Detail"><i class="mdi mdi-magnify"></i></a>
                <a href="'.route('pasien.edit', $pasien->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete('.$pasien->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('pasien.destroy', $pasien->id).'" method="POST" id="form-delete-'.$pasien->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })
        ->addColumn('details_url', function($pasien) {
            return url('pasien/details-data/'.$pasien->id);
        })

        ->toJson();
    }

    public function export() 
    {
        $pasiens = Pasien::select('no_rm','name','allergy','another_note','pasien_datas.place','pasien_datas.place','pasien_datas.date_of_birth','pasien_datas.gender','pasien_datas.religion','pasien_datas.education','pasien_datas.age','pasien_datas.status','pasien_datas.blood_group','pasien_datas.address','pasien_datas.work','pasien_datas.district_id','pasien_datas.city_id','pasien_datas.province_id','pasien_datas.phone','pasien_datas.postal_code','pasien_datas.identification_number','pasien_datas.phone','pasien_datas.father_name','pasien_datas.mother_name','pasien_datas.age_father','pasien_datas.age_mother','pasien_datas.guardian_name','pasien_datas.guardian_address')
                    ->join('pasien_datas', 'pasien_datas.pasien_id', '=', 'pasiens.id')
                    ->get();

       return Excel::create('Data Pasien', function($excel) use ($pasiens){
             $excel->sheet('Data Pasien', function($sheet) use ($pasiens){
                 $sheet->fromArray($pasiens);

             });

        })->download('csv');

    }

    public function getDetailsData($id)
    {
        $details = Pasien::find($id)
                ->details()
                ->get();
        // dd($details);
        return Datatables::of($details)->make(true);
    }

    public function getDistrict($province_id)
    {
        $district = City::select('id', 'name as text')
                            ->where('province_id', $province_id)
                            ->get();

        return response()->json(array_merge($this->arr_dummy, $district->toArray()));
    }

    public function getCities($city_id)
    {
        $city = District::select('id', 'name as text')
                            ->where('city_id', $city_id)
                            ->get();

        return response()->json(array_merge($this->arr_dummy, $city->toArray()));
    }

}
