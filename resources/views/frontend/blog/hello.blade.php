@auth

    @php
        $message = "";
        $icon = "";
        $color = "";
        $hour = \Carbon\Carbon::now('Europe/Istanbul')->hour;

        if ($hour >= 0 && $hour < 6) {
            $message = "İyi Geceler";
            $icon = "moon";
            $color = "secondary";
        } elseif ($hour >= 18) {
            $message = "İyi Akşamlar";
            $icon = "coffee";
            $color = "primary";
        } elseif($hour >= 12){
            $message = "İyi Günler";
            $icon = "laptop";
            $color = "success";
        } else {
            $message = "Günaydın";
            $icon = "sun";
            $color = "warning";
        }
    @endphp

    <div class="col-12 mb-4">
        <div class="alert alert-{{ $color }} d-flex align-items-center shadow-sm" role="alert">
            <i class="fa fa-{{ $icon }} fa-2x me-3"></i>
            <div>
                <strong>{{ $message }}, {{ Auth::user()->name }}!</strong>
            </div>
        </div>
    </div>
@endauth
