<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Once;


class OnceController extends Controller
{
    public function show(Request $request)
    {
        $firstNumber = $this->getNumber();

        $secondNumber = $this->getNumber();

        $thirdNumber = $this->getNumber();

        $fourthNumber = $this->getNumber();

        $fifthNumber = $this->getNumber();

        return [$firstNumber, $secondNumber, $thirdNumber, $fourthNumber, $fifthNumber];
    }

    /**
     * @return Once
     */
    protected function getNumber()
    {
        return once(function () {
            return rand(1, 10000);
        });
    }
}
