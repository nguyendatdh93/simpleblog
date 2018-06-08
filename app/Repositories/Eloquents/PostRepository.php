<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 08/11/2017
 * Time: 16:38
 */

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\PostRepositoryInterface;
use DB;
use Illuminate\Container\Container as App;

class PostRepository extends Repository implements PostRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\Models\Post';
    }
}