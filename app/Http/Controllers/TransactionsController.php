<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\transactions;
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
        return view('admin.pages.transactions.add');
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

    public function view($id){
        $transactions=transactions::findOrFail($id);
        $transaction_details = transaction_details::orderBy('created_at','desc')->where('transaction_id',$id)->get();
        return view('admin.pages.transactions.view',['transactions'=>$transactions,'transaction_details'=>$transaction_details]);
    }

    public function edit($id){
        $transactions=transactions::findOrFail($id);
        return view('admin.pages.transactions.edit',['transactions'=>$transactions]);
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

    //items
    public function saveitem($id, Request $request){
        $validated=$request->validate([
            'item'=>'required',
            'quantity'=>'required',
        ]);
        $transaction_id=$id;
        $item=$request->input('item');
        $quantity=$request->input('quantity');
        transaction_details::create([
            'transaction_id'=>$transaction_id,
            'item'=>$item,
            'quantity'=>$quantity,
        ]);
        return redirect()->back();
    }
    public function updateitem($id, Request $request){
        $transaction_details=transaction_details::findOrFail($id);
        $transaction_details->item = $request->input('item');
        $transaction_details->quantity = $request->input('quantity');
        $transaction_details->save();
        return redirect()->back()->with('updated','Transaksi telah diupdate');
    }
    public function deleteitem($id){
        $transaction_details = transaction_details::find($id);
        $transaction_details->delete();
        return redirect()->back()->with('deleted','Item telah dihapus');
    }
}
