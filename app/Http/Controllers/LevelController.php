<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use DataTables;
use DB;
use Storage;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            
            $level= Level::get();
            
            return response()->json($level);

        }
        return view('pages.level');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getCodeLevel = Level::getCodeLevel();
        return view('pages.level.create',compact(['getCodeLevel']));
        
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

            $level                 = new Level;
            $level->code           = $request->code;
            $level->class          = $request->class;
            $level->tarif          = $request->tarif;
            
            $level->save();
        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('level')
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
        $level  = Level::find($id);
        return view('pages.level.show', compact(['level']));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $level  = Level::find($id);
        return view('pages.level.edit', compact(['level']));
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

            $level                 = Level::find($id);
            $level->code           = $request->code;
            $level->class          = $request->class;
            $level->tarif          = $request->tarif;
            
            $level->save();
        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('level')
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

            $level = Level::find($id);
            $level->delete();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil sihapus!'
                ];

        return redirect('level')
                    ->with($res);
    }

    public function export() 
    {
        $levels = Level::get();

       return Excel::create('Data Kelas', function($excel) use ($levels){
             $excel->sheet('Data Kelas', function($sheet) use ($levels){
                 $sheet->fromArray($levels);
             });

        })->download('csv');

    }

    public function getData(Request $request)
    {
        $Levels = Level::get();

        return DataTables::of($Levels)

        ->rawColumns(['options'])

        ->addColumn('options', function($level){
            return '
                <a href="'.route('level.edit', $level->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete('.$level->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('level.destroy', $level->id).'" method="POST" id="form-delete-'.$level->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }
}
