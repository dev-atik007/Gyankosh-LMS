<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class ManageBlogController extends Controller
{
    public function blogCategory()
    {
        $category = BlogCategory::latest()->get();
        return view('admin.blog.category', compact('category'));
    }

    public function blogStore(Request $request)
    {
        $blogCategory = new BlogCategory();

        $blogCategory->category         = $request->category;
        $blogCategory->category_slug    = strtolower(str_replace(' ', '-', $request->category));
        $blogCategory->save();

        $notification = array(
            'message'   => 'Blog Category Inserted successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.blog.category')->with($notification);
    }

    public function categoryEdit($id)
    {
        $categories = BlogCategory::find($id);
        return response()->json($categories);

    }

    public function categoryUpdate(Request $request)
    {
        $catId = $request->catId;

        $blogCategory = BlogCategory::find($catId);

        $blogCategory->category         = $request->category;
        $blogCategory->category_slug    = strtolower(str_replace(' ', '-', $request->category));
        $blogCategory->save();

        $notification = array(
            'message'   => 'Blog Category Updated successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function categoryDelete($id)
    {
        BlogCategory::find($id)->delete();

        $notification = array(
            'message'   => 'Blog Category Deleted successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
