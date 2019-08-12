<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diagnosis;
use DataTables;
use DB;
use Storage;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $diagnoses = Diagnosis::get();
            return response()->json($diagnoses);
        }
        return view('pages.diagnosis');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.diagnosis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function() use ($request)
        {
            $diagnosis              = new Diagnosis;
            $diagnosis->code        = $request->code;
            $diagnosis->diagnosis   = $request->diagnosis;

            $diagnosis->save();
        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('diagnosis')
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
        $diagnosis = Diagnosis::find($id);

        return view('pages.diagnosis.show', compact(['diagnosis']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diagnosis = Diagnosis::find($id);

        return view('pages.diagnosis.edit', compact(['diagnosis']));
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
        DB::transaction(function() use ($request,$id)
        {
            $diagnosis              = Diagnosis::find($id);
            $diagnosis->code        = $request->code;
            $diagnosis->diagnosis   = $request->diagnosis;

            $diagnosis->save();
        });

        $res = [
                'title' => 'Sukses',
                'type' => 'success',
                'message' => 'Data berhasil disimpan!'
            ];

        return redirect('diagnosis')
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

            $diagnosis = Diagnosis::find($id);
            $diagnosis->delete();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect('diagnosis')
                    ->with($res);
    }

    public function getData(Request $request)
    {
        $diagnosis = Diagnosis::get();

        return DataTables::of($diagnosis);

        ->rawColumns(['options'])
        ->addColumns('options' function($diagnosis)){

            
        }
    }
}
