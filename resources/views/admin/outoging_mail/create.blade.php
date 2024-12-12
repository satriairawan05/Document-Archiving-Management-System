@extends('admin.layouts.app')

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
                            @include('admin.incoming_mail._form',[
                                'cancelRoute' => route('incoming_mail.index'),
                                'submitButton' => 'Submit',
                                'formAction' => route('incoming_mail.store')
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
