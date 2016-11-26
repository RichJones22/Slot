<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhpFiddler extends Controller
{
    public function show()
    {
        // should return 'zap'
        $a = (($a ?? 0) === false ? 'zip' : 'zap');

        return "a is: $a";
    }
}
