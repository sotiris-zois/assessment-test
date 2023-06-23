<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Throwable;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;

class ProductController extends Controller
{
    use ValidatesRequests;

    public function listPage(Request $request){


        $categories = Category::orderBy('updated_at','desc')->get();

        return view('welcome')->with([
            'categories' => $categories
        ]);
    }

    public function index(Request $request){
        try{

            $categoryId = $request->get('category_id');

            if(!is_null($categoryId)){
                $products = Product::withIndices([
                    'category_id_index'
                ])->with(['category','tags'])->where('category_id','=',$categoryId)->paginate($request->get('per_page',10));
             }
            else{
                $products = Product::withIndices([
                    'category_id_index'
                ])->with(['category','tags'])->paginate($request->get('per_page',10));
            }

            $response =   response()->json([
                'message' => 'Products fetched successful',
                'data' => $products,
                'success' => true
            ]);
        }
        catch(Throwable $error){

            $response =  response()->json([
                'success' => false,
                'message' => $error->getMessage() .'<BR>'. print_r($error->getTrace(),true),
                'data' => []
            ]);
        }
        finally{
            return $response;
        }
    }

    public function update(Request $request){
        try{

            $this->validate($request,[
                'id' => 'required|exists:products,id'
            ]);

            $product = Product::with(['category','tags'])->findOrFail($request->get('id'));
            $categories = Category::all();
            $tags = Tag::all();
            $response = view('updateForm')->with([
                'product' => $product,
                'categories' => $categories,
                'tags' => $tags
            ]);
        }
        catch(Throwable $error){
            dd($error);
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

            $response = response()->json([
                'success' => true,
                'message' => 'Product updated',
                'products' => [$product]
            ]);
        }

        catch(Throwable $error){
            $response = response()->json([
                'success' => false,
                'message' => $error->getMessage() .'<BR>'. print_r($error->getTrace(),true),
                'products' => []
            ]);
        }
        finally{
            return  $response;
        }
    }

}
