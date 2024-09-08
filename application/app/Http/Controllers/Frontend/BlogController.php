<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BlogController extends Controller
{
    public function blog()
    {
        $blog = BlogPost::latest()->get();
        $blogCat = BlogCategory::latest()->get();
        $post = BlogPost::latest()->limit(3)->get();

        return view('templates.blog.blog', compact('blog', 'blogCat', 'post'));
    }

    public function blogDetails($slug)
    {
        $blog = BlogPost::where('post_slug', $slug)->first();
        $tag = $blog->tags;
        $tags = explode(',', $tag);

        $blogCat = BlogCategory::latest()->get();
        $post = BlogPost::latest()->limit(3)->get();

        return view('templates.blog.singlePage', compact('blog', 'tags', 'blogCat', 'post'));
    }

    public function catList($id,$slug)
    {
        $decryptedId = Crypt::decrypt($id);
        $blog = BlogPost::where('blogcat_id', $decryptedId)->get();
        $cateTitle = BlogCategory::find($decryptedId);
        $blogCat = BlogCategory::latest()->get();
        $post = BlogPost::latest()->limit(3)->get();

        return view('templates.blog.category_page', compact('blog', 'blogCat', 'post','cateTitle'));
    }
}
