<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\System;

use DataTables;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $system = System::get();

        if ($request->wantsJson()) {
            return response()->json($system, 200);
        }

        return view('pages.system');
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
            'system_type' => 'required',
            'system_code' => 'required',
            'system_val' => 'required'
        ]);

        $system = new System;
        $system->system_type = $request->system_type;
        $system->system_code = $request->system_code;
        $system->system_val = $request->system_val;
        $system->save();

        if ($request->wantsJson()) {
            return response()->json($system);
        }

        $res = [
                    'title' => 'Succses',
                    'type' => 'success',
                    'message' => 'Data Saved Success!'
                ];

        return redirect()
                ->route('system.index')
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
        $system = System::find($id);
        if (empty($system)) {
            return response()->json('Type not found', 500);
        }
        return response()->json($system, 200);
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
            'system_type' => 'required',
            'system_code' => 'required',
            'system_val' => 'required'
        ]);

        $system = System::find($id);

        if (empty($system)) {
            return response()->json('Type not found', 500);
        }
        $system->system_type = $request->system_type;
        $system->system_code = $request->system_code;
        $system->system_val = $request->system_val;
        $system->save();

        if ($request->wantsJson()) {
            return response()->json($system);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect()
                ->route('system.index')
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
        $system = System::find($id);

        if (empty($system)) {
            return response()->json('Type not found', 500);
        }

        $system->delete();

        if ($request->wantsJson()) {
            return response()->json('Type deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect()
                ->route('system.index')
                ->with($res);

    }

    public function getData(Request $request)
    {
        $system = System::get();
        return DataTables::of($system)
        ->rawColumns(['options'])

        ->addColumn('options', function($system){
            return '
                <a href="'.route('system.edit', $system->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="on_delete('.$system->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('system.destroy', $system->id).'" method="POST" id="form-delete-'.$system->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }

    public function create()
    {
        return view('pages.system.create');
    }

    public function edit($id)
    {
        $system = System::find($id);
        return view('pages.system.edit', compact(['system']));
    }
}

    
