<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\transactions;
use App\Models\transaction_details_temp;
use App\Models\transaction_details;

use Carbon\carbon;

use Hash;
use Auth;
use File;

class TransactionsController extends Controller
{
    public function daftar(){
        $transactions = transactions::orderBy('created_at','desc')->get();
        return view('admin.pages.transactions.daftar',['transactions' => $transactions]);
    }
    public function add(){
        $transaction_details_temp = transaction_details_temp::orderBy('created_at','desc')->get();
        return view('admin.pages.transactions.add',['transaction_details_temp'=>$transaction_details_temp]);
    }
    public function savetemporaryitems(Request $request){
        $validated=$request->validate([
            'item'=>'required',
            'quantity'=>'required',
        ]);
        $no_transaction=$request->input('no_transaction');
        $item=$request->input('item');
        $quantity=$request->input('quantity');
        transaction_details_temp::create([
            'no_transaction'=>$no_transaction,
            'item'=>$item,
            'quantity'=>$quantity,
        ]);
        return redirect()->back();
    }
    public function save(Request $request){
        $validated=$request->validate([
            'no_transaction'=>'required',
            'transaction_date'=>'required',
        ]);
        $no_transaction=$request->input('no_transaction');
        $transaction_date=$request->input('transaction_date');
        $newtransaction=transactions::create([
            'no_transaction'=>$no_transaction,
            'transaction_date'=>$transaction_date,
        ]);
        return redirect()->route('admin.transactions.view', ['id' => $newtransaction->id])->with('added','Transaksi telah ditambahkan');
    }
    public function view($id, Request $req){
        return 'u/c';
    }
    public function update($id, Request $request){
        $transactions = transactions::findOrFail($id);
        $transactions->no_transaction = $request->input('no_transaction');
        $transactions->transaction_date = $request->input('transaction_date');
        $transactions->save();
        return redirect()->back()->with('updated','Transaksi telah diupdate');
    }
    public function delete($id){
        $transactions = transactions::find($id);
        $transactions->delete();
        return redirect()->back()->with('deleted','Kategori telah dihapus');
    }
}
