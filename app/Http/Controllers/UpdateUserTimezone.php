<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateUserTimezone
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'timezone' => ['required', 'string', Rule::in(timezone_identifiers_list())],
        ]);

        auth()->user()->timezone = $validated['timezone'];
        
        auth()->user()->save();

        return response()->noContent();
    }
}
