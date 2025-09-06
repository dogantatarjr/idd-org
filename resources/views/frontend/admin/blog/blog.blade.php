@extends('frontend.admin.master')

@section('topbar-header', 'Blog Yönetimi')

@section('topbar-icon', 'fas fa-blog')

@section('blog-sit', 'active')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-left">
        <div class="col-auto">

            <h2 class="fw-bold">En Son Yazılar</h2><br>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($articles as $article)
                    <div class="col">
                        <div class="card h-100">
                        <img src="{{ $article->image }}" class="card-img-top" alt="article-image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>

                            @php
                                $maxWords = 25;

                                $text = $article->content;

                                $words = Str::words($text, $maxWords, '');

                                $lastPeriodPos = strrpos($words, '.');

                                if ($lastPeriodPos !== false) {
                                    $words = substr($words, 0, $lastPeriodPos + 1) . '..';
                                } else {
                                    $words .= '...';
                                }
                            @endphp

                            <p class="card-text">{{ $words }}</p>
                            <p class="card-text text-uppercase">{{ $categories->where('id', $article->category_id)->first()->name }}</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary">En son güncelleme ~{{ round($article->updated_at->diffInDays(\Carbon\Carbon::now('Europe/Istanbul'))) }} gün önce</small>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center fw-bold">
                {{ $articles->links('pagination::bootstrap-5') }}
            </div>

            <br><h2 class="fw-bold">Kategoriler</h2><br>

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <table class="table table-hover" style="text-align: center; border-radius: 10px; overflow: hidden;">
                            <thead style="background-color: #6c757d;">
                                <tr>
                                    <th scope="col" style="color: white; background-color: gray; padding: 15px;">Kategori ID</th>
                                    <th scope="col" style="color: white; background-color: gray; padding: 15px;">Kategori Adı</th>
                                    <th scope="col" style="color: white; background-color: gray; padding: 15px;">Yazı Sayısı</th>
                                    <th scope="col" style="color: white; background-color: gray; padding: 15px;">Kategori Durumu</th>
                                    <th scope="col" style="color: white; background-color: gray; padding: 15px;">Kategoriyi Düzenle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <th scope="row" style="padding: 15px;">{{ $category->id }}</th>
                                        <td style="padding: 15px;">
                                            <a href="javascript:void(0)" style="text-decoration: none; color: #007bff; cursor: pointer;"
                                                onclick="showCategoryDetails({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ $category->created_at->format('d.m.Y H:i') }}', '{{ $category->status }}')">
                                                {{ $category->name }}
                                            </a>
                                        </td>
                                        <td style="padding: 15px; text-color: dark;">{{ \App\Models\Article::where('category_id', $category->id)->count() }}</td>
                                        <td style="padding: 15px;">
                                            <span class="badge badge-pill" style="background-color: {{ $category->status === 'active' ? 'green' : ($category->status === 'passive' ? 'gray' : 'red') }}; color: white;">{{ $category->status }}</span>
                                        </td>
                                        <td style="padding: 15px;">
                                            <i class="fas fa-edit" href="javascript:void(0)" style="cursor: pointer; color: orange;"
                                                onclick="showCategoryEdit({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ $category->status }}')">
                                            </i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn btn-success" data-toggle="modal" onclick="showCategoryAdd()">
                                <i class="fas fa-plus" href="javascript:void(0)"></i> Yeni Kategori
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <br><br>

        </div>
    </div>
</div>

@include('frontend.admin.blog.category-detail')

@include('frontend.admin.blog.category-edit')

@include('frontend.admin.blog.category-add')

@endsection
