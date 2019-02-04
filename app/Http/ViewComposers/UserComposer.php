<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('users', User::select('id', 'name', 'avatar', 'email')
            ->withCount('articles')
            ->whereStatus(true)
            ->where('id', '!=', Auth::id())
            ->where('is_admin', '!=', 1)
            ->OrderBy('articles_count', 'desc')
            ->get()
            ->take(4));
    }
}
