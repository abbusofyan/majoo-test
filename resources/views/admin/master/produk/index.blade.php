@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          @if (Session::has('success'))
            <div class="alert alert-success">
                <p>{{Session::get('success')}}</p>
            </div>
          @endif
          <a class="btn btn-primary mb-2" href="{{route('admin.master.produk.tambah')}}">Tambah Produk</a>
          <div class="table-responsive" width="100%">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Deskripsi</th>
                  <th>Harga</th>
                  <th>Kategori</th>
                  <th>Gambar</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($produk as $prod)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$prod->nama_produk}}</td>
                    <td>{!! $prod->deskripsi !!}</td>
                    <td>{{Currency::idr($prod->harga)}}</td>
                    <td>{{$prod->kategori->kategori}}</td>
                    <td>
                      <img src="{{asset('upload/image/'.$prod->image)}}" alt="" height="100">
                    </td>
                    <td>
                      <button type="button" class="btn btn-primary btn-sm" name="button">Edit</button>
                      <button type="button" class="btn btn-danger btn-sm" name="button">Delete</button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          {{$produk->links('pagination::bootstrap-4')}}
        </div>
    </div>
</div>
@endsection
