<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function create()
    {
        return view('frontend.admin.events.create-event');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'time' => 'required|date',
            'place' => 'required|string|max:255',
            'link' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events-photos', 'public');
        }

        Event::create($validated);

        return redirect('/dashboard/events')->with('success-event', 'Etkinlik başarıyla eklendi!');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

        return view('frontend.admin.events.edit-event', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'time' => 'required|date',
            'place' => 'required|string|max:255',
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }

            $validated['image'] = $request->file('image')->store('events-photos', 'public');
        }

        $event->update($validated);

        return redirect('/dashboard/events')->with('success-event', 'Etkinlik başarıyla güncellendi!');
    }

    public function delete($id)
    {
        $event = Event::findOrFail($id);

        // Görseli sil
        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect('/dashboard/events')->with('success-event', 'Etkinlik başarıyla silindi!');
    }
}
