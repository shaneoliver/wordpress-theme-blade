<!DOCTYPE html>
<html {{ language_attributes() }}>
<head>
    <meta charset="{{ bloginfo( 'charset' ) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    {{ wp_head() }}
</head>
<body {{ body_class() }}>

    {{ wp_body_open() }}

    <div id="site" class="site-container">
        @include('header')
        @yield('content')
        @include('footer')
    </div>

    {{ wp_footer() }}
</body>
</html>