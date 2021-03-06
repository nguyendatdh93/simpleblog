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


class PostController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * @var PostValidator
     */
    private $validator;

    /**
     * Create a new controller instance.
     *
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(
        PostRepositoryInterface $postRepository
    ) {
        $this->postRepository = $postRepository;
        $this->validator = new PostValidator();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $user = Auth::user();
//        date_default_timezone_set($user->timezone->timezone);
        $posts = $this->postRepository->all();

        return view('admin.post.list', ['posts' => $posts]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view('admin.post.add');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        if (!empty($request->route('id'))) {
            $post = $this->postRepository->find($request->route('id'));
            if (empty($post)) {
                return redirect()->route(Error::ERROR_404);
            }

            return view('admin.post.edit', ['post' => $post]);
        }

        return redirect()->route(Error::ERROR_403);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        $errors = $this->validator->validate($request);

        if (!empty($errors)) {
            return back()->with('errors', $errors)->withInput();
        }

        if (empty($request->get('id'))) {
            $this->postRepository->create([
                'user_id' => Auth::id(),
                'title'   => $request->get('title'),
                'content' => $request->get('content'),
            ]);

            return redirect()->route(Post::ROUTE_LIST_POST)->with(['success' => __('post.add.successMessage')]);
        } else {
            $this->postRepository->update([
                'title'   => $request->get('title'),
                'content' => $request->get('content'),
            ], $request->get('id'));

            return redirect()->route(Post::ROUTE_LIST_POST)->with(['success' => __('post.edit.successMessage')]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Request $request)
    {
        if (!empty($request->route('id'))) {
            $this->postRepository->delete($request->route('id'));

            return redirect()->route(Post::ROUTE_LIST_POST)->with(['success' => __('post.list.removeSuccessMessage')]);
        }

        return redirect()->route(Error::ERROR_403);
    }
}
