<?php
/**
 * Need to install package thujohn/twitter
 * https://github.com/thujohn/twitter
 */

namespace App\Validators;

use Illuminate\Support\Facades\Auth;
use Twitter;

class TwitterValidator
{
    public function checkMediaId($mediaId)
    {
        $res = Twitter::uploadMedia(['media' => '', 'command' => 'FINALIZE', 'media_id' => $mediaId]);

        if (!empty($res->media_id)) {
            return $res;
        }

        return null;
    }

    /**ediaId
     * @param $twitter_id
     * @return bool
     */
    public function checkUserExistOnTwitterById($twitter_id)
    {
        try {
            $token_info = Auth::user()->getTokenInfoAttribute(Auth::id());
            Twitter::reconfig([
                "token"  => $token_info->access_token,
                "secret" => $token_info->access_token_secret,
            ]);

            $res = Twitter::getUsers(['user_id' => $twitter_id]);

            return !empty($res);
        } catch (\Exception $exception) {
            return false;
        }
    }
}