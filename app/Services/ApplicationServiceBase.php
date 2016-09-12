<?php
/**
 * Created by PhpStorm.
 * User: richjones
 * Date: 9/11/16
 * Time: 11:26 PM
 */

namespace app\Services;



class ApplicationServiceBase
{

    /**
     * Filter collection to only show displayable fields (fillable - hidden).
     * @return array
     */
    protected function displayOnlyFillableFields()
    {
        $fields = null;

        $displayableFields = $this->getDisplayableFields();

        foreach ($displayableFields as $key => $fieldName)
        {
            /** @noinspection PhpUndefinedFieldInspection */
            $fields[$fieldName] = $this->collection->getAttribute($fieldName);
        }

        return $fields;
    }

    /**
     * @return array
     */
    protected function getDisplayableFields()
    {
        /** @noinspection PhpUndefinedFieldInspection */
        $fillableFields = $this->collection->getFillable();

        /** @noinspection PhpUndefinedFieldInspection */
        $myHidden = $this->collection->getHidden();

        $displayableFields = array_diff($fillableFields, $myHidden);

        return $displayableFields;
    }

}