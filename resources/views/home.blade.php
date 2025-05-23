@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'WELCOME')
@section('content_header_title', 'HOME')
@section('content_header_subtitle', 'MENU')

{{-- Content body: main page content --}}

@section('content_body')

    <div class="row">
        @can('order create')
            <div class="col-lg-4 col-sm-12">
                <a href="{{route('order.create')}}">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>NEW ORDER</h3>
                            <small class="mb-2">create new order</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-bag"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        @can('order access')
            <div class="col-lg-4 col-sm-12">
                <a href="{{route('order.index')}}">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>ORDER LIST</h3>
                            <small class="mb-2">list of orders</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-list"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        @can('order report')
            <div class="col-lg-4 col-sm-12">
                <a href="{{route('order.report')}}">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>ORDER REPORT</h3>
                            <small class="mb-2">Order reports</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-chart-line"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
    </div>

@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    <style>
        .small-box {
            transition: transform 0.3s ease;
        }

        .small-box:hover {
            transform: scale(1.04);
        }

        .bg-info {
            background: linear-gradient(0deg, rgb(0 133 128 / 70%), rgb(0 197 223));
        }
        .bg-success {
            background: linear-gradient(0deg, rgb(60 139 35), rgb(90 235 2));
        }
        .bg-danger {
            background: linear-gradient(0deg, rgb(139 55 35), rgb(235 45 2));
        }
    </style>
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush