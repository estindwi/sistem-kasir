<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public function __construct(
        public string $variant = 'success',
        public string $type = 'button',
        public ?string $href = null,
        public string $size = 'md'
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}