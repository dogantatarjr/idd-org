<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {

        $carousels = Carousel::orderByDesc('created_at')->paginate(6);

        return view('frontend.admin.dashboard', compact('carousels'));
    }

    public function create()
    {
        return view('frontend.admin.carousels.create-carousel');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'link' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('carousels-photos', 'public');
        }

        Carousel::create($validated);

        return redirect()->route('dashboard')->with('success-carousel', 'Carousel başarıyla eklendi!');
    }

    public function edit($id)
    {

        $carousel = Carousel::findOrFail($id);

        return view('frontend.admin.carousels.edit-carousel', compact('carousel'));
    }

    public function update(Request $request, $id)
    {
        $carousel = Carousel::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($carousel->image && Storage::disk('public')->exists($carousel->image)) {
                Storage::disk('public')->delete($carousel->image);
            }

            $validated['image'] = $request->file('image')->store('carousels-photos', 'public');
        }

        $carousel->update($validated);

        return redirect()->route('dashboard')->with('success-carousel', 'Carousel başarıyla güncellendi!');
    }

    public function delete($id)
    {
        $carousel = Carousel::findOrFail($id);

        if ($carousel->image && Storage::disk('public')->exists($carousel->image)) {
            Storage::disk('public')->delete($carousel->image);
        }

        $carousel->delete();

        return redirect()->route('dashboard')->with('success-carousel', 'Carousel başarıyla silindi!');
    }
}
