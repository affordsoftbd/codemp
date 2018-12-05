<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Event;

class CheckEventCreator
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
        $id = $request->route('event');

        $event = Event::where('id', $id)->where('user_id', $request->session()->get('user_id'))->first();

        if($event) return $next($request); 

        return redirect()->back(); 
    }
}
