<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inpatient;
use App\Room;
use App\Pasien;
use App\Doctor;
use App\System;
use DB;
use DataTables;
use Excel;
use PDF;
use Storage;

class InpatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {

            $inpatients= Inpatient::with(['room','pasien','doctor'])->get();

            return response()->json($inpatients);
        }
        return view('pages.inpatient');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms                  = Room::get();
        $pasiens                = Pasien::get();
        $doctors                = Doctor::get();
        $entry_procedures       = System::config('entry_procedure');
        $person_in_charges      = System::config('person_in_charge');
        $getCodeInpatient       = Inpatient::getCodeInpatient();

        return view('pages.inpatient.create', compact(['rooms','pasiens','doctors','person_in_charges','entry_procedures','getCodeInpatient']));
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

            $inpatient                    = new Inpatient;
            $inpatient->no_registrasi     = $request->no_registrasi;
            $inpatient->pasien_id         = $request->pasien_id;
            $inpatient->tgl_masuk         = $request->tgl_masuk;
            $inpatient->time              = $request->time;
            $inpatient->entry_procedure   = $request->entry_procedure;
            $inpatient->room_id           = $request->room_id;
            $inpatient->doctor_id         = $request->doctor_id;
            $inpatient->disease           = $request->disease;
            $inpatient->person_in_charge  = $request->person_in_charge;
            $inpatient->name              = $request->name;
            $inpatient->address           = $request->address;
            $inpatient->phone             = $request->phone;
            $inpatient->complaint         = $request->complaint;
            $inpatient->save();
            

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('registration_inpatient')
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
        $rooms = Room::get();
        $pasiens = Pasien::get();
        $doctors = Doctor::get();
        $entry_procedures       = System::config('entry_procedure');
        $person_in_charges      = System::config('person_in_charge');
        $registration_inpatient = Inpatient::find($id);

        return view('pages.inpatient.show', compact(['registration_inpatient','rooms','pasiens','doctors','entry_procedures','person_in_charges']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $registration_inpatient = Inpatient::with(['room', 'doctor', 'pasien','examination_inpatient'])->find($id);

        $viewData = view('pages.inpatient.show-pdf', compact(['registration_inpatient']));
        $nameFile = 'INAP-'.$registration_inpatient->no_registrasi.'-'.$registration_inpatient->pasien->details->identification_number.'.pdf';
        $pdf = PDF::loadHtml($viewData)->setWarnings(false);
        return $pdf->download($nameFile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rooms = Room::get();
        $pasiens = Pasien::get();
        $doctors = Doctor::get();
        $entry_procedures       = System::config('entry_procedure');
        $person_in_charges      = System::config('person_in_charge');
        $registration_inpatient = Inpatient::find($id);

        return view('pages.inpatient.edit', compact(['registration_inpatient','rooms','pasiens','doctors','entry_procedures','person_in_charges']));
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

            $inpatient                    = Inpatient::find($id);
            $inpatient->no_registrasi     = $request->no_registrasi;
            $inpatient->pasien_id         = $request->pasien_id;
            $inpatient->tgl_masuk         = $request->tgl_masuk;
            $inpatient->time              = $request->time;
            $inpatient->entry_procedure   = $request->entry_procedure;
            $inpatient->room_id           = $request->room_id;
            $inpatient->doctor_id         = $request->doctor_id;
            $inpatient->disease           = $request->disease;
            $inpatient->person_in_charge  = $request->person_in_charge;
            $inpatient->name              = $request->name;
            $inpatient->address           = $request->address;
            $inpatient->phone             = $request->phone;
            $inpatient->complaint         = $request->complaint;
            $inpatient->save();
            

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('registration_inpatient')
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
        
           //true
            $vocation = Inpatient::whereIn('id', $request->id)
                                ->delete();
        
                $res = [
                    'title' => 'Berhasil',
                    'type' => 'success',
                    'message' => count($request->id). 'Data berhasil dihapus!'
                ];

        return response()->json($res);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request,$id)
    {
        
        //true
        $vocation = Inpatient::where('id', $request->id)->delete();
    
        $res = [
            'title' => 'Berhasil',
            'type' => 'success',
            'message' => count($request->id). 'Data berhasil dihapus!'
        ];

        return response()->json($res);
        
    }

    public function export() 
    {
        $inpatients = Inpatient::select('no_registrasi','tgl_masuk','time','pasiens.name','pasiens.allergy')
                    ->join('pasiens', 'inpatients.pasien_id', '=', 'pasiens.id')
                    ->get();
       return Excel::create('Data Registrasi Rawat Inap', function($excel) use ($inpatients){
             $excel->sheet('Data Registrasi Rawat Inap', function($sheet) use ($inpatients){
                 $sheet->fromArray($inpatients);
             });

        })->download('csv');

    }

    public function getData(){
        
        $data = Inpatient::with(['room','pasien','doctor'])->get();

        return DataTables::of($data)

            ->rawColumns(['option', 'actions'])

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

            ->addColumn('room_name', function($data){
                return $data->room->name;
            })

            ->addColumn('room_class', function($data){
                return $data->room->level->class;
            })

            ->addColumn('actions', function($data){
                return '
                    <a href="'.route('registration_inpatient.show', $data->id).'" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Lihat Detail"><i class="mdi mdi-magnify"></i></a>
                    <a href="'.route('registration_inpatient.edit', $data->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah"><i class="mdi mdi-pencil"></i></a>
                    <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete('.$data->id.')"><i class="mdi mdi-close"></i></button>
                ';
            })

            ->make(true);
    }
}
