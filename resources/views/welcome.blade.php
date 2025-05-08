@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')
    <!-- Hero Section -->
    <section class="hero text-center">
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

            <div class="card mx-auto shadow-sm" style="max-width: 500px;">
                <div class="card-body text-start">
                    <h5 class="card-title mb-3">📍 Booth Information</h5>
                    <ul class="list-unstyled">
                        <li><strong>Event:</strong> TNAP Convention 2025</li>
                        <li><strong>Date:</strong> June 15–17, 2025</li>
                        <li><strong>Location:</strong> SMX Convention Center, Pasay City</li>
                        <li><strong>Booth:</strong> Purgold Booth – Look for the yellow and red display!</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="section-red py-5">
        <div class="container text-center">
            <h2 class="mb-5 text-danger">🎁 What's Waiting at Our Booth?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">💥 Special Promos</h5>
                            <p class="card-text">Get exclusive on-site discounts on select Purgold products.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">🎉 Free Samples</h5>
                            <p class="card-text">Take home free product samples and try our newest releases!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">📸 Photo Spot</h5>
                            <p class="card-text">Snap a photo at our booth and tag us for a chance to win goodies.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Visit -->
    <section class="section-yellow py-5 text-center">
        <div class="container">
            <h2 class="text-danger mb-3">👋 See You at the Booth!</h2>
            <p class="lead mb-4">Come visit Purgold and discover products made for every sari-sari store owner. See you there!</p>
            <a href="#" class="btn btn-danger btn-lg">Learn More</a>
        </div>
    </section>

@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    <style>
        .hero {
            background-color: #c1121f;
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