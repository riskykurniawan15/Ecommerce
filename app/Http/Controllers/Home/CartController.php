<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;

class CartController extends Controller
{
    public function index()
    {
        return view('home.pages.cart.index');
    }

    public function updatecart(Request $request)
    {
        $cart = session()->get('cart');
        foreach ($request->id as $value) {
            if (isset($cart[$value])) {
                $cart[$value]['QUANTITY_ITEM_DETAIL_TRANSACTIONS'] = $request->quant[$value];
                session()->put('cart', $cart);
            } else {
                return redirect()->back()->with('status', 'Product failed to update your cart!');
            }
            echo $request->quant[$value];
        }
        return redirect()->back()->with('status', 'Product update to cart successfully!');
    }

    public function formaddcart(Request $request, $id)
    {
        $validatedData = $request->validate([
            'jml' => 'required|min:1'
        ]);

        return $this->addcart($id, $request->jml[$id]);
    }

    public function addcart($id, $count = 0)
    {
        if ($count != 0) {
            $jml = $count;
        } else {
            $jml = 1;
        }

        $product = Item::find($id);

        if (!$product) {

            return redirect('/')->back()->with('error', 'Product failed added to cart!');

        }

        $cart = session()->get('cart');
 
        // if cart is empty then this the first product
        if (!$cart) {

            $cart = [
                $id => [
                    "ID_ITEMS" => $product->ID_ITEMS,
                    "CODE_ITEMS" => $product->CODE_ITEMS,
                    "NAME_ITEMS" => $product->NAME_ITEMS,
                    "PRICE_ITEMS_TRANSACTIONS" => $product->SELLING_PRICE_ITEMS,
                    "QUANTITY_ITEM_DETAIL_TRANSACTIONS" => $jml,
                    "HEAD_PICTURE_ITEMS" => $product->HEAD_PICTURE_ITEMS,
                    "WEIGHT_ITEMS" => $product->WEIGHT_ITEMS,
                    "DESCRIPTION_ITEMS" => $product->DESCRIPTION_ITEMS
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('status', 'Product added to cart successfully!');
        }
 
        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {

            $cart[$id]['QUANTITY_ITEM_DETAIL_TRANSACTIONS'] += $jml;

            session()->put('cart', $cart);

            return redirect()->back()->with('status', 'Product added to cart successfully!');

        }
 
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "ID_ITEMS" => $product->ID_ITEMS,
            "CODE_ITEMS" => $product->CODE_ITEMS,
            "NAME_ITEMS" => $product->NAME_ITEMS,
            "PRICE_ITEMS_TRANSACTIONS" => $product->SELLING_PRICE_ITEMS,
            "QUANTITY_ITEM_DETAIL_TRANSACTIONS" => $jml,
            "HEAD_PICTURE_ITEMS" => $product->HEAD_PICTURE_ITEMS,
            "WEIGHT_ITEMS" => $product->WEIGHT_ITEMS,
            "DESCRIPTION_ITEMS" => $product->DESCRIPTION_ITEMS
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('status', 'Product added to cart successfully!');
    }

    public function dropcart(Request $request)
    {
        if ($request->id) {

            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('status', 'Product removed successfully');
        }
    }

    public function weight()
    {
        $WEIGHT_ITEMS = 0;
        foreach (session('cart') as $id => $datacart) {
            $WEIGHT_ITEMS += $datacart['WEIGHT_ITEMS'] * $datacart['QUANTITY_ITEM_DETAIL_TRANSACTIONS'];
        }
        return $WEIGHT_ITEMS;
    }
}
