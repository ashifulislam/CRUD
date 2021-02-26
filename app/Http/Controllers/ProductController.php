<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.view_products',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('products.add_product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'price'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);
        $product_details = new Product();
        $product_details->title = $request->input('title');
        $product_details->description = $request->input('description');
        $product_details->price = $request->input('price');

      //check the image file is clicked or not
        if($request->has('image'))
        {
        $image = $request->file('image');
        //get the image extension here
        $re_image = time(). '.'.$image->extension();
        $destination = public_path('images');
        $image->move($destination,$re_image);
        $product_details->Image = $re_image;

        }
        else
            {
            return redirect('products/create')->with('choose_file','Please choose the image file');
        }
        $product_details->save();
        return redirect('products')
            ->with('Success','products are added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::find($id);
        return view('products.edit_products')
           ->with('products',$products);

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

        //check the image file is clicked or not
        if($request->has('image'))
        {
            $image = $request->file('image');
            //get the image extension here
            $re_image = time(). '.'.$image->extension();
            $destination = public_path('images');
            $image->move($destination,$re_image);
            //getting value from the requests
            $title = $request->input('title');
            $description = $request->input('description');
            $price = $request->input('price');

            Product::where('id',$id)->update(array('Title'=>$title,'Description'=>$description,'Price'=>$price,'Image'=>$re_image));
            return redirect('products')->with('Update','Products are updated successfully');

        }
        else
        {
            return redirect('products/create')->with('choose_file','Please choose the image file');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $products = Product::find($id);

        $image_path = "images/".$products->Image;

        if (file_exists($image_path)) {

            @unlink($image_path);

        }
        $products->delete();
        return redirect('products')
            ->with('Delete','Products are successfully deleted');
    }
}
