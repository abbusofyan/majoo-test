<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use Validator;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
      $produk = Produk::with('kategori')->paginate(2);
      return view('admin.master.produk.index', compact('produk'));
    }

    public function tambah() {
      $kategori = Kategori::all();
      return view('admin.master.produk.tambah', compact('kategori'));
    }

    public function store(Request $request) {
      $validate = Validator::make($request->all(), [
        'nama_produk' => 'required|unique:produk',
        'deskripsi' => 'required',
        'harga' => 'required',
        'kategori' => 'required',
        'gambar' => 'required'
      ]);

      if ($validate->fails()) {
        return redirect()->back()->withErrors($validate)->withInput();
      }

      Produk::store($request->all());
      return redirect(route('admin.master.produk.index'))->with(['success' => 'Produk berhasil ditambahkan']);
    }

    public function uploadImage(Request $request) {
      $request->validate([
          'image' => 'required|image',
      ]);

      $filename = time().'.'.request()->image->getClientOriginalExtension();

      request()->image->move(public_path('upload/image'), $filename);

      return response()->json([
        'success'=>'Gambar berhasil diupload',
        'filename' => $filename
      ]);
    }

}
