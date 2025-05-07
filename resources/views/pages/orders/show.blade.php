@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'ORDERS')
@section('content_header_title', 'ORDERS')
@section('content_header_subtitle', 'DETAILS')

{{-- Content body: main page content --}}

@section('content_body')
    
    <livewire:orders.show :order="$order"/>
    
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    <style>
        .product-img-sm {
            max-height: 50px;
        }
    </style>
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush