<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\ExaminationOutpatient;
use App\ExaminationInpatient;
use App\Laboratorium;
use App\Inpatient;
use App\Action;
use App\Material;
use App\Doctor;
use App\Room;
use App\Level;
use App\Outpatient;
use App\System;
use App\LabCheckup;
use App\ExaminationLabCheckup;
use DataTables;
use Storage;

class LabCheckupController extends Controller
{
    public function index()
    {
        return view('pages.lab_checkup.index');
    }

    public function getdata(){
       
        $lab_checkup = LabCheckup::with('inpatient')->get();

        return DataTables::of($lab_checkup)

        ->rawColumns(['options'])

        ->addColumn('options', function($lab_checkup){
            return '
                <a href="'.route('lab_checkup.edit', $lab_checkup->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete('.$lab_checkup->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('lab_checkup.destroy', $lab_checkup->id).'" method="POST" id="form-delete-'.$lab_checkup->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })
        ->addColumn('pasien_name', function($lab_checkup){
                return $lab_checkup->inpatient->pasien->name.' | '.$lab_checkup->inpatient->no_registrasi;
        })

        // ->addColumn('lab_keterangan', function($lab_checkup){
        //     return $lab_checkup->lab->keterangan;
        // })

        ->addColumn('total_biaya', function($lab_checkup){
            return $lab_checkup->total_ammount;
        })

        ->addColumn('tanggal_registrasi', function($lab_checkup){
            return $lab_checkup->registration_date;
        })

        ->addColumn('catatan', function($lab_checkup){
            return $lab_checkup->notes;
        })

        ->addColumn('details_url', function($lab_checkup) {
            return url('lab_checkup/details-data/'.$lab_checkup->id);
        })

        ->toJson();
    }

    public function destroy($id)
    {
        DB::transaction(function() use ($id){

            $lab_checkup = LabCheckup::find($id);
            $lab_checkup->delete();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect('lab_checkup')->with($res);
    }

    public function create()
    {
        $inpatient = Inpatient::all();
        $labs = Laboratorium::all();
        $rooms = Room::get(); //room Model
        return view('pages.lab_checkup.create', compact(['inpatient','labs','rooms']));

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

            $lab_checkup                    = new LabCheckup;
            $lab_checkup->inpatient_id      = $request->inpatient_id;
            $lab_checkup->total_ammount     = $request->total_amount;
            $lab_checkup->registration_date = $request->registration_date;
            $lab_checkup->notes             = $request->notes;
            $lab_checkup->person_in_charge  = $request->person_in_charge;
            $lab_checkup->save();

            $lab_checkup_id                  = $lab_checkup->id;

            if (count($request->lab_test) > 0) {

                foreach($request->lab_test as $index => $value) { 
                    $actions                            = new ExaminationLabCheckup;
                    $actions->examination_checkup_id  = $lab_checkup_id;
                    $actions->lab_id                 = $request->lab_test[$index];
                    $actions->save();
                }
            }
        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('lab_checkup')->with($res);
    }

    public function edit($id)
    {
        $inpatient = Inpatient::select('id', 'no_registrasi as text')->get();
        $rooms = Room::get(); //room Model
        $labs = Laboratorium::all();
        
        $lab_checkup  = LabCheckup::find($id);


        return view('pages.lab_checkup.edit', compact(['inpatients', 'labs','lab_checkup','rooms']));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function() use ($request, $id){

            $lab_checkup                    = LabCheckup::find($id);
            $lab_checkup->inpatient_id      = $request->inpatient_id;
            $lab_checkup->total_ammount     = $request->total_amount;
            $lab_checkup->registration_date = $request->registration_date;
            $lab_checkup->notes             = $request->notes;
            $lab_checkup->person_in_charge  = $request->person_in_charge;
            $lab_checkup->save();

            $truncate = ExaminationLabCheckup::where('examination_checkup_id', $id)
            ->delete();

            if (count($request->lab_test) > 0) {

                foreach($request->lab_test as $index => $value) { 
                    $data_detail                            = new ExaminationLabCheckup;
                    $data_detail->examination_checkup_id    = $id;                    
                    $data_detail->lab_id                    = $request->lab_test[$index];
                    $lab_checkup->labo()->save($data_detail);
                }
            }
        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('lab_checkup')
                    ->with($res);
    }

    public function getInpatient(Request $request)
    {
        $array = [['id' => '', 'text' => '']];
        $inpatient = Inpatient::get();
        return response()->json(array_merge($array, $inpatient->toArray()));
    }

    public function getInpatientId($id) {
        $inpatient = Inpatient::with(['pasien','room','detail'])->find($id);
        return response()->json($inpatient);
    }

    public function getLabo(Request $request)
    {   
        $labo = Laboratorium::select('id', 'keterangan as text')->get();

        return response()->json($labo);
    }

    public function getLaboId($id) {
        $labo = Laboratorium::find($id);
        return response()->json($labo);
    }

    // Get Action
    public function getDetailLab($id){
        $labolatorium = LabCheckup::find($id)
                ->labo()
                ->with(['lab'])
                ->get();
        // dd($details);
        return Datatables::of($labolatorium)->make(true);
    }
}
