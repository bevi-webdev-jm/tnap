@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'WELCOME')
@section('content_header_title', 'HOME')
@section('content_header_subtitle', 'MENU')

{{-- Content body: main page content --}}

@section('content_body')

    <div class="card">
        <div class="card-body">
            <h1>You are currently not connected to any networks.</h1>
        </div>
    </div>

@stop

{{-- Push extra CSS --}}

@push('css')
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush