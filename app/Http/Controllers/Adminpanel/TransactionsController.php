<?php

namespace App\Http\Controllers\Adminpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transaction;


class TransactionsController extends Controller
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
    public function index($fill = '')
    {
        if ($fill != '') {
            if ($fill == "Waiting for confirmation") {
                $where = array(
                    'STATUS_TRANSACTIONS' => 'Waiting for confirmation'
                );
            } else if ($fill == "Confirmed and is being packed") {
                $where = array(
                    'STATUS_TRANSACTIONS' => 'Confirmed and is being packed'
                );
            } else if ($fill == "Item Shipped") {
                $where = array(
                    'STATUS_TRANSACTIONS' => 'Item Shipped'
                );
            } else if ($fill == "Orders accepted") {
                $where = array(
                    'STATUS_TRANSACTIONS' => 'Orders accepted'
                );
            } else {
                return redirect(url('adminpanel/transactions'));
            }
            $transactions = Transaction::where('STATUS_TRANSACTIONS', '!=', 'Resend proof of payment')->where('STATUS_TRANSACTIONS', '!=', 'Not yet paid')->where($where)->get();
        } else {
            $transactions = Transaction::where('STATUS_TRANSACTIONS', '!=', 'Resend proof of payment')->where('STATUS_TRANSACTIONS', '!=', 'Not yet paid')->get();
        }
        return view('adminpanel.pages.transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('adminpanel.pages.transaction.show', compact('transaction'));
    }

    public function save(Request $request, Transaction $transaction)
    {
        $validatedData = $request->validate([
            'kode' => 'required'
        ]);

        if (md5(crypt($transaction->CODE_TRANSACTIONS, $transaction->created_at)) != $request->kode) {
            return back()->with('status', 'Kode tidak berhasil diverifikasi');
        }

        $where = array(
            'ID_TRANSACTIONS' => $transaction->ID_TRANSACTIONS,
            'CODE_TRANSACTIONS' => $transaction->CODE_TRANSACTIONS
        );

        if ($transaction->STATUS_TRANSACTIONS == "Waiting for confirmation") {
            $validatedData = $request->validate([
                'confirm' => 'required'
            ]);

            if ($request->confirm == '1') {
                Transaction::where($where)
                    ->update([
                        'ID_USERS' => Auth::user()->id,
                        'STATUS_TRANSACTIONS' => 'Confirmed and is being packed'
                    ]);
                return redirect(url('adminpanel/transactions'))->with('status', 'Perintah berhasil dijalankan');
            } else if ($request->confirm == '0') {
                Transaction::where($where)
                    ->update([
                        'ID_USERS' => Auth::user()->id,
                        'STATUS_TRANSACTIONS' => 'Resend proof of payment'
                    ]);
                return redirect(url('adminpanel/transactions'))->with('status', 'Perintah berhasil dijalankan');
            } else {
                return back()->with('status', 'Argumen tidak valid');
            }
        } else if ($transaction->STATUS_TRANSACTIONS == "Confirmed and is being packed" || $transaction->STATUS_TRANSACTIONS == "Item Shipped") {
            $validatedData = $request->validate([
                'resi' => 'required'
            ]);

            Transaction::where($where)
                ->update([
                    'RECEIPT_CODE_TRANSACTIONS' => $request->resi,
                    'STATUS_TRANSACTIONS' => 'Item Shipped'
                ]);
            return redirect(url('adminpanel/transactions'))->with('status', 'Perintah berhasil dijalankan');
        } else {
            return back()->with('status', 'Argumen tidak valid');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
