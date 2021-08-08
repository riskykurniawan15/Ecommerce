<?php

namespace App\Http\Controllers\Adminpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Item;
use App\Item_image;

use Image;
use File;

class ItemsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('adminpanel.pages.item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminpanel.pages.item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'NAME_ITEMS' => 'required|max:100',
            'HEAD_PICTURE_ITEMS' => 'required|mimes:jpeg,png,jpg',
            'PURCHASE_PRICE_ITEMS' => 'numeric|required',
            'SELLING_PRICE_ITEMS' => 'numeric|required',
            'WEIGHT_ITEMS' => 'numeric|required',
            'DESCRIPTION_ITEMS' => 'required'
        ]);

        $primary = "CODE_ITEMS";
        $prefix = "BRG";
        $q = DB::table('items')->select(DB::raw('MAX(RIGHT(' . $primary . ',4)) as kd_max'));
        $prx = $prefix . now()->format('Ym');
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = $prx . sprintf("%04s", $tmp);
            }
        } else {
            $kd = $prx . "0001";
        }

        $image = $request->file('HEAD_PICTURE_ITEMS');
        $filename = md5(Hash::make($kd) . md5(Hash::make(now()))) . '.' . $image->getClientOriginalExtension();

        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(550, 750);
        $image_resize->save(public_path('assets/img/items/' . $filename));

        Item::create([
            'CODE_ITEMS' => $kd,
            'NAME_ITEMS' => $request->NAME_ITEMS,
            'HEAD_PICTURE_ITEMS' => $filename,
            'PURCHASE_PRICE_ITEMS' => $request->PURCHASE_PRICE_ITEMS,
            'SELLING_PRICE_ITEMS' => $request->SELLING_PRICE_ITEMS,
            'WEIGHT_ITEMS' => $request->WEIGHT_ITEMS,
            'DESCRIPTION_ITEMS' => $request->DESCRIPTION_ITEMS
        ]);

        return redirect(url('adminpanel/items'))->with('status', 'Perintah berhasil dijalankan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $item_images = Item_image::where('ID_ITEMS', $item->ID_ITEMS)->get();
        return view('adminpanel.pages.item.image.index', compact('item', 'item_images'));
    }

    public function upload(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'NAME_ITEM_IMAGES' => 'required|mimes:jpeg,png,jpg'
        ]);

        $image = $request->file('NAME_ITEM_IMAGES');
        $filename = md5(Hash::make($item->CODE_ITEMS . ' - item_images') . md5(Hash::make(now()))) . '.' . $image->getClientOriginalExtension();

        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(569, 528);
        $image_resize->save(public_path('assets/img/items/images/' . $filename));

        Item_image::create([
            'ID_ITEMS' => $item->ID_ITEMS,
            'NAME_ITEM_IMAGES' => $filename
        ]);

        return redirect(url('adminpanel/items/' . $item->ID_ITEMS))->with('status', 'Perintah berhasil dijalankan');
    }

    public function drop(Item_image $item_image)
    {
        File::delete('assets/img/items/images/' . $item_image->NAME_ITEM_IMAGES);
        Item_image::destroy($item_image->ID_ITEM_IMAGES);
        return back()->with('status', 'Perintah berhasil dijalankan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('adminpanel.pages.item.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'NAME_ITEMS' => 'required|max:100',
            'PURCHASE_PRICE_ITEMS' => 'numeric|required',
            'SELLING_PRICE_ITEMS' => 'numeric|required',
            'WEIGHT_ITEMS' => 'numeric|required',
            'DESCRIPTION_ITEMS' => 'required'
        ]);

        if ($request->HEAD_PICTURE_ITEMS != "") {
            $validatedData = $request->validate([
                'HEAD_PICTURE_ITEMS' => 'mimes:jpeg,png,jpg'
            ]);
        }

        Item::where('ID_ITEMS', $item->ID_ITEMS)
            ->update([
                'NAME_ITEMS' => $request->NAME_ITEMS,
                'PURCHASE_PRICE_ITEMS' => $request->PURCHASE_PRICE_ITEMS,
                'SELLING_PRICE_ITEMS' => $request->SELLING_PRICE_ITEMS,
                'WEIGHT_ITEMS' => $request->WEIGHT_ITEMS,
                'DESCRIPTION_ITEMS' => $request->DESCRIPTION_ITEMS
            ]);

        if ($request->HEAD_PICTURE_ITEMS == "") {
            return redirect(url('adminpanel/items'))->with('status', 'Perintah berhasil dijalankan tanpa upload gambar');
        } else {

            $image = $request->file('HEAD_PICTURE_ITEMS');
            $filename = md5(Hash::make($item->ID_ITEMS) . md5(Hash::make(now()))) . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(550, 750);
            $image_resize->save(public_path('assets/img/items/' . $filename));

            File::delete('assets/img/items/' . $item->HEAD_PICTURE_ITEMS);

            Item::where('ID_ITEMS', $item->ID_ITEMS)
                ->update([
                    'HEAD_PICTURE_ITEMS' => $filename
                ]);

            return redirect(url('adminpanel/items'))->with('status', 'Perintah berhasil dijalankan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        File::delete('assets/img/items/' . $item->HEAD_PICTURE_ITEMS);
        Item::destroy($item->ID_ITEMS);
        return redirect(url('adminpanel/items'))->with('status', 'Perintah berhasil dijalankan');
    }
}
