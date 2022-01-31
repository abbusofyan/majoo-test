@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
              Tambah Kategori
            </button>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (Session::has('success'))
              <div class="alert alert-success">
                  <p>{{Session::get('success')}}</p>
              </div>
            @endif
            <div class="card">
                <div class="card-header">Master Kategori</div>
                <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($kategori as $kat)
                            <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$kat->kategori}}</td>
                              <td>
                                <a href="{{route('admin.master.kategori.delete', $kat->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Produk dengan kategori ini juga akan terhapus. Yakin ingin menghapus kategori ini ?');">Delete</a>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{$kat->id}}">
                                  Edit
                                </button>
                              </td>
                            </tr>

                            <div class="modal fade" id="editModal{{$kat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form class="" action="{{route('admin.master.kategori.update', $kat->id)}}" method="post">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="form-group">
                                          <label>Kategori</label>
                                          <input type="text" class="form-control" name="kategori" value="{{$kat->kategori}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="{{route('admin.master.kategori.store')}}" method="post">
        <div class="modal-body">
            @csrf
            <div class="form-group">
              <label>Kategori</label>
              <input type="text" class="form-control" name="kategori" value="">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
