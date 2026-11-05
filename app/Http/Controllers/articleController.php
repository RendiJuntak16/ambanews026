<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class articleController extends Controller
{
    
    public function showDashboard(){
        $data = Article::latest()->get();
        return view('admin.ArticleList', compact('data'));
    }
    public function showNewArticle(){
        return view('admin.NewArticle');
    }

    public function store(Request $request){
        
        //validasi wajib diisi semua isi
        $request->validate([
            'title' => 'required |string |max:255',
            'category' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',//max 2MB
            'content' => 'required'
        ]);
        //upload gambar
        //gambar akan di simpan di folder storage/app/public/thumbnails
        $imagePath = $request->file('thumbnail')->store('public/thumbnails');

        //simpan ke database
        Article::create([
            'title' => $request->title,
            'category' => $request->category,
            'thumbnail' =>$request->file('thumbnail')->store('public/thumbnails'),
            'content' => $request->content
        ]);
        return redirect('/admin/dashboard')->with('success','Artikel berhasil dipublish!');
    }

    public function edit(int $id){
        $data = Article::findOrFail($id);
        return view('admin/edit', compact('data'));
    }    

    public function update(int $id,Request $request){
        $data = Article::findOrFail($id);
        $request-> validate([
            'title' => 'required |string |max:255',
            'category' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',//max 2MB
            'content' => 'required'
        ]);
        $dataToUpdate = [
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content
        ];
         // 3. Cek apakah ada file gambar BARU yang diunggah
         if($request->hasFile('thumbnail')){
            if ($data->thumbnail) {
            // Hapus gambar lama dari folder server agar penyimpanan tidak penuh
            Storage::disk('public')->delete($data->thumbnail);          
            }
            // Simpan gambar baru
            $imagePath = $request->file('thumbnail')->store('public/thumbnails');
            
            // Masukkan path gambar baru ke dalam array yang akan diupdate
            $dataToUpdate['thumbnail'] = $imagePath;
         }
        
        // 4. Update data ke database
        $data->update($dataToUpdate);
        return redirect("/admin/dashboard")->with("massage","Berhasil memperbarui data");
    }

    public function delete(int $id){
         // 1. Cari artikel berdasarkan ID
        $data = Article::findOrFail($id);

        // 2. Hapus file gambar thumbnail dari server
        if ($data->thumbnail) {
            Storage::disk('public')->delete($data->thumbnail);
        }

        // 3. Hapus data dari database MySQL
        $data->delete();
        return redirect()->back()->with("massage","Berhasil menghapus data");
    }

}
