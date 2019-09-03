<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\ExaminationOutpatient;
use App\ExaminationOutpatientData;
use App\ExaminationOutpatientDetail;
use App\ExaminationOutpatientLab;
use App\Laboratorium;
use App\Outpatient;
use App\Action;
use App\Doctor;
use App\Material;
use DataTables;
use Storage;

class ExaminationOutpatientController extends Controller
{
    public function index()
    {
        return view('pages.examination_outpatient.index');
    }

    public function create()
    {
        $outpatient  = Outpatient::doesnthave('examination_outpatient')->get();
        $materials   = Material::get();
        $actions  	 = Action::get();
        $labs = Laboratorium::all();

        return view('pages.examination_outpatient.create', compact(['outpatient','materials','actions', 'labs']));
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

            $examination_outpatient                    = new ExaminationOutpatient;
            $examination_outpatient->outpatient_id     = $request->outpatient_id;
            $examination_outpatient->registration_date = $request->registration_date;
            $examination_outpatient->pasien_id         = $request->pasien_id;
            $examination_outpatient->check_date        = $request->check_date;
            $examination_outpatient->amount_action     = $request->amount_action;
            $examination_outpatient->amount_material   = $request->amount_material;
            $examination_outpatient->amount_lab        = $request->amount_lab;
            $examination_outpatient->amount            = $request->amount;
            $examination_outpatient->doctor_name            = $request->doctor_name;
            $examination_outpatient->save();

            $examination_outpatient_id = $examination_outpatient->id;

            if (count($request->action_id) > 0) {

              foreach($request->action_id as $index => $value) { 
                $actions 							= new ExaminationOutpatientData;
                $actions->examination_outpatient_id = $examination_outpatient_id;
                $actions->action_id 				= $request->action_id[$index];
                $actions->cost_outpatient 			= $request->cost_outpatient[$index];
                $actions->many_action 				= $request->many_action[$index];
                $actions->total_action 				= $request->total_action[$index];
                $actions->doctor_id 				= $request->doctor_id[$index];
                $actions->save();
              }

            }

            if (count($request->material_id) > 0) {

              foreach($request->material_id as $index => $value) { 
                $materials                            = new ExaminationOutpatientDetail;
                $materials->examination_outpatient_id = $examination_outpatient_id;
                $materials->material_id               = $request->material_id[$index];
                $materials->price_material            = $request->price_material[$index];
                $materials->many_material             = $request->many_material[$index];
                $materials->total_material            = $request->total_material[$index];
                $materials->save();
              }
            }

            if (count($request->lab_id) > 0) {
  
                foreach($request->lab_id as $index => $value) { 
                  $labs                            = new ExaminationOutpatientLab;
                  $labs->examination_outpatient_id  = $examination_outpatient_id;
                  $labs->lab_id                    = $request->lab_id[$index];
                  $labs->hasil                     = $request->hasil_lab[$index];
                  $labs->biaya                     = $request->price_lab[$index];
                  $labs->doctor_id                 = $request->doctor_id_lab[$index];
                  $labs->save();
                }
            }
        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('examination_outpatient')
                    ->with($res);
    }

    public function edit($id)
    {
        $outpatients = Outpatient::select('id', 'no_registrasi as text')->get();
        $actions = Action::select('id', 'action as text')->get();
        $doctors = Doctor::select('id', 'name as text')->get();
        $materials = Material::select('id', 'name as text')->get();
        $labs = Laboratorium::all();
        
        $examination_outpatient  = ExaminationOutpatient::find($id);


        return view('pages.examination_outpatient.edit', compact(['outpatients','actions','doctors','examination_outpatient','materials', 'labs']));
    }

    public function update(Request $request,$id)
    {
        DB::transaction(function() use ($request, $id){

            $examination_outpatient                        = ExaminationOutpatient::find($id);
            $examination_outpatient->outpatient_id         = $request->outpatient_id;
            $examination_outpatient->check_date            = $request->check_date;
            $examination_outpatient->registration_date     = $request->registration_date;
            $examination_outpatient->amount_action         = $request->amount_action;
            $examination_outpatient->amount_material       = $request->amount_material;
            $examination_outpatient->amount_lab            = $request->amount_lab;
            $examination_outpatient->amount                = $request->amount;
            $examination_outpatient->doctor_name           = $request->doctor_name;
            $examination_outpatient->save();

            $truncate = ExaminationOutpatientData::where('examination_outpatient_id', $id)
                          ->delete();
            $truncate = ExaminationOutpatientDetail::where('examination_outpatient_id', $id)
                          ->delete();

            if (count($request->action_id) > 0) {

              foreach($request->action_id as $index => $value) { 
                $details 							= new ExaminationOutpatientData;
                $details->action_id 				= $request->action_id[$index];
                $details->cost_outpatient 			= $request->cost_outpatient[$index];
                $details->many_action 				= $request->many_action[$index];
                $details->total_action 				= $request->total_action[$index];
                $details->doctor_id 				= $request->doctor_id[$index];
                
                $examination_outpatient->details()->save($details);
              }

            }

            if (count($request->material_id) > 0) {

              foreach($request->material_id as $index => $value) { 
                $materials                            = new ExaminationOutpatientDetail;
                $materials->material_id               = $request->material_id[$index];
                $materials->price_material            = $request->price_material[$index];
                $materials->many_material             = $request->many_material[$index];
                $materials->total_material            = $request->total_material[$index];
                $examination_outpatient->material()->save($materials);
              }

            }

            if (count($request->lab_id) > 0) {
  
                foreach($request->lab_id as $index => $value) { 
                  if (empty($request->check_lab_id[$index])) {
                    $labs                          = new ExaminationOutpatientLab;
                  } else {
                    $labs                          = ExaminationOutpatientLab::find($request->check_lab_id[$index]);
                  }
                  $labs->examination_outpatient_id = $id;
                  $labs->lab_id                    = $request->lab_id[$index];
                  $labs->hasil                     = $request->hasil_lab[$index];
                  $labs->biaya                     = $request->price_lab[$index];
                  $labs->doctor_id                 = $request->doctor_id_lab[$index];
                  $labs->save();
                }

            }
        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('examination_outpatient')
                    ->with($res);
    }

    public function CheckValidation(Request $request)
    {

      if (!empty($request->id)) {
          clone $examination_outpatient->where('id', '!=', $request->id);
      }

      if ($examination_outpatient->count() > 0) {
          return 'false';
      } else {
          return 'true';
      }

        
    }

    public function getdata(){
        
        $examination_outpatient = ExaminationOutpatient::with(['outpatient','doctor'])->get();

        return DataTables::of($examination_outpatient)

        ->rawColumns(['options'])

        ->addColumn('options', function($examination_outpatient){
            return '
                <a href="'.route('examination_outpatient.edit', $examination_outpatient->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete('.$examination_outpatient->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('examination_outpatient.destroy', $examination_outpatient->id).'" method="POST" id="form-delete-'.$examination_outpatient->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })
        ->addColumn('pasien_name', function($examination_outpatient){
                return $examination_outpatient->outpatient->pasien->name.' / '.$examination_outpatient->outpatient->no_registrasi;
        })

        ->editColumn("amount", function ($examination_outpatient) {
                    return 'Rp '.number_format($examination_outpatient->amount);
                })

        ->editColumn("amount_material", function ($examination_outpatient) {
                    return 'Rp '.number_format($examination_outpatient->amount_material);
                })

        ->editColumn("amount_action", function ($examination_outpatient) {
                    return 'Rp '.number_format($examination_outpatient->amount_action);
                })
        
        ->addColumn('tgl_periksa', function($examination_outpatient){
                return $examination_outpatient->outpatient->tgl_periksa;
        })

        ->addColumn('doktor_name', function($examination_outpatient){
                return $examination_outpatient->outpatient->doctor->name;
        })

        ->addColumn('disease', function($examination_outpatient){
                return $examination_outpatient->outpatient->disease;
        })

        ->addColumn('complaint', function($examination_outpatient){
                return $examination_outpatient->outpatient->complaint;
        })
        ->addColumn('details_url', function($examination_outpatient) {
            return url('examination_outpatient/details-data/'.$examination_outpatient->id);
        })

        ->addColumn('details_url1', function($examination_outpatient) {
            return url('examination_outpatient/details-data1/'.$examination_outpatient->id);
        })

        ->toJson();
    }
    // getMaterial
    public function getDetailsData($id)
    {
        $details = ExaminationOutpatient::find($id)
                ->details()
                ->with(['action','doctor','material'])
                ->get();
        // dd($details);
        return Datatables::of($details)->make(true);
    }
    // Get Action
    public function getDetailsMaterial($id)
    {
        $materials = ExaminationOutpatient::find($id)
                ->material()
                ->with(['action','doctor','material'])
                ->get();
        // dd($details);
        return Datatables::of($materials)->make(true);
    }

    public function getOutpatient(Request $request)
    {
        $array = [['id' => '', 'text' => '']];
        $outpatient = Outpatient::select('id', 'no_registrasi as text')
                    ->doesnthave('examination_outpatient')
                    ->get();
        
        return response()->json(array_merge($array, $outpatient->toArray()));


    }

    public function getAction(Request $request)
    {	
        $actions = Action::select('id', 'action as text')
                  ->get();

        return response()->json($actions);
    }

    public function getDoctor(Request $request)
    {   
        $doctor = Doctor::select('id', 'name as text')
                  ->get();

        return response()->json($doctor);
    }

    public function getMaterial(Request $request)
    {
        $array = [['id' => '', 'text' => '']];
        $material = Material::select('id', 'name as text')
                    ->get();
        
        return response()->json(array_merge($array, $material->toArray()));


    }

    public function destroy($id)
    {
        DB::transaction(function() use ($id){

            $examination_outpatient = ExaminationOutpatient::find($id);
            $examination_outpatient->delete();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect('examination_outpatient')
                    ->with($res);
    }

    public function getMaterialId($id) {
        $material = Material::find($id);
        return response()->json($material);
    }

    public function getOutpatientId($id) {
        $outpatient = Outpatient::with(['pasien','doctor'])->find($id);
        return response()->json($outpatient);
    }

    public function getActionId($id) {
        $action = Action::find($id);
        return response()->json($action);
    }
}
