<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-6">
                    <span class="badge badge-{{$status_arr[$order->status]}} text-lg text-uppercase">{{$order->status}}</span>
                </div>
                <div class="col-lg-6 mt-1 text-right">
                    <a href="{{route('order.index')}}" class="btn btn-default btn-sm">
                        <i class="fa fa-list mr-1"></i>
                        ORDER LIST
                    </a>

                    @if($order->status == 'draft')
                        <button class="btn btn-primary btn-sm" wire:click.prevent="updateOrderStatus('submitted')">
                            <i class="fa fa-save mr-1"></i>
                            SUBMIT
                        </button>
                    @endif

                    @can('order cancel')
                        @if($order->status == 'draft' || $order->status == 'submitted')
                            <button class="btn btn-danger btn-sm" wire:click.prevent="updateOrderStatus('cancelled')">
                                <i class="fa fa-ban mr-1"></i>
                                CANCEL
                            </button>
                        @endif
                    @endcan

                    @can('order re-order')
                        <button class="btn btn-info btn-sm" wire:click.prevent="reOrder">
                            <i class="fa fa-recycle mr-1"></i>
                            RE-ORDER
                        </button>
                    @endcan

                    @can('order complete')
                        @if($order->status == 'submitted')
                            <button class="btn btn-primary btn-sm" wire:click.prevent="updateOrderStatus('payment received')">
                                <i class="fa fa-check mr-1"></i>
                                PAYMENT RECEIVED
                            </button>
                        @endif
                    @endcan

                    @can('order release')
                        @if($order->status == 'payment received')
                            <button class="btn btn-success btn-sm" wire:click.prevent="updateOrderStatus('released')">
                                <i class="fa fa-check mr-1"></i>
                                RELEASED
                            </button>
                        @endif
                    @endcan
                </div>
            </div>
            
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ORDER HEADER</h3>
                </div>
                <div class="card-body px-2 py-4">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>ORDER NUMBER: </strong> <span class="badge badge-success float-right text-lg">{{$order->order_number}}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>BA NAME: </strong> <span class="float-right">{{$order->user->name}}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>CUSTOMER NAME: </strong> <span class="float-right">{{$order->customer_name}}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>ADDRESS: </strong> <span class="float-right">{{$order->address}}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>ORDER DATE: </strong> <span class="float-right">{{$order->order_date}}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ORDER SUMMARY</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>TOTAL AMOUNT:</strong> <span class="float-right">{{number_format($order->total, 2)}}</span>
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

        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ORDER DETAILS</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
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
                                    <td class="text-center align-middle">
                                        <img src="{{asset($product_images_arr[$detail->product->stock_code])}}" alt="{{$detail->product->stock_code}}" class="product-img-sm">
                                    </td>
                                    <td class="align-middle text-left">{{$detail->product->description}}</td>
                                    <td class="text-right align-middle">{{number_format($detail->product->price, 2)}}</td>
                                    <td class="text-right align-middle">{{number_format($detail->quantity)}}</td>
                                    <td class="text-right align-middle">{{number_format($detail->amount, 2)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            @can('order history')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ORDER HISTORY</h3>
                    </div>
                    <div class="card-body">

                        <div class="timeline timeline-inverse">

                            @foreach($approvals as $date => $data)
                                {{-- DATE LABEL --}}
                                <div class="time-label">
                                    <span class="bg-primary text-uppercase">
                                        {{date('M j Y', strtotime($date))}}
                                    </span>
                                </div>
            
                                @foreach($data as $approval)
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-user bg-{{$status_arr[$approval->status]}}"></i>
            
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> {{$approval->created_at->diffForHumans()}}</span>
            
                                            <h3 class="timeline-header {{!empty($approval->remarks) ? '' : 'border-0'}}">
                                                <a href="#">{{$approval->user->name}}</a> <span class="mx-2 badge bg-{{$status_arr[$approval->status]}}">{{$approval->status}}</span> the order
                                            </h3>
            
                                            @if(!empty($approval->remarks))
                                                <div class="timeline-body">
                                                    <label class="mb-0">REMARKS:</label>
                                                    <pre class="mb-0 ml-2">{{$approval->remarks ? preg_replace('/[^\S\n]+/', ' ', $approval->remarks) : '-'}}</pre>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
            
                            @endforeach
            
                            <div>
                                <i class="far fa-clock bg-gray"></i>
                            </div>
                        </div>
            
                        <div class="row mt-2">
                            <div class="col-12">
                                {{$approval_dates->links()}}
                            </div>
                        </div>

                    </div>
                </div>
            @endcan
        </div>
    </div>
</div>
