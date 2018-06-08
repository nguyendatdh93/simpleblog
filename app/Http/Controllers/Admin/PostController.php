<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepositoryInterface;


class PostController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * Create a new controller instance.
     *
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(
        PostRepositoryInterface $postRepository
    ) {
        $this->postRepository = $postRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepository->all();

        return view('admin.post', ['posts' => $posts]);
    }

    public function add()
    {
        $post = array(
            'user_id'     => 2,
            'name'        => 'tesst',
            'content'     => 'dsdssdsd',
            'approver_id' => 0,
            'approved_at' => new \DateTime(),
            'del_flg'     => 0,
        );

        $this->postRepository->create($post);
    }
}
