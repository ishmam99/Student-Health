@extends('layouts.fixed')

@section('title', 'Add-Product')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">View Product</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Product</li>
            <li class="breadcrumb-item active">View</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            Product List
          </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered" id="product_tbl">
            <thead>
              <tr>
                <th>SL</th>
                <th>Code</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Category</th>
                <th>Image</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
                <tr>
                  <td>{{ $product->sl }}</td>
                  <td>{{ $product->sell_code != null ? $product->sell_code : '' }}</td>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->quantity - $product->stock_out }}</td>
                  <td>{{ $product->price }}</td>
                  <td>{{ $product->category->name }}</td>
                  <td>
                    @foreach ($product->images as $image)
                      <img src="{{ asset('storage/product/' . $image->image) }}" alt="no img" height="50px" width="50px">
                    @endforeach
                  </td>
                  <td>{!! substr(strip_tags($product->description), 0, 30) !!}</td>
                  <td>
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{ $products->links() }}
        </div>
      </div>
    </div>
  </section>
@endsection
