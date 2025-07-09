<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Enums\SourceType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SourceTypeTabNavigator extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.source-type-tab-navigator', [
            'sourceTypes' => SourceType::cases(),
        ]);
    }
}
