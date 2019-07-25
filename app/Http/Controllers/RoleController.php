<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;

use DB;
use DataTables;
use Helper;
use Carbon\Carbon;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::with('perms')->get();

        if ($request->wantsJson()) {
            return response()->json($roles, 200);    
        }
        
        return view('pages.role');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$role = '';

    	DB::transaction(function() use ($request, &$role) {

    		$role = new Role;
	        $role->name = Helper::createSlug($request->name, 'role');
	        $role->display_name = $request->name;
	        $role->description = $request->description;
	        $role->save();
	        $role->perms()->sync($request->permissions);

    	});

        if ($request->wantsJson()) {
            return response()->json($role->load('perms'), 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect()
                ->route('role.index')
                ->with($res);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Park  $park
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $role = Role::find($id);

        if (empty($role)) {
            return response()->json('Role not found', 500);
        }

        if ($request->wantsJson()) {
            return response()->json($role->load('perms'), 200);    
        }

        return view('pages.role.show', compact(['role']));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        if (empty($role)) {
            return response()->json('Role not found', 500);
        }

        DB::transaction(function() use ($request, &$role, $id) {

	        $role->name = Helper::createSlug($request->name, 'role', $id);
	        $role->display_name = $request->name;
	        $role->description = $request->description;
	        $role->save();
	        $role->perms()->sync($request->permissions);

    	});

        if ($request->wantsJson()) {
            return response()->json($role->load('perms'), 200);
        }


        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect()
                ->route('role.index')
                ->with($res);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $role = Role::find($id);
        
        if (empty($role)) {
            return response()->json('Role not found', 500);
        }

        DB::transaction(function() use ($request, $role, $id){
            $role->perms()->sync([]);
            $role->delete();
        });
        

        if ($request->wantsJson()) {
            return response()->json('Role deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect()
                ->route('role.index')
                ->with($res);
    }

    public function getData(Request $request)
    {
        $role = Role::get();

        return DataTables::of($role)

        ->rawColumns(['options', 'title'])

        ->addColumn('options', function($data){
            return '<a href="'. route('role.edit', $data->id) .'" class="btn btn-success btn-bordered waves-effect waves-light btn-xs">Edit</a>
                <button class="btn btn-danger btn-bordered waves-effect waves-light btn-xs" onClick="on_delete('.$data->id.')">Hapus</button>
                
                <form action="'. route('role.destroy', $data->id) .'" method="POST" id="form-delete-'.$data->id.'" style="display:none">
                    '. method_field('DELETE') .'
                    '. csrf_field() .'
                </form>
            ';
        })

        ->addColumn('title', function($data){

            return '<a href="'. route('role.show', $data->id) .'"><strong>'.$data->name.' ('.$data->display_name.')</strong></a>
                    <br>
                <small class="text-muted">Created at '.
                     Carbon::parse($data->created_at)->format('M jS, Y') 
                .'</small>';
        })

        ->toJson();
    }

    public function create()
    {
        $permissions = Permission::with(['parent', 'children'])->where('parent_id', 0)
                                ->get();

        return view('pages.role.create', compact(['permissions']));
                            
    }

    public function edit($id)
    {
        $permissions = Permission::where('parent_id', 0)
                                ->get();

        $role = Role::find($id);

        return view('pages.role.edit', compact(['permissions', 'role']));
    }
}