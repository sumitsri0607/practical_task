<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('product.index', ['products' => $products])->with('no', 1);
    }

    public function create()
    {
        return view('product.add');
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'product_name' => 'required',
            'description' => 'required',
        ]);
        
        $product = new Product;
        
        $product->user_id = Auth()->id();
        
        $product->product_name = $request->input('product_name');
        $product->description = $request->input('description');
        $product->save();
        // dd($request->all());
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $extension = $image->extension();
             if($extension=='jpg' || $extension=='png'){
                 $image_path = $image->storeAs('public/product/images', time().'.'.$extension);
             }
         $product->image =  time().'.'.$extension;
         $product->save();
         return redirect()->route('product.list')->with('message','Product added successfully');
        }
         

    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('product.view', ['product' => $product]);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            // 'description' => 'required',
        ]);
        
        $product = Product::find($id);

            Product::where('id', $id)
                    ->update([
                        'product_name' => $request->input('product_name'),
                        'description' => $request->input('description')
            ]);
            if($request->hasFile('image')){
                $image = $request->file('image');
                $extension = $image->extension();
                 if($extension=='jpg' || $extension=='png'){
                     $image_path = $image->storeAs('public/product/images', time().'.'.$extension);
                 }
                 Product::where('id', $id)
                 ->update([
                     'image' => time().'.'.$extension,
                     ]);
            return redirect()->route('product.list')->with('message','Product updated successfully');
            }
            return redirect()->route('product.list')->with('message','Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if(!empty($product)){
            $product->delete();
            return redirect()->route('product.list')->with('message','Product deleted successfully');
        }else{
            return redirect()->route('product.list')->with('message','Invalid request');
        }
    }
}
