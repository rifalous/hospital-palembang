<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Outpatient;
use App\Room;
use App\Pasien;
use App\Doctor;
use App\System;
use DB;
use DataTables;
use Storage;

class OutpatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {

            $outpatient= Outpatient::with(['pasien','doctor'])->get();

            return response()->json($outpatient);
        }
        return view('pages.outpatient');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pasiens           = Pasien::get();
        $doctors           = Doctor::get();
        $polikliniks       = System::configMultiply('poliklinik');
        $getCodeOutpatient = Outpatient::getCodeOutpatient();

        return view('pages.outpatient.create', compact(['pasiens','doctors','polikliniks','getCodeOutpatient']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function() use ($request){

            $outpatient                    = new Outpatient;
            $outpatient->no_registrasi     = $request->no_registrasi;
            $outpatient->pasien_id         = $request->pasien_id;
            $outpatient->tgl_periksa       = $request->tgl_periksa;
            $outpatient->poliklinik        = $request->poliklinik;
            $outpatient->doctor_id         = $request->doctor_id;
            $outpatient->disease           = $request->disease;
            $outpatient->complaint         = $request->complaint;
            
            
            $outpatient->save();
            

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('registration_outpatient')
                    ->with($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pasiens           = Pasien::get();
        $doctors           = Doctor::get();
        $polikliniks       = System::configMultiply('poliklinik');
        $registration_outpatient = Outpatient::find($id);
        return view('pages.outpatient.show', compact(['pasiens','doctors','polikliniks','registration_outpatient']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pasiens           = Pasien::get();
        $doctors           = Doctor::get();
        $polikliniks       = System::configMultiply('poliklinik');
        $registration_outpatient = Outpatient::find($id);
        return view('pages.outpatient.edit', compact(['pasiens','doctors','polikliniks','registration_outpatient']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::transaction(function() use ($request, $id){

            $outpatient                    = Outpatient::find($id);
            $outpatient->no_registrasi     = $request->no_registrasi;
            $outpatient->pasien_id         = $request->pasien_id;
            $outpatient->tgl_periksa       = $request->tgl_periksa;
            $outpatient->poliklinik        = $request->poliklinik;
            $outpatient->doctor_id         = $request->doctor_id;
            $outpatient->disease           = $request->disease;
            $outpatient->complaint         = $request->complaint;
            
            
            $outpatient->save();
            

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('registration_outpatient')
                    ->with($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $outpatient = Outpatient::whereIn('id', $request->id)
                                ->delete();
        
                $res = [
                    'title' => 'Berhasil',
                    'type' => 'success',
                    'message' => count($request->id). 'Data berhasil dihapus!'
                ];

        return response()->json($res);
    }

    public function getData(){
        
        $data = Outpatient::with(['pasien','doctor'])->get();

        return DataTables::of($data)

            ->rawColumns(['option', 'details'])

            ->addColumn('option', function($data) {

                return '<div class="checkbox">
                            <input type="checkbox" name="rowcheck[]" value="'.$data->id.'">
                            <label></label>
                        </div>';

            })
            

            ->addColumn('pasien_name', function($data){
                return $data->pasien->name;
            })

            ->addColumn('pasien_gender', function($data){
                return $data->pasien->details->gender;
            })

            ->addColumn('pasien_age', function($data){
                return $data->pasien->details->age;
            })

            ->addColumn('doctor_name', function($data){
                return $data->doctor->name;
            })

            ->make(true);
    }
}
