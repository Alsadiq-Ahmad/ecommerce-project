@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            @foreach($data as $items)
            <div class="card mt-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="/assets\images\{{$items->images}}" alt="" width="250" height="200">
                        </div>
                        <div class="col-sm-6">
                            <h4 class="alert alert-success">{{$items->Productname}}</h4>
                            <ul class="list-unstyled">
                                <li class="badge bg-danger p-2" style="font-size: medium;">{{$items->description}}</li>
                                <li class="p-2"><h4>color: {{$items->color}}</h4></li>
                                <li class="p-2"><small>Address Jeddah</small></li>

                            </ul>

                        </div>
                        <div class="col-sm-3">
                            <ul class="list-unstyled p-2">
                                <li class="badge bg-success" style="font-size: medium;">{{__('message.price')}}: {{$items->price}}</li>
                                <li class=""><span>{{__('message.Tax')}}: {{$items->tax}} {{__('message.SAR')}}</span></li>
                                <li class=""><small>{{__('message.Total')}}: {{$items->total}} {{__('message.SAR')}}</small></li>
                                <li class=""><small>{{__('message.Descount')}}:  <del class="text-danger">{{$items->descount}} {{__('message.SAR')}}</del></small></li>
                                <li class=""><small>{{__('message.Net')}}: {{$items->net}} {{__('message.SAR')}}</small></li>

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