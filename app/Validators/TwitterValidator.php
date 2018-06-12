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
    /**
     * @param $mediaId
     * @return null
     */
    public function checkMediaId($mediaId)
    {
        $res = Twitter::uploadMedia(['media' => '', 'command' => 'FINALIZE', 'media_id' => $mediaId]);

        if (!empty($res->media_id)) {
            return $res;
        }

        return null;
    }

    /**ediaId
     * @param $twitterId
     * @return bool
     */
    public function checkUserExistOnTwitterById($twitterId)
    {
        try {
            $tokenInfo = Auth::user()->getTokenInfoAttribute(Auth::id());
            Twitter::reconfig([
                "token"  => $tokenInfo->access_token,
                "secret" => $tokenInfo->access_token_secret,
            ]);

            $res = Twitter::getUsers(['user_id' => $twitterId]);

            return !empty($res);
        } catch (\Exception $exception) {
            return false;
        }
    }
}