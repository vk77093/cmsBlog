<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class VerifyCategoriescount
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
if(Category::all()->count()==0){
    $request->session()->flash('sucess','You must need to had the category before creating post');
    return redirect('/category/create');

}
        return $next($request);
    }
}
