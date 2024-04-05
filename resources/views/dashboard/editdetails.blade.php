@extends('layouts.base')

@section('content')

<div class="container">

    <div class="card mt-5 bg-white">
        <div class="card-body">
            <form action="{{ route('update-details') }}" method="post">
                @csrf
                <div class="row mt-3 text-center">
                    <input type="hidden" name="id" class="form-control p-2" value="{{ $Productdetails['id'] }}">
                    <span class="text-dark" style="font-size: large;">Update product details</span>
                 <div class="row">
                    <div class="col">
                    <label for="color" class="text-dark">color</label>
                        <input type="text" name="color" id="color" class="form-control p-2" value="{{ $Productdetails['color'] }}">
                        <label for="description" class="text-dark">description</label>
                        <input type="text" name="description" id="description" class="form-control p-2" value="{{ $Productdetails['description'] }}">
                    </div>
                    <div class="col">
                    <label for="price" class="text-dark">price</label>
                        <input type="text" name="price" id="price" class="form-control p-2" value="{{ $Productdetails['price'] }}">
                        <label for="images" class="text-dark">image</label>
                        <input type="text" name="images" id="images" class="form-control p-2" value="{{ $Productdetails['images'] }}">
                    </div>
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
