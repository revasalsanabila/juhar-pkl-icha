@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="row bg-light rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-6 text-center p-3r">
                        <h3>HI, {{ Auth::guard('admin')->user()->nama_admin }} Selamat datang di website Jurnal Harian PKL</h3>
                    </div>
                </div>

@endsection