<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::query();


        // Filter berdasarkan 'search' (judul berita)
        if (request()->has('search') && request()->input('search') != '') {
            $news->where('title', 'like', '%' . request()->input('search') . '%');
        }

        // Filter berdasarkan 'status'
        if (request()->has('status') && request()->input('status') != '') {
            $news->where('status', request()->input('status'));
        }

        // Filter berdasarkan 'date' (tanggal publikasi)
        if (request()->has('date') && request()->input('date') != '') {
            // Menggunakan whereDate untuk pencocokan tanggal yang tepat
            $news->whereDate('published_at', request()->input('date'));
        }

        // Urutkan dan paginasi hasilnya
        $news = $news->orderBy('created_at', 'desc')->paginate(10);
        $totalNews = $news->total();
        $publishedNews = $news->where('status', 'published');
        $publishedNewsCount = $publishedNews->count();
        $draftNews = $news->where('status', 'draft')->count();

        
        return view('backend.admin.news.index', compact('news', 'totalNews', 'publishedNews', 'draftNews', 'publishedNewsCount'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
            'status' => 'required|in:published,draft',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news_images', 'public');
        } else {
            $data['image'] = null;
        }

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $data['user_id'] = FacadesAuth::user()->id; // Assuming the user is authenticated

        $news = News::create($data);
        if (!$news) {
            return redirect()->back()->withErrors(['error' => 'Gagal membuat berita.']);
        }

        return redirect()->route('news.index')->with('success', 'Berita berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        // Load the user relationship
        $news->load('user');

        return view('backend.admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('backend.admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
            'status' => 'required|in:published,draft',
            'remove_image' => 'nullable|boolean',
        ]);

        // Handle image upload/removal
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news_images', 'public');
        } elseif ($request->remove_image) {
            // Remove existing image
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = null;
        }

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $news->update($data);

        return redirect()->route('news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        // Delete associated image if exists
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus.');
    }

    public function multipleDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:news,id',
        ]);

        $newsIds = $request->input('ids');
        $newsToDelete = News::whereIn('id', $newsIds)->get();

        $deletedCount = 0;
        foreach ($newsToDelete as $news) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $news->delete();
            $deletedCount++;
        }

        if ($deletedCount > 0) {
            return redirect()->back()>with('success', 'Data terpilih berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
        }
    }
}
