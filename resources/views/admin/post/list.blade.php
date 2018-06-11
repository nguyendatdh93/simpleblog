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
                            <h2>{{ __('post.list.titleBox') }}</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a href="{{ route(Post::ROUTE_ADD_POST) }}"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> {{ __('post.list.addButton') }}</button></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="post-datatable" class="table table-striped table-bordered bulk_action">
                                <thead>
                                <tr>
                                    <th>{{ __('post.list.id') }}</th>
                                    <th>{{ __('post.list.title') }}</th>
                                    <th>{{ __('post.list.author') }}</th>
                                    <th>{{ __('post.list.createdAt') }}</th>
                                    <th>{{ __('post.list.updatedAt') }}</th>
                                    <th class="action">{{ __('post.list.action') }}</th>
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

                                            <div class="fa-hover col-md-3 col-sm-4 col-xs-12 btn-remove"
                                                 data-toggle-tooltip="tooltip"
                                                 title="Hooray!"
                                                 data-toggle="modal"
                                                 data-target=".modal-remove-post"
                                                 data-id = {{ $post->id }}
                                            >
                                                <i class="fa fa-trash-o"></i>
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

    <div class="modal fade modal-remove-post" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">{{ __('post.list.confirmRemoveTitle') }}</h4>
                </div>
                <div class="modal-body">
                    <h4>{{ __('post.list.confirmText') }}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('post.list.noButton') }}</button>
                    <a href="" class="btn btn-primary btn-confirm">{{ __('post.list.yesButton') }}</a>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('Script')
    <script>
        $(function () {
            $('#post-datatable').dataTable({
                order: [ 0, 'DESC' ],
                columnDefs: [
                    { targets: 'action', orderable: false, width: 50}
                ]
            });
        })
        
        $(document).on('click', '.btn-remove', function (e) {
            var id = $(this).attr('data-id');
            var url_remove = "{{ route(Post::ROUTE_REMOVE_POST) }}" + "/" + id;
            $('.btn-confirm').attr("href", url_remove);
        })
    </script>
@endsection