@extends('layouts.admin')
@php
    use App\Models\Post as Post;
@endphp
@section('PageContent')
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    @if(!empty(session('success')))
                        <div class="alert alert-info alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(!empty(session('error')))
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Post management</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a href="{{ route(Post::ROUTE_ADD_POST) }}"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add new post</button></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="post-datatable" class="table table-striped table-bordered bulk_action">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Controls</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>{{ $post->updated_at }}</td>
                                        <td>
                                            <div class="fa-hover col-md-3 col-sm-4 col-xs-12" data-toggle-tooltip="tooltip" title="Hooray!">
                                                <a href="{{ route(Post::ROUTE_EDIT_POST, ['id' => $post->id]) }}"><i class="fa fa-edit"></i></a>
                                            </div>

                                            <div class="fa-hover col-md-3 col-sm-4 col-xs-12" data-toggle-tooltip="tooltip" title="Hooray!">
                                                <a href="#/pencil-square-o"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('Script')
    <script>
        $(function () {
            $('#post-datatable').dataTable();
        })
    </script>
@endsection