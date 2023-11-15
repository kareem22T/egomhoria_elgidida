@extends('admin.layouts.admin-layout')

@section('title', 'اضافة قسم')

@section('categories_add_active', 'active')

@section('content')
<h1 class="mb-5 page-title text-center">
    محتوى الصفحة الرئيسية
</h1>
<div id="edit_home">
    <div class="w-100 mb-3">
        <textarea name="news" id="news" cols="30" rows="5" placeholder="شريط الاخبار" class="form-control" v-model="news_bar"></textarea>
    </div>
    <div class="mb-3 w-100">
        <label for="categories" class="d-block mb-2">اقسام الصفحة الرئيسية</label>
        <div class="w-100 d-flex gap-2 mb-3" style="position: relative">
            <select v-if="categories_data" v-model="catInput" id="categories" @change="getCategoryText" @keydown.enter="addTag" placeholder="اقسام الصفحة الرئيسية ..." class="form-control">
                <option v-for="(category, index) in categories_data" :key="index" :value="category.id" v-if="categories_data.length > 0">
                    @{{category.main_name}}
                </option>
            </select>
            <button class="btn btn-secondary w-25 button-secondary" @click="addTag">اضافة قسم</button>
            <div class="suggestions card p-2 w-100" style="position: absolute; top: calc(100% + 10px);
            lef: 0; max-height: 132px; overflow: auto;" v-if="search_categories && search_categories.length > 0">
                <div class="p-1 btn btn-light mb-1" style="text-align: left;padding: .3rem 1rem !important" v-for="tag in search_categories" :key="tag.id"  @click="this.catInput = tag.name; addTag(); this.search_categories = []" > @{{tag.name}} </div>
            </div>
        </div>
        <ul class="d-flex gap-2 flex-wrap-wrap">
            <li v-for="(tag, index) in prevCategories" :key="index" class="btn btn-light">
                @{{ tag }}
                <button @click="removeTag(index)" class="ti ti-x" style="background: transparent; border: none; cursor: pointer;"></button>
            </li>
        </ul>
    </div>
    <button class="button btn btn-primary w-25" @click="saveHomeContent(news_bar, categories)">حفظ</button>
</div>
@endsection

@section('styles')
<style>
    .swiper-button-next, .swiper-button-prev {
        width: fit-content !important;
        height: fit-content !important;
        padding: 4px !important;
        display: flex !important;
        bottom: 0 !important;
        top: auto;
        z-index: 9999;
    }
    .swiper-pagination {
        bottom: 0
    }
    .swiper-button-next::after, .swiper-button-prev::after {
        content: ""
    }
</style>
@endsection

@section('scripts')
<!-- Swiper JS -->

<!-- Initialize Swiper -->
<script>
const { createApp, ref } = Vue;

createApp({
  data() {
    return {
        categories: [],
        prevCategories: [],
        category: '',
        catInput: '',
        categories_data: null,
        news_bar: '',
    }
  },
  methods: {
    getCategoryText(event) {
      const selectedIndex = event.target.selectedIndex;
      this.category = event.target.options[selectedIndex].text;
    },
    addTag() {
      if (this.category.trim() !== '' && this.catInput !== '') {
        this.prevCategories.push(this.category.trim());
        this.category = '';
        this.categories.push(this.catInput);
        this.catInput = '';
      }
    },
    removeTag(index) {
      this.categories.splice(index, 1);
      this.prevCategories.splice(index, 1);
    },
    async getCategories() {
        $('.loader').fadeIn().css('display', 'flex')
        try {
            const response = await axios.post(`/elgomhoria/admin/categories/main`, {
                cat: 'cat'
            },
            );
            if (response.data.status === true) {
                $('.loader').fadeOut()
                this.categories_data = response.data.data
            } else {
                $('.loader').fadeOut()
                document.getElementById('errors').innerHTML = ''
                $.each(response.data.errors, function (key, value) {
                    let error = document.createElement('div')
                    error.classList = 'error'
                    error.innerHTML = value
                    document.getElementById('errors').append(error)
                });
                $('#errors').fadeIn('slow')
                setTimeout(() => {
                    $('input').css('outline', 'none')
                    $('#errors').fadeOut('slow')
                }, 5000);
            }

        } catch (error) {
            document.getElementById('errors').innerHTML = ''
            let err = document.createElement('div')
            err.classList = 'error'
            err.innerHTML = 'server error try again later'
            document.getElementById('errors').append(err)
            $('#errors').fadeIn('slow')
            $('.loader').fadeOut()
            this.languages_data = false
            setTimeout(() => {
                $('#errors').fadeOut('slow')
            }, 3500);

            console.error(error);
        }
    },
    async getHomeCategories() {
        $('.loader').fadeIn().css('display', 'flex')
        try {
            const response = await axios.get(`{{route('get.homeCategories')}}`);
            if (response.data.status === true) {
                $('.loader').fadeOut()
                this.categories = response.data.data.ids
                this.prevCategories = response.data.data.names
            } else {
                $('.loader').fadeOut()
                document.getElementById('errors').innerHTML = ''
                $.each(response.data.errors, function (key, value) {
                    let error = document.createElement('div')
                    error.classList = 'error'
                    error.innerHTML = value
                    document.getElementById('errors').append(error)
                });
                $('#errors').fadeIn('slow')
                setTimeout(() => {
                    $('input').css('outline', 'none')
                    $('#errors').fadeOut('slow')
                }, 5000);
            }

        } catch (error) {
            document.getElementById('errors').innerHTML = ''
            let err = document.createElement('div')
            err.classList = 'error'
            err.innerHTML = 'server error try again later'
            document.getElementById('errors').append(err)
            $('#errors').fadeIn('slow')
            $('.loader').fadeOut()
            this.languages_data = false
            setTimeout(() => {
                $('#errors').fadeOut('slow')
            }, 3500);

            console.error(error);
        }
    },
    async saveHomeContent(news_bar, categories) {
        $('.loader').fadeIn().css('display', 'flex')
        try {
            const response = await axios.post(`{{ route('save.home') }}`, {
                news_bar: news_bar,
                categories: categories
            },
            );
            if (response.data.status === true) {
                document.getElementById('errors').innerHTML = ''
                let error = document.createElement('div')
                error.classList = 'success'
                error.innerHTML = response.data.message
                document.getElementById('errors').append(error)
                $('#errors').fadeIn('slow')
                $('.loader').fadeOut()
                location.reload()
                setTimeout(() => {
                    $('#errors').fadeOut('slow')
                }, 2000);
            } else {
                $('.loader').fadeOut()
                document.getElementById('errors').innerHTML = ''
                $.each(response.data.errors, function (key, value) {
                    let error = document.createElement('div')
                    error.classList = 'error'
                    error.innerHTML = value
                    document.getElementById('errors').append(error)
                });
                $('#errors').fadeIn('slow')
                setTimeout(() => {
                    $('input').css('outline', 'none')
                    $('#errors').fadeOut('slow')
                }, 5000);
            }

        } catch (error) {
            document.getElementById('errors').innerHTML = ''
            let err = document.createElement('div')
            err.classList = 'error'
            err.innerHTML = 'server error try again later'
            document.getElementById('errors').append(err)
            $('#errors').fadeIn('slow')
            $('.loader').fadeOut()
            this.languages_data = false
            setTimeout(() => {
                $('#errors').fadeOut('slow')
            }, 3500);

            console.error(error);
        }
    },
  },
  mounted() {
    $('.loader').fadeOut()
  },
  created() {
    this.getCategories()
    this.getHomeCategories()
  },
}).mount('#edit_home')
</script>
<script>
window.onload = function() {
    setTimeout(() => {
        var swiper = new Swiper(".mySwiper", {
                pagination: {
                    el: ".swiper-pagination",
                    type: "fraction",
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
            },
        });
    }, 3000);
}
</script>

@endsection