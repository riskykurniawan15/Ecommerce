<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Transaction;
use File;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer');

    }

    public function index($fill = '')
    {

        if ($fill != '') {
            if ($fill == "Not yet paid") {
                $where = array(
                    'STATUS_TRANSACTIONS' => 'Not yet paid'
                );
            } else if ($fill == "Resend proof of payment") {
                $where = array(
                    'STATUS_TRANSACTIONS' => 'Resend proof of payment'
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
                return redirect(url('transaction'));
            }

            $transactions = Transaction::where('ID_CUSTOMERS', '=', Auth::guard('customer')->user()->id)->where($where)->get();
        } else {
            $transactions = Transaction::where('ID_CUSTOMERS', '=', Auth::guard('customer')->user()->id)->get();
        }
        return view('home.pages.transaction.index', compact('transactions'));
    }

    public function detail(Transaction $transaction, $code)
    {
        if ($transaction->CODE_TRANSACTIONS != $code) {
            return redirect(url('transaction'))->with('status', 'Failed executed');
        }

        if ($transaction->ID_CUSTOMERS != Auth::guard('customer')->user()->id) {
            return redirect(url('transaction'))->with('status', 'Failed executed');
        }

        return view('home.pages.transaction.detail', compact('transaction'));
    }

    public function save(Request $request, Transaction $transaction, $code)
    {
        if ($transaction->CODE_TRANSACTIONS != $code) {
            return back()->with('status', 'Failed executed');
        }

        if ($transaction->ID_CUSTOMERS != Auth::guard('customer')->user()->id) {
            return redirect(url('transaction'))->with('status', 'Failed executed');
        }

        $validatedData = $request->validate([
            'kode' => 'required'
        ]);

        if (md5(crypt($transaction->CODE_TRANSACTIONS, $transaction->created_at)) != $request->kode) {
            return back()->with('status', 'Kode tidak berhasil diverifikasi');
        }

        if ($transaction->STATUS_TRANSACTIONS == 'Not yet paid' || $transaction->STATUS_TRANSACTIONS == 'Resend proof of payment') {
            $validatedData = $request->validate([
                'UPLOAD_FILE' => 'mimes:jpeg,png,jpg'
            ]);

            $file = $request->file('UPLOAD_FILE');

            $namafile = md5(crypt($file->getClientOriginalName(), Hash::make(now())) . $transaction->CODE_TRANSACTIONS) . '.' . $file->getClientOriginalExtension();
            
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'assets/img/payment/';

            if ($transaction->STATUS_TRANSACTIONS == 'Not yet paid') {
                $where = array(
                    'ID_TRANSACTIONS' => $transaction->ID_TRANSACTIONS,
                    'ID_CUSTOMERS' => $transaction->ID_CUSTOMERS,
                    'STATUS_TRANSACTIONS' => 'Not yet paid'
                );
            } else if ($transaction->STATUS_TRANSACTIONS == 'Resend proof of payment') {
                File::delete('assets/img/payment/' . $transaction->PROOF_OF_PAYMENT_TRANSACTIONS);

                $where = array(
                    'ID_TRANSACTIONS' => $transaction->ID_TRANSACTIONS,
                    'ID_CUSTOMERS' => $transaction->ID_CUSTOMERS,
                    'STATUS_TRANSACTIONS' => 'Resend proof of payment'
                );
            }

            // upload file
            $file->move($tujuan_upload, $namafile);

            Transaction::where($where)
                ->update([
                    'PROOF_OF_PAYMENT_TRANSACTIONS' => $namafile,
                    'STATUS_TRANSACTIONS' => 'Waiting for confirmation',
                ]);

            return redirect(url('transaction'))->with('status', 'Proof of payment uploaded successfully');
        } else if ($transaction->STATUS_TRANSACTIONS == 'Item Shipped') {
            $validatedData = $request->validate([
                'orders' => 'required'
            ]);

            $where = array(
                'ID_TRANSACTIONS' => $transaction->ID_TRANSACTIONS,
                'ID_CUSTOMERS' => $transaction->ID_CUSTOMERS,
                'STATUS_TRANSACTIONS' => 'Item Shipped'
            );

            Transaction::where($where)
                ->update([
                    'STATUS_TRANSACTIONS' => 'Orders accepted'
                ]);
            return redirect(url('transaction'))->with('status', 'Orders is accepted');
        } else {
            return redirect(url('transaction'))->with('status', 'Failed executed');
        }

    }
}
