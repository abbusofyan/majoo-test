<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Validator;
use App\Models\Kategori;

class KategoriController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
      $kategori = Kategori::all();
      return view('admin.master.kategori.index', compact('kategori'));
    }

    public function store(Request $request) {
       $validate = Validator::make($request->all(), [
         'kategori' => 'required'
       ]);

       if ($validate->fails()) {
         return redirect()->back()->withErrors($validate);
       }

       if (Kategori::store($request->all())) {
         return redirect()->back()->with(['success' => 'Kategori Berhasil Ditambahkan']);
       }
    }

    public function delete($id) {
      $kategori = Kategori::findOrFail($id)->delete();

      return redirect()->back()->with(['success' => 'Kategori berhasil dihapus']);
    }

    public function update(Request $request, $id) {
      $kategori = Kategori::find($id);
      $kategori->kategori = $request->kategori;
      $kategori->save();
      return redirect()->back()->with(['success' => 'Kategori berhasil diupdate']);
    }
}
