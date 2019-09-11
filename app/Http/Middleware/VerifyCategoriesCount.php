<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

class VerifyCategoriesCount
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
      //create middleware to refuse entering of posts when there is no category
      //Register the middleware in a Kernel
      if(Category::all()->count() === 0){
        return redirect()->route('categories.create')->with('error', 'You have to create a category before creating a post.');
      }
        return $next($request);
    }
}
