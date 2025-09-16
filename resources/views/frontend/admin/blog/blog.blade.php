@extends('frontend.admin.master')

@section('topbar-header', 'Aktif Blog Yazıları')

@section('topbar-icon', 'fas fa-check-circle')

@section('blog-sit', 'active')

@section('content')

<div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-auto">

                @if(session('success-article'))
                    <div class="alert alert-success">
                        {{ session('success-article') }}
                    </div>
                @endif

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($articles as $article)
                        @include('frontend.admin.blog.article-card')
                    @endforeach
                </div>

                <div class="d-flex justify-content-center fw-bold">
                    {{ $articles->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        <br><br>

</div>

@endsection
