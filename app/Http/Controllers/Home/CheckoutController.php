<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Item;
use App\Transaction;
use App\Detail_transaction;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer');

    }

    public function index()
    {
        $cart = session()->get('cart');
        if (empty($cart)) {
            return redirect('/')->with('error', 'Your cart is empty');
        }

        $data = app('App\Http\Controllers\Home\RajaOngkirController')->provinsi();
        $provinsi = $data['results'];
        return view('home.pages.checkout.index', compact('provinsi'));
    }

    public function city(Request $request)
    {
        $city = app('App\Http\Controllers\Home\RajaOngkirController')->city($request->province);
        foreach ($city['results'] as $data) {
            echo "<option data-value=" . $data['city_id'] . ">" . $data['type'] . " " . $data['city_name'] . "</option>";
        }
    }

    public function cost(Request $request)
    {
        $destination = $request->destination;
        $weight = app('App\Http\Controllers\Home\CartController')->weight();
        $idnya = 0;
        $harga = 0;
        $cost = app('App\Http\Controllers\Home\RajaOngkirController')->cost($destination, $weight, 'jne');
        $value = "";
        foreach ($cost['results'][0]['costs'] as $data) {
            $idnya++;
            if (isset($_GET['id'])) {
                if ($idnya == $_GET['id']) {
                    $harga = $data['cost'][0]['value'];
                    $value .= $cost['results'][0]['name'] . ' ' . $data['service'] . ' Rp. ' . $data['cost'][0]['value'] . ' [' . $data['cost'][0]['etd'] . ']';
                    return $this->shippingcost($harga, $value, $request->couriername);
                    return 0;
                }
            } else {
                $value .= '<option data-name="jne" data-service="' . $data['service'] . '" data-value="' . $idnya . '">' . $cost['results'][0]['name'] . ' ' . $data['service'] . ' Rp. ' . number_format($data['cost'][0]['value'], 0, ',', '.') . ' [' . $data['cost'][0]['etd'] . ']</option>';
            }
        }

        $cost = app('App\Http\Controllers\Home\RajaOngkirController')->cost($destination, $weight, 'pos');
        foreach ($cost['results'][0]['costs'] as $data) {
            $idnya++;
            if (isset($_GET['id'])) {
                if ($idnya == $_GET['id']) {
                    $harga = $data['cost'][0]['value'];
                    $value .= $cost['results'][0]['name'] . ' ' . $data['service'] . ' Rp. ' . $data['cost'][0]['value'] . ' [' . $data['cost'][0]['etd'] . ']';
                    return $this->shippingcost($harga, $value, $request->couriername);
                    return 0;
                }
            } else {
                // $value .= '<option data-value="' . $idnya . '">' . $cost['results'][0]['name'] . ' ' . $data['service'] . ' Rp. ' . $data['cost'][0]['value'] . ' [' . $data['cost'][0]['etd'] . ']</option>';
                $value .= '<option data-name="pos" data-service="' . $data['service'] . '" data-value="' . $idnya . '">' . $cost['results'][0]['name'] . ' ' . $data['service'] . ' Rp. ' . number_format($data['cost'][0]['value'], 0, ',', '.') . ' [' . $data['cost'][0]['etd'] . ']</option>';
            }
        }

        $cost = app('App\Http\Controllers\Home\RajaOngkirController')->cost($destination, $weight, 'tiki');
        foreach ($cost['results'][0]['costs'] as $data) {
            $idnya++;
            if (isset($_GET['id'])) {
                if ($idnya == $_GET['id']) {
                    $harga = $data['cost'][0]['value'];
                    $value .= $cost['results'][0]['name'] . ' ' . $data['service'] . ' Rp. ' . $data['cost'][0]['value'] . ' [' . $data['cost'][0]['etd'] . ']';
                    return $this->shippingcost($harga, $value, $request->couriername);
                    return 0;
                }
            } else {
                $value .= '<option data-name="tiki" data-service="' . $data['service'] . '" data-value="' . $idnya . '">' . $cost['results'][0]['name'] . ' ' . $data['service'] . ' Rp. ' . number_format($data['cost'][0]['value'], 0, ',', '.') . ' [' . $data['cost'][0]['etd'] . ']</option>';
            }
        }

        if (!isset($_GET['id'])) {
            echo $value;
        }
    }

    public function shippingcost($harga = 0, $value = '', $name = '')
    {
        $total = 0;
        foreach (session('cart') as $id => $datacart) {
            $total += $datacart['PRICE_ITEMS_TRANSACTIONS'] * $datacart['QUANTITY_ITEM_DETAIL_TRANSACTIONS'];
        }
        echo '{"harga":"Rp. ' . number_format($harga, 0, ',', '.') . '",
               "total":"Rp. ' . number_format($total, 0, ',', '.') . '",
               "subtotal":"Rp. ' . number_format($total + $harga, 0, ',', '.') . '"}
        ';
    }

    public function CODE_TRANSACTIONS()
    {
        $primary = "CODE_TRANSACTIONS";
        $prefix = "TRS";
        $q = DB::table('transactions')->select(DB::raw('MAX(RIGHT(' . $primary . ',4)) as kd_max'));
        $prx = $prefix . now()->format('Ym');
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = $prx . sprintf("%04s", $tmp);
            }
        } else {
            $kd = $prx . "0001";
        }

        return $kd;
    }

    public function proceed(Request $request)
    {
        $cart = session()->get('cart');
        if (empty($cart)) {
            return redirect('/')->with('error', 'Your cart is empty');
        }

        $validatedData = $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'provinsiSelect' => 'required',
            'provinsi' => 'required|numeric',
            'countytownSelect' => 'required',
            'countytown' => 'required|numeric',
            'sub' => 'required',
            'post' => 'required|numeric',
            'address' => 'required',
            'courierSelect' => 'required',
            'courier' => 'required|numeric',
            'namecourier' => 'required',
            'servicecourier' => 'required'
        ]);

        $city = app('App\Http\Controllers\Home\RajaOngkirController')->city($request->provinsi, $request->countytown);
        if ($request->provinsiSelect != $city['results']['province']) {
            return back()->with('error', 'Command failed to run');
        }

        if ($request->countytownSelect != $city['results']['type'] . ' ' . $city['results']['city_name']) {
            return back()->with('error', 'Command failed to run');
        }

        $weight = app('App\Http\Controllers\Home\CartController')->weight();
        $cost = app('App\Http\Controllers\Home\RajaOngkirController')->cost($request->countytown, $weight, $request->namecourier);
        $harga = 0;
        $value = "";
        foreach ($cost['results'][0]['costs'] as $data) {
            if ($data['service'] == $request->servicecourier) {
                $value .= $cost['results'][0]['name'] . ' ' . $data['service'] . ' Rp. ' . number_format($data['cost'][0]['value'], 0, ',', '.') . ' [' . $data['cost'][0]['etd'] . ']';
                if ($value != $request->courierSelect) {
                    return back()->with('error', 'Command failed to run');
                }
                $harga += $data['cost'][0]['value'];
                $value = $cost['results'][0]['name'] . ' ' . $data['service'];
                break;
            }
        }

        if ($value == "" || $harga == 0) {
            return back()->with('error', 'Command failed to run');
        }

        $CODE_TRANSACTIONS = $this->CODE_TRANSACTIONS();
        $SHIPPING_ADDRESS_TRANSACTIONS = $request->address . '
Kec. ' . $request->sub . ' Kode Pos. ' . $request->post . '
' . $request->countytownSelect . ' Prov. ' . $request->provinsiSelect;
        Transaction::create([
            'ID_CUSTOMERS' => Auth::guard('customer')->user()->id,
            'ID_USERS' => null,
            'CODE_TRANSACTIONS' => $CODE_TRANSACTIONS,
            'RECIPIENT_TRANSACTIONS' => $request->name,
            'CONTACT_RECIPIENT_TRANSACTIONS' => $request->contact,
            'SHIPPING_ADDRESS_TRANSACTIONS' => $SHIPPING_ADDRESS_TRANSACTIONS,
            'SHIPPING_COSTS_TRANSACTIONS' => $harga,
            'COURIER_TRANSACTIONS' => $value,
            'PROOF_OF_PAYMENT_TRANSACTIONS' => '',
            'STATUS_TRANSACTIONS' => 'Not yet paid',
            'RECEIPT_CODE_TRANSACTIONS' => ''
        ]);

        $where = array(
            'ID_CUSTOMERS' => Auth::guard('customer')->user()->id,
            'CODE_TRANSACTIONS' => $CODE_TRANSACTIONS
        );
        $ID_TRANSACTIONS = Transaction::where($where)->pluck('ID_TRANSACTIONS')->first();

        foreach (session('cart') as $id => $datacart) {
            $rows = Item::where('ID_ITEMS', $datacart['ID_ITEMS'])->get();
            foreach ($rows as $data) {
                Detail_transaction::create([
                    'ID_TRANSACTIONS' => $ID_TRANSACTIONS,
                    'ID_ITEMS' => $data->ID_ITEMS,
                    'PRICE_ITEMS_TRANSACTIONS' => $data->SELLING_PRICE_ITEMS,
                    'QUANTITY_ITEM_DETAIL_TRANSACTIONS' => $datacart['QUANTITY_ITEM_DETAIL_TRANSACTIONS']
                ]);
            }
        }
        $request->session()->forget('cart');
        return redirect(url('transaction'))->with('status', 'Transaction successfully executed');
    }
}
