@extends('site.layouts.main')

@section('title', 'الرئيسية')

@section('content')
<main class="home">
    <div class="container">
        <div class="col-1">
            <div class="ad_wrapper">
                <section class="ad"></section>
            </div>
            <section class="latest">
                <div class="cat-head">
                    <div class="cat">
                        الاحدث                    
                    </div>
                    <span></span>
                </div>
                @if($latestArticles && count($latestArticles) > 0)
                    @foreach ($latestArticles as $article)
                        <a href="article/{{$article->id}}" class="card">
                            <p>
                                {{ $article->title }}
                            </p>
                            <div class="img">
                                <img src="{{ $article->thumbnail_path }}" alt="">
                            </div>
                        </a>
                    @endforeach
                @endif
                <div class="cat-head" style="margin-top: 30px;">
                    <div class="cat">
                        الاكثر قراءة                    
                    </div>
                    <span></span>
                </div>
                <div class="card">
                    <p>
                        المعارضة بالغابون نطالب الانقلابيين بالاعتراف بفوزنا في الانتخابات
                    </p>
                    <div class="img">
                        <img src="{{ asset('/public/site/imgs/latest-1.jpeg') }}" alt="">
                    </div>
                </div>
                <div class="card">
                    <p>
                        النزاع مستمر.. قصف جوي ومدفعي واشتباكات في الخرطوم
                    </p>
                    <div class="img">
                        <img src="{{ asset('/public/site/imgs/latest-1.jpeg') }}" alt="">
                    </div>
                </div>
                <div class="card">
                    <p>
                        المعارضة بالغابون نطالب الانقلابيين بالاعتراف بفوزنا في الانتخابات
                    </p>
                    <div class="img">
                        <img src="{{ asset('/public/site/imgs/latest-1.jpeg') }}" alt="">
                    </div>
                </div>
                <div class="card">
                    <p>
                        المعارضة بالغابون نطالب الانقلابيين بالاعتراف بفوزنا في الانتخابات
                    </p>
                    <div class="img">
                        <img src="{{ asset('/public/site/imgs/latest-1.jpeg') }}" alt="">
                    </div>
                </div>
            </section>
        </div>
        <div class="col-2">
            <div class="swiper mainSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="thumbnail">
                            <img src="{{ asset('/public/site/imgs/main-slider.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h2>“عنوان الخبر”</h2>
                            <p>
                                <span>للكاتب: حسام البحيري</span><br>
                                رئيس الوزراء: مركز السيطرة بالقاهرة جزء من منظومة كبرى تنفذها الدولة بالمحافظات بهدف إدارة الأزمات.. "مجمع أديان" يضم مباني تاريخية تخص الديانات السماوية الثلاث
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="thumbnail">
                            <img src="{{ asset('/public/site/imgs/main-slider.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h2>“عنوان الخبر”</h2>
                            <p>
                                <span>للكاتب: حسام البحيري</span><br>
                                رئيس الوزراء: مركز السيطرة بالقاهرة جزء من منظومة كبرى تنفذها الدولة بالمحافظات بهدف إدارة الأزمات.. "مجمع أديان" يضم مباني تاريخية تخص الديانات السماوية الثلاث
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="thumbnail">
                            <img src="{{ asset('/public/site/imgs/main-slider.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h2>“عنوان الخبر”</h2>
                            <p>
                                <span>للكاتب: حسام البحيري</span><br>
                                رئيس الوزراء: مركز السيطرة بالقاهرة جزء من منظومة كبرى تنفذها الدولة بالمحافظات بهدف إدارة الأزمات.. "مجمع أديان" يضم مباني تاريخية تخص الديانات السماوية الثلاث
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mainSwiper-swiper-button-next"><i class="fa-solid fa-angle-right"></i></div>
                <div class="mainSwiper-swiper-button-prev"><i class="fa-solid fa-angle-left"></i></div>
                <div class="mainSwiper-swiper-pagination"></div>
            </div>
            <section class="categories">
                @if ($categories_per_home && count($categories_per_home )> 0)
                    @foreach ($categories_per_home as $category)                            
                        <div class="swiper catSwiper">
                            <div class="swiper-wrapper">
                                @foreach ($category->articles as $article)
                                    <a href="article/{{$article->id}}" class="swiper-slide">
                                        <div class="thumbnail">
                                            <img src="{{ $article->thumbnail_path }}" alt="">
                                        </div>
                                        <div class="text">
                                            <div class="cat-head">
                                                <span></span>
                                                <div class="cat">
                                                    {{$category->main_name}}                    
                                                </div>
                                            </div>
                                            <p>
                                                {{ $article->title }}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="navYpag">
                                <div class="mainSwiper-swiper-button-prev"><i class="fa-solid fa-angle-left"></i></div>
                                <div class="mainSwiper-swiper-pagination"></div>
                                <div class="mainSwiper-swiper-button-next"><i class="fa-solid fa-angle-right"></i></div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </section>
        </div>
        <div class="col-3">
            <div class="ad_wrapper">
                <section class="ad"><img src="" alt=""></section>
            </div>
            <div class="ad_wrapper">
                <section class="ad"></section>
            </div>
            <div class="ad_wrapper">
                <section class="ad"></section>
            </div>
        </div>
    </div>
</main>
{{-- <section class="more">
    <div class="container">
        <div>
            <span>اقرأ المزيد من جميع الاقسام</span>
            عاجل _ الاخبار  _ سياسة _ رآي _ فن وثقافة
            المرآة _ رياضة _ حوادث _ اقتصاد _ تحقيقات _ منوعات
        </div>
    </div>
</section> --}}
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
