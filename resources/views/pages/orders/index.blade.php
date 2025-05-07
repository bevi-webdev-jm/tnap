@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'ORDERS')
@section('content_header_title', 'ORDERS')
@section('content_header_subtitle', 'LIST')

{{-- Content body: main page content --}}

@section('content_body')

    <livewire:orders.order-list/>

@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    <style>
        .row-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease, border 0.3s ease;
        }

        .row-hover:hover {
            transform: scale(1.02);
        }
    </style>
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush