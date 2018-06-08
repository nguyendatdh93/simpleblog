<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials.head')
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        @include('layouts.partials.menu_left')

        @include('layouts.partials.menu_header')

        @include('layouts.partials.page_content')

        @include('layouts.partials.footer')
    </div>
</div>

@include('layouts.partials.script')

</body>
</html>