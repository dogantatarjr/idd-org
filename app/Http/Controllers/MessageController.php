<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Message::create($validated);

        return redirect()->back()->with('success', 'Mesajınız başarıyla gönderildi!');
    }

    public function markRead(Message $message)
    {
        $message->status = "passive";
        $message->save();

        // AJAX isteği kontrolü
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Mesaj okundu olarak işaretlendi.',
                'status' => 'passive'
            ]);
        }

        return redirect()->back()->with('success', 'Mesaj okundu olarak işaretlendi.');
    }

    public function markUnread(Message $message)
    {
        $message->status = "active";
        $message->save();

        // AJAX isteği kontrolü
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Mesaj okunmadı olarak işaretlendi.',
                'status' => 'active'
            ]);
        }

        return redirect()->back()->with('success', 'Mesaj okunmadı olarak işaretlendi.');
    }
}
