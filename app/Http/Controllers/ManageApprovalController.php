<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Approval;
use App\ApprovalDtl;
use DataTables;
use DB;

use App\User;
use App\UserData;
use App\Role;
use App\Division;
use App\Department;
use App\System;


class ManageApprovalController extends Controller
{
	public $arr_dummy = [['id' => '', 'text' => '']];

    public function index(Request $request)
    {

    	$approval = Approval::get();
    	if ($request->wantsJson()) {
            return response()->json($approval, 200);
        }

        return view('pages.manage_approval.index');
    }
    public function create()
    {
    	$approval 	= Approval::get();
    	// $department = Department::get();
    	$users 		= User::get();
    	$role      = Role::get();

    	return view('pages.manage_approval.create', compact(['approval','users','role'])) ;
    }

    public function store(Request $request)
    {
    	DB::transaction(function() use ($request){

		    $approval = new Approval;
		    $approval->name             = $request->name;
		    $approval->is_seq       	= $request->is_seq;
		    $approval->is_must_all      = $request->is_must_all;
		    $approval->total_approval      = count(array_filter($request->level));
		    $approval->save();

		    if (count($request->level > 0) && count($request->user) > 0) {
		        
		        for ($i = 0; $i < count($request->user); $i++) {

		        	if (!empty($request->level[$i]) && !empty($request->user[$i])) {

	        			$approval_d 				= new ApprovalDtl;
			            $approval_d->approval_id	= $approval->id;
			            $approval_d->level       	= $request->level[$i];
			            $approval_d->user_id 		= $request->user[$i];

			            $approval_d->save();
		        	}
		            

		        }
		    }

		 });

        $res = [
                    'title' => 'Succses',
                    'type' => 'success',
                    'message' => 'Data Saved Success!'
                ];

        return redirect()
                ->route('manage_approval.index')
                ->with($res);
    }
	
    public function getData()
    {

    	$approval = Approval::get();
        return DataTables::of($approval)
        ->rawColumns(['options'])

        ->addColumn('options', function($approval){
            return '
                <a href="'.route('manage_approval.edit', $approval->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="on_delete('.$approval->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('manage_approval.destroy', $approval->id).'" method="POST" id="form-delete-'.$approval->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }

    public function edit($id)
    {
        $approval = Approval::find($id);
		$approval_dtl = ApprovalDtl::where('approval_id',$id)->get();
    	$users 		= User::get();
    	$role      = Role::get();
        return view('pages.manage_approval.edit', compact(['approval','approval_dtl','users','role']));
    }

    public function update(Request $request)
    {
		DB::transaction(function() use ($request){
			$approval = Approval::find($request->approval_id);

			if (empty($approval)) {
				return response()->json('Type not found', 500);
			}
			
			$approval->name 		= $request->name;
			$approval->is_seq 		= $request->is_seq;
			$approval->is_must_all 	= $request->is_must_all;
			$approval->total_approval = count($request->level);
			$approval->save();
			
			ApprovalDtl::where('approval_id',$approval->id)->delete();

			for($i=0; $i < count($request->level); $i++)
			{
				$approval_dtl = new ApprovalDtl();
				$approval_dtl->approval_id 	= $approval->id; 
				$approval_dtl->user_id 		= $request->user[$i];
				$approval_dtl->level 		= $request->level[$i];
				
				$approval_dtl->save();
			}
			
		});
		
		if ($request->wantsJson()) {
			return response()->json($approval);
		}
        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect()
                ->route('manage_approval.index')
                ->with($res);

    }

    public function destroy(Request $request, $id)
    {
        $approval = Approval::find($id);

        if (empty($approval)) {
            return response()->json('Type not found', 500);
        }

        $approval->delete();

        if ($request->wantsJson()) {
            return response()->json('Type deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data Deleted Success!'
                ];

        return redirect()
                ->route('manage_approval.index')
                ->with($res);
    }
    public function getUser(Request $request)
    {
        $data = User::select('id', 'name as text')
                        ->get()
                        ->toArray();

        return response()->json(array_merge($this->arr_dummy, $data));
    }

}
