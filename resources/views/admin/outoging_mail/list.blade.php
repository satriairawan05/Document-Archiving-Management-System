@extends('admin.layouts.app')

@push('css')
    <style>
        .card-item {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease-in-out;
        }

        .card-item:hover {
            transform: scale(1.10);
        }

        .card-item h1 {
            font-size: 1.75rem;
            word-wrap: break-word;
        }

        .card-item a {
            display: block;
            margin-top: 5px;
            font-size: 1rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endpush

@section('main')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-block card-stretch card-transparent">
                        <div class="card-header d-flex justify-content-end pb-0">
                            <div class="header-title">
                                <h4 class="card-title">{{ $name }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex justify-content-end my-2">
                                <a href="{{ route('outgoing_mail.create') }}" class="btn btn-success"><i
                                        class="fas fa-pen"></i></a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($letters as $letter)
                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                            <div class="card-item {{ $letter->id % 2 === 0 ? 'bg-primary' : 'bg-secondary' }} rounded p-3 text-center {{ $letter->id % 2 === 0 ? 'text-white' : 'text-dark' }}">
                                                <h1 class="font-weight-bold mb-2">{{ $letter->code }}</h1>
                                                <a href="?letter_id={{ $letter->id }}"
                                                    class="text-decoration-none {{ $letter->id % 2 === 0 ? 'text-white' : 'text-dark' }}"><i class="fas {{ $letter->id % 2 === 0 ? 'fa-file-signature' : 'fa-file-archive' }}"></i> {{ $letter->type }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row mt-3">
                                    {{ $letters->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
