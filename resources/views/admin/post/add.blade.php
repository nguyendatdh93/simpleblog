@php
    use App\Models\Post as Post;
@endphp

@extends('layouts.admin')

@section('PageContent')
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{ __('post.add.titleBox') }}</h2>
                            <ul class="nav navbar-right panel_toolbox">
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <form class="form-horizontal form-label-left" novalidate action="{{ route(Post::ROUTE_SAVE_POST) }}" method="post">
                                {{ csrf_field() }}
                                <div class="item form-group {{ $errors->has('title') ? 'bad' : '' }}">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{ __('post.add.title') }} <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="title" placeholder="" required="required" type="text">
                                        <p class="required">{{ $errors->first('title') ?? '' }}</p>
                                    </div>
                                </div>
                                <div class="item form-group {{ $errors->has('content') ? 'bad' : '' }}">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">{{ __('post.add.content') }} <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="form-control" name="content" rows="3" placeholder=""></textarea>
                                        <p class="required">{{ $errors->first('content') ?? '' }}</p>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button id="send" type="submit" class="btn btn-success">{{ __('post.add.add_button') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection