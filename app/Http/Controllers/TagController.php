<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Throwable;

class TagController extends Controller
{
    public function index(){
        try{
            $tags = Tag::orderBy('title','asc')->get();
            $response = [
                'data' => $tags,
                'success' => true,
                'message' => 'All tags loaded',
            ];
        }
        catch(Throwable $error){
            $response = [
                'data' => $error->getTrace(),
                'success' => false,
                'message' => $error->getMessage(),
            ];
        }
        finally{
            return response()->json($response);
        }
    }
}
