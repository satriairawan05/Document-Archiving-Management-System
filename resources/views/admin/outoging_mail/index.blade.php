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
                            <div class="table-responsive">
                                <table class="table-striped table-bordered data-table table" role="grid">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Letter Type</th>
                                            <th>Date</th>
                                            <th>Subject</th>
                                            <th>From</th>
                                            <th>Sender</th>
                                            <th>Receipint</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mails as $mail)
                                            <tr>
                                                <td>{{ $loop->iteration }}
                                                </td>
                                                <td>{{ $mail->letterType->type }}</td>
                                                <td>{{ \Carbon\Carbon::parse($mail->date)->translatedFormat('l, d F Y') }}
                                                </td>
                                                <td>
                                                    {{ $mail->subject }}
                                                </td>
                                                <td>{{ $mail->from }}</td>
                                                <td>{{ $mail->sender }}</td>
                                                <td>{{ $mail->receipint }}</td>
                                                <td>
                                                    @if($mail->document !== null)
                                                    <a href="{{ route('outgoing_mail.show',$mail->id) }}" target="__blank" class="btn btn-sm btn-primary"><i class="fas fa-file-pdf"></i></a>
                                                    @endif
                                                    @if ($access['Update'] == 1)
                                                        <a href="{{ route('outgoing_mail.edit', ['outgoing_mail' => $mail->id, 'letter_id' => $letter_id]) }}"
                                                            class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                    @endif
                                                    @if ($access['Delete'] == 1)
                                                        <form action="{{ route('outgoing_mail.destroy', $mail->id) }}"
                                                            method="post" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Letter Type</th>
                                            <th>Date</th>
                                            <th>Subject</th>
                                            <th>From</th>
                                            <th>Sender</th>
                                            <th>Receipint</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
