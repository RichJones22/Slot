<?php
/**
 * Created by PhpStorm.
 * User: richjones
 * Date: 9/11/16
 * Time: 12:46 PM
 */

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserBase extends Authenticatable
{
    use Notifiable;

//    public function displayOnlyFillableFields()
//    {
//        $displayableFields = null;
//
//        $myFillableFields = $this->getFillable();
//        $myHidden = $this->getHidden();
//
//        $myFillableFields = array_diff($myFillableFields, $myHidden);
//
//        foreach ($myFillableFields as $key => $fieldName)
//        {
//            $displayableFields[$fieldName] = $this->attributes[$fieldName];
//        }
//
//        return $displayableFields;
//    }

}