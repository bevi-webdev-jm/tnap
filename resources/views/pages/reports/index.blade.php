@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'REPORTS')
@section('content_header_title', 'REPORTS')
@section('content_header_subtitle', 'ORDERS')

{{-- Content body: main page content --}}

@section('content_body')
    <livewire:reports.order/>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    <style>
    </style>
@endpush

{{-- Push extra scripts --}}

@push('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
@endpush