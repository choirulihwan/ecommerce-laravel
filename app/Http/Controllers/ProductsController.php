<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('products.index', [
                'products' => Product::all(),                
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('products.form', [
            'is_edit'   => false,
            'title'     => 'Create',
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required', 
            'image' => 'required', 
            'price' => 'required', 
            'description' => 'required',
        ]);

        $product = new Product;
        $product_image = $request->image;
        $image_new_name = time().$product_image->getClientOriginalName();
        $product_image->move('uploads/products', $image_new_name);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = str_replace('.', '', $request->price);
        $product->image = 'uploads/products/'.$image_new_name;

        $product->save();
        Session::flash('success', 'Product created');
        return redirect()->route('products.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('products.form', [
            'is_edit'   => true,
            'title'     => 'Update',
            'product' => Product::find($id),
            'categories' => Category::all()       
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'name' => 'required', 
            'price' => 'required', 
            'description' => 'required',
        ]);

        $product = Product::find($id);
        if($request->hasFile('image')){
            $product_image = $request->image;    
            $image_new_name = time().$product_image->getClientOriginalName();
            $product_image->move('uploads/products', $image_new_name);
            $product->image = 'uploads/products/'.$image_new_name;
            $product->save();
        }
               

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = str_replace('.', '', $request->price);
        $product->category_id = $request->category;
        

        $product->save();
        Session::flash('success', 'Product updated');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);
        if(file_exists($product->image)){
            unlink($product->image);
        }
        $product->delete();
        Session::flash('success', 'Product deleted');
        return redirect()->route('products.index');   
    }
}
