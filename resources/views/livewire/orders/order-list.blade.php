<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-xl">ORDER LIST</h3>
        </div>
        <div class="card-body">

            <ul class="list-group">
                @foreach($orders as $order)
                    <a href="" class="text-dark text-lg">
                        <li class="list-group-item row-hover">
                            <div class="row">
                                <div class="col-lg-2 text-center align-middle">
                                    <strong>
                                        {{$order->order_number}}
                                        <br>
                                        <small class="text-sm text-muted">ORDER NUMBER</small>
                                    </strong>
                                </div>
                                <div class="col-lg-3 text-center align-middle">
                                    <strong>
                                        {{$order->user->name}}
                                        <br>
                                        <small class="text-sm text-muted">BA NAME</small>
                                    </strong>
                                </div>
                                <div class="col-lg-3 text-center align-middle">
                                    <strong>
                                        {{$order->customer_name}}
                                        <br>
                                        <small class="text-sm text-muted">CUSTOMER NAME</small>
                                    </strong>
                                </div>
                                <div class="col-lg-2 text-center align-middle">
                                    <strong>
                                        {{number_format($order->total, 2)}}
                                        <br>
                                        <small class="text-sm text-muted">TOTAL AMOUNT</small>
                                    </strong>
                                </div>
                                <div class="col-lg-2 text-center align-middle">
                                    <strong>
                                        <span class="badge badge-{{$status_arr[$order->status]}}">
                                            {{$order->status}}
                                        </span>
                                        <br>
                                        <small class="text-sm text-muted">STATUS</small>
                                    </strong>
                                </div>
                            </div>
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
        <div class="card-footer">
            {{$orders->links()}}
        </div>
    </div>
</div>
