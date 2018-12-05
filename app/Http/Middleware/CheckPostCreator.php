<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Post;

class CheckPostCreator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->route('id');

        $post = Post::where('post_id', $id)->where('user_id', $request->session()->get('user_id'))->first();

        if($post) return $next($request); 

        return redirect()->back();
    }
}
