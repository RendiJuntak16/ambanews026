<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showHome(){

        //ambil semua artikel,urutan dari yang terbaru diposting(latest)
        $articles = Article::latest()->get();   
        return view('user.homeMenu', compact('articles'));
    }

    
    public function showdetail(){
        return view('user.detailMenu');
    }

    public function show(int $id){
        // Cari artikel berdasarkan ID. Jika tidak ada, otomatis error 404.
        $article = Article::findOrFail($id);

        return view('user.detailMenu', compact('article'));
    }
}
