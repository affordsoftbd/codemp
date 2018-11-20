<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\MessageSubject;

class SubjectAuthorOnly
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
        $id = $request->id;

        $message = MessageSubject::where('id', $id)->where('author', $request->session()->get('user_id'))->first();

        if($message) return $next($request); 

        return redirect()->back();
    }
}
