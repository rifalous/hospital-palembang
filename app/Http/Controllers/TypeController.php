<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

use DataTables;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $types = Type::get();

        if ($request->wantsJson()) {
            return response()->json($types, 200);
        }

        return view('pages.type');
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
            'name' => 'required'
        ]);

        $type = new Type;
        $type->name = $request->name;
        $type->description = $request->description;
        $type->save();

        if ($request->wantsJson()) {
            return response()->json($type);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect()
                ->route('type.index')
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
        $type = Type::find($id);
        if (empty($type)) {
            return response()->json('Type not found', 500);
        }
        return response()->json($type, 200);
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
            'name' => 'required'
        ]);

        $type = Type::find($id);

        if (empty($type)) {
            return response()->json('Type not found', 500);
        }

        $type->name = $request->name;
        $type->description = $request->description;
        $type->save();

        if ($request->wantsJson()) {
            return response()->json($type);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect()
                ->route('type.index')
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
        $type = Type::find($id);

        if (empty($type)) {
            return response()->json('Type not found', 500);
        }

        $type->delete();

        if ($request->wantsJson()) {
            return response()->json('Type deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect()
                ->route('type.index')
                ->with($res);

    }

    public function getData(Request $request)
    {
        $types = Type::get();
        return DataTables::of($types)
        ->rawColumns(['options'])

        ->addColumn('options', function($type){
            return '
                <a href="'.route('type.edit', $type->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete('.$type->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('type.destroy', $type->id).'" method="POST" id="form-delete-'.$type->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }

    public function create()
    {
        return view('pages.type.create');
    }

    public function edit($id)
    {
        $type = Type::find($id);
        return view('pages.type.edit', compact(['type']));
    }
}
