@extends('layouts.dashboard')
@section('title')
    Store Dashboard Products
@endsection
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Dashboard</h2>
                <p class="dashboard-subtitle">Lihat apa yang telah Anda buat hari ini!</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('dashboard-products-create') }}" class="btn btn-success">Tambah Produk</a>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach ($products as $product)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <a href="{{ route('dashboard-products-details', $product->id) }}"
                                class="card card-dashboard-product d-block">
                                <div class="card-body">
                                    <img src="{{ Storage::url($product->galleries->first()->photos ?? '') }}" alt=""
                                        class="w-100 mb-2" />
                                    <div class="product-title">
                                        {{ $product->name }}
                                    </div>
                                    <div class="product-category">
                                        {{ $product->category->name }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
