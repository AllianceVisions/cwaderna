<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @php
        $general_settings = App\Models\GeneralSettings::first();
    @endphp

    @if($general_settings)
        <title>{{$general_settings->site_name}}</title>
        @if($general_settings->logo)
        <link name="favicon" type="image/x-icon" href="{{ $general_settings->logo->getUrl() }}" rel="shortcut icon" />
        @endif
    @else
        <title>{{ trans('panel.site_title') }}</title>
    @endif
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/images/favicons/site.webmanifest')}}">

    <!-- plugin scripts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,500i,600,700,800%7CSatisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free-5.11.2-web/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/kipso-icons/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vegas.min.css')}}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="{{asset('assets/fonts/stylesheet.css')}}" rel="stylesheet">
    <!-- template styles -->

    <link rel="stylesheet" href="{{asset('assets/css/rtl.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}"> 

    
    <style> 
        .page-item.active .page-link {
            background-color: #012237 !important; 
        }
        .pagination li{
            margin: 0 10px; 
        }
        .inner-banner__title{
            padding:15px
        }
    </style>
    
    @yield('styles')
</head>

<body>

    <div class="page-wrapper">

        @include('inc.frontend_nav') 
    
        @yield('content')

        @include('inc.frontend_footer')
    </div>
        
    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
        
    
    @include('sweetalert::alert')
    
    <!-- plugin scripts -->
    <script src="https://kit.fontawesome.com/e0387e9a75.js"></script>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/waypoints.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('assets/js/TweenMax.min.js')}}"></script>
    <script src="{{asset('assets/js/wow.js')}}"></script>
    <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/js/countdown.min.js')}}"></script>
    <script src="{{asset('assets/js/vegas.min.js')}}"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script> 

    <!-- template scripts -->
    <script src="{{asset('assets/js/theme.js')}}"></script>  
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    
    <script>
        
        function showFrontendAlert(type, title, message){
            swal({ 
                title: title,
                text: message,
                type: type, 
                showConfirmButton: 'Okay',
                timer: 3000
            });
        }

        
        function deleteConfirmation(route) {
        console.log(route);
            swal({
                title: "{{trans('global.flash.delete_')}}",
                text: "{{trans('global.flash.sure_')}}",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "{{trans('global.flash.yes_')}}",
                cancelButtonText: "{{trans('global.flash.no_')}}",
                reverseButtons: !0
            }).then(function (e) {

                if (e.value === true) { 

                    $.ajax({
                        type: 'DELETE',
                        url: route,
                        data: { _token: '{{ csrf_token() }}' }, 
                        success: function (results) { 
                        location.reload(); 
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function (dismiss) {
                return false;
            })
        }
    </script>
    @yield('scripts')
</body>

</html>