<?php
/**
 * Created by PhpStorm.
 * User: atb-member
 * Date: 23/05/2018
 * Time: 10:31
 */

namespace App\Rules;


use Illuminate\Contracts\Validation\Rule;

class IsoDateTimeRangeRule implements Rule
{
    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (empty($value) || strlen($value) < 23) {
            return false;
        }

        $rangeArr = explode(' - ', $value);
        if (count($rangeArr) !== 2) {
            return false;
        }

        $dateTimePattern = "/^[0-9]{4}-[0-9]{2}-[0-9]{2}(?: [0-9]{2}:[0-9]{2})?$/";
        foreach ($rangeArr as $dateString) {
            if (!preg_match($dateTimePattern, $dateString)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return array|null|string
     */
    public function message()
    {
        return __('validation.invalid_format');
    }
}