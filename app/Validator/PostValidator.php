<?php

namespace App\Validator;

use Validator;

class PostValidator
{
    public function validate($request)
    {
        $validator = Validator::make($request->all(), [
            'title'   => 'string|required|max:255',
            'content' => 'string|required',
        ]);

        $validator->setAttributeNames([
            'title'   => __('post.add.title'),
            'content' => __('post.add.content')
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages();
        }

        return $errors ?? array();
    }
}