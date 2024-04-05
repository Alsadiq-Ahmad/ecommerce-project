@extends('layouts.app')
@section('content')

   <section class="py-5">
    <div class="container">
      <div class="row gx-5">
        <aside class="col-lg-6">
          <div class="border rounded-4 mb-3 d-flex justify-content-center">
            <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" >
              <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit"src="/assets\images\{{$data->images}}" />
            </a>
          </div>
        
          <!-- thumbs-wrap.// -->
          <!-- gallery-wrap .end// -->
        </aside>
        <main class="col-lg-6">
          <div class="ps-lg-3">
            <h4 class="title text-dark">
                {{$data->description}}
            </h4>
            <div class="d-flex flex-row my-3">
              <div class="text-warning mb-1 me-2">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span class="ms-1">
                  4.5
                </span>
              </div>
              <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>4 orders</span>
              <span class="text-success ms-2">Quantity: {{$data->qty}}</span>
            </div>
  
            <div class="mb-3">
              <span class="h5">  {{$data->net}} SAR</span>
              <span class="text-muted">/per box</span>
            </div>
  
         
  
            <div class="row">
              <dt class="col-3">{{__('message.Type')}}: {{$data->Productname}}</dt>

              <dt class="col-3">{{__('message.Color')}} : {{$data->color}}</dt>
              
  
              <dt class="col-3">{{__('message.Brand')}} : {{$data->Productname}}</dt>
            </div>
  
            <hr />
  
           
              <!-- col.// -->
             
            <a href="#" class="btn btn-warning shadow-0"> Buy now </a>
            <a href="{{route('add_to_cart',['id'=>$data->id])}}" class="btn btn-primary shadow-0"> <i class="me-1 fa fa-shopping-basket"></i> Add to cart </a>
            <a href="#" class="btn btn-light border border-secondary py-2 icon-hover px-3"> <i class="me-1 fa fa-heart fa-lg"></i> Save </a>
          </div>
        </main>
      </div>
    </div>
  </section>
  <!-- content -->
  
  

@endsection