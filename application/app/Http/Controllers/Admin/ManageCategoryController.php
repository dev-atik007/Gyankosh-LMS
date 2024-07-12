<?php

namespace App\Http\Controllers\Admin;


use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;



class ManageCategoryController extends Controller
{
    public function category()
    {
        $category = Category::latest()->get();

        return view('admin.category.index', compact('category'));
    }

    public function addCategory()
    {
        return view('admin.category.form');
    }

    public function categoryStore(Request $request)
    {
        $image = $request->file('image');
        $image_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 246)->save('application/public/upload/category/' . $image_gen);
        $save_url = 'application/public/upload/category/' . $image_gen;

        Category::insert([
            'category' => $request->category,
            'slug'    => strtolower(str_replace(' ', '-', $request->category)),
            'image' => $save_url,
        ]);

        $notification = array(
            'message'   => 'Category Inserted Succesfuly',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all.category')->with($notification);

        $notification = [
            'message'   => 'Failed to Insert Category. Please upload an image.',
            'alert-type' => 'error'
        ];
        return redirect()->back()->withInput()->withErrors($notification);
    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function updateCategory(Request $request)
    {
        $cat_id = $request->id;

        if ($request->file('image')) {

            $image = $request->file('image');
            $image_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 246)->save('application/public/upload/category/' . $image_gen);
            $save_url = 'application/public/upload/category/' . $image_gen;

            Category::find($cat_id)->update([
                'category' => $request->category,
                'slug'    => strtolower(str_replace(' ', '-', $request->category)),
                'image' => $save_url,
            ]);

            $notification = array(
                'message'   => 'Category Updated Succesfuly',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.edit.category')->with($notification);
            
        } else {
            Category::find($cat_id)->update([
                'category' => $request->category,
                'slug'    => strtolower(str_replace(' ', '-', $request->category)),
            ]);

            $notification = array(
                'message'   => 'Category Updated Succesfuly',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.edit.category')->with($notification);
        }
    }

    public function deleteCategory($id)
    {
        $delete = Category::find($id);
        $img    = $delete->image;
        unlink($img);

        Category::find($id)->delete();

        $notification = array(
            'message'   => 'Category Deleted Successfuly',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all.category')->with($notification);
    }
}
