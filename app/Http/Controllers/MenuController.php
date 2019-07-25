<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\User;
use App\Permission;
use App\Role;
use Entrust;

class MenuController extends Controller
{
    public $arr_dummy = [['id' => '', 'text' => '']];

    // public function __construct()
    // {
    //     $this->middleware(['auth', 'role:admin']);
    // }

    public function index(Request $request)
    {
        //permission
        // if (Entrust::can('atur-menu')) {
            //true

            if ($request->ajax()) {

                $menus = Menu::with(['children'])
                        ->where('parent_id', 0)
                        ->orderBy('order_number')
                        ->get();

                if ($request->ajax()){

                    return view('pages.menu.load_data', ['menus' => $menus])->render();  

                }

            }

            $permissions = Permission::get();
            return view('pages.menu', compact('permissions'));

        // } else {
        //     abort(403);
        // }
    }

    public function store(Request $request)
    {
        //permission
        // if (Entrust::can('simpan-menu')) {
            //true

            $order_number = Menu::count() + 1;

            $menu = new Menu();
            $menu->name= $request->name;
            $menu->method = $request->method;
            $menu->url = $request->url;
            $menu->icon = $request->icon;
            $menu->is_showed = $request->is_showed;
            $menu->order_number = $order_number;
            $menu->save();

            $res = [
                        'title' => 'Berhasil',
                        'type' => 'success',
                        'message' => 'Data Berhasil Di Simpan!'
                    ];

            return response()->json($res);

        // } else {
        //     abort(403);
        // }
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $menu = Menu::select('id', 'name as text')
                        /*->where('parent_id', $id)*/
                        ->get();

            return response()->json(array_merge($this->arr_dummy, $menu->toArray()));
        }
    }

     public function edit(Request $request, $id)
    {

        // if (Entrust::can('ubah-menu')) {
            if ($request->ajax()) {
                $menu = Menu::find($id);
                return $menu->toJson();
            }
        // }

    }

    public function update(Request $request, $id)
    {
        //permission
        // if (Entrust::can('perbaharui-menu')) {
            //true
            $menu = Menu::find($id);
            $menu->name= $request->name;
            $menu->url = $request->url;
            $menu->method = $request->method;
            $menu->icon = $request->icon;
            $menu->is_showed = $request->is_showed;
            $menu->order_number = $request->order_number;
            $menu->save();

            $res = [
                        'title' => 'Berhasil',
                        'type' => 'success',
                        'message' => 'Data Berhasil Di Ubah!'
                    ];

            return response()->json($res);

        // } else {
        //     abort(403);
        // }
    }

    public function destroy(Request $request, $id)
    {
        //permission
        // if (Entrust::can('hapus-menu')) {
           //true
            if ($request->ajax()) {

                $menu = Menu::find($id);
                $menu->children()->delete();
                $menu->delete();

                $res = [
                            'title' => 'Berhasil',
                            'type' => 'success',
                            'message' => 'Data berhasil dihapus!'
                        ];

                return response()->json($res);

            }

        // } else {
        //     abort(403);
        // }
    }


    public function bulkEdit(Request $request)
    {

        // if (Entrust::can('ubah-menu')) {

            if ($request->ajax()) {

                foreach ($request->data as $data) {
                    if (isset($data['id'])) {
                        $menu = Menu::find($data['id']);
                        $menu->parent_id = $data['parent_id'] == null ? 0 : $data['parent_id'];
                        $menu->order_number = $data['left'];
                        $menu->save();
                    }
                }

                $res = [
                            'title' => 'Berhasil',
                            'type' => 'success',
                            'message' => 'Data berhasil diubah!'
                        ];

                return response()->json($res);

            }

        // } else {

        //     abort(403);

        // }
        
    }
}
