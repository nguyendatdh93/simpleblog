<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route(\App\Models\Post::ROUTE_LIST_POST)  }}" class="site_title"><i class="fa fa-paw"></i> <span>{{ __('menu.logo') }}</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">

        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3></h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> {{ __('menu.post.postManagement') }} <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route(\App\Models\Post::ROUTE_ADD_POST) }}">{{ __('menu.post.addNewPost') }}</a></li>
                            <li><a href="{{ route(\App\Models\Post::ROUTE_LIST_POST) }}">{{ __('menu.post.postList') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>