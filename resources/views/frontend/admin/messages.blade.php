@extends('frontend.admin.master')

@section('topbar-header', 'Mesajlar')

@section('topbar-icon', 'fas fa-envelope')

@section('messages-sit', 'active')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-auto">
            @if($messages->count())
                <table class="table table-hover align-middle">
                    <thead class="table-secondary">
                        <tr class="text-center" style="border-radius: 0.5rem 0.5rem 0 0; overflow: hidden;">
                            <th class="text-center rounded-top-start" style="border-top-left-radius: 0.5rem;">Ad</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Konu</th>
                            <th class="text-center">Mesaj</th>
                            <th class="text-center">Tarih</th>
                            <th class="text-center rounded-top-end" style="border-top-right-radius: 0.5rem;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td class="py-4 px-4 align-middle">
                                    {{ $message->name }}
                                </td>
                                <td class="py-4 px-4 align-middle">
                                    {{ $message->email }}
                                </td>
                                <td class="py-4 px-4 align-middle">
                                    {{ Str::limit($message->subject, 30) }}
                                </td>
                                <td class="py-4 px-4 align-middle">
                                    <span class="text-secondary fst-italic">"{{ Str::limit($message->message, 80) }}"</span>
                                </td>
                                <td class="py-4 px-4 align-middle">
                                    <span class="badge bg-light text-dark border">
                                        <i class="far fa-calendar me-1"></i>
                                        {{ $message->created_at->format('d.m.Y H:i') }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 align-middle text-end">
                                    <button type="submit" class="btn btn-outline-success btn-sm">
                                        <i class="fas fa-external-link-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center fw-bold mt-4">
                    {{ $messages->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center p-5">
                    <i class="fas fa-envelope fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Henüz hiç mesaj yok.</h5>
                    <p class="text-muted">İletişim formundan gelen mesajlar burada görünecektir.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
