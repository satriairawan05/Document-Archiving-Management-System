@extends('admin.layouts.app')

@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/img/Logo.png') }}" width="100" alt="{{ env('APP_NAME') }}"
                            class="img-thumbnail img-fluid">
                    </div>
                    <div class="mt-4 text-center">
                        <h1 class="h3 font-bold">Welcome to <span class="text-dark">{{ env('APP_NAME') }}</span></h1>
                        <h4 class="h5">"Untuk <span class="text-dark">Menang Besar</span>, terkadang anda harus mengambil <span class="text-dark">resiko yang besar</span> pula." - Bill Gates</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
