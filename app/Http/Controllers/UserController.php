<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

use App\User;
use App\UserData;
use App\Role;
use App\Division;
use App\Department;
use App\System;

use App\Exports\UsersExport;
use Excel;

use Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with(['division'])
                        ->with(['department'])
                        ->get();

        $dir_key = System::config('dir_key');

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = $users;
        $perPage = 6;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());

        return view('pages.user', ['users' => $paginatedItems]);
    }

    public function create()
    {

        $roles = Role::get();
        $division = Division::get();
        $department = Division::get();
        $dir_keys = System::config('dir_key');
        $status = System::configmultiply('status');

        return view('pages.user.create', compact(['roles','division','department','dir_keys','status']));
    }

    public function store(Request $request)
    {
        DB::transaction(function() use ($request){

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->status = $request->status;
            // $user->sap_cc_code = $request->sap_cc_code;

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads',$name);

                $user->photo = 'uploads/'.$name;   
            }

            $user->division_id = $request->division_id;
            $user->department_id = $request->department_id;
            $user->direction = $request->dir_key;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->roles()->sync($request->roles);
        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('user')
                    ->with($res);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $division = Division::get();
        $department = Department::where('division_id', $user->division_id)->get();
        $dir_key = System::config('dir_key');
        $roles = Role::get();
        $status = System::configmultiply('status');


        return view('pages.user.edit', compact(['division','department','dir_key','roles', 'user', 'status']));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function() use ($request, $id){

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            // $user->status = $request->status;
            // $user->sap_cc_code = $request->sap_cc_code;
            $user->division_id = $request->division_id;
            $user->department_id = $request->department_id;
            $user->direction = $request->dir_key;

            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            if ($request->hasFile('photo')) {

                $file = $request->file('photo');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads',$name);
                // $path = $file->storeAs('public/uploads', $name);

                $path = 'uploads/';
                
                if (file_exists($user->photo) && !empty($user->photo)) {
                    unlink($user->photo);
                }

                $user->photo = $path.$name;
            }

            // if ($request->hasFile('photo')) {
            //     $file = $request->file('photo');
            //     $name = time() . '.' . $file->getClientOriginalExtension();
            //     $path = $file->storeAs('public/uploads', $name);

            //     $user->photo = $name;   
            // }
            
            $user->save();
            $user->roles()->sync($request->roles);

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect('user')
                    ->with($res);
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('pages.user.show', compact(['user']));
    }

    public function destroy($id)
    {
        DB::transaction(function() use ($id){

            $user = User::find($id);
            $user->roles()->sync([]);
            $user->delete();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'User berhasil sihapus!'
                ];

        return redirect('user')
                    ->with($res);
    }

    public function validatePost(Request $request)
    {
        if ($request->ajax()) {

            $user = User::where('email', $request->email);

            if (!empty($request->id)) {
                clone $user->where('id', '!=', $request->id);
            }

            if ($user->count() > 0) {
                return 'false';
            } else {
                return 'true';
            }
        }
    }

    // public function export() 
    // {
    //     $users = User::join('user_datas', 'user_datas.user_id', '=', 'users.id')
    //                 ->whereNull('user_datas.deleted_at')
    //                 ->get()
    //                 ->makeHidden(['id', 'user_id', 'account_bank_number', 'account_bank_name', 'upload_saving_book', 'upload_identity_card', 'deleted_at']);

    //     return Excel::create('data_pengguna', function($excel) use ($users){
    //          $excel->sheet('mysheet', function($sheet) use ($users){
    //              $sheet->fromArray($users);
    //          });

    //     })->download('xls');

    // }

    public function import(Request $request)
    {
        // $validation = $request->validate([
        //     'file' => 'required|mimes:xls'
        // ]);

        $file = $request->file('file'); 
        $name = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/uploads', $name);

        if ($request->hasFile('file')) {

            $file = public_path('storage/uploads/1534217112.xls');
            $datas = Excel::load(public_path('storage/uploads/'.$name), function($reader){})->get();

            if ($datas->first()->has('email') && $datas->first()->has('default_group_location_id')) {
                
                foreach ($datas as $data) {
                    
                    if (!empty($data->email)) {

                        DB::transaction(function() use ($data){

                            $user = User::firstOrNew(['email' => $data->email]);
                            $user->email = $data->email;
                            $user->deleted_at = null;
                            
                            if (!$user->exists) {
                                $user->password = Hash::make('secret');
                            }

                            $user->save();

                            $user_data = UserData::firstOrNew(['user_id' => $user->id]);
                            $user_data->name = $data->name;
                            $user_data->identity_number = $data->identity_number;
                            $user_data->kk_number = $data->kk_number;
                            $user_data->phone_number = $data->phone_number;
                            $user_data->leader_name = $data->leader_name;

                            $user_data->gender = $data->gender;
                            $user_data->place_of_birth = $data->place_of_birth;
                            $user_data->date_of_birth = $data->date_of_birth;
                            $user_data->address = $data->address;
                            $user_data->account_bank_number = $data->account_bank_number;
                            $user_data->account_bank_name = $data->account_bank_name;
                            $user_data->upload_saving_book = $data->upload_saving_book;
                            $user_data->upload_identity_card = $data->upload_identity_card;
                            $user_data->default_group_location_id = $data->default_group_location_id;
                            $user_data->deleted_at = null;

                            $user->user_data()->save($user_data);

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

    public function tes()
    {
        $file = public_path('storage/uploads/plat.jpg');
        dd(\Ocr::recognize($file));
    
    }

}