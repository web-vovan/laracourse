<?php

namespace App\View\Composers;

use App\Menu\Menu;
use Illuminate\View\View;

class NavigationComposer
{
    public function compose(View $view): void
    {
        $view->with('menu', Menu::make());
    }
}
