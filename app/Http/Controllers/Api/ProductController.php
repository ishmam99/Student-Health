<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;

class ProductController extends Controller
{
    public function view($id)
    {
        $product = Product::with('images', 'category')->findOrFail($id);

        $images = [];
        $sizes = [];
        $colors = [];

        if (count($product->images) > 0) {
            foreach ($product->images as $img) {
                $images[] = asset('storage/product/' . $img->image);
            }
        }

        $psizes = explode(',', $product->size_id);

        if (count($psizes) > 0) {
            foreach ($psizes as $size) {
                $sizes[] = Size::find($size)->name ?? '';
            }
        }

        $pcolors = explode(',', $product->color_id);
        if (count($pcolors) > 0) {
            foreach ($pcolors as $color) {
                $colors[] = Color::find($color)->name ?? '';
            }
        }

        $product = [
            "id"          => $product->id,
            "title"       => $product->name,
            "code"        => $product->sell_code,
            "category"    => $product->category->name,
            "price"       => $product->price,
            "stock"       => $product->quantity - $product->stock_out,
            "sizes"       => $sizes,
            "colors"      => $colors,
            "unit"        => $product->unit,
            "image"       => $images,
            "description" => $product->description,
        ];

        return $this->apiResponse(200, 'Single product show.', ['data' => $product]);
    }

}
