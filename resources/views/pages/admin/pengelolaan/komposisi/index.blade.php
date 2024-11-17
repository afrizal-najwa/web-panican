@extends('layouts.admin')

@section('title')
    Kelola Data Komposisi Sampah
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Komposisi Sampah</h2>
                <p class="dashboard-subtitle">
                    Kelola data komposisi sampah
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('komposisi.create') }}" class="btn btn-primary mb-3">
                                    + Tambah data komposisi baru
                                </a>
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead>
                                            <tr>
                                                <th>Kategori</th>
                                                <th>Jumlah (ton)</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
<script>
    var datatable = $('#crudTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax:{
            url: '{{ route('komposisi.index') }}' // Memastikan URL menuju method index yang benar
        },
        columns:[
            {data: 'kategori', name:'kategori'},
            {data: 'jumlah', name:'jumlah'},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: '15%'
            }
        ]
    });
</script>
@endpush
