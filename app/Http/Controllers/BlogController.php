<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegtechBlog;

class BlogController extends Controller
{
    public function dashboard()
    {
      
        return view('blog.dashboard');
     }
    public function blog()
    {
        $item = RegtechBlog::all();
        return view('blog.blog_operation.index', compact('item'));
    }
    public function createBlog()
    {
        return view('blog.blog_operation.create');
    }
    public function createBlogSubmit(Request $request)
    {
          $request->validate([
             'image'=>'required|image|mimes:jpeg,png,jpg',
             'description'=>'required', 
             'url'=>'nullable|url',
          ],[
            'image.required'=>'Please select image.',
            'image.mimes'=>'Image should be jpg,jpeg,png.',
            'description.required'=>'Please enter a description.',
            'url.url'=>'Url Invalid. Please enter valid url',
          ]
         );
        $blog = new RegtechBlog();
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blog'), $imageName);
            $blog->image = $imageName;
        }
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keyword = $request->meta_keywords;
        $blog->url = $request->url;
        $blog->save();
        return redirect()->route('create');
    }
    public function edit($id)
    {
        $blogedit = RegtechBlog::where('id', $id)->first();
         return view('blog.blog_operation.edit', compact('blogedit'));
    }
    public function update(Request $request, $id)
    {
        // return 'ok2';
        $request->validate([
            'image'=>'required|image|mimes:jpeg,png,jpg',
            'description'=>'required', 
            'url'=>'nullable|url',
         ],[
           'image.required'=>'Please select image.',
           'image.mimes'=>'Image should be jpg,jpeg,png.',
           'description.required'=>'Please enter a description.',
           'url.url'=>'Url Invalid. Please enter valid url',
         ]
        );
        $blog = RegtechBlog::where('id',$id)->first();
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blog'), $imageName);
            $blog->image = $imageName;

            // $image = $request->file('image');
            // $name = time() . '.' . $image->getClientOriginalExtension();

            // // $destinationPath = public_path() . '/uploads/agents/Documents/';
            // $destinationPath = '/uploads/';
            // $img = Image::make($image);
            // $img->resize(800, null, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // });

            // $resource = $img->stream()->detach();
            // // sotring images to amazone s3 ======
            // Helper::S3U($resource, $destinationPath.$name);
            // $blog->image = $name;
        }
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keyword = $request->meta_keyword;
        $blog->url = $request->url;
        $blog->save();
        return redirect()->route('blog_list');
    }
    public function delete($id){
        $blog = RegtechBlog::findOrFail($id);
        $blog->delete();
        return redirect('blog');
    }

    public function createblogApi(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'image' => 'required|image|mimes:jpeg,png,jpg',
                'description' => 'required',
                'url' => 'nullable|url',
            ],
            [
                'image.required' => 'Please select image.',
                'image.mimes' => 'Image should be jpg,jpeg,png.',
                'description.required' => 'Please enter a description.',
                'url.url' => 'Url Invalid. Please enter valid url',
            ]
        );
        if ($validator->fails()) {
            if (!empty($validator->messages()->first('image'))) {
                return response()->json(['status_code' => 404, 'message' => $validator->messages()->first('image')]);
            }
            if (!empty($validator->messages()->first('description'))) {
                return response()->json(['status_code' => 404, 'message' => $validator->messages()->first('description')]);
            }
            if (!empty($validator->messages()->first('url'))) {
                return response()->json(['status_code' => 404, 'message' => $validator->messages()->first('url')]);
            }
        }
        $blog = new RegtechBlog();
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('uploads/blog'), $imageName);
            $blog->image = $imageName;
        }
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keyword = $request->meta_keyword;
        $blog->url = $request->url;
        $blog->save();
        if ($blog) {
            return response()->json(['status_code' => 200, 'message' => 'Blog Created Successfully.']);
        }
        return response()->json(['status_code' => 102, 'message' => 'Blog Create Failed.']);
    }
    public function editBlog(Request $request)
    {
        $id = $request->id;
        $blogedit = RegtechBlog::where('id', $id)->first();
        if (isset($blogedit)) {
            return response()->json(['status_code' => 200, 'data' => $blogedit]);
        }
        return response()->json(['status_code' => 102, 'message' => 'No found this record.']);
    }

    public function updateblogApi(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make(
            $request->all(),
            [
                'image' => 'required|image|mimes:jpeg,png,jpg',
                'description' => 'required',
                'url' => 'nullable|url',
            ],
            [
                'image.required' => 'Please select image.',
                'image.mimes' => 'Image should be jpg,jpeg,png.',
                'description.required' => 'Please enter a description.',
                'url.url' => 'Url Invalid. Please enter valid url',
            ]
        );
        if ($validator->fails()) {
            if (!empty($validator->messages()->first('image'))) {
                return response()->json(['status_code' => 404, 'message' => $validator->messages()->first('image')]);
            }
            if (!empty($validator->messages()->first('description'))) {
                return response()->json(['status_code' => 404, 'message' => $validator->messages()->first('description')]);
            }
            if (!empty($validator->messages()->first('url'))) {
                return response()->json(['status_code' => 404, 'message' => $validator->messages()->first('url')]);
            }
        }
        $blog = RegtechBlog::where('id', $id)->first();
        if (isset($blog)) {
            if ($request->has('image')) {
                $image = $request->file('image');
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('uploads/blog'), $imageName);
                $blog->image = $imageName;
            }
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->meta_description = $request->meta_description;
            $blog->meta_keyword = $request->meta_keyword;
            $blog->url = $request->url;
            $blog->save();
            return response()->json(['status_code' => 200, 'message' => 'Blog Updated Successfully.']);
        }
        return response()->json(['status_code' => 102, 'message' => 'Blog Update Failed. Please pass correct id.']);
    }
   
    public function deleteBlog(Request $request)
    {
        $id = $request->id;
        $blog = RegtechBlog::where('id', $id)->first();
        if (isset($blog)) {
            $blog->delete();
            return response()->json(['status_code' => 200, 'message' => 'Blog Deleted Successfully.']);
        }
        return response()->json(['status_code' => 102, 'message' => 'No record found.']);
    }

    public function getBlog()
    {
        $item = RegtechBlog::all();
        if (isset($item)) {
            return response()->json(['status_code' => 200, 'data' => $item]);
        }
        return response()->json(['status_code' => 102, 'message' => 'No record found.']);
    }
}
