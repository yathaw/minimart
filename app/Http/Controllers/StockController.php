<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;
use App\Product;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;


class StockController extends Controller
{
    // instock
        public function instock_create($id)
        {
            $product = Product::find($id);
            return view('backend.stock.instock_new',compact('product'));

        }

        public function instock_store(Request $request)
        {
            $product = $request->productid;
            $stockqty = $request->stock;
            $stockdate = $request->edate;
            $status = 'Instock';

            $auth=Auth::user();
            $userid=$auth->id;

            $shopid = $auth->shop->id;

            $stock= new Stock;
            $stock->qty=$stockqty;
            $stock->stockdate=$stockdate;
            $stock->status=$status;
            $stock->product_id=$product;
            $stock->user_id=$userid;
            $stock->shop_id=$shopid; 
            $stock->save();

            return redirect()->route('product.index')->with("successMsg",'Add Stock');

        }

        public function instock_edit($id)
        {
            $stock = Stock::find($id);

            // dd($stock->product->codeno);
            return view('backend.stock.instock_edit',compact('stock'));
        }

        public function instock_update(Request $request, $id)
        {
            $product = $request->productid;
            $stockqty = $request->stock;
            $stockdate = $request->edate;
            $status = 'Instock';

            $auth=Auth::user();
            $userid=$auth->id;

            $shopid = $auth->shop->id;

            $stock= Stock::find($id);
            $stock->qty=$stockqty;
            $stock->stockdate=$stockdate;
            $stock->status=$status;
            $stock->product_id=$product;
            $stock->user_id=$userid;
            $stock->shop_id=$shopid; 
            $stock->save();

            return redirect()->route('product.index')->with("successMsg",'Add Stock');
        }
    // ------------------------------------------------------------------------

    // Debit
        public function debit_list()
        {
            $now = Carbon::now();
            $month = $now->month;
            $date = $now->toDateString();

            $leftoverProducts=Stock::where('status','Leftover')
                        ->where('stockdate',$date)
                        ->get();
            return view('backend.stock.debit_list',compact('leftoverProducts'));
        }

        public function debit_create()
        {
            $products = Product::all();

            return view('backend.stock.debit_new',compact('products'));

        }

        public function debit_store(Request $request)
        {
            $product = $request->productid;
            $stockqty = $request->stock;
            $stockdate = $request->edate;
            $status = 'Leftover';

            $auth=Auth::user();
            $userid=$auth->id;

            $shopid = $auth->shop->id;

            $stock= new Stock;
            $stock->qty=$stockqty;
            $stock->stockdate=$stockdate;
            $stock->status=$status;
            $stock->product_id=$product;
            $stock->user_id=$userid;
            $stock->shop_id=$shopid; 
            $stock->save();

            return redirect()->route('debit.index')->with("successMsg",'Add Stock');
        }

        public function debit_destroy($id)
        {
            $stock=Stock::find($id);
            $stock->delete();
            
            return redirect()->route('debit.index')->with('successMsg','Existing Product is DELETED in your data');
        }
    // ------------------------------------------------------------------------

    // Return
        public function return_list()
        {
            $now = Carbon::now();
            $month = $now->month;
            $date = $now->toDateString();

            $returnProducts=Stock::where('status','Outofstock')
                        ->where('stockdate',$date)
                        ->get();
            return view('backend.stock.return_list',compact('returnProducts'));
        }

        public function return_create()
        {
            $products = Product::all();

            return view('backend.stock.return_new',compact('products'));

        }

        public function return_store(Request $request)
        {
            $product = $request->productid;
            $stockqty = $request->stock;
            $stockdate = $request->edate;
            $status = 'Outofstock';

            $auth=Auth::user();
            $userid=$auth->id;

            $shopid = $auth->shop->id;

            $stock= new Stock;
            $stock->qty=$stockqty;
            $stock->stockdate=$stockdate;
            $stock->status=$status;
            $stock->product_id=$product;
            $stock->user_id=$userid;
            $stock->shop_id=$shopid; 
            $stock->save();

            return redirect()->route('return.index')->with("successMsg",'Add Stock');
        }

        public function return_destroy($id)
        {
            $stock=Stock::find($id);
            $stock->delete();
            
            return redirect()->route('return.index')->with('successMsg','Existing Product is DELETED in your data');
        }
    // ------------------------------------------------------------------------
}
