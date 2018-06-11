<?php

namespace App\Http\Controllers\Error;

use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page404()
    {
        return view('errors.404');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page403()
    {
        return view('errors.403');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page500()
    {
        return view('errors.500');
    }
}
