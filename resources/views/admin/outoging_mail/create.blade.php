@extends('admin.layouts.app')

@push('css')
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/js/jquery-3.6.4.min.js') }}"></script>
    <!-- Select2 JS -->
    <script src="{{ asset('assets/modules/select2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#letter-select').select2({
                placeholder: 'Select a letter',
                allowClear: true,
            });
        });
    </script>
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
                            @include('admin.outoging_mail._form', [
                                'cancelRoute' => route('outgoing_mail.index'),
                                'submitButton' => 'Submit',
                                'formAction' => route('outgoing_mail.store'),
                                'letters' => $letters,
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
