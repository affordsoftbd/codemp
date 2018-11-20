<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Message;

class MessageCreatorOnly
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
        $id = $request->route('message');

        $message = Message::where('id', $id)->where('user_id', $request->session()->get('user_id'))->first();

        if($message) return $next($request); 

        return redirect()->back(); 
    }
}
