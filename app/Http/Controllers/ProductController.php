<?php

namespace App\Http\Controllers;


// use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use Illuminate\View\View;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;



class ProductController extends Controller
{
    private $userId;
    // public function __construct()
    // {
    //     $this->userId = auth()->id();
        
    // }
    public function products(){
        $products = DB::table('products')->get();
       
        return view('products.myproducts',['allproducts' => $products]);
    }

    // Create Product (insert product details in db) 
    public function store(Request $req){
        // $userId =  auth()->id();
        $userId = auth()->id();
        
        $validatedData = $req->validate([
            'prod_name' => 'required',
            'prod_qty' => 'required | integer',
            'prod_price' => 'required | integer',
            'prod_desc' => 'required',
        ],[
            'prod_name.required' => 'Name field is required.',
            'prod_qty.required' => 'Quantity field is required.',
            'prod_qty.integer' => 'Quantity field must be an integer',
            'prod_price.integer' => 'Price field must be an integer',
            'prod_price.required' => 'Price field is required and must be an integer',
            'prod_desc.required' => 'Description field is required.',
        ]); 
        try{
            $product = DB::table('products')->insert([
                'pname' => $validatedData['prod_name'],
                'pqty' => $validatedData['prod_qty'],
                'pprice' => $validatedData['prod_price'],
                'pdescription' => $validatedData['prod_desc'],
                'created_at' =>  now(),
                'updated_at' =>  now(),
                'userid' =>  $userId,
                

            ]);
             if($product){
                return redirect()->route('product.myproducts')->with('success','Created');
                // return redirect()->route('product.create')->with('success', 'Data inserted successfully!');
            }else{
                return redirect()->back()->withInput()->withErrors(['error' => 'Something Wrong.']);
            }        
        } catch (\Exception $e){
            return redirect()->back()->withInput()->withErrors(['error' => 'Something went wrong. Please try again.']);
        }
    }

    // Getdata in update form 
    public function updatepage(string $id){
        $product = DB::table('products')->find($id);
        return view('products.updateproduct',['product' => $product]);
    }

    // update product
    public function update(Request $req, $id){
        $userId = auth()->id();
        $validatedData = $req->validate([
            'prod_name' => 'required',
            'prod_qty' => 'required | numeric',
            'prod_price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'prod_desc' => 'required',
        ],[
            'prod_name.required' => 'Name field is required.',
            'prod_qty.required' => 'Quantity field is required and must be an integer',
            'prod_qty.numeric' => 'Quantity field must be an integer',
            'prod_price.numeric' => 'Price field must be an integer',
            'prod_price.required' => 'price field is required',
            'prod_desc.required' => 'description field is required.',
        ]); 
        try{
            $product = DB::table('products')
            ->where('id',$id)
            ->where('userid', $userId)
            ->update([
                'pname' =>  $validatedData['prod_name'],
                'pqty' =>  $validatedData['prod_qty'],
                'pprice' =>  $validatedData['prod_price'],
                'pdescription' =>  $validatedData['prod_desc'],
                'updated_at' =>  now(),
                'userid' =>  $userId,

            ]);
            return redirect()->route('product.myproducts')->with('success','Updated');

        }catch(\Exception $e){
            return redirect()->back()->withInput()->withErrors(['error' => 'Something went wrong. Please try again.']);
        }
    }

    // delete Product 
    public function delete(Request $req, $id){

        $this->userId = auth()->id();
        $product = DB::table('products')
        ->where('id',$id)
        ->where('userid',$userId)
        ->delete();
        if($product){
            return redirect()->route('product.myproducts');
        }
    }
}
