@extends('layouts.admin')

@section('title')
    Pemilahan Sampah
@endsection

@section('content')
    <!-- Section Content -->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Pemilahan Sampah</h2>
                <p class="dashboard-subtitle">
                    Tambah Data
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('pemilahan.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="kategori">Pilih Kategori</label>
                                                <select name="kategori" id="kategori" class="form-control">
                                                    <option value="" disabled selected>Pilih Kategori</option>
                                                    <option value="Organik">Organik</option>
                                                    <option value="Anorganik">Anorganik</option>
                                                    <option value="Residu">Residu</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="jumlah">Jumlah Sampah</label>
                                                <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
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
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
