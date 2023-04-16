<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        return response()->json([
            'data' => ProductResource::collection(Product::with('category')->get()),
        ]);
    }
}
