<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    // Menampilkan daftar semua artikel
    public function index()
    {
        $articles = Article::with('author')->latest()->paginate(10);
        return view('articles.index', compact('articles'));
    }

    // Menampilkan detail satu artikel
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    // Menampilkan form untuk membuat artikel (Hanya Admin)
    public function create()
    {
        return view('articles.create');
    }

    // Menyimpan artikel baru (Hanya Admin)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|string',
            'url_media' => 'nullable|url',
        ]);

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type,
            'url_media' => $request->url_media,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dipublikasikan.');
    }
}