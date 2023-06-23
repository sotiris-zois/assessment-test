<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Throwable;

class ProductController extends Controller
{
    public function index(){
        try{
            $products = Product::with(['category','tags'])->get();

            $response =  redirect('/')->with([
                'success' => true,
                'message' => 'Products fetched',
                'new_product' => null,
                'products' => compact('products')
            ]);
        }
        catch(Throwable $error){

            $response =  redirect('/')->with([
                'success' => false,
                'new_product' => null,
                'message' => $error->getMessage() .'<BR>'. print_r($error->getTrace(),true),
                'products' => []
            ]);
        }
        finally{
            return $response;
        }
    }

    public function store(ProductUpdateRequest $request)
    {
        try{
            $data = $request->validated();

            $product = Product::find($data['id']);

            $product->update($data);

            return redirect('/')->with([
                'success' => true,
                'message' => 'Product updated',
                'new_product' => $product,
                'products' => []
            ]);
        }

        catch(Throwable $error){
            return redirect('/')->with([
                'success' => false,
                'message' => $error->getMessage() .'<BR>'. print_r($error->getTrace(),true),
                'products' => []
            ]);
        }
    }

}
