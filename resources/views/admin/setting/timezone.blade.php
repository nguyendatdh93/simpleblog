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
                            <h2>{{ __('setting.timezone.titleBox') }}</h2>
                            <ul class="nav navbar-right panel_toolbox">
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <form class="form-horizontal form-label-left" novalidate action="" method="post">
                                {{ csrf_field() }}
                                <div class="item form-group {{ $errors->has('timezone') ? 'bad' : '' }}">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{ __('setting.timezone.timezone') }}
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="select2_single form-control"  tabindex="-1">
                                            <option></option>
                                            <option value="Asia/Saigon">{{ __('setting.timezone.vietnam') }}</option>
                                            <option value="HI">{{ __('setting.timezone.japan') }}</option>
                                        </select>
                                        <p class="required">{{ $errors->first('timezone') ?? '' }}</p>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button id="send" type="submit" class="btn btn-success">{{ __('post.add.addButton') }}</button>
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

@section('Script')
    <script src="{{ asset("/assets/vendors/moment/moment.js") }}"></script>
    <script src="{{ asset("/assets/vendors/moment-timezone/moment-timezone.js") }}"></script>
    <script src="{{ asset("/assets/vendors/moment-timezone/moment-timezone-with-data.js") }}"></script>
    <script>
        $(document).on('ready', function(){
            var timezone = $('#timezoneInput').val();
            if (!timezone) {
                timezone = moment.tz.guess();
                $('#timezoneInput').val(timezone);
            }
        })
    </script>
@endsection