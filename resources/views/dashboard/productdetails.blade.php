@extends('layouts.base')

@section('content')

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <strong class="text text-danger">Errors:</strong>
    <ul>
        @foreach ($errors->all() as $error)
            <li class="list-unstyled alert alert-dismissible fade show p-0">{{ $error }}</li>
        @endforeach
    </ul>
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
                            <h1 class="modal-title fs-5 text-success" id="staticBackdropLabel">Add new product Details</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('create-details') }}" method="post" id="productForm">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <label for="products" class="text-dark">Select product</label>
                                        <select name="products" id="products" class="form-select">
                                            @foreach($products as $item)
                                            <option value="{{$item->id}}" class="text-dark">{{$item->Productname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="color" class="text-dark">Color</label>

                                        <input type="text" class="form-control @error('color') is-invalid @enderror" name="color" id="color">
                                        <!-- @error('color')
                                            <span class="invalid-feedback " role="alert">{{ $message }}</span>
                                        @enderror -->
                                    </div>
                                    <div class="col">
                                        <label for="price" class="text-dark">Price</label>
                                        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price">
                                      
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="qty" class="text-dark">Quantity</label>
                                        <input type="text" class="form-control @error('qty') is-invalid @enderror" name="qty" id="qty">
                                        
                                    </div>
                                    <div class="col">
                                        <label for="description" class="text-dark">Description</label>
                                        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description">
                                       
                                    </div>
                                </div>

                                <button type="submit" class="mt-3 btn btn-primary">Save</button>
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
            <form action="{{route('search-details')}}" method="get">
                @csrf
                <input type="text" name="name" class="form-control">

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary mt-2  me-md-5">Search</button>

                    </div>
                    <div class="col d-flex justify-content-end ">
                        <a href="{{route('products')}}"><button type="submit" class="btn btn-primary mt-2" id="btn2">Show all</button></a>

                    </div>
                </div>


            </form>

        </div>
    </div>

    <div class="row mt-5 text-dark">
        <div class="col">
            <div class="card bg-white">
                <div class="card-body">
                    <table class=" table table-bordered text-center">
                        <thead>
                            <th>ID</th>
                            <th>Product Details ID</th>
                            <th>Product Name</th>
                            <th>Color</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Description</th>
                            <th>Image Name</th>

                            <th colspan="2">Action</th>
                        </thead>
                        <tbody>
                            @foreach($productsdetails as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->productid}}</td>
                                <td>{{$item->Productname}}</td>
                                <td>{{$item->color}}</td>
                                <td>{{$item->price}} SAR</td>
                                <td>{{$item->qty}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->images}}</td>


                                <td>

                                    <a href="{{route('del-details',['id'=>$item->id])}}"> <i class="fa fa-trash text-danger" aria-hidden="true"></i></a>


                                </td>
                                <td>
                                    <a href="{{route('edit-details',['id'=>$item->id])}}"> <i class="fa fa-edit text-success" aria-hidden="true"></i></a>
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
