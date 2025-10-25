<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    public function create()
    {
        return view('frontend.admin.campaigns.create-campaign');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('campaigns-photos', 'public');
        }

        Campaign::create($validated);

        return redirect('/dashboard/campaigns')->with('success-campaign', 'Kampanya başarıyla eklendi!');
    }

    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);

        return view('frontend.admin.campaigns.edit-campaign', compact('campaign'));
    }

    public function update(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($campaign->image && Storage::disk('public')->exists($campaign->image)) {
                Storage::disk('public')->delete($campaign->image);
            }

            $validated['image'] = $request->file('image')->store('campaigns-photos', 'public');
        }

        $campaign->update($validated);

        return redirect('/dashboard/campaigns')->with('success-campaign', 'Kampanya başarıyla güncellendi!');
    }

    public function delete($id)
    {
        $campaign = Campaign::findOrFail($id);

        // Görseli sil
        if ($campaign->image && Storage::disk('public')->exists($campaign->image)) {
            Storage::disk('public')->delete($campaign->image);
        }

        $campaign->delete();

        return redirect('/dashboard/campaigns')->with('success-campaign', 'Kampanya başarıyla silindi!');
    }
}
