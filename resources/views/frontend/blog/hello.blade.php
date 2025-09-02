@auth
    <div class="col-12 mb-4">
        <div class="alert alert-success d-flex align-items-center shadow-sm" role="alert">
            <i class="fa fa-user-circle fa-2x me-3"></i>
            <div>
                @php
                    $message = "";
                    $hour = \Carbon\Carbon::now('Europe/Istanbul')->hour;

                    if ($hour < 12) {
                        $message = "Günaydın";
                    } elseif ($hour < 18) {
                        $message = "İyi Günler";
                    } else {
                        $message = "İyi Akşamlar";
                    }
                @endphp

                <strong>{{ $message }}, {{ Auth::user()->name }}!</strong>
            </div>
        </div>
    </div>
@endauth
