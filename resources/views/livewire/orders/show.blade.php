<div>
    <div class="card">
        <div class="card-header">
            <span class="badge badge-{{$status_arr[$order->status]}} text-lg">{{$order->status}}</span>
            <div class="card-tools">
                <a href="{{route('order.index')}}" class="btn btn-default">
                    <i class="fa fa-list mr-1"></i>
                    ORDER LIST
                </a>

                @if($order->status == 'draft')
                    <button class="btn btn-primary" wire:click.prevent="submitOrder">
                        <i class="fa fa-save mr-1"></i>
                        SUBMIT
                    </button>
                @endif

                @can('order cancel')
                    @if($order->status == 'draft' || $order->status == 'submitted')
                        <button class="btn btn-danger" wire:click.prevent="cancelOrder">
                            <i class="fa fa-ban mr-1"></i>
                            CANCEL
                        </button>
                    @endif
                @endcan

                @can('order re-order')
                    <button class="btn btn-info" wire:click.prevent="reOrder">
                        <i class="fa fa-recycle mr-1"></i>
                        RE-ORDER
                    </button>
                @endcan
                
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
                            <strong>PAYMENT TYPE:</strong> <span class="float-right">{{$order->payment_type}}</span>
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
                <div class="card-footer text-right">
                    @if($order->status == 'submitted')
                        <button class="btn btn-success" wire:click.prevent="completeOrder">
                            <i class="fa fa-check mr-1"></i>
                            COMPLETED
                        </button>
                    @endif
                </div>
            </div>
            
            @can('order history')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">APPROVALS</h3>
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
                                                <a href="#">{{$approval->user->name}}</a> <span class="mx-2 badge bg-{{$status_arr[$approval->status]}}">{{$approval->status}}</span> the trip request
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
