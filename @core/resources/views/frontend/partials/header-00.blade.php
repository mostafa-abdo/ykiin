<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/assets/frontend/vendor/bootstrap-5.3.6-dist/css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/frontend/vendor/fontawesome-free-6.6.0-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/frontend/vendor/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/frontend/vendor/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') }}">
    <style>
        @font-face {
            font-family: "IBM Plex Sans Arabic";
            src: url("{{ asset('/assets/frontend/fonts/IBM_Plex_Sans_Arabic/IBMPlexSansArabic-Thin.ttf') }}") format('truetype');
            font-weight: 100;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: "IBM Plex Sans Arabic";
            src: url("{{ asset('/assets/frontend/fonts/IBM_Plex_Sans_Arabic/IBMPlexSansArabic-ExtraLight.ttf') }}") format('truetype');
            font-weight: 200;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: "IBM Plex Sans Arabic";
            src: url("{{ asset('/assets/frontend/fonts/IBM_Plex_Sans_Arabic/IBMPlexSansArabic-Light.ttf') }}") format('truetype');
            font-weight: 300;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: "IBM Plex Sans Arabic";
            src: url("{{ asset('/assets/frontend/fonts/IBM_Plex_Sans_Arabic/IBMPlexSansArabic-Regular.ttf') }}") format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: "IBM Plex Sans Arabic";
            src: url("{{ asset('/assets/frontend/fonts/IBM_Plex_Sans_Arabic/IBMPlexSansArabic-Medium.ttf') }}") format('truetype');
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: "IBM Plex Sans Arabic";
            src: url("{{ asset('/assets/frontend/fonts/IBM_Plex_Sans_Arabic/IBMPlexSansArabic-SemiBold.ttf') }}") format('truetype');
            font-weight: 600;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'IBM Plex Sans Arabic';
            src: url("{{ asset('/assets/frontend/fonts/IBM_Plex_Sans_Arabic/IBMPlexSansArabic-Bold.ttf') }}") format('truetype');
            font-weight: 700;
            font-style: normal;
            font-display: swap;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/main-00.css') }}">
    <title>{{get_static_option('site_title')}}</title>
</head>

<body>