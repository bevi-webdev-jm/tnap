@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'SYSTEM SETTING')
@section('content_header_title', 'SYSTEM SETTINGS')
@section('content_header_subtitle', 'SYSTEM SETTING')

{{-- Content body: main page content --}}
@section('content_body')
    <livewire:system-settings/>
@stop

{{-- Push extra CSS --}}
@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}
@push('js')
    <script> 
    </script>
@endpush