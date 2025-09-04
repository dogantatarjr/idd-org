@auth

    @php
        $message = "";
        $icon = "";
        $color = "";
        $hour = \Carbon\Carbon::now('Europe/Istanbul')->hour;

        if ($hour > 6 && $hour < 12) {
            $message = "Günaydın";
            $icon = "sun";
            $color = "warning";
        } elseif ($hour > 12 && $hour < 18) {
            $message = "İyi Günler";
            $icon = "coffee";
            $color = "success";
        } elseif($hour > 18 && $hour < 23){
            $message = "İyi Akşamlar";
            $icon = "laptop";
            $color = "primary";
        } else {
            $message = "İyi Geceler";
            $icon = "moon";
            $color = "secondary";
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
