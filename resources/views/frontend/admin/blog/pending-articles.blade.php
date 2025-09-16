@extends('frontend.admin.master')

@section('topbar-header', 'Beklemedeki Blog Yazıları')

@section('topbar-icon', 'fas fa-clock')

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

                @if (empty($pendingArticles) || $pendingArticles->count() == 0)
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle" style="padding-right: 5px;"></i> Beklemede herhangi bir yazı bulunmamaktadır.
                    </div>
                @endif

                @if(!empty($pendingArticles) && $pendingArticles->count() > 0)
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach ($pendingArticles as $article)
                            @include('frontend.admin.blog.article-card')
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center fw-bold">
                        {{ $pendingArticles->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>

        <br><br>

</div>

@endsection
