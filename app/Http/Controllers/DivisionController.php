<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Division;
use App\System;
use DataTables;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $division = Division::get();
        $dir_key = System::config('dir_key');

        if ($request->wantsJson()) {
            return response()->json($divisions, 200);
        }

        return view('pages.division');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'division_code' => 'required',
            'division_name' => 'required'
        ]);

        $division = new Division;
        $division->division_code = $request->division_code;
        $division->division_name = $request->division_name;
        $division->dir_key = $request->dir_key;
        $division->save();

        if ($request->wantsJson()) {
            return response()->json($division);
        }

        $res = [
                    'title' => 'Succses',
                    'type' => 'success',
                    'message' => 'Data Saved Success!'
                ];

        return redirect()
                ->route('division.index')
                ->with($res);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Park  $park
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $division = Division::find($id);
        if (empty($division)) {
            return response()->json('Type not found', 500);
        }
        return response()->json($division, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'division_code' => 'required',
            'division_name' => 'required'
        ]);

        $division = Division::find($id);

        if (empty($division)) {
            return response()->json('Type not found', 500);
        }

        $division->division_code = $request->division_code;
        $division->division_name = $request->division_name;
        $division->save();

        if ($request->wantsJson()) {
            return response()->json($division);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect()
                ->route('division.index')
                ->with($res);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $division = Division::find($id);

        if (empty($division)) {
            return response()->json('Type not found', 500);
        }

        $division->delete();

        if ($request->wantsJson()) {
            return response()->json('Type deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect()
                ->route('division.index')
                ->with($res);

    }

    public function getData(Request $request)
    {
        $division = Division::get();
        return DataTables::of($division)
        ->rawColumns(['options'])

        ->addColumn('options', function($division){
            return '
                <a href="'.route('division.edit', $division->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="on_delete('.$division->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('division.destroy', $division->id).'" method="POST" id="form-delete-'.$division->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }

    public function create()
    {
        $dir_keys = System::config('dir_key');
        return view('pages.division.create', compact(['dir_keys']));
    }

    public function edit($id)
    {
        $division = Division::find($id);
        $dir_keys = System::config('dir_key');
        return view('pages.division.edit', compact(['division','dir_keys']));
    }

    public function getDepartmentByDivision($division_id)
    {
        $division = Division::find($division_id);
        $result = [['id' => '', 'text' => '']];

        foreach ($division->department as $department) {
            $result[] = ['id' => $department->id, 'text' => $department->department_name];
        }

        return response()->json($result);
    }

    public function import(Request $request)
    {

        $file = $request->file('file');
        $name = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/uploads', $name);

        if ($request->hasFile('file')) {

            // $file = public_path('storage/uploads/1534217112.xls');
            $datas = Excel::load(public_path('storage/uploads/'.$name), function($reader){})->get();

            if ($datas->first()->has('division_code')) {
                
                foreach ($datas as $data) {
                    
                    if (!empty($data->division_code)) {

                        DB::transaction(function() use ($data){

                            $division = Division::firstOrNew(['division_code' => $data->division_code]);
                            $division->division_code = $data->division_code;
                            
                            $division->save();

                            $division->user_data()->delete();

                            $divisions = new Division;
                            $divisions->division_code = $data->division_code;
                            $divisions->division_name = $data->division_name;

                            $division->$divisions()->save($divisions);

                        });
                    }
                    
                }

                Storage::delete('public/uploads/'.$name);

                return redirect()
                        ->route('user.index')
                        ->with(
                            [
                                'title' => 'Sukses',
                                'type' => 'success',
                                'message' => 'Data berhasil di import!'
                            ]
                        );

            } else {

                Storage::delete('public/uploads/'.$name);

                return redirect()
                        ->route('user.index')
                        ->with(
                            [
                                'title' => 'Error',
                                'type' => 'error',
                                'message' => 'Format Buruk!'
                            ]
                        );
            }
                

        }

        
    }
}
