<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\LanguagesController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\WordsController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\ImagesController;
use App\Http\Controllers\Admin\HomeController;

Route::middleware(['guest_admin'])->group(function () {
    Route::get('/login', [RegisterController::class, 'getLoginIndex']);
    Route::post('/login', [RegisterController::class, 'login']);
});

Route::post('/admin/categories/get-languages', [CategoriesController::class, 'getLanguages'])->name('languages.get');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/', [RegisterController::class, 'ff'])->name('admin.dashboard');
    Route::get('/logout', [RegisterController::class, 'logout']);

    Route::get('/edit-home', [HomeController::class, 'index'])->name('home.edit');
    Route::post('/save-home', [HomeController::class, 'savePageContent'])->name('save.home');
    Route::get('/get-categories-home', [HomeController::class, 'returnHomeCategories'])->name('get.homeCategories');

    //tags
    Route::get('/tags', [TagsController::class, 'preview']);
    Route::post('/tags', [TagsController::class, 'getTags']);
    Route::post('/tags/search', [TagsController::class, 'search']);
    Route::post('/tags/edit', [TagsController::class, 'editTag']);
    Route::post('/tags/delete', [TagsController::class, 'delete']);
    Route::get('/tags/add', [TagsController::class, 'addIndex']);
    Route::post('/tags/add', [TagsController::class, 'add']);
    Route::get('/tags/content', [TagsController::class, 'contentIndex']);
    Route::post('/tags/content/update', [TagsController::class, 'updateContentFile']);

    //categories
    Route::get('/categories', [CategoriesController::class, 'preview']);
    Route::post('/categories/main', [CategoriesController::class, 'getMainCategories']);
    Route::post('/categories/sub', [CategoriesController::class, 'getSubCategories']);
    Route::post('/category', [CategoriesController::class, 'getCategoryById']);
    Route::get('/category/{cat_id}', [CategoriesController::class, 'getCategoryIndex']);
    Route::post('/category/names', [CategoriesController::class, 'getCategoryNames']);
    Route::post('/categories/get-languages', [CategoriesController::class, 'getLanguages']);
    Route::post('/categories/search', [CategoriesController::class, 'search']);
    Route::post('/categories/delete', [CategoriesController::class, 'delete']);
    Route::get('/categories/add', [CategoriesController::class, 'addIndex'])->name('category.add');
    Route::post('/categories/add', [CategoriesController::class, 'add']);
    Route::get('/categories/edit/', [CategoriesController::class, 'preview']);
    Route::post('/categories/edit', [CategoriesController::class, 'editCategory']);
    Route::get('/categories/edit/{cat_id}', [CategoriesController::class, 'editIndex']);

    //articles
    Route::get('/articles', [ArticleController::class, 'preview']);
    Route::post('/articles', [ArticleController::class, 'getArticles']);
    Route::post('/categories', [ArticleController::class, 'getMainCategories']);
    Route::post('/article', [ArticleController::class, 'getArticleById']);
    Route::post('/article/titles', [ArticleController::class, 'getArticleTitles']);
    Route::post('/article/contents', [ArticleController::class, 'getArticleContents']);
    Route::post('/articles/get-languages', [ArticleController::class, 'getLanguages']);
    Route::post('/articles/search', [ArticleController::class, 'search']);
    Route::post('/articles/delete', [ArticleController::class, 'delete']);
    Route::get('/articles/add', [ArticleController::class, 'addIndex'])->name('article.add');
    Route::post('/articles/add', [ArticleController::class, 'add']);
    Route::get('/articles/edit/', [ArticleController::class, 'preview']);
    Route::post('/articles/edit', [ArticleController::class, 'editArticle']);
    Route::get('/articles/edit/{article_id}', [ArticleController::class, 'editIndex']);

    // images
    Route::post('/images/upload', [ImagesController::class, 'uploadeImg']);
    Route::get('/images/get_images', [ImagesController::class, 'getImages']);
    Route::post('/images/search', [ImagesController::class, 'search']);
});

