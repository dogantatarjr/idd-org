@extends('frontend.admin.master')

@section('topbar-header', 'Pasif Blog Yazıları')

@section('topbar-icon', 'fas fa-minus-circle')

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

                @if (empty($passiveArticles) || $passiveArticles->count() == 0)
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle" style="padding-right: 5px;"></i> Pasif durumda herhangi bir yazı bulunmamaktadır.
                    </div>
                @endif

                @if(!empty($passiveArticles) && $passiveArticles->count() > 0)
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach ($passiveArticles as $article)
                            @include('frontend.admin.blog.article-card')
                        @endforeach

                        <div class="d-flex justify-content-center fw-bold">
                            {{ $passiveArticles->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <br><br>

</div>

@endsection
