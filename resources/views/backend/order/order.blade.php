@extends('layouts.fixed')

@section('title','Order')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{$type}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Order</li>
            <li class="breadcrumb-item active">{{$type}}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <!-- /.row -->
      <!-- Main row -->
      <div class="card col elevation-2">
        <div class="row">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
        <div class="row p-3">
          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
            <table class="table table-bordered " id="CategoryTable">
              <thead>
                <tr>
                  <th>SL</th>
                  <th>Order NO</th>
                  <th>User Name</th>
                  <th>Items</th>
                  <th>Products</th>
                  <th>Total Price</th>
                  <th>Cash Amount</th>
                  <th>TBC</th>
                  <th>Action</th>

                </tr>
              </thead>
              <tbody>
                @php $i=0 @endphp

                @foreach($orders as $order)
                  <tr>
                    <td>{{ $loop->iteration + $orders->firstItem() - 1 }}</td>
                    <td>{{ $order->order_no}}</td>
                    <td>{{ $order->user->name}}</td>
                    <td>{{ $order->item}}</td>
                    <td>
                      @foreach($order->orderProduct as $idx => $product)
                        {{$idx+1}}. ({{$product->product->sell_code}}) {{$product->product->name}} [
                        <span class="text-success">Qty- {{$product->qty}}</span>]<br>
                      @endforeach
                    </td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->cash_amount }}</td>
                    <td>{{ $order->tbc_amount}}</td>

                    <td class="d-flex">
                      <a data-toggle="modal"
                         data-target="#order{{$order->id}}"
                         class="btn ">
                        <i class="fa fa-eye"></i>
                      </a>
                      <a href="{{route('order.shipping',$order->id)}}"
                         class="btn" title="Shipping Order">
                        <i class="fa fa-car"></i>
                      </a>
                      <a href="{{route('order.delivered',$order->id)}}"
                         class="btn" title="Delivered Order">
                        <i class="fa fa-check-circle"></i>
                      </a>
                      <a href="{{route('order.cancel',$order->id)}}"
                         class="btn eraser" title="Cancel Order">
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>

                  <!-- The Modal -->
                  <div class="modal" id="order{{$order->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content modal-lg">
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Order Details</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;
                          </button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                          <div class="col-12">
                            <p>
                              Order Date: {{date("d-m-Y h:i A",strtotime($order->shipping->crated_at))}}
                            </p>
                            <p>
                              Cash TXR ID: {{$order->txr_id}}
                            </p>

                            <p>
                              Mobile: {{$order->shipping->mobile}}
                            </p>
                            <p>
                              Division: {{$order->shipping->division}}
                            </p>
                            <p>
                              District: {{$order->shipping->district}}
                            </p>
                            <p>
                              Thana: {{$order->shipping->thana}}
                            </p>
                            <p>
                              Address: {{$order->shipping->address}}
                            </p>

                            {{--                                                            <table class="table table-bordered">--}}
                            {{--                                                                <tr>--}}
                            {{--                                                                    <th>Customer's Name</th>--}}
                            {{--                                                                    <td>{{$order->user->name}}</td>--}}
                            {{--                                                                </tr>--}}
                            {{--                                                                <tr>--}}
                            {{--                                                                    <th>Customer's Mobile</th>--}}
                            {{--                                                                    <td>{{$order->user->mobile}}</td>--}}
                            {{--                                                                </tr>--}}
                            {{--                                                                <tr>--}}
                            {{--                                                                    <th>Product Details</th>--}}
                            {{--                                                                    <td>--}}
                            {{--                                                                        <table>--}}
                            {{--                                                                            <tr>--}}
                            {{--                                                                                <th>SL</th>--}}
                            {{--                                                                                <th>Product Code</th>--}}
                            {{--                                                                                <th>Product Name</th>--}}
                            {{--                                                                                <th>Qty</th>--}}
                            {{--                                                                                <th>Price</th>--}}
                            {{--                                                                            </tr>--}}
                            {{--                                                                            @foreach($order->orderProduct as $idx => $product)--}}
                            {{--                                                                                <tr>--}}
                            {{--                                                                                    <td>{{$idx+1}}</td>--}}
                            {{--                                                                                    <td>{{$product->product->sell_code}}</td>--}}
                            {{--                                                                                    <td>{{$product->product->name}}</td>--}}
                            {{--                                                                                    <td>{{$product->qty}}</td>--}}
                            {{--                                                                                    <td>{{$product->product->price}}</td>--}}
                            {{--                                                                                </tr>--}}
                            {{--                                                                            @endforeach--}}
                            {{--                                                                        </table>--}}
                            {{--                                                                    </td>--}}
                            {{--                                                                </tr>--}}
                            {{--                                                            </table>--}}
                          </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Close
                          </button>
                        </div>

                      </div>
                    </div>
                  </div>

                @endforeach

              </tbody>
            </table>
            <div class="text-end">{{ $orders->links() }}</div> 
          </div>

        </div>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->


  </section>
  <!-- /.content -->
@stop
