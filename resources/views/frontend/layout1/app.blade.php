<!DOCTYPE html>
<html lang="en" dir="ltr">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="google-site-verification" content="tAbcuE2ADEsgR3oCEKaL56PpBuk7t-E9HqL6riegR7g" />
    <title>Readiwork</title>
    <meta name="keywords" value="ddd"/>
    <meta name="description" value="ddd"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Default Top Script and css -->
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <!--<meta content="" name="ddd" />
       <meta content="" name="ddd" />-->
    <meta content="" name="author" />
    
    @include('frontend.layout1.style')
    @yield('style')
</head>
<body>
<!-- home page -->
<div id="main-uber-page">
    @include('frontend.layout.header')
    @yield('content')
    @include('frontend.layout1.footer')
    <!-- Footer Script -->
    <!-- Modal -->
    <div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Change Language Label</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body" id="lang_popup">
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateLanguage();">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal --><!-- End: Footer Script -->
    @include('frontend.layout.script')
    
    @yield('script')
</body>
</html>