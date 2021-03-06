<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inpatient;
use App\PatientExits;
use App\Room;
use App\Level;
use App\Pasien;
use App\System;
use App\ExaminationInpatient;
use DB;
use DataTables;
use Storage;

class PatientExitsController extends Controller
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
        return view('pages.patientexits');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::get();
        $pasiens = Pasien::get();
        $inpatients = Inpatient::get();
        $way_outs = System::configMultiply('way_out');
        $exit_states = System::configMultiply('exit_state');

        return view('pages.patientexits.create', compact(['rooms','pasiens','inpatients','way_outs','exit_states']));
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

            $patient_exits                    = new PatientExits;
            $patient_exits->no_registrasi     = $request->no_registrasi;
            $patient_exits->pasien_id         = $request->pasien_id;
            $patient_exits->tgl_masuk         = $request->tgl_masuk;
            $patient_exits->time              = $request->time;
            $patient_exits->room_id           = $request->room_id;
            $patient_exits->disease           = $request->disease;
            $patient_exits->tgl_keluar        = $request->tgl_keluar;
            $patient_exits->time_keluar       = $request->time_keluar;
            $patient_exits->way_out           = $request->way_out;
            $patient_exits->exit_state        = $request->exit_state;
            $patient_exits->total_biaya       = $request->total_biaya;
            $patient_exits->save();
            

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('patient_exits')
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
        //
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
        $inpatients = Inpatient::get();
        $way_outs = System::configMultiply('way_out');
        $exit_states = System::configMultiply('exit_state');
        $patient_exits = PatientExits::find($id);

        return view('pages.patientexits.edit', compact(['patient_exits','rooms','pasiens','inpatients','way_outs','exit_states']));
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

            $patient_exits                    = PatientExits::find($id);
            $patient_exits->no_registrasi     = $request->no_registrasi;
            $patient_exits->pasien_id         = $request->pasien_id;
            $patient_exits->tgl_masuk         = $request->tgl_masuk;
            $patient_exits->time              = $request->time;
            $patient_exits->room_id           = $request->room_id;
            $patient_exits->disease           = $request->disease;
            $patient_exits->tgl_keluar        = $request->tgl_keluar;
            $patient_exits->time_keluar       = $request->time_keluar;
            $patient_exits->way_out           = $request->way_out;
            $patient_exits->exit_state        = $request->exit_state;
            $patient_exits->total_biaya       = $request->total_biaya;
            $patient_exits->save();
            

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('patient_exits')
                    ->with($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        DB::transaction(function() use ($id){

            $vocation = PatientExits::find($id);
            $vocation->delete();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect('patient_exits')->with($res);
    }

    public function getData(){
        
        $data = PatientExits::with(['room','pasien'])->get();

        return DataTables::of($data)

            ->rawColumns(['option'])

            ->addColumn('option', function($data){
                return '
                    <a href="'.route('patient_exits.edit', $data->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah"><i class="mdi mdi-pencil"></i></a>
                    <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete('.$data->id.')"><i class="mdi mdi-close"></i></button>
                    <form action="'.route('patient_exits.destroy', $data->id).'" method="POST" id="form-delete-'.$data->id .'" style="display:none">
                        '.csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                ';
            })
            

            ->addColumn('pasien_name', function($data){
                return $data->pasien->name;
            })

            ->addColumn('pasien_gender', function($data){
                return $data->pasien->details->gender;
            })

            ->addColumn('pasien_address', function($data){
                return $data->pasien->details->address;
            })

            ->addColumn('pasien_age', function($data){
                return $data->pasien->details->age;
            })
            
            ->addColumn('room_name', function($data){
                return $data->room->name;
            })

            ->addColumn('room_class', function($data){
                return $data->room->level->class;
            })

            ->addColumn('details_url', function($data) {
                return url('patient_exits/details-data/'.$data->id);
            })
    
            ->addColumn('details_url1', function($data) {
                return url('patient_exits/details-data1/'.$data->id);
            })
    
            ->addColumn('details_url2', function($data) {
                return url('patient_exits/details-data2/'.$data->id);
            })

            ->make(true);
    }

    public function getDataByRegistrationNumber($id) {
        $data = Inpatient::find($id);
        $data->pasien->no_rm;
        $data->room->id;
        $amount = 0;
        foreach($data->examination_inpatient as $exam) {
            $amount += $exam->amount;
        }
        $data->totalAmount = $amount;
        return response()->json($data);
    }

    public function getInpatientId($id) {
        $inpatient = Inpatient::with(['pasien','doctor','room','examination_inpatient'])->find($id);
        return response()->json($inpatient);
    }

    public function getInpatient(Request $request)
    {
        $array = [['id' => '', 'text' => '']];
        $inpatient = Inpatient::select('id', 'no_registrasi as text')
                    ->doesnthave('examination_inpatient')
                    ->get();
        return response()->json(array_merge($array, $inpatient->toArray()));
    }

    // getMaterial
    public function getDetailsData($id)
    {
        $details = ExaminationInpatient::find($id)
                ->details()
                ->with(['action','doctor'])
                ->get();
        return Datatables::of($details)->make(true);
    }
    
    // Get Action
    public function getDetailsMaterial($id)
    {
        $materials = ExaminationInpatient::find($id)
                ->material()
                ->with(['doctor','material'])
                ->get();
        // dd($details);
        return Datatables::of($materials)->make(true);
    }

    // Get Labolatorium
    public function getDetailsLabolatorium($id)
    {
        $labolatoriums = ExaminationInpatient::find($id)
                ->labs()
                ->with(['doctor','lab'])
                ->get();
        return Datatables::of($labolatoriums)->make(true);
    }

    
}
