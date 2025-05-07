@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'ORDERS')
@section('content_header_title', 'ORDERS')
@section('content_header_subtitle', 'NEW')

{{-- Content body: main page content --}}

@section('content_body')

    <livewire:orders.form/>

@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    <style>
        .product-img {
            max-height: 200px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .type-selected {
            background-color:rgb(10, 90, 86);
            color: white;
        }
    </style>
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush