<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Department;
use App\Division;
use App\System;

use DataTables;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $section = Section::with(['department'])->get();
        $dir_key = System::config('dir_key');
        
        if ($request->wantsJson()) {
            return response()->json($section, 200);
        }

        return view('pages.section');
        
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
            'section_code' => 'required',
            // 'dir_key' => 'required',
            'department_id' => 'required|exists:departments,id',
            // 'dep_grp' => 'required',
            // 'sap_key' => 'required',
            'section_name' => 'required'
        ]); 
        
        $section = new Section;
        $section->section_code = $request->section_code;
        $section->section_name = $request->section_name;
        $section->department_id = $request->department_id;
        $section->save();

        if ($request->wantsJson()){
            return response()->json($department->load(['department_id']), 200);    
        }
        
        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data success!'
                ];

        return redirect()
                ->route('section.index')
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
        $section = Section::with(['department'])->find($id);
        
        if (empty($section)) {
            return response()->json('Section not found', 500);
        }

        return response()->json($section->load(['department']), 200);
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
            'section_code' => 'required',
            // 'dir_key' => 'required',
            'department_id' => 'required|exists:departments,id',
            // 'dep_grp' => 'required',
            // 'sap_key' => 'required',
            'section_name' => 'required'
        ]);
        
        $section = Section::find($id);

        if (empty($section)) {
            return response()->json('Department not found', 500);
        }

        $section->section_code = $request->section_code;
        $section->section_name = $request->section_name;
        $section->department_id = $request->department_id;
        $section->save();

        // return response()->json($department->load(['division']), 200);
        if ($request->wantsJson()) {
            return response()->json($section);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect()
                ->route('section.index')
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
        $section = Section::find($id);

        if (empty($section)) {
            return response()->json('Section not found', 500);
        }

        $section->delete();

        if($request->wantsJson()) {
            return response()->json('Section deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect()
                    ->route('section.index')
                    ->with($res);
    }

    public function getData(Request $request)
    {
        $section = Section::with(['department', 'department.division'])->get();
        return DataTables::of($section)
        ->rawColumns(['options'])

        ->addColumn('options', function($section){
            return '
                <a href="'.route('section.edit', $section->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="on_delete('.$section->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('section.destroy', $section->id).'" method="POST" id="form-delete-'.$section->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }


    public function create()
    {
        $section = Section::get();
        $department = Department::get();
        $division = Division::get();
        $dir_keys = System::config('dir_key');

        return view('pages.section.create', compact(['department','division', 'dir_keys']));
        // dd($dir_keys);
    }

    public function edit($id)
    {
    	$division = Division::get();
        $department = Department::get();
        $section = Section::find($id);
        $dir_keys = System::config('dir_key');

        return view('pages.section.edit', compact(['section', 'department','division', 'dir_keys']));
    }
}


