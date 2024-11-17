@extends('layouts.admin')

@section('title')
    Store Dashboard
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Admin Dashboard</h2>
                <p class="dashboard-subtitle">
                    Welcome to Admin Area
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Customer
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $customer }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Revenue
                                </div>
                                <div class="dashboard-card-subtitle">
                                    Rp {{ $revenue }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Transaction
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $transaction }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    {{-- <div class="col-12 mt-2">
                        <ul class="nav nav-pills" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="sell-tab" data-toggle="tab" href="#sell" role="tab"
                                    aria-controls="sell" aria-selected="true">Transaksi Terbaru</a>
                            </li>
                        </ul>
                        @foreach ($sellTransactions as $transaction)
                            <div class="tab-pane fade show active" id="sell" role="tabpanel" aria-labelledby="sell-tab">
                                <div class="row mt-3">
                                    <div class="col-12 mt-2">
                                        <a class="card card-list d-block" href="{{ route('dashboard-transaction-details', $transaction->id) }}">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <img src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                                                            alt=""
                                                            class="w-50" />
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ $transaction->product->name }}
                                                    </div>
                                                    <div class="col-md-3">
                                                        {{ $transaction->product->user->store_name }}
                                                    </div>
                                                    <div class="col-md-3">
                                                        {{ $transaction->created_at }}
                                                    </div>
                                                    <div class="col-md-1 d-none d-md-block">
                                                        <img src="/images/dashboard-arrow-right.svg" alt="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
