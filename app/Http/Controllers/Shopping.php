<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductDetails;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Http;

class Shopping extends Controller
{

    public function ShowListItemsPhone(Request $request)
    {

        $data = DB::table('products')
            ->join('product_details', 'products.id', '=', 'product_details.productid')
            ->get();

        // we need loop because we use get()
        $tax = 0.15;
        $descount = 10;

        foreach ($data as $key => $row) {
            $data[$key]->total = ($data[$key]->price * $tax) + $data[$key]->price;
            $data[$key]->descount = $descount;
            $data[$key]->tax = $tax;
            $data[$key]->net = $data[$key]->total - $data[$key]->descount;
        }
        return view('shopping.list-items', ['data' => $data]);
    }

    public function ShowDetailsPhone($id)
    {
        $data = DB::table('products')
            ->join('product_details', 'products.id', '=', 'product_details.productid')
            ->where('product_details.id', '=', $id)
            ->first();
        //   if you use first  you dont need loop foreach below
        $tax = 0.15;
        $descount = 10;

        $data->total = ($data->price * $tax) + $data->price;
        $data->descount = $descount;
        $data->tax = $tax;
        $data->net = $data->total - $data->descount;


        return view('shopping.details', ['data' => $data]);
    }
    public function Add_to_cart(Request $request, $id)
    {

        $userid = $request->user()->id; //get current user id
        $data = DB::table('products')
            ->join('product_details', 'products.id', '=', 'product_details.productid')
            ->where('product_details.id', '=', $id)
            ->first();

        $tax = 0.15;
        $descount = 10;

        $data->total = ($data->price * $tax) + $data->price;
        $data->descount = $descount;
        $data->tax = $tax;
        $data->net = $data->total - $data->descount;

        $row = [
            'productid' => $data->id,
            'price' => $data->price,
            'qty' => $data->qty,
            'tax' => $data->tax,
            'total' => $data->total,
            'desc' => $data->descount,
            'net' => $data->net,
            'userid' => $userid,
        ];

        DB::table('carts')->insert($row);
        $count = DB::table('carts')->where('userid', '=', $userid)->count();
        Session::put('count', $count);

        return redirect()->back();
    }

    public function getCafeHot()
    {
        $response = HTTP::get('https://api.sampleapis.com/coffee/hot');
        $data = $response->object();


        return view('shopping.cafe', ['data' => $data]);
    }

    public function GetUsersAPI()
    {
        $apiURL = 'https://v1.baseball.api-sports.io/leagues';

        $headers = [
            'Content-Type' => 'application/json',
            'X-RapidAPI-Key' => '24c939c2ba293c859d5ecd476932d293'
        ];

        $response = Http::withHeaders($headers)->get($apiURL);
        $data = $response->json();

        return Response()->json($data);
    }
// join three tables
    public function cartview()
    {
        $productsdetails = DB::table('carts')
            ->join('product_details', 'carts.productid', '=', 'product_details.id')
            ->join('products', 'product_details.productid', '=', 'products.id')
            ->select('products.id as product_id', 'products.Productname', 'product_details.*', 'carts.*')
            ->get();
    
        return view('shopping.cart', ['productsdetails' => $productsdetails]);
    }
    
    public function DelCart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return Redirect('/shopping/cartview');
    }
}
