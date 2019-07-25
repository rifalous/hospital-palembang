<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemCategory;
use App\Item;
use App\SapUom;
use App\Supplier;
use App\Tag;
use App\Exports\MasterItemExport;
use Excel;
use Storage;

use DataTables;

class ItemController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $item = Item::with(['item_category','uom','supplier','tags'])->get();
                
        if ($request->wantsJson()) {
            return response()->json($item, 200);
        }

        return view('pages.item');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {       
        $item = new Item;
        $item->item_category_id = $request->item_category_id;
        $item->item_code = $request->item_code;
        $item->item_description = $request->item_description;
        $item->item_specification = $request->item_specification;
        $item->item_brand = $request->item_brand;
        $item->item_price = $request->item_price;
        $item->uom_id = $request->uom_id;
        $item->supplier_id = $request->supplier_id;
        $item->lead_times = $request->lead_times;
        $item->remarks = $request->remarks;
        $item->feature_image = $request->feature_image;
        $item->feature_file = $request->feature_file;
        $item->save();

        if (count($request->tags) > 0 || !empty($request->tags)){

            foreach ($request->tags as $tag) {

                $tag = Tag::firstOrCreate(['name' => $tag]);
                if ($tag) {
                    $tagIds[] = $tag->id;
                }
            }
            
            $item->tags()->sync($tagIds);
        }
        
        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data success!'
                ];

        return redirect()
                ->route('item.index')
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
        $item = Item::with(['item_category','uom','supplier'])->find($id);
        
        if (empty($item)) {
            return response()->json('Item not found', 500);
        }

        return response()->json($item->load(['item_category','uom','supplier']), 200);
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
        $item = Item::find($id);

        if (empty($item)) {
            return response()->json('Item not found', 500);
        }

        $item->item_code = $request->item_code;
        $item->item_description = $request->item_description;
        $item->item_specification = $request->item_specification;
        $item->item_brand = $request->item_brand;
        $item->item_price = $request->item_price;
        $item->uom_id = $request->uom_id;
        $item->supplier_id = $request->supplier_id;
        $item->lead_times = $request->lead_times;
        $item->remarks = $request->remarks;
        $item->feature_image = $request->feature_image;
        $item->feature_file = $request->feature_file;
        $item->save();

        if (count($request->tags) > 0 || !empty($request->tags)){

            foreach ($request->tags as $tag) {

                $tag = Tag::firstOrCreate(['name' => $tag]);
                if ($tag) {
                    $tagIds[] = $tag->id;
                }
            }
            
            $product->tags()->sync($tagIds);
        }

        // return response()->json($department->load(['division']), 200);
        if ($request->wantsJson()) {
            return response()->json($item);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect()
                ->route('item.index')
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
        $item = Item::find($id);

        if (empty($item)) {
            return response()->json('Item not found', 500);
        }

        $item->delete();

        if($request->wantsJson()) {
            return response()->json('Item deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data Deleted Success!'
                ];

        return redirect()
                    ->route('item.index')
                    ->with($res);
    }

    public function getData(Request $request)
    {
        $item = Item::with(['item_category','uom','supplier','tags'])->get();
        return DataTables::of($item)
        ->rawColumns(['options', 'tags'])

        ->addColumn('tags', function($item){
            $tags =  $item->tags->pluck('name');
            return '<span class="badge bg-info">'.$tags->implode('</span>&nbsp;<span class="badge bg-info">');
        })

        ->addColumn('options', function($item){
            return '
                <a href="'.route('item.edit', $item->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="on_delete('.$item->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('item.destroy', $item->id).'" method="POST" id="form-delete-'.$item->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })
        

        ->toJson();
    }


    public function create()
    {
        // $item = Item::with(['item_category','uom','supplier'])->get();
        $item = Item::get();
        $item_category = ItemCategory::get();
        $uom = SapUom::get();
        $supplier = Supplier::get();
        $tags=Tag::get();
        
        // dd($item_category);
        return view('pages.item.create', compact(['item_category','uom','supplier', 'tags']));
        
    }

    public function edit($id)
    {
        $item = Item::find($id);
        $item_category = ItemCategory::get();
        $uom = SapUom::get();
        $supplier = Supplier::get();
        $tags=Tag::get();
        
        return view('pages.item.edit', compact(['item', 'item_category','uom','supplier','tags']));
    }


    public function import(Request $request)
    {
        $file = $request->file('file');
        $name = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/uploads', $name);
        $data = [];
        if ($request->hasFile('file')) {
            $datas = Excel::load(public_path('storage/uploads/'.$name), function($reader){})->get();

                // if ($datas->first()->has('item_code')){
                    foreach ($datas as $data) {

                        $item_id = Item::where('item_code', $data->item_code)->first();
                        $item_category = ItemCategory::where('category_code', $data->category_code)->first();
                        $uom = SapUom::where('uom_sname',$data->uom)->first();
                        $supplier = Supplier::where('supplier_code',$data->supplier_code)->first();
                        
                        $item                       = Item::firstOrNew(['id' => $item_id]);
                        $item->item_category_id     = !empty($item_category) ? $item_category->id : NULL;
                        $item->item_code            = $data->item_code;
                        $item->item_description     = $data->description;
                        $item->item_specification   = $data->specification;
                        $item->item_brand           = $data->brand;
                        $item->item_price           = $data->price;
                        $item->uom_id               = !empty($uom) ? $uom->id : NULL;
                        $item->supplier_id          = !empty($supplier) ? $supplier->id : NULL;
                        $item->lead_times           = $data->lead_times;
                        $item->remarks              = $data->remarks;
                        $item->save();                  
                    }  

                    if (count($data->tags) > 0 || !empty($data->tags)){
                        // dd($data->tags);

                        foreach (explode(';', $data->tags) as $tag) {
            
                            $tag = Tag::firstOrCreate(['name' => $tag]);
                            if ($tag) {
                                $tagIds[] = $tag->id;
                            }
                        }
                        
                        $item->tags()->sync($tagIds);
                    }

                    $res = [
                                'title'             => 'Sukses',
                                'type'              => 'success',
                                'message'           => 'Upload Data Success!'
                            ];
                    Storage::delete('public/uploads/'.$name); 
                    return redirect()
                            ->route('item.index')
                            ->with($res);
        }
    }

    public function export() 
    {
        $item = Item::all();

        return Excel::create('master_item', function($excel) use ($masterprices){
             $excel->sheet('mysheet', function($sheet) use ($masterprices){
                 $sheet->fromArray($masterparts);
             });

        })->download('csv');

    }

    public function template_item() 
    {
       return Excel::create('Template Items', function($excel){
             $excel->sheet('mysheet', function($sheet){
                $sheet->cell('A1', function($cell) {$cell->setValue('category_code');});
                $sheet->cell('B1', function($cell) {$cell->setValue('item_code');});
                $sheet->cell('C1', function($cell) {$cell->setValue('description');});
                $sheet->cell('D1', function($cell) {$cell->setValue('specification');});
                $sheet->cell('E1', function($cell) {$cell->setValue('brand');});
                $sheet->cell('F1', function($cell) {$cell->setValue('price');});
                $sheet->cell('G1', function($cell) {$cell->setValue('UoM');});
                $sheet->cell('H1', function($cell) {$cell->setValue('supplier_code');});
                $sheet->cell('I1', function($cell) {$cell->setValue('lead_times');});
                $sheet->cell('J1', function($cell) {$cell->setValue('remarks');});
                $sheet->cell('K1', function($cell) {$cell->setValue('tags');});
             });

        })->download('csv');
    } 
}



    
