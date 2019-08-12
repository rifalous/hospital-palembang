<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\ExaminationOutpatient;
use App\ExaminationInpatient;
use App\ExaminationInpatientData;
use App\ExaminationInpatientDetail;
use App\Inpatient;
use App\Action;
use App\Material;
use App\Doctor;
use App\Room;
use App\Level;
use App\Outpatient;
use DataTables;
use Storage;


class ExaminationInpatientController extends Controller
{
    public function index()
    {
        return view('pages.examination_inpatient.index');
    }

     public function create()
    {
        $inpatient = Inpatient::get();
        $materials = Material::get(); 
        $actions   = Action::get();
        $rooms = Room::get(); //room Model
        $class = Level::all(); //Class Model
       
        return view('pages.examination_inpatient.create', compact(['inpatient','materials','actions','rooms','class']));

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

            $examination_inpatient                  = new ExaminationInpatient;
            $examination_inpatient->inpatient_id    = $request->inpatient_id;
            $examination_inpatient->check_date      = $request->check_date;
            $examination_inpatient->room_id         = $request->room_id;
            $examination_inpatient->level_id        = $request->class_id;

            $examination_inpatient->save();

            $examination_inpatient_id = $examination_inpatient->id;

            if (count($request->action_id) > 0) {

              foreach($request->action_id as $index => $value) { 
                $actions                            = new ExaminationInpatientData;
                $actions->examination_inpatient_id  = $examination_inpatient_id;
                $actions->action_id                 = $request->action_id[$index];
                $actions->cost_inpatient            = $request->cost_inpatient[$index];
                $actions->many_action               = $request->many_action[$index];
                $actions->total_action              = $request->total_action[$index];
                $actions->doctor_id                 = $request->doctor_id[$index];
                $actions->save();
              }

            }

            if (count($request->material_id) > 0) {

              foreach($request->material_id as $index => $value) { 
                $materials                            = new ExaminationInpatientDetail;
                $materials->examination_inpatient_id = $examination_inpatient_id;
                $materials->material_id               = $request->material_id[$index];
                $materials->price_material            = $request->price_material[$index];
                $materials->many_material             = $request->many_material[$index];
                $materials->total_material            = $request->total_material[$index];
                $materials->save();
              }

            }

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('examination_inpatient')
                    ->with($res);
    }

    public function edit($id)
    {
        $inpatient = Inpatient::select('id', 'no_registrasi as text')->get();
        $actions = Action::select('id', 'action as text')->get();
        $doctors = Doctor::select('id', 'name as text')->get();
        $materials = Material::select('id', 'name as text')->get();
        
        $examination_inpatient  = ExaminationInpatient::find($id);


        return view('pages.examination_inpatient.edit', compact(['inpatients','actions','doctors','examination_inpatient','materials']));
    }

    public function destroy($id)
    {
        DB::transaction(function() use ($id){

            $examination_inpatient = ExaminationInpatient::find($id);
            $examination_inpatient->delete();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect('examination_inpatient')->with($res);
    }

    public function getInpatient(Request $request)
    {
        $inpatient = Inpatient::with('room','doctor')->get();
        
        return response()->json($inpatient->first());
    }

    public function getAction(Request $request){
        $actions = Action::select('id', 'action as text')->get();
       
        return response()->json($actions);
    }

    public function getMedicine(Request $request){
        $actions = Material::select('id', 'name as text')->get();
        return response()->json($actions);
    }

    public function getdata(){
       
        $examination_inpatient = ExaminationInpatient::with('inpatient')->get();

        return DataTables::of($examination_inpatient)

        ->rawColumns(['options'])

        ->addColumn('options', function($examination_inpatient){
            return '
                <a href="'.route('examination_inpatient.edit', $examination_inpatient->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete('.$examination_inpatient->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('examination_inpatient.destroy', $examination_inpatient->id).'" method="POST" id="form-delete-'.$examination_inpatient->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })
        ->addColumn('pasien_name', function($examination_inpatient){
                return $examination_inpatient->inpatient->pasien->name.' | '.$examination_inpatient->inpatient->no_registrasi;
        })

        ->addColumn('tgl_periksa', function($examination_inpatient){
                return $examination_inpatient->check_date;
        })

        ->addColumn('doktor_name', function($examination_inpatient){
                return $examination_inpatient->inpatient->doctor->name;
        })

        ->addColumn('disease', function($examination_inpatient){
                return $examination_inpatient->inpatient->disease;
        })

        ->addColumn('complaint', function($examination_inpatient){
                return $examination_inpatient->inpatient->complaint;
        })
        ->addColumn('details_url', function($examination_inpatient) {
            return url('examination_inpatient/details-data/'.$examination_inpatient->id);
        })

        ->toJson();
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
        $details = ExaminationInpatient::find($id)
                ->details()
                ->with(['action','doctor'])
                ->get();
        $materials = ExaminationInpatient::find($id)
                ->material()
                ->with(['material'])
                ->get();
        $details[0]->examination_inpatient_id = $materials[0]->examination_inpatient_id;
        $details[0]->material_id = $materials[0]->material_id;
        $details[0]->price_material = $materials[0]->price_material;
        $details[0]->many_material = $materials[0]->many_material;
        $details[0]->total_material = $materials[0]->total_material;
        return Datatables::of($details)->make(true);
    }

}
