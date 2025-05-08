@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')
    @auth
        <a href="{{route('home')}}" class="btn btn-default">
            <i class="fa fa-home"></i>
            HOME
        </a>
    @else
        <a href="/login" class="btn btn-primary">
            <i class="fa fa-lock"></i>
            LOGIN
        </a>
    @endauth

    <!-- Hero Section -->
    <section class="hero text-center mt-2">
        <div class="container">
            <h1 class="display-4 fw-bold">Tindahan ni Aling Puring 2025</h1>
            <p class="lead mt-3">Visit Our Booth at the Tindahan ni Aling Puring Convention</p>
        </div>
    </section>

    <!-- Booth Details -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="mb-4 text-danger">We're Excited to See You at TNAP 2025!</h2>
            <p class="lead mb-5">Join the Tindahan ni Aling Puring Convention and drop by the <strong>Kojiesan Booth</strong> for exclusive treats, product samples, and great deals!</p>
        </div>
    </section>

@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    <style>
        .hero {
            background-color:rgb(43, 137, 1);
            color: white;
            padding: 60px 0;
        }
        .section-yellow {
            background-color: #fff3cd;
        }
        .section-red {
            background-color: #f8d7da;
        }
    </style>
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush