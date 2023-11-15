@extends('site.layouts.main')

@section('title', $article ? $article->title : '404')

@section('content')
@if ($article)
<main class="aritcle">
    <div class="container">
        <section class="article">
            <aside></aside>
            <article>
                <h1>{{ $article->title }}</h1>
                <div class="thumbnail">
                    <img src="{{ $article->thumbnail_path }}" alt="">
                </div>
                <h4>{{ $article->category->main_name }}</h4>
                <p>
                    <span>للكاتب: {{ $article->author_name }}</span> <br>
                    {!! $article->content !!}
                </p>
            </article>
            <div class="ad_wrapper">
                <section class="ad"></section>
            </div>
        </section>
    </div>
</main>
@endif
@endsection

@section('scripts')
<script>
    var swiper = new Swiper(".mainSwiper", {
      navigation: {
        nextEl: ".mainSwiper-swiper-button-next",
        prevEl: ".mainSwiper-swiper-button-prev",
      },
      spaceBetween: 30,
      pagination: {
        el: ".mainSwiper-swiper-pagination",
      },
    });
    var swiper = new Swiper(".catSwiper", {
      navigation: {
        nextEl: ".mainSwiper-swiper-button-next",
        prevEl: ".mainSwiper-swiper-button-prev",
      },
      spaceBetween: 30,
      pagination: {
        el: ".mainSwiper-swiper-pagination",
      },
    });
</script>
@endsection
