<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        return view('products.index',['products'=>Product::latest()->paginate(5)]);
    }
    public function create(){
        return view('products.create');
    }
    public function store(Request $request){
        //dd($request->all());
        //upload image
        //Validate data
        $request->validate([
            'name'=>'required',
            'details'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png,gif|max:1000'
         ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'),$imageName);
        //dd($imageName);
        $product = new product;
        $product->image = $imageName;
        $product->name = $request->name;
        $product->details = $request->details;
        $product->save();
        return back()->withSuccess('Product Created !!');
    }
    public function edit($id){
        //dd($id);
        $product=Product::where('id',$id)->first();
        return view('products.edit',['product'=>$product]);
    }
    Public function update(Request $request,$id){
        //dd($request->all());
          //Validate data
        $request->validate([
            'name'=>'required',
            'details'=>'required',
            'image'=>'nullable|mimes:jpeg,jpg,png,gif|max:1000'
         ]);
         $product = Product::where('id',$id)->first();
         if(isset($request->image)){
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'),$imageName);
         $product->image = $imageName;
         }
        //dd($imageName);
       // $product = new product;
        //$product->image = $imageName;
        $product->name = $request->name;
        $product->details = $request->details;
        $product->save();
        return back()->withSuccess('Product Updated !!');
    
    }
    public function destroy($id){
        $product = Product::where('id',$id)->first();
        $product->delete();
          return back()->withSuccess('Product Deleted !!');
    }
     public function show($id){
        $product = Product::where('id',$id)->first();
        return view ('products.show',['product'=>$product]);
    }

}
