<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Currency;

class HomeController extends Controller
{

    public function index()
    {
        $produk = Produk::with('kategori')->get();
        return view('index', compact('produk'));
    }
}
