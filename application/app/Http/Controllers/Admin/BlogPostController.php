<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;


class BlogPostController extends Controller
{
    public function blogPost()
    {
        $posts = BlogPost::latest()->get();

        return view('admin.post.index', compact('posts'));
    }

    public function addPost()
    {
        $category = BlogCategory::all();

        return view('admin.post.form', compact('category'));
    }

    public function postStore(Request $request)
    {
        $image = $request->file('post_image');
        $image_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 247)->save('application/public/upload/blog_post/' . $image_gen);
        $save_url = 'application/public/upload/blog_post/' . $image_gen;

        BlogPost::insert([
            'blogcat_id'    => $request->blogcat_id,
            'post_title'    => $request->post_title,
            'post_slug'     => strtolower(str_replace(' ', '-', $request->post_title)),
            'description'   => $request->description,
            'tags'          => $request->tags,
            'post_image'    => $save_url,
            'created_at'    => Carbon::now(),
        ]);

        $notification = array(
            'message'   => 'Blog Post Inserted Succesfuly',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.blog.post')->with($notification);
    }

    public function editPost($id)
    {
        $category = BlogCategory::all();
        $post = BlogPost::find($id);

        return view('admin.post.edit', compact('category', 'post'));
    }

    public function postUpdate(Request $request)
    {
        $id = $request->id;

        if ($request->file('post_image')) {

            $image = $request->file('post_image');
            $image_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 247)->save('application/public/upload/blog_post/' . $image_gen);
            $save_url = 'application/public/upload/blog_post/' . $image_gen;

            BlogPost::find($id)->update([
                'blogcat_id'    => $request->blogcat_id,
                'post_title'    => $request->post_title,
                'post_slug'     => strtolower(str_replace(' ', '-', $request->post_title)),
                'description'   => $request->description,
                'tags'          => $request->tags,
                'post_image'    => $save_url,
                'created_at'    => Carbon::now(),
            ]);

            $notification = array(
                'message'   => 'Blog Post Updated Succesfuly',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            BlogPost::find($id)->update([
                'blogcat_id'    => $request->blogcat_id,
                'post_title'    => $request->post_title,
                'post_slug'     => strtolower(str_replace(' ', '-', $request->post_title)),
                'description'   => $request->description,
                'tags'          => $request->tags,
                'created_at'    => Carbon::now(),
            ]);

            $notification = array(
                'message'   => 'Blog Post Updated Succesfuly',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function editDelete($id)
    {
        $post = BlogPost::find($id);

        // Check if the image exists and delete it
        if (file_exists($post->post_image)) {
            unlink($post->post_image);
        }

        // Delete the blog post
        BlogPost::find($id)->delete();

        $notification = array(
            'message'   => 'Blog Post Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.blog.post')->with($notification);
    }
}
