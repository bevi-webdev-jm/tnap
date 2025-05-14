<div>
    <div class="card" wire:poll.1000ms>
        <div class="card-header">
            <h3 class="card-title text-xl">ORDER LIST</h3>
            <div class="card-tools">
                @can('order create')
                    <a href="{{route('order.create')}}" class="btn btn-primary btn-lg">
                        <i class="fa fa-plus mr-1"></i>
                        NEW ORDER
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="search">SEARCH</label>
                        <input type="text" class="form-control" wire:model.live="search" placeholder="Search">
                    </div>
                </div>
                <div class="col-12">
                    {{$orders->links()}}
                </div>
            </div>

            <ul class="list-group">
                @foreach($orders as $order)
                    @php
                        $row_bg = '';
                        switch($order->status) {
                            case 'submitted':
                                $row_bg = 'bg-danger';
                            break;
                            case 'payment received':
                                $row_bg = 'bg-info';
                            break;
                            case 'released':
                                $row_bg = 'bg-secondary';
                            break;
                            case 'cancelled':
                                $row_bg = 'bg-warning';
                            break;
                        }
                    @endphp
                    <a href="{{route('order.show', encrypt($order->id))}}" class="text-dark text-lg">
                        <li class="list-group-item row-hover {{$row_bg}}">
                            <div class="row">
                                <div class="col-lg-2 text-center align-middle">
                                    <strong>
                                        {{$order->order_number}}
                                        <br>
                                        <small class="text-sm">ORDER NUMBER</small>
                                    </strong>
                                </div>
                                <div class="col-lg-3 text-center align-middle">
                                    <strong>
                                        {{$order->user->name}}
                                        <br>
                                        <small class="text-sm">BA NAME</small>
                                    </strong>
                                </div>
                                <div class="col-lg-3 text-center align-middle">
                                    <strong>
                                        {{$order->customer_name}}
                                        <br>
                                        <small class="text-sm">CUSTOMER NAME</small>
                                    </strong>
                                </div>
                                <div class="col-lg-2 text-center align-middle">
                                    <strong>
                                        {{number_format($order->total, 2)}}
                                        <br>
                                        <small class="text-sm">TOTAL AMOUNT</small>
                                    </strong>
                                </div>
                                <div class="col-lg-2 text-center align-middle">
                                    <strong>
                                        <span class="badge badge-{{$status_arr[$order->status]}}">
                                            {{$order->status}}
                                        </span>
                                        <br>
                                        <small class="text-sm">STATUS</small>
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
