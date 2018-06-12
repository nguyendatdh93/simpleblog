<?php
/**
 * Created by PhpStorm.
 * User: atb-member
 * Date: 22/05/2018
 * Time: 17:32
 * Requirement : need to install package thujohn/twitter https://github.com/thujohn/twitter
 */

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Twitter;

/**
 * Class TwitterHashTagRule
 * @package App\Validation\Rules
 */
class TwitterHashTagRule implements Rule
{
    private $multipleTag = false;

    private $verifyExists = false;

    private $message;

    /**
     * TwitterHashTagRule constructor.
     * @param bool $multiple
     * @param bool $verifyExists
     */
    public function __construct($multiple = false, $verifyExists = false)
    {
        $this->multipleTag = $multiple;
        $this->verifyExists = $verifyExists;
        $this->message = __('validation.tweet_hashtag_invalid_format'); //Default message
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (empty($value)) {
            return false;
        }

        $invalidPattern = "/^#[0-9_]+$|^#.*[#$%^&*()+=\-\[\]\';,.\/{}|\":<>?~\\\\]/";
        $hashTags = preg_split("/ OR |[ ]+/ui", $value);
        if (!$this->multipleTag && count($hashTags) > 1) {
            return false;
        }

        foreach ($hashTags as $tag) {
            if ($tag[0] !== '#' || preg_match($invalidPattern, $tag)) {
                return false;
            }

            if (!$this->verifyExists) {
                continue;
            }
            $twitterFeed = Twitter::getSearch(['q' => $tag, 'count' => 1, 'max_id' => 0, 'since_id' => 0]);
            if (count($twitterFeed->statuses) > 0) {
                $this->message = __('validation.twitter_hashtag_is_existed');

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
        return $this->message;
    }
}