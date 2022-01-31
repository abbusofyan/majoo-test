<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $guarded = [];

    public function store($request) {
      $data = new Kategori();
      $data->kategori = $request['kategori'];
      $data->save();
      return true;
    }

    public function produk() {
      return $this->hasMany(Produk::class);
    }

}
