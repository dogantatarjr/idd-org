<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Podcast;
use Illuminate\Support\Facades\Storage;

class PodcastController extends Controller
{
    public function create()
    {
        return view('frontend.admin.podcasts.create-podcast');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'time' => 'required|string',
            'link' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('podcasts-photos', 'public');
        }

        Podcast::create($validated);

        return redirect('/dashboard/podcasts')->with('success-podcast', 'Podcast başarıyla eklendi!');
    }

    public function edit($id)
    {
        $podcast = Podcast::findOrFail($id);

        return view('frontend.admin.podcasts.edit-podcast', compact('podcast'));
    }

    public function update(Request $request, $id)
    {
        $podcast = Podcast::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'time' => 'required|string',
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($podcast->image && Storage::disk('public')->exists($podcast->image)) {
                Storage::disk('public')->delete($podcast->image);
            }

            $validated['image'] = $request->file('image')->store('podcasts-photos', 'public');
        }

        $podcast->update($validated);

        return redirect('/dashboard/podcasts')->with('success-podcast', 'Podcast başarıyla güncellendi!');
    }

    public function delete($id)
    {
        $podcast = Podcast::findOrFail($id);

        // Görseli sil
        if ($podcast->image && Storage::disk('public')->exists($podcast->image)) {
            Storage::disk('public')->delete($podcast->image);
        }

        $podcast->delete();

        return redirect('/dashboard/podcasts')->with('success-podcast', 'Podcast başarıyla silindi!');
    }
}
