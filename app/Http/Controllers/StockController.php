<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StockController extends Controller
{
    public function add(Request $request)
    {
        $stock = new Stock();
        $stock->stokAdeti = $request->stokAdeti;
        $stock->uuid = Str::uuid()->toString();
        $stock->silindiMi = 1;


        $stock->save();
        return redirect()->route('stock')
            ->with('message','Stok  başarıyla eklendi.');
    }
    public function delete($id){
        $stock=Stock::find($id);
        $stock->silindiMi = 0;
        $stock->save();
        return redirect()->route('stock')
            ->with('message','Stok Silindi.');
    }

    public function index()
    {
        //return view("proje.stock");
        $data['stock'] = Stock::all()->where("silindiMi", 1);
        /*
        foreach (stock::all() as $stock) {
            echo $stock->ad;
        }*/
        return view("proje.stock" , $data);
    }
    public function edit($id){

        $stock=Stock::find($id);
        $data['stock'] = $stock;
        return view("proje.update" , $data);
    }
    public function save(Request $request){
        $stock=Stock::find($request->id);
        $stock->stokAdeti = $request->stokAdeti;
        $stock->save();

        return redirect()->route('stock')
            ->with('message',$request->stokAdeti .' adlı ürün Güncellendi.');

    }
    public function update(Request $request){
    }
}
