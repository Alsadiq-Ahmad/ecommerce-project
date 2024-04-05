@extends('layouts.base')

@section('content')

<div class="container">

    <div class="card mt-5 bg-white">
        <div class="card-body">
            <form action="{{ route('update-product') }}" method="post">
                @csrf
                <div class="row mt-3 text-center">
                    <input type="hidden" name="id" class="form-control p-2" value="{{ $products['id'] }}">
                    
                    <div class="col">
                        <label for="prname" class="text-dark">New product name</label>
                        <input type="text" name="productname" id="prname" class="form-control p-2" value="{{ $products['Productname'] }}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col text-center">
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
