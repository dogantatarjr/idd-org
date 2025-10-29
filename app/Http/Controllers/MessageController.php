<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Message;

class MessageController extends Controller
{
    public function submit(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required',
        ]);

        // Google reCAPTCHA v2 doğrulaması
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $result = $response->json();

        if (!($result['success'] ?? false)) {
            return back()->withErrors(['g-recaptcha-response' => 'Lütfen reCAPTCHA doğrulamasını tamamlayın.'])->withInput();
        }

        Message::create($request->only('name', 'email', 'subject', 'message'));

        return back()->with('success', 'Mesajınız başarıyla gönderildi!');
    }

    public function markRead(Message $message)
    {
        $message->update(['status' => 'passive']);

        return response()->json([
            'success' => true,
            'message' => 'Mesaj okundu olarak işaretlendi.'
        ]);
    }

    public function markUnread(Message $message)
    {
        $message->update(['status' => 'active']);

        return response()->json([
            'success' => true,
            'message' => 'Mesaj okunmadı olarak işaretlendi.'
        ]);
    }

}
