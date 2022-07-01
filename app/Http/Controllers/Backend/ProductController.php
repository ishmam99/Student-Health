<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\Size;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add()
    {
        $category = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('backend.product.add-product', compact('category', 'sizes', 'colors'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'        => 'required',
            'category_id' => 'required',
        ]);
        $product = $request->except('image', 'color_id', 'size_id');

        if ($request->size_id) $size = implode(",", $request->size_id);
        else $size = null;

        if ($request->color_id) $color = implode(",", $request->color_id);
        else $color = null;

        $product['size_id'] = $size;
        $product['color_id'] = $color;
        $product = Product::query()->create($product);
        $sl = 0;
        if ($request->hasFile('image')) {
            foreach ($request->file("image") as $img) {
                $imagePro = new ImageProduct;
                $image_name = time() . '_' . $request->name . '_' . $product->id . "_";
                $filename = $image_name . ++$sl . "." . $img->getClientOriginalExtension();
                $path = $img->storeAs('product/', $filename, 'public');
                $imagePro->image = $filename;
                $imagePro->product_id = $product->id;

                $imagePro->save();
            }
        }

        session()->flash('success', 'Product has store successfully');
        return redirect()->route('product.add');
    }


    public function view()
    {
        $products = Product::query()->orderBy('id', $this->defaultOrderBy)->paginate($this->itemPerPage);
        $this->putSL($products);
        return view('backend.product.view-product', compact('products'));
    }

    public function edit($id)
    {
        $product = Product::query()->findOrFail($id);
        $category = Category::all();

        $sel_sizes = explode(',', $product->size_id);
        $sel_colors = explode(',', $product->color_id);

        $sizes = Size::all();
        $colors = Color::all();

        return view(
            'backend.product.edit-product',
            compact('category', 'product', 'sel_sizes', 'sel_colors', 'sizes', 'colors')
        );
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'        => 'required',
            'category_id' => 'required',
        ]);

        $up_product = Product::find($id);
        $data = $request->except('image');
        $product = $request->except('image', 'color_id', 'size_id');
        if ($request->size_id) $size = implode(",", $request->size_id);
        else $size = null;
        if ($request->color_id) $color = implode(",", $request->color_id);
        else $color = null;
        $product['size_id'] = $size;
        $product['color_id'] = $color;
        $product = $up_product->update($product);
        $sl = 0;
        if ($request->hasFile('image')) {
            foreach ($request->file("image") as $img) {
                $imagePro = new ImageProduct;
                $image_name = time() . '_' . $request->name . '_' . $id . "_";
                $filename = $image_name . ++$sl . "." . $img->getClientOriginalExtension();

                $path = $img->storeAs('product/', $filename, 'public');
                $imagePro->image = $filename;
                $imagePro->product_id = $id;
                $imagePro->save();
            }
        }

        if ($request->pro_image_delete != NULL) {
            foreach ($request->pro_image_delete as $img_id) {
                $image_product = ImageProduct::find($img_id);

                if(\File::exists('storage/product/' . $image_product->image)){
                    \File::delete('storage/product/' . $image_product->image);
                }
                $image_product->delete();
            }
        }

        session()->flash('success', 'Product has Update successfully');
        return redirect()->route('product.view');
    }

    public function size_color()
    {
        $sizes = Size::all();
        $colors = Color::all();
        return view('backend.product.view-size-color', compact('sizes', 'colors'));
    }
}
