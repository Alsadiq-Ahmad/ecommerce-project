@extends('layouts.base')

@section('content')

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <strong class="text text-danger">Error:</strong> {{ $errors->first() }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif

<div class="container">
    <!-- <span class="text-dark">{{ Session::get('data') }}</span> -->

    <div class="row mt-5">
        <div class="col">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <span>Add new product</span>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-success" id="staticBackdropLabel">Add new product</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('CreateProducts') }}" method="post" id="productForm">
                                @csrf
                                <label for="ProductName" class="text text-dark">Enter product name</label>
                                <input type="text" class="form-control @error('ProductName') is-invalid @enderror" name="ProductName" id="ProductName">
                                <button type="submit" class=" mt-3 btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <form action="{{ route('products') }}" method="post" class="">
                @csrf
                <input type="text" name="name" class="form-control">
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary mt-2 me-md-5">Search</button>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <a href="{{ route('products') }}"><button type="submit" class="btn btn-primary mt-2" id="btn2">Show all</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-5 text-dark">
        <div class="col">
            <div class="card bg-white">
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th colspan="2">Action Name</th>
                        </thead>
                        <tbody>
                            @foreach($products as $item)
                            <tr>
                                <td class="text dark">{{ $item->id }}</td>
                                <td class="text-dark">{{ $item->Productname }}</td>
                                <td>
                                    <a href="{{ route('del',['id'=>$item['id']]) }}"> <i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                                </td>
                                <td>
                                    <a href="{{ route('edit-items',['id'=>$item['id']]) }}"> <i class="fa fa-edit text-success" aria-hidden="true"></i></a>
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

@endsection
