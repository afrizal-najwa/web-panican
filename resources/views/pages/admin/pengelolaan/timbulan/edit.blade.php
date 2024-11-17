@extends('layouts.admin')

@section('title')
    Timbulan Sampah
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Timbulan Sampah</h2>
                <p class="dashboard-subtitle">
                    Edit Data Timbulan Sampah
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('timbulan.update', $timbulanSampah->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <select name="kategori" id="kategori" class="form-control" required>
                                                    <option value="" disabled selected>Pilih Kategori</option>
                                                    <option value="Desa" {{ $timbulanSampah->kategori == 'Desa' ? 'selected' : '' }}>Desa</option>
                                                    <option value="Perumahan" {{ $timbulanSampah->kategori == 'Perumahan' ? 'selected' : '' }}>Perumahan</option>
                                                    <option value="Wilayah Lain" {{ $timbulanSampah->kategori == 'Wilayah Lain' ? 'selected' : '' }}>Wilayah Lain</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nama">Nama Wilayah</label>
                                                <input type="text" class="form-control" name="nama" value="{{ $timbulanSampah->nama }}" required />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="jumlah">Jumlah (ton)</label>
                                                <input type="number" class="form-control" name="jumlah" value="{{ $timbulanSampah->jumlah }}" min="1" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endpush
