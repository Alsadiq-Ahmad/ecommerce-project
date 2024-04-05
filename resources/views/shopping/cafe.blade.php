@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            @foreach($data as $items)
            <div class="card mt-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="{{$items->image}}" alt="" width="250" height="200">
                        </div>
                        <div class="col-sm-6">
                            <h4 class="alert alert-success">{{$items->title}}</h4>
                            <ul class="list-unstyled">
                                <li class="  p-2" style="font-size: medium;">{{$items->description}}</li>
                                @foreach($items->ingredients as $row) <!--use loop to read array -->
                                <li class="p-2"><h4>type: {{$row}}</h4></li>
                                @endforeach
                                <li class="p-2"><small>Address Jeddah</small></li>

                            </ul>

                        </div>
                        <div class="col-sm-3">
                            <ul class="list-unstyled p-2">
                              

                            <div class="row mt-3">
                                <div class="col">
                                <a href="{{ route('show-items-details', ['id' => $items->id]) }}" class="btn btn-primary">{{__('message.Show Details')}}</a>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

@endsection