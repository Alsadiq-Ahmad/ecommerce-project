@extends('layouts.app')

@section('content')

<div class="container">

@foreach($productsdetails as $cartItem)
    <div class="card mt-2">
        <div class="card-body d-flex align-items-center">
            <div class="col-sm-3">
                <img src="\assets\images\{{ $cartItem->images }}" alt="{{ $cartItem->Productname }}" width="200px" height="120px" class="img-fluid rounded">
            </div>
            <div class="col-sm-6">
                <h3 class="mb-0">{{ $cartItem->Productname }}</h3>
                <p class="mb-1">{{ $cartItem->description }}</p>
            </div>
            <div class="col-sm-2">
                <p class="fw-bold">Price: {{ $cartItem->net }} SAR</p>
            </div>
            <div class="col-sm-1">
                <a href="{{ route('del-cart', ['id' => $cartItem->id]) }}" class="btn btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
            </div>
        </div>
    </div>
@endforeach

@if ($productsdetails->isEmpty())
    <div class="text-center mt-3">
        <p class="fw-bold">Your cart is empty</p>
    </div>
@endif

</div>

@endsection
