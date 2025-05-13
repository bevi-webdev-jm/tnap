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
            background: linear-gradient(1deg, rgb(255 255 250), rgb(197 231 8 / 58%));
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border 0.3s ease;
            margin-bottom: 12px;
        }

        .row-hover:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.25);
            cursor: pointer;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 16px;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.25);
        }
    </style>
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush