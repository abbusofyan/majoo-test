@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif

          <a class="btn btn-primary mb-2" href="{{route('admin.master.produk.index')}}">Kembali</a>
            <div class="card">
                <div class="card-header">Tambah Produk</div>
                <div class="card-body">
                  <form action="{{route('admin.master.produk.store')}}" method="post" id="produk-form">
                    @csrf
                    <div class="form-group">
                      <label>Nama Produk</label>
                      <input type="text" class="form-control" name="nama_produk" value="{{old('nama_produk')}}">
                    </div>
                    <div class="form-group">
                      <label>Deskripsi</label>
                      <textarea id="deskripsi" class="form-control" name="deskripsi" rows="10" cols="50">{{old('deskripsi')}}</textarea>
                    </div>
                    <div class="form-group">
                      <label>Harga</label>
                      <input type="number" class="form-control" name="harga" value="{{old('harga')}}">
                    </div>
                    <div class="form-group">
                      <label>Kategori</label>
                      <select class="select2 form-control" name="kategori">
                        <option value="">-- pilih kategori --</option>
                        @foreach ($kategori as $kat)
                          <option value="{{$kat->id}}" {{old('kategori') == $kat->id ? 'selected' : ''}}>{{$kat->kategori}}</option>
                        @endforeach
                      </select>
                    </div>

                    <input type="text" name="gambar" id="filename" value="{{old('gambar')}}"><br><br>
                  </form>
                  <form action="{{route('admin.master.produk.uploadImage')}}" id="form-image" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label>Gambar Produk</label>
                      <input type="file" class="form-control-file" name="image" id="image">
                    </div>
                    <div class="form-group">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        </div>
                    </div>
                    <p><i id="image-caption"></i></p>
                  </form>
                  <button type="button" class="btn btn-primary" id="btn-submit">Submit</button>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
  <script>
    $(document).ready(function() {
      var image = $('#filename').val()
      if (image) {
        $('.progress .progress-bar').css("width", 100+'%', function() {
          return $(this).attr("aria-valuenow", 100) + "%";
        })
        $('#image-caption').text('gambar produk berhasil diupload')
      }
    })

    $('#btn-submit').click(function() {
      $('#produk-form').submit()
    })

    $('#image').change(function() {
      $('#form-image').submit()
    })

    $('#form-image').ajaxForm({
        beforeSend: function () {
            var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
            var percentage = percentComplete;
            $('.progress .progress-bar').css("width", percentage+'%', function() {
              return $(this).attr("aria-valuenow", percentage) + "%";
            })
        },
        complete: function (xhr) {
          $('#filename').val(xhr.responseJSON.filename)
          $('#image-caption').text('gambar produk berhasil diupload')
        }
    });

  </script>
@endsection
