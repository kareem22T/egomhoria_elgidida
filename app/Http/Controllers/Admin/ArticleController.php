<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\DataFormController;
use App\Traits\SaveFileTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Language;
use App\Models\Category;
use App\Models\Category_Name;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Article_Title;
use App\Models\Article_Content;
use App\Models\Articles_image;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    use DataFormController;
    use SaveFileTrait;

    public function preview() {
        return view('admin.articles.preview');
    }

    public function getLanguages() {
        $languages = Language::all();
        
        return $this->jsonData(true, true, '', [], $languages);
    }

    public function getMainCategories() {
        $categories = Category::with('sub_categories')->where('cat_type', 0)->get();
        
        return $this->jsonData(true, true, '', [], $categories);
    }

    public function getArticles() {
        $Articles = Article::with('category')->orderby('id', 'desc')->paginate(10);
        
        return $this->jsonData(true, true, '', [], $Articles);
    }


    public function search(Request $request) {
        $articles = Article::with('category')
                    ->where('title', 'like', '%' . $request->search_words . '%')
                    ->orWhere('content', 'like', '%' . $request->search_words . '%')
                    ->paginate(10);

        return $this->jsonData(true, true, '', [], $articles->isEmpty() ? [] : $articles);
    }

    public function addIndex() {
        return view('admin.articles.add');
    }

    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'required',
            'author_name' => 'required'
        ], [
            'title.required' => 'من فضلك قم بكتابة عنوان الخبر',
            'author_name.required' => 'من فضلك قم بكتابة اسم الكاتب',
            'content.required' => 'من فضلك قم بكتابة محتوى الخبر',
            'thumbnail.required' => 'من فضلك اختر صورة مصغرة للخبر',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, true, 'Add failed', [$validator->errors()->first()], []);
        }

        if (!$request->cat_id) { 
            return $this->jsondata(false, true, 'Add failed', ['من فضلك قم باختيار القسم'], []);
        }

        $createArticle = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'thumbnail_path' => $request->thumbnail ? $request->thumbnail : null,
            'category_id' => $request->cat_id,
            'author_name' => $request->author_name,
        ]);

        if ($request->tags)
            foreach ($request->tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]); // Check if tag exists or create a new one
                $createArticle->tags()->attach($tag->id); // Attach the tag to the Article
            }

        if ($createArticle)
            return $this->jsonData(true, true, 'تم اضافة المقال بنجاح', [], []);
    }

    public function editIndex ($cat_id) {
        $Article = Article::find($cat_id);
        return view('admin.articles.edit')->with(compact('Article'));
    }    

    public function getArticleById(Request $request) {
        $Article = Article::with('category')->with('tags')->find($request->article_id);
        
        return $this->jsonData(true, true, '', [], $Article);
    }


    public function editArticle(Request $request) {
        $Article = Article::find($request->article_id);

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'required',
            'author_name' => 'required'
        ], [
            'title.required' => 'من فضلك قم بكتابة عنوان الخبر',
            'author_name.required' => 'من فضلك قم بكتابة اسم الكاتب',
            'content.required' => 'من فضلك قم بكتابة محتوى الخبر',
            'thumbnail.required' => 'من فضلك اختر صورة مصغرة للخبر',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, true, 'Add failed', [$validator->errors()->first()], []);
        }

        if (!$request->cat_id) { 
            return $this->jsondata(false, true, 'Add failed', ['من فضلك قم باختيار القسم'], []);
        }

        $Article->title = $request->title;
        $Article->content = $request->content;
        $Article->thumbnail_path = $request->thumbnail;
        $Article->author_name = $request->author_name;
        $Article->save();

        DB::table('article_tag')->where('article_id', $Article->id)->delete();
        if ($request->tags)
        foreach ($request->tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]); // Check if tag exists or create a new one
            $Article->tags()->attach($tag->id); // Attach the tag to the Article
        }

        if ($Article)
            return $this->jsonData(true, true, 'تم تحديث الخبر بنجاح', [], []);
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'article_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, true, 'Edit failed', [$validator->errors()->first()], []);
        }

        $Article = Article::find($request->article_id);
        $Article->delete();

        if ($Article)
            return $this->jsonData(true, true, $request->file_name . ' Article has been deleted succussfuly', [], []);
    }
}
