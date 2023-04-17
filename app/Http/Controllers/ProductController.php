<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        $sku = (array) $request->query('sku');
        $name = (array) $request->query('name');
        $priceStart = (int) $request->query('price_start');
        $priceEnd = (int) $request->query('price_end');
        $stockStart = (int) $request->query('stock_start');
        $stockEnd = (int) $request->query('stock_end');
        $categoryId = (array) $request->query('category_id');
        $categoryName = (array) $request->query('category_name');

        $query = Product::with('category');
        if (count($sku)) {
            $query = $query->whereIn('sku', $sku);
        }

        if ($priceStart) {
            $query = $query->where('price', '>=', $priceStart);
        }

        if ($priceEnd) {
            $query = $query->where('price', '<=', $priceEnd);
        }

        if ($stockStart) {
            $query = $query->where('stock', '>=', $stockStart);
        }

        if ($stockEnd) {
            $query = $query->where('stock', '<=', $stockEnd);
        }

        if (count($categoryId)) {
            $query = $query->whereIn('category_id', $categoryId);
        }

        $pageSize = 10;
        $products = $query->paginate($pageSize);

        return response()->json(new ProductCollection($products));
    }
}
