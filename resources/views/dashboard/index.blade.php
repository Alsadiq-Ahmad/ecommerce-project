@extends('layouts.base')

@section('content')

<h1 class="text-dark">Welcome to Dashboard</h1>
<span class="text-dark">{{ Session::get('data') }}</span>
<span class="text-dark">{{ Cookie::get('A') }}</span>

<div class="container">
    <div class="row mt-5 ">
        <div class="col">
            <div class="card">
                <div class="card-body">
                <h1 class="text-center"><i class="bi bi-person-fill text-success"></i></h1>
                    <h3 class="text-center text-dark">Users</h3>
                    <h4 class="text-center text-dark">{{ Session::get('countusers') }}</h4> <!-- Display countusers from session -->
                </div>
            </div>
        </div>
        <div class="col">
        <div class="card">
                <div class="card-body">
                <h1 class="text-center"><i class="bi bi-dropbox text-success"></i></h1>
                    <h3 class="text-center text-dark">Products</h3>
                    <h4 class="text-center text-dark">{{ Session::get('countproducts') }}</h4> <!-- Display countproducts from session -->
                </div>
            </div>
        </div>
        <div class="col">
        <div class="card">
                <div class="card-body">
                <h1 class="text-center"><i class="bi bi-receipt-cutoff text-success"></i></h1>
                    <h3 class="text-center text-dark">invoices</h3>
                    <h4 class="text-center text-dark">{{ Session::get('countinvoice') }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
