<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
use App\Level;
use Excel;
use DataTables;
use DB;
use Storage;


class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $actions= Action::with(['level'])->get();
            return response()->json($actions);
        }
        return view('pages.action');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels    = Level::get();
        return view('pages.action.create', compact(['levels']));
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

            $action                     = new Action;
            $action->action           = $request->action;
            $action->level_id         = $request->level_id;
            $action->material         = $request->material;
            $action->service_rs       = $request->service_rs;
            $action->service_medis    = $request->service_medis;
            $action->service_anestesi = $request->service_anestesi;
            $action->service_dll      = $request->service_dll;
            $action->total            = $request->total;

            $action->save();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('action')
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
        $actions = Action::find($id);
        return view('pages.action.show',compact(['actions']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $levels    = Level::get();
        $action = Action::find($id);
        return view('pages.action.edit',compact(['action', 'levels']));   
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
       DB::transaction(function() use ($request,$id){

            $action                   = Action::find($id);
            $action->action           = $request->action;
            $action->level_id         = $request->level_id;
            $action->material         = $request->material;
            $action->service_rs       = $request->service_rs;
            $action->service_medis    = $request->service_medis;
            $action->service_anestesi = $request->service_anestesi;
            $action->service_dll      = $request->service_dll;
            $action->total            = $request->total;

            $action->save();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('action')
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

            $action = Action::find($id);
            $action->delete();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil sihapus!'
                ];

        return redirect('action')
                    ->with($res);
    }

    public function export() 
    {
        $actions = Action::select('action','material','service_rs','service_medis','service_medis','service_anestesi','service_dll','total','levels.code','levels.class')
                    ->join('levels', 'actions.level_id', '=', 'levels.id')
                    ->get();
       return Excel::create('Data Tindakan Dan Tarif', function($excel) use ($actions){
             $excel->sheet('Data Tindakan Dan Tarif', function($sheet) use ($actions){
                 $sheet->fromArray($actions);
             });

        })->download('csv');

    }

    public function getData(Request $request)
    {
        $actions = Action::with(['level'])->get();

        return DataTables::of($actions)

        ->rawColumns(['options'])

        ->addColumn('options', function($action){
            return '
                <a href="'.route('action.edit', $action->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete('.$action->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('action.destroy', $action->id).'" method="POST" id="form-delete-'.$action->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }
}
