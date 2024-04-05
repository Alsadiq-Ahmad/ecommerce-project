<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductDetails;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;
use App\Models\User;

use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Redirect;

class Dashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/logout');
    }

    public function Index(Request $request)
    {
        Cookie::queue('A', 'here my cookies', 60);
        $user = $request->User()->email;

        session::put('data', 'welcome to twaiq');

        // count user, products and display them in dashboard
        $countusers = DB::table('users')->count();
        Session::put('countusers', $countusers); 
    
        $countproducts = DB::table('products')->count();
        Session::put('countproducts', $countproducts); 

        $countinvoice = DB::table('invoices')->count();
        Session::put('countinvoice', $countinvoice);
        return view('dashboard.index');
    }
    //old GetProducts method 
    // public function GetProducts()
    // {
    //     $products = Product::all();
    //     return view('dashboard.products', ['products' => $products]);
    // }

    // both search and get all products in one method
    public function GetProducts(Request $request)
{
    // Check if search query is provided
    if ($request->has('name')) {
        $product = Product::where('Productname', 'like', '%' . $request->name . '%')->get();
    } else {
        // If no search query is provided, get all products
        $product = Product::all();
    }
    
    return view('dashboard.products', ['products' => $product]);
}



    public function createproducts(Request $request)
    {
          $validate =  $request->validate([
            'ProductName' => 'required|string|min:3', // Validation rule to ensure ProductName is provided and is a string
        ]);


        $product = new Product();
        $product->ProductName = $request->ProductName;
        $product->save();

        // Redirect the user to the products page
        return Redirect('/dashboard/products');
    }

    public function Del($id)
    {
        $products = Product::find($id);
        $products->delete();
        return Redirect('/dashboard/products');
    }


    public function DelDetails($id)
    {
        $Productdetails = ProductDetails::find($id);
        $Productdetails->delete();
        return Redirect('/dashboard/getproductdetails');
    }



    public function Edit($id)
    {

        $products = Product::find($id);

        return view('dashboard.edit', ['products' => $products]);
    }
    public function EditDetails($id)
    {

        $Productdetails = ProductDetails::find($id);

        return view('dashboard.editdetails', ['Productdetails' => $Productdetails]);
    }
    public function UpdateDetails(Request $request)
    {
        $Productdetails = ProductDetails::where('id', $request->id)->Update([

            'color' => $request->color,
            'price' => $request->price,
            'description' => $request->description,
            'images' => $request->images,



        ]);


        return Redirect('/dashboard/getproductdetails');
    }
    public function Update(Request $request)
    {
        $products = Product::where('id', $request->id)->Update([

            'productname' => $request->productname,



        ]);


        return Redirect('/dashboard/products');
    }
    // Normal search
    // public function Search(Request $request){
    //     $product=Product::where('Productname',$request->name)->get();
    //     return view('dashboard.products', ['products' => $product]);

    // }
    // Normal search(contain)

  
    public function Search(Request $request)
    {
        $product = Product::where('Productname', 'like', '%' . $request->name . '%')->get();
        return view('dashboard.products', ['products' => $product]);
    }
    public function SearchProductDetails(Request $request)
    {
        // Fetch all products
        $products = Product::all();

        // Join products table with product_details table
        $productsdetails = Product::where('Productname', 'like', '%' . $request->name . '%')
            ->join('product_details', 'products.id', '=', 'product_details.productid')
            ->select('products.*', 'product_details.*')
            ->get();


        // Pass the results to the view with the correct variable names
        return view('dashboard.productdetails', ['products' => $products, 'productsdetails' => $productsdetails]);
    }


    public function test()
    {
        // there two ways in DB 
        // $data=DB::table('products')->get(); first way
        // $data=DB::table('products')->where('productnmae','iphone')->get(); first way use where

        // $data=DB::select('select *from products'); //second way

        $data = DB::table('products')
            ->join('product_details', 'products.id', '=', 'product_details.productid')
            ->get();

        return Response()->json($data);
    }

    public function GetProductsDetails()
    {

        $products = Product::all();

        $productsdetails = DB::table('products')
            ->join('product_details', 'products.id', '=', 'product_details.productid')
            // ->select('products.id','products.Productname','product_details.color','product_details.price','product_details.qty','product_details.description')
            ->get();
        return view('dashboard.productdetails', ['productsdetails' => $productsdetails, 'products' => $products]);
    }
    public function createproductDetails(Request $request)
    {

        $validate =  $request->validate([
            'color' => 'required|string|max:20', 
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'description' => 'required|string|max:200',
        ]);

        $productsdetails = ProductDetails::create([

            'color' => $request->color,
            'price' => $request->price,
            'qty' => $request->qty,
            'description' => $request->description,
            'productid' => $request->products,

        ]);

        $productsdetails->save();

        return Redirect('/dashboard/getproductdetails');
    }

    
    
}
