<?php

namespace App\Http\Controllers;

use App\Factories\PlatformServiceFactory;
use App\Models\Post;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('platforms')->where('user_id' , auth()->user()->id)->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $platforms = Platform::all();
        return view('posts.create', compact('platforms'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required|string',
            'platforms' => 'required|array',
            'platforms.*' => 'integer',
            'scheduled_time' => 'required|date|after_or_equal:now',
            'image_url' => 'nullable|url'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $postData = [
            'title' => $request->title,
            'content' => $request->get('content'),
            'image_url' => $request->image_url,
            'scheduled_time' => $request->scheduled_time,
        ];


        foreach ($request->platforms as $platformId) {
            try {
                $platformService = PlatformServiceFactory::create($platformId);

                if (!$platformService->validatePost($postData)) {
                    // Add manual error message for this platform
                    return redirect()->back()
                        ->withErrors(["The post is invalid for platform ID {$platformId}."])
                        ->withInput();
                }
            } catch (InvalidArgumentException $e) {
                return redirect()->back()
                    ->withErrors([$e->getMessage()])
                    ->withInput();
            }
        }

        $post = auth()->user()->posts()->create([
            'title' => $request->title,
            'content' => $request->get('content'),
            'image_url' => $request->image_url,
            'scheduled_time' => $request->scheduled_time,
            'status' => 'scheduled',
        ]);

        foreach ($request->platforms as $platformId) {
            $post->platforms()->attach($platformId, [
                'platform_status' => 'pending'
            ]);
        }

        return redirect()->route('posts.index')
            ->with('success', 'Post scheduled successfully!');
    }


    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted successfully!');
    }
}
