@extends('layouts.app')

@section('content')
  <div class="col-md-12">
      <h3>Produk</h3>
      <div class="row">
        @foreach ($produk as $prod)
          <div class="col-lg-3 col-md-4 col-sm-6 d-flex align-items-stretch">
            <div class="card mb-3">
              <img src="{{asset('upload/image/'.$prod->image)}}" class="card-img-top" alt="...">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title text-center">{{$prod->nama_produk}}</h5>
                <h5 class="card-title text-center">{{Currency::idr($prod->harga)}}</h5>
                <p class="card-text">{!! $prod->deskripsi !!}</p>
                <center class="mt-auto"><a href="#" class="mt-auto btn btn-primary">beli</a></center>
              </div>
            </div>
          </div>
        @endforeach
      </div>

  </div>
@endsection
