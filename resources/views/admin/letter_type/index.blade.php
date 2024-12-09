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
                            <div class="d-flex justify-content-end my-2">
                                <a href="{{ route('letter_type.create') }}" class="btn btn-success"><i class="fas fa-pen"></i></a>
                            </div>
                            <div class="table-responsive">
                                <table class="table-striped table-bordered data-table table" role="grid">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Type</th>
                                            <th>Code</th>
                                            <th>Number</th>
                                            <th>Ordinal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($letters as $letter)
                                            <tr>
                                                <td>{{ ($letters->currentPage() - 1) * $letters->perPage() + $loop->iteration }}</td>
                                                <td>{{ $letter->type }}</td>
                                                <td>{{ $letter->code }}</td>
                                                <td>{{ $letter->number }}</td>
                                                <td>{{ $letter->ordinal }}</td>
                                                <td>
                                                    @if ($access['Update'] == 1)
                                                        <a href="{{ route('letter_type.edit', $letter->id) }}"
                                                            class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                    @endif
                                                    @if ($access['Delete'] == 1)
                                                        <form action="{{ route('letter_type.destroy', $letter->id) }}"
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
                                            <th>Type</th>
                                            <th>Code</th>
                                            <th>Number</th>
                                            <th>Ordinal</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>

                                <p class="mt-4">
                                    {{ $letters->links() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
@endpush

@push('js')
    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.6.4.min.js') }}"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#table').DataTable({
                responsive: true,
                pageLength: 10,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    }
                }
            });
        });
    </script>
@endpush
