<div>

    <div class="row mb-2">
        <div class="col-12 text-right">
            <a href="{{route('home')}}" class="btn btn-default">
                <i class="fa fa-home mr-1"></i>
                HOME
            </a>
            <a href="{{route('order.index')}}" class="btn btn-info">
                <i class="fa fa-list mr-1"></i>
                ORDER LIST
            </a>
        </div>
    </div>

    @if($show_summary == 1)

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">ORDER SUMMARY</h3>
            </div>
            <div class="card-body">

                <div class="row">

                    <!-- HEADER -->
                    <div class="col-12">
                        <ul class="list-group">
                            <li class="list-group-item py-2 text-lg">
                                <strong>BA NAME</strong>
                                <span class="float-right">{{$order->user->name}}</span>
                            </li>
                            <li class="list-group-item py-2 text-lg">
                                <strong>CUSTOMER NAME</strong>
                                <span class="float-right">{{$order->customer_name}}</span>
                            </li>
                            <li class="list-group-item py-2 text-lg">
                                <strong>ADDRESS</strong>
                                <span class="float-right">{{$order->address}}</span>
                            </li>
                            <li class="list-group-item py-2 text-lg">
                                <strong>ORDER DATE</strong>
                                <span class="float-right">{{$order->order_date}}</span>
                            </li>
                        </ul>
                    </div>

                    <!-- DETAILS -->
                    <div class="col-12 mt-2">
                        <ul class="list-group">
                            @foreach($order->details as $detail)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-lg-2 product-img">
                                            <img src="{{asset($product_images_arr[$detail->product->stock_code])}}" alt="">
                                        </div>
                                        <div class="col-lg-10 mt-2">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <strong>DESCRIPTION:</strong> {{$detail->product->description}}
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>PRICE:</strong> PHP {{$detail->product->price}}
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>QUANTITY:</strong> {{number_format($detail->quantity)}}
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>AMOUNT:</strong> {{number_format($detail->amount, 2)}}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- TOTAL -->
                    <div class="col-12 mt-2">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>TOTAL AMOUNT:</strong> {{number_format($order->total, 2)}}
                            </li>
                            <li class="list-group-item">
                                <strong>PAYMENT TYPE:</strong> {{$order->payment_type}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary" wire:click.prevent="submitOrder">
                    <i class="fa fa-save"></i>
                    SUBMIT ORDER
                </button>
            </div>
        </div>

    @elseif($show_summary == 2)

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">ORDER NUMBER</h4>
            </div>
            <div class="card-body text-center align-middle">

                <div class="row mb-2">
                    <div class="col-12">
                        <strong class="text-xl">ORDER NUMBER: </strong>
                        <br>
                        <strong class="text-xl badge badge-success">{{$order->order_number}}</strong>
                    </div>
                </div>

                <hr>

                <div class="row text-lg">
                    <!-- HEADER -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-lg text-info font-weight-bold">ORDER HEADER</h3>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group">
                                    <li class="list-group-item py-2">
                                        <strong class="float-left">BA NAME</strong>
                                        <span class="float-right">{{$order->user->name}}</span>
                                    </li>
                                    <li class="list-group-item py-2">
                                        <strong class="float-left">CUSTOMER NAME</strong>
                                        <span class="float-right">{{$order->customer_name}}</span>
                                    </li>
                                    <li class="list-group-item py-2">
                                        <strong class="float-left">ADDRESS</strong>
                                        <span class="float-right">{{$order->address}}</span>
                                    </li>
                                    <li class="list-group-item py-2">
                                        <strong class="float-left">ORDER DATE</strong>
                                        <span class="float-right">{{$order->order_date}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- DETAILS -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-lg text-info font-weight-bold">ORDER DETAILS</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>DESCRIPTION</th>
                                            <th>PRICE</th>
                                            <th>QUANTITY</th>
                                            <th>AMOUNT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->details as $detail)
                                            <tr>
                                                <td class="align-middle">
                                                    <img src="{{asset($product_images_arr[$detail->product->stock_code])}}" alt="{{$detail->product->stock_code}}" class="summary-img">
                                                </td>
                                                <td class="align-middle">{{$detail->product->description}}</td>
                                                <td class="align-middle">{{number_format($detail->product->price, 2)}}</td>
                                                <td class="align-middle">{{number_format($detail->quantity, 2)}}</td>
                                                <td class="align-middle">{{number_format($detail->amount, 2)}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- SUMMARY -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-lg text-info font-weight-bold">ORDER SUMMARY</h3>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong class="float-left">TOTAL AMOUNT:</strong> 
                                        <span class="float-right">{{number_format($order->total, 2)}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <strong class="float-left">PAYMENT TYPE:</strong> 
                                            </div>
                                            <div class="col-lg-6">
                                                @foreach($order->order_payment_types as $order_payment_type)
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <span>{{$order_payment_type->payment_type->type}}</span>
                                                        </div>
                                                        <div class="col-2">
                                                            <span class="float-right">{{number_format($order_payment_type->amount, 2)}}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                               
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer text-right">
                <button class="btn btn-lg btn-info" wire:click.prevent="newOrder">
                    <i class="fa fa-plus mr-1"></i>
                    NEW ORDER
                </button>
            </div>
        </div>

    @else

        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-xl font-weight-bold text-info">ORDER HEADER</h3>
            </div>
            <div class="card-body">
            
                <form class="form-horizontal" wire:submit.prevent="saveOrder">
                    <div class="form-group row mb-2">
                        <label for="ba_name" class="col-sm-3 col-form-label text-lg">BA NAME</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-lg" placeholder="BA Name" readonly wire:model="ba_name" id="ba_name">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="customer_name" class="col-sm-3 col-form-label text-lg">CUSTOMER NAME</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-lg{{$errors->has('customer_name') ? ' is-invalid' : ''}}" placeholder="Customer Name" wire:model="customer_name" id="customer_name">
                            <small class="text-danger">{{$errors->first('customer_name')}}</small>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="address" class="col-sm-3 col-form-label text-lg">ADDRESS</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-lg{{$errors->has('address') ? ' is-invalid' : ''}}" placeholder="Address" wire:model="address" id="address">
                            <small class="text-danger">{{$errors->first('address')}}</small>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="order_date" class="col-sm-3 col-form-label text-lg">ORDER DATE</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-lg" placeholder="BA Name" readonly wire:model="order_date" id="order_date">
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-xl font-weight-bold text-info">ORDER DETAILS</h3>
            </div>
            <div class="card-body">

                <div class="row">
                    @foreach($products as $product)
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="text-xl">
                                        {{$product->description}}
                                    </strong>
                                    <br>
                                    <strong class="text-lg badge badge-success">
                                        PHP {{$product->price}}
                                    </strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-3 text-center border py-2 product-img">
                                            <img src="{{asset($product_images_arr[$product->stock_code])}}" alt="{{$product->stock_code}}" class="">
                                        </div>

                                        <div class="col-sm-12 col-lg-9 p-3">
                                            <div class="form-group row mb-2">
                                                <label for="quantity{{$product->id}}" class="col-sm-3 col-form-label text-lg">QUANTITY</label>
                                                <div class="col-sm-9">
                                                    @php
                                                        $qtyModel = "details.{$product->id}.quantity";
                                                        $amountModel = "details.{$product->id}.amount";
                                                    @endphp
                                                    <input type="number" class="form-control form-control-lg" placeholder="Quantity" wire:model.live="{{$qtyModel}}" id="quantity{{$product->id}}">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="customer_name" class="col-sm-3 col-form-label text-lg">AMOUNT</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-lg bg-white" placeholder="Amount" readonly wire:model="details.{{$product->id}}.amount">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-xl font-weight-bold text-info">ORDER SUMMARY</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-6 mb-2">
                        <strong class="text-lg">SUMMARY</strong>
                        <ul class="list-group">
                            <li class="list-group-item align-middle">
                                <strong class="text-lg">TOTAL AMOUNT</strong>
                                <span class="float-right text-lg font-weight-bold">
                                    {{number_format($total_amount, 2)}}
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-6">
                        <strong class="text-lg">PAYMENT TYPE</strong>
                        @if($errors->has('payment_type'))
                            <span class="badge badge-danger">REQUIRED</span>
                        @endif
                        <ul class="list-group">
                            @foreach($payment_types as $payment_type)
                                <li class="list-group-item border my-1 {{isset($payment_type_arr[$payment_type->id]) ? 'type-selected' : ''}}" wire:click.prevent="selectPaymentType({{$payment_type->id}})">
                                    @if(isset($payment_type_arr[$payment_type->id]) && count($payment_type_arr) > 1)
                                        <div class="row">
                                            <div class="col-6">
                                                <strong class="text-lg">{{$payment_type->type}}</strong>
                                            </div>
                                            <div class="col-6">
                                                <input type="number" class="form-control form-control-sm border-0 border-bottom" wire:model.live="payment_type_arr.{{$payment_type->id}}" onclick="event.stopPropagation();">
                                            </div>
                                        </div>
                                    @else
                                        <strong class="text-lg">{{$payment_type->type}}</strong>
                                    @endif
                                    
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary btn-lg" wire:click.prevent="saveOrder">
                    <i class="fa fa-save mr-1"></i>
                    SUBMIT
                </button>
            </div>
        </div>

    @endif
</div>
