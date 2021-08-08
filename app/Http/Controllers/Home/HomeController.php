<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;


class HomeController extends Controller
{
    public function index()
    {
        if (isset($_GET['o'])) {
            $order = $_GET['o'];
        } else {
            $order = "ascending";
        }

        if ($order == "ascending") {
            $items = Item::orderBy('NAME_ITEMS', 'asc');
        } else if ($order == "descending") {
            $items = Item::orderBy('NAME_ITEMS', 'desc');
        } else if ($order == "expensive") {
            $items = Item::orderBy('PURCHASE_PRICE_ITEMS', 'desc');
        } else if ($order == "cheap") {
            $items = Item::orderBy('PURCHASE_PRICE_ITEMS', 'asc');
        } else if ($order == "newest") {
            $items = Item::orderBy('created_at', 'asc');
        } else if ($order == "longest") {
            $items = Item::orderBy('created_at', 'desc');
        } else if ($order == "heaviest") {
            $items = Item::orderBy('WEIGHT_ITEMS', 'desc');
        } else if ($order == "lightest") {
            $items = Item::orderBy('WEIGHT_ITEMS', 'asc');
        } else {
            return redirect(url('/'));
        }

        if (isset($_GET['s'])) {
            $s = $_GET['s'];
            $items = $items->where('NAME_ITEMS', 'like', '%' . $s . '%');
        } else {

        }

        $items = $items->get();
        return view('home.pages.home.index', compact('items'));
    }

}
