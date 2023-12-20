<!DOCTYPE html>
<html
    lang="tr"
    class="light-style layout-wide customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="/assets/"
    data-template="vertical-menu-template">
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login Cover - Pages | Tulpar CMS - Bootstrap Admin Template</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ tcms_asset('img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ tcms_asset('vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ tcms_asset('vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ tcms_asset('vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ tcms_asset('vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ tcms_asset('vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ tcms_asset('css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ tcms_asset('vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ tcms_asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ tcms_asset('vendor/libs/typeahead-js/typeahead.css') }}" />
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ tcms_asset('vendor/libs/@form-validation/umd/styles/index.min.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ tcms_asset('vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ tcms_asset('vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ tcms_asset('vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ tcms_asset('js/config.js') }}"></script>
</head>
<body>
<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
        @yield('content')
    </div>
</div>
<script src="{{ tcms_asset('vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ tcms_asset('vendor/libs/popper/popper.js') }}"></script>
<script src="{{ tcms_asset('vendor/js/bootstrap.js') }}"></script>
<script src="{{ tcms_asset('vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ tcms_asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ tcms_asset('vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ tcms_asset('vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ tcms_asset('vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ tcms_asset('vendor/js/menu.js') }}"></script>
<script src="{{ tcms_asset('vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
<script src="{{ tcms_asset('vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
<script src="{{ tcms_asset('vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
<script src="{{ tcms_asset('js/main.js') }}"></script>
@yield('footer')
</body>
</html>



