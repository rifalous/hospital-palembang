<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Division;
use App\System;

use DataTables;

class DepartmentController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $department = Department::with(['division'])->get();
        $dir_key = System::config('dir_key');
        
        if ($request->wantsJson()) {
            return response()->json($department, 200);
        }

        return view('pages.department');
        
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
            'department_code' => 'required',
            // 'dir_key' => 'required',
            'division_id' => 'required|exists:divisions,id',
            // 'dep_grp' => 'required',
            // 'sap_key' => 'required',
            'department_name' => 'required'
        ]); 
        
        $department = new Department;
        $department->department_code = $request->department_code;
        $department->division_id = $request->division_id;
        $department->sap_key = $request->sap_key;
        $department->department_name = $request->department_name;
        $department->save();

        if ($request->wantsJson()){
            return response()->json($department->load(['division_id']), 200);    
        }
        
        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data success!'
                ];

        return redirect()
                ->route('department.index')
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
        $department = Department::with(['division'])->find($id);
        
        if (empty($department)) {
            return response()->json('Department not found', 500);
        }

        return response()->json($department->load(['division']), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'department_code' => 'required',
            // 'dir_key' => 'required',
            'division_id' => 'required|exists:divisions,id',
            // 'dep_grp' => 'required',
            // 'sap_key' => 'required',
            'department_name' => 'required'
        ]);
        
        $department = Department::find($id);

        if (empty($department)) {
            return response()->json('Department not found', 500);
        }

        $department->division_id = $request->division_id;
        $department->sap_key = $request->sap_key;
        $department->department_name = $request->department_name;
        $department->save();

        // return response()->json($department->load(['division']), 200);
        if ($request->wantsJson()) {
            return response()->json($department);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect()
                ->route('department.index')
                ->with($res);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $department = Department::find($id);

        if (empty($department)) {
            return response()->json('Department not found', 500);
        }

        $department->delete();

        if($request->wantsJson()) {
            return response()->json('Department deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data Deleted Success!'
                ];

        return redirect()
                    ->route('department.index')
                    ->with($res);
    }

    public function getData(Request $request)
    {
        $department = Department::with(['division'])->get();
        return DataTables::of($department)
        ->rawColumns(['options'])

        ->addColumn('options', function($department){
            return '
                <a href="'.route('department.edit', $department->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="on_delete('.$department->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('department.destroy', $department->id).'" method="POST" id="form-delete-'.$department->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }


    public function create()
    {
        $department = Department::get();
        $division = Division::get();
        $dir_keys = System::config('dir_key');

        return view('pages.department.create', compact(['division', 'dir_keys']));
        // dd($dir_keys);
    }

    public function edit($id)
    {
        $division = Division::get();
        $department = Department::find($id);
        $dir_keys = System::config('dir_key');

        return view('pages.department.edit', compact(['department', 'division', 'dir_keys']));
    }

}

