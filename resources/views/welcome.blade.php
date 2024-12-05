@extends('layouts.app')

@section('auth')
    <div class="card">
        <div class="card-body">
            <div class="row d-flex justify-content-center">
                <img src="{{ asset('assets/img/Logo.png') }}" width="100" alt="{{ env('APP_NAME') }}">
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <h1 class="text-center font-bold">{{ env('APP_NAME') }}</h1>
                    <h4 class="h5">Sistem ini bertujuan untuk kelola Surat yang ada Di Dinas Pendidikan Kota Samarinda</h4>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <a href="{{ route('login') }}" class="btn btn-success">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                </div>
            </div>
        </div>
    </div>
@endsection
