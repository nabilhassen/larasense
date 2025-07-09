<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateUserTimezoneController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'timezone' => ['required', 'string', Rule::in(timezone_identifiers_list())],
        ]);

        if (auth()->check()) {
            auth()->user()->update(['timezone' => $validated['timezone']]);
        } else {
            session()->put('timezone', $validated['timezone']);
        }

        return response()->noContent();
    }
}
