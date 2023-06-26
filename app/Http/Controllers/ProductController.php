<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Throwable;
use Illuminate\Http\Request;
use App\Models\Category;
use WebSocket\Client as WebSocketClient;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use ValidatesRequests;

    protected $socket;

    public function __construct()
    {
        $this->socket = new WebSocketClient('ws://localhost:3000');
    }
    public function listPage(Request $request)
    {


        $categories = Category::orderBy('updated_at', 'desc')->get();

        return view('welcome')->with([
            'categories' => $categories,
        ]);
    }

    public function index(Request $request)
    {
        try {

            $categoryId = $request->get('category_id');

            if (!is_null($categoryId)) {
                $products = Product::withIndices([
                    'category_id_index'
                ])->with(['category', 'tags'])->where('category_id', '=', $categoryId)->paginate(10);
            } else {
                $products = Product::withIndices([
                    'category_id_index'
                ])->with(['category', 'tags'])->paginate(10);
            }

            $response =   response()->json([
                'message' => 'Products fetched successful',
                'data' => $products,
                'success' => true
            ]);
        } catch (Throwable $error) {

            $response =  response()->json([
                'success' => false,
                'message' => $error->getMessage(),
                'data' => $error->getTrace()
            ]);
        } finally {
            return $response;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::with(['category', 'tags'])->findOrFail($id);

            $categories = Category::orderBy('title', 'asc')->get();

            $response = view('updateForm')->with([
                'product' => $product,
                'categories' => $categories,
                'productTags' => json_encode(array_column($product->tags->toArray(), 'id'))
            ]);
        } catch (Throwable $error) {
            $response =  response()->json([
                'success' => false,
                'message' => $error->getMessage(),
                'data' => $error->getTrace()
            ]);
        } finally {
            return $response;
        }
    }

    public function store(ProductUpdateRequest $request)
    {
        try {
            $data = $request->all();

            $this->validate($request, $request->rules());

            $product = Product::with(['category', 'tags'])->find($data['id']);

            $product->update($data);

            $product->tags()->sync($data['tags']);


            $payload = json_encode(['type' => 'product-updated', 'data' => $product]);

            $this->socket->send($payload);

            $response = response()->json([
                'success' => true,
                'message' => 'Product updated',
                'data' => [$product]
            ]);
        } catch (Throwable $error) {
            $response =  response()->json([
                'success' => false,
                'message' => $error->getMessage(),
                'data' => $error->getTrace()
            ]);
        } finally {
            return  $response;
        }
    }
}
