<?php
/**
 * Created by PhpStorm.
 * User: atb-member
 * Date: 23/05/2018
 * Time: 10:31
 * Requirement : need to install package thujohn/twitter https://github.com/thujohn/twitter
 */

namespace App\Rules;

use App\Validators\TwitterValidator;
use Illuminate\Contracts\Validation\Rule;

class TwitterUserIdRule implements Rule
{
    private $twitterUserId = '';

    /**
     * TwitterUserIdRule constructor.
     * @param $twitterUserId
     */
    public function __construct($twitterUserId)
    {
        $this->twitterUserId = $twitterUserId;
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $validator = new TwitterValidator();

        return $validator->checkUserExistOnTwitterById($this->twitterUserId);
    }

    /**
     * @return array|null|string
     */
    public function message()
    {
        return strtr(__('validation.twitter_id_not_existed'), [':twitter_id' => $this->twitterUserId]);
    }
}