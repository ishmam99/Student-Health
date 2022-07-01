<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::all();
        return $this->apiResponseResourceCollection(200, 'all categories', CategoryResource::collection($categories));
    }

    public function categoryWiseProduct(Category $category): JsonResponse
    {
        $products = $category->products()->with('category', 'images')->paginate(10);
        return $this->apiResponseResourceCollection(200, 'Category Wise Product.', ProductResource::collection($products));
    }
}
