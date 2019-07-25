<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;

use DataTables;
use Carbon\Carbon;
use Helper;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::get();

        if ($request->wantsJson()) {
            return response()->json($permissions, 200);    
        }
        
        return view('pages.permission');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	
		$permission = new Permission;
        $permission->name = Helper::createSlug($request->name, 'permission');
        $permission->display_name = $request->name;
        $permission->parent_id = $request->parent_id;
        $permission->description = $request->description;
        $permission->save();

        if ($request->wantsJson()) {
            return response()->json($permission, 200);    
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect()
                ->route('permission.index')
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
        $permission = Permission::find($id);

        if (empty($permission)) {
            return response()->json('Permission not found', 500);
        }

        return response()->json($permission, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);

        if (empty($permission)) {
            return response()->json('Permission not found', 500);
        }

        $permission->name = Helper::createSlug($request->name, 'permission', $id);
        $permission->display_name = $request->name;
        $permission->parent_id = $request->parent_id;
        $permission->description = $request->description;
        $permission->save();

        if ($request->wantsJson()) {
            return response()->json($permission, 200);    
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect()
                ->route('permission.index')
                ->with($res);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $permission = Permission::find($id);
        
        if (empty($permission)) {
            return response()->json('Permission not found', 500);
        }

        $permission->delete();

        if ($request->wantsJson()) {
            return response()->json('Permission deleted', 200);    
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect()
                ->route('permission.index')
                ->with($res);
        
    }


    public function getData(Request $request)
    {
        $permission = Permission::with('parent')->get();

        return DataTables::of($permission)

        ->rawColumns(['options', 'title'])

        ->addColumn('options', function($data){
            return '<a href="'. route('permission.edit', $data->id) .'" class="btn btn-success btn-bordered waves-effect waves-light btn-xs">Edit</a>
                <button class="btn btn-danger btn-bordered waves-effect waves-light btn-xs" onClick="on_delete('.$data->id.')">Hapus</button>
                
                <form action="'. route('permission.destroy', $data->id) .'" method="POST" id="form-delete-'.$data->id.'" style="display:none">
                    '. method_field('DELETE') .'
                    '. csrf_field() .'
                </form>
            ';
        })

        ->addColumn('parent', function($data){
            return !empty($data->parent) ? $data->parent->display_name : 'Tidak ada parent';
        })

        ->toJson();
    }

    public function create()
    {
        $parents = Permission::where('parent_id', 0)
                    ->get();

        return view('pages.permission.create', compact(['parents']));
    }

    public function edit($id)
    {
        $parents = Permission::where('parent_id', 0)
                    ->where('id', '!=', $id)
                    ->get();

        $permission = Permission::find($id);

        return view('pages.permission.edit', compact(['parents', 'permission']));
    }
}
