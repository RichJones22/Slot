<?php

use App\Enum\EnumAppTypes;

Route::get('/', function () {
//    return view('welcome');
//    return view('testing');
//    return view('testing02');

    $types = new EnumAppTypes();

    var_dump($types->getConstants());

//    foreach($types as $key => $value)
//    {
//        echo "type is: $key" . '<br/>';
//    }
});

Route::get('/test', ['as' => 'bar.show', 'uses' => 'BarController@show']);
