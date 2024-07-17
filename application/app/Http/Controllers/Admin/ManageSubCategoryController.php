<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManageSubCategoryController extends Controller
{
    public function subCategory()
    {
        $subCategory = SubCategory::latest()->get();
        // $subCategory = SubCategory::latest()->get();

        return view('admin.sub_category.index', compact('subCategory'));
    }

    public function AddsubCategory()
    {
        $category = Category::all();
        return view('admin.sub_category.form', compact('category'));
    }

    public function subCategoryStore(Request $request)
    {
        $subCat = new SubCategory();
        $subCat->category_id = $request->category_id;
        $subCat->subcategory = $request->subcategory;
        $subCat->slug = $this->createUniqueSlug($request->subcategory, SubCategory::class);
        $subCat->save();

        $notification = array(
            'message'   => 'SubCategory Inserted Succesfuly',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all.sub.category')->with($notification);
    }

    public function editsubCategory($slug)
    {
        // dd($slug);

        $subCategory = SubCategory::where('slug', $slug)->first();

        $category = Category::all();

        return view('admin.sub_category.edit', compact('subCategory', 'category'));
    }

    protected function createUniqueSlug($title, $model)
    {
        // ei code block ta ensure kore je database e slug always unique thakbe, 
        // jodi kono duplicate slug thake tahole oitar shathe number add kore ekta unique slug generate kora hoy.
        
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while ($model::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function updateSubCategory(Request $request, $slug)
    {
        $subCat  = SubCategory::where('slug', $slug)->first();

        if ($subCat) {
            $subCat->category_id = $request->category_id;
            $subCat->subcategory = $request->subcategory;
            $subCat->save();

            $notification = array(
                'message'   => 'SubCategory Updated Succesfuly',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'SubCategory Not Found',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function deleteSubCategory($slug)
    {
        $delete = SubCategory::where('slug', $slug)->first();

        if ($delete) {
            $delete->delete();

            $notification = array(
                'message'   => 'SubCategory Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.all.sub.category')->with($notification);
        }

        $notification = array(
            'message'   => 'SubCategory Not Found',
            'alert-type' => 'error'
        );
        return redirect()->route('admin.all.sub.category')->with($notification);
    }

    
}
