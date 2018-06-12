<?php
/**
 * Created by PhpStorm.
 * User: atb-member
 * Date: 22/05/2018
 * Time: 16:59
 * Requirement : need to install package thujohn/twitter https://github.com/thujohn/twitter
 */

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxTweetLengthRule implements Rule
{
    const MAX_TWEET_LENGTH = 280;
    private $tweetLength = 0;

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

        $tweetParser = new \Twitter\Text\Parser();
        $result = $tweetParser->parseTweet($value);
        $this->tweetLength = $result->weightedLength;
        if ($result->weightedLength > self::MAX_TWEET_LENGTH) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function message()
    {
        return strtr(__('validation.tweet_length'),
            [':max_length' => self::MAX_TWEET_LENGTH, ':input_length' => $this->tweetLength]);
    }
}