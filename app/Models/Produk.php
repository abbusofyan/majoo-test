<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    public function store($request) {
      $produk = new Produk;
      $produk->nama_produk = $request['nama_produk'];
      $produk->deskripsi = $request['deskripsi'];
      $produk->harga = $request['harga'];
      $produk->id_kategori = $request['kategori'];
      $produk->image = $request['gambar'];
      $produk->save();
    }

    public function kategori() {
      return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
}
