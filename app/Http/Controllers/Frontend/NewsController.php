<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutVillage;
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
        $aboutVillage = AboutVillage::first();
        $totalPeople = $aboutVillage->people_total ?? 0;
        $totalFamilies = $aboutVillage->family_total ?? 0;
        $totalBloks = $aboutVillage->blok_total ?? 0;
        $totalPrograms = $aboutVillage->program_total ?? 0;
        $description = $aboutVillage->description ?? '';
        $visi = $aboutVillage->visi ?? '';
        $misi = $aboutVillage->misi ?? '';
        $location = $aboutVillage->location ?? '';
        $telp = $aboutVillage->no_telp ?? '';
        $email = $aboutVillage->email ?? '';

        return view('frontend.news.index', compact('news', 'totalPeople', 'totalFamilies', 'totalBloks', 'totalPrograms', 'description', 'visi', 'misi', 'location', 'telp', 'email'));
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

        $aboutVillage = AboutVillage::first();
        $totalPeople = $aboutVillage->people_total ?? 0;
        $totalFamilies = $aboutVillage->family_total ?? 0;
        $totalBloks = $aboutVillage->blok_total ?? 0;
        $totalPrograms = $aboutVillage->program_total ?? 0;
        $description = $aboutVillage->description ?? '';
        $visi = $aboutVillage->visi ?? '';
        $misi = $aboutVillage->misi ?? '';
        $location = $aboutVillage->location ?? '';
        $telp = $aboutVillage->no_telp ?? '';
        $email = $aboutVillage->email ?? '';

        return view('frontend.news.show', compact('news', 'relatedNews', 'totalPeople', 'totalFamilies', 'totalBloks', 'totalPrograms', 'description', 'visi', 'misi', 'location', 'telp', 'email'));
    }
}
