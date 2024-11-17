@extends('layouts.admin')

@section('title')
    Product Gallery
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Product Gallery</h2>
                <p class="dashboard-subtitle">
                    List of Products Gallery
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('product-gallery.create') }}" class="btn btn-primary mb-3">
                                    + Tambah Product Gallery Baru
                                </a>
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead>
                                            <tr>
                                                <th>Produk</th>
                                                <th>Foto Produk</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($galleries as $gallery)
                                                <tr>
                                                    <td>
                                                        {{ $gallery->product ? $gallery->product->name : 'Produk tidak tersedia' }}
                                                    </td>
                                                    <td>
                                                        @if ($gallery->photos)
                                                            <img src="{{ Storage::url($gallery->photos) }}" style="max-height: 80px;" alt=""/>
                                                        @else
                                                            Foto tidak tersedia
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('product-gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
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
