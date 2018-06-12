<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Error;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Validators\PostValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


class UserController extends Controller
{
    public function showSettingTimezoneForm()
    {
        return view('admin.setting.timezone');
    }
}
