<?php
/**
 * Created by PhpStorm.
 * User: richjones
 * Date: 9/11/16
 * Time: 11:26 PM
 */

namespace app\Services;



use Illuminate\Database\Eloquent\Model;

/**
 * Class ApplicationServiceBase
 * @package app\Services
 */
class ApplicationServiceBase
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Filter model to only show displayable fields (fillable - hidden).
     * @return array
     */
    protected function getDisplayOnlyFillableFields()
    {
        $fields = null;

        $displayableFields = $this->getDisplayableFields();

        foreach ($displayableFields as $key => $fieldName)
        {
            $fields[$fieldName] = $this->model->getAttribute($fieldName);
        }

        return $fields;
    }

    /**
     * @return array
     */
    protected function getDisplayableFields()
    {
        $fillableFields = $this->model->getFillable();

        $hiddenFields = $this->model->getHidden();

        $displayableFields = array_diff($fillableFields, $hiddenFields);

        return $displayableFields;
    }

}