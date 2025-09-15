@extends('frontend.admin.master')

@section('topbar-header', 'Blog Yazıları')

@section('topbar-icon', 'fas fa-pencil-square')

@section('blog-sit', 'active')

@section('content')

<div class="container-fluid">
    <h2 class="fw-bold">En Son Yazılar</h2><br>
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

        @if(!empty($pendingArticles) && $pendingArticles->count() > 0)
            <hr class="my-5">
            <h2 class="fw-bold">Onay Bekleyen Yazılar</h2><br>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($pendingArticles as $article)
                    @include('frontend.admin.blog.article-card')
                @endforeach
            </div>

            <div class="d-flex justify-content-center fw-bold">
                {{ $pendingArticles->links('pagination::bootstrap-5') }}
            </div>
        @endif

        @if(!empty($passiveArticles) && $passiveArticles->count() > 0)
            <hr class="my-5">
            <h2 class="fw-bold">Pasif Yazılar</h2><br>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($passiveArticles as $article)
                    @include('frontend.admin.blog.article-card')
                @endforeach

                <div class="d-flex justify-content-center fw-bold">
                    {{ $passiveArticles->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif

        <br><br>

</div>

@endsection
