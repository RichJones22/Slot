<?php

use App\Enum\EnumAppTypes;
use Premise\Utilities\PremiseUtilities;

Route::get('testing', function(){
  Artisan::call('optionsHouse:get-activity');
});


Route::get('map', function() {
    $myArray = [1,2,3];

    echo "starting with ";
    var_dump($myArray);


    $myResult = array_map(function($value) {
        return $value * 2;
    }, $myArray);

    echo "ending with ";
    var_dump($myResult);
});

Route::get('reduce', function() {
    $myArray = [1,2,3];

    echo "starting with: " . json_encode($myArray) . "<br/><br/>";

    $myResult = array_reduce($myArray, function($carry, $item) {
        return $carry += $item;
    });

    echo "ending with: " . json_encode($myResult) . "<br/><br/>";
});

Route::get('filter', function() {
    $myArray = [1,2,3];

    echo "starting with: " . json_encode($myArray) . "<br/><br/>";

    $myResult = array_filter($myArray, function($item) use ($myArray){
        return $item === 2;
    });

    echo "ending with: " . json_encode($myResult) . "<br/><br/>";
});

Route::get('decorator', 'Decorator@show');

Route::get('/welcome', function() {
   return view('welcome');
});

Route::get('/', function () {
//    return view('welcome');
//    return view('testing');
    return view('testing02');

//    $types = new EnumAppTypes();
//
//    var_dump($types->getConstantsList());
//    var_dump($types->displayArrayFormat());
//
//class bob {
//
//    private $appTypeEnums;
//
//    public function __construct(EnumAppTypes $appTypes)
//    {
//        $this->appTypeEnums = $appTypes;
//    }
//
//    public function getEnums()
//    {
//        return $this->appTypeEnums;
//    }
//}
//
//$myBob = new bob(new EnumAppTypes());
//
//var_dump($myBob->getEnums()->getName(EnumAppTypes::MAIN));
//var_dump($myBob->getEnums()->getName(EnumAppTypes::JOINT));
//
////    foreach($types as $key => $value)
////    {
////        echo "type is: $key" . '<br/>';
////    }
});//

Route::get('/test', ['as' => 'bar.show', 'uses' => 'BarController@show']);


Route::get('/phpfiddler', 'PhpFiddler@show');

Route::get('/reports', 'TransactionController@reports');
Route::get('/bySymbol/{symbol}', 'TransactionController@getBySymbol');

