<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::where('status', 'published')->latest();
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }
        
        // Category filter if needed
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }
        
        $news = $query->paginate(9);
        
        return view('frontend.news.index', compact('news'));
    }
    
    public function show($id)
    {
        $news = News::where('status', 'published')->findOrFail($id);
        
        // Get related news
        $relatedNews = News::where('status', 'published')
            ->where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();
        
        return view('frontend.news.show', compact('news', 'relatedNews'));
    }
}
