<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\DataFormController;
use App\Traits\SaveFileTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Home_category;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    use DataFormController;
    use SaveFileTrait;

    public function index() {
        return view('admin.edit-home');
    }

    public function savePageContent(Request $request) {
        $validator = Validator::make($request->all(), [
            'categories' => 'required|min:1',
        ], [
            'categories.required' => 'يجب اختيار ع الاقل قسم واحد',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, true, 'upload failed', [$validator->errors()->first()], []);
        }

        Home_category::truncate();

        foreach ($request->categories as $category) {
            $cat = Category::find($category);
            $saveCategories = Home_category::create([
                'name' => $cat->main_name,
                'category_id' => $category
            ]);
        }

        return $this->jsondata(true, true, 'تم حفظ المحتوى بنجاح', [], []);
    }

    public function returnHomeCategories() {
        $categories = Home_category::all();

        // Get the category ID in an array
        $categoryIds = $categories->pluck('id')->toArray();

        // Get the category name in an array
        $categoryNames = $categories->pluck('name')->toArray();

        return $this->jsondata(true, true, 'عملية ناجحة', [], ["ids" => $categoryIds, "names" => $categoryNames]);
    }

}
