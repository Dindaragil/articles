<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'     => 'required|min:5',
            'author'     => 'required',
            'content'   => 'required|min:10'
        ]);

        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        Post::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'author' => $request->author,
            'content' => $request->content
        ]);

        return redirect()->route('posts.index')->with(['success' => 'Create post successfully!']);
    }

    public function show(string $id): View
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit(string $id): View
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
        'image'     => 'image|mimes:jpeg,jpg,png|max:2048',
        'title'     => 'required|min:5',
        'author'     => 'required',
        'content'   => 'required|min:10'
        ]);

        $post = Post::findOrFail($id);

        if($request->hasFile('image')) {

            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            Storage::delete('public/posts/'.$post->image);

            $post->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'author'     => $request->author,
                'content'   => $request->content
            ]);
        } else {
            $post->update([
                'title'     => $request->title,
                'author'     => $request->author,
                'content'   => $request->content
            ]);
        }
       return redirect()->route('posts.index')->with(['success' => 'Updated post successfully!']);
    }

    public function destroy($id): RedirectResponse
    {
        $post = Post::findOrFail($id);
        Storage::delete('public/posts/'.$post->image);
        $post->delete();

        return redirect()->route('posts.index')->with(['success' => 'Deleted post successfully!']);
    }

}
