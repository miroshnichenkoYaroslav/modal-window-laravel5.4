<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'F1917') }}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- toastr notifications -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ asset('css/header-footer-style.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>
<div id="app">
    <!--======= HEADER start =======-->
    <header class="outer-wrapper-header">
        <div class="content-centered">
            <div class="block-title">
                <a href="/" id="logo"><img src="/images/logo.png" alt=""></a>
                <div class="suptitle">Федеральная служба по надзору в сфере образования и науки</div>
                <div class="title">Федеральное государственное бюджетное учреждение &laquo;Федеральный центр
                    тестирования&raquo;
                </div>
                <!--<div class="subtitle">Организационно-технологическое сопровождение ЕГЭ</div>-->
            </div>
            <div class="block-phone">
                Телефон:
                <div class="phone"><span style="color: #0a0a0a; background-color: #ffffff;"><span
                                style="font-size: 11pt;"><b>+7 (495) 530-10-03</b></span></span><span
                            style="color: #0a0a0a; background-color: #ffffff;"><span style="font-size: 11pt;"><br>
 </span></span></div>
            </div>
        </div>

        <div class="outer-wrapper-menu-main">
            <div class="content-centered clearfix">
                <nav class="menu-main">
                    <ul>
                        <li class="active"><a href="/">Главная</a></li>
                        <li><a href="/loader">Загрузка результатов <br>диагностики</a></li>
                        <li><a href="/accounting">Формирование <br>отчетности</a></li>
                        <li><a href="/admin">Администрирование</a></li>
                        <li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                        <!-- Right Side Of Navbar -->
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Вход</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Выйти
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>

                </nav>
            </div>
        </div>
    </header>
    @if(session()->has('message'))
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                        @php
                            session()->forget('message')
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    @endif
    @yield('content')
</div>

<!--======= FOOTER start =======-->
<div class="outer-wrapper-partners">
    <div class="content-centered clearfix">
        <a href="http://минобрнауки.рф/" class="block-partner" target="_blank">
            <span class="block-position"><img src="/images/c6941e08df25dcbfc01d5de0a4f43250.png" alt=""></span>
            Министерство образования и науки Российской Федерации </a>
        <a href="http://obrnadzor.gov.ru/" class="block-partner" target="_blank">
            <span class="block-position"><img src="/images/987fd5d3502d9acb0070136be1ce7d0e.png" alt=""></span>
            Федеральная служба по надзору в сфере образования и науки </a>
        <a href="http://www.fipi.ru/" class="block-partner" target="_blank">
            <span class="block-position"><img src="/images/7f387456d3452a3971f876606b840d0b.png" alt=""></span>
            Федеральный институт педагогических измерений </a>
        <a href="http://www.ege.edu.ru/" class="block-partner" target="_blank">
            <span class="block-position"><img src="/images/ccc08589d9898cc0465e62cebb51d71e.gif" alt=""></span>
            Официальный информационный портал единого государственного экзамена </a>
        <a href="http://topic.ege.edu.ru/" class="block-partner" target="_blank">
            <span class="block-position"><img src="/images/ccc08589d9898cc0465e62cebb51d71e.gif" alt=""></span>
            ТЕМЫ ИТОГОВЫХ СОЧИНЕНИЙ </a>
        <a href="http://gia.edu.ru/" class="block-partner" target="_blank">
            <span class="block-position"><img src="/images/1edae204c6bbfc0f3936eaf879db3d5e.gif" alt=""></span>
            Официальный информационный портал ГИА 9 </a>
    </div>
</div>
<footer class="outer-wrapper-footer">
    <div class="wrapper-footer">
        <div class="content-centered clearfix">
            <div class="block-copyright">© 2014-2017 &nbsp; ФГБУ «ФЦТ»</div>
            <div class="block-contacts">
                <span class="address"><img src="/images/icons/icon-footer-location.png" alt="">123557, Москва,
Пресненский Вал, д.19 стр.1</span>
                <span class="phone"><img src="/images/icons/icon-footer-phone.png" alt=""><span
                            style="font-size: 10pt;">Приёмная</span> +7 (495) 530-10-00</span>
                <span class="email"><img src="/images/icons/icon-footer-mail.png" alt=""><a
                            href="mailto:test@rustest.ru">test@rustest.ru</a><!-- Yandex.Metrika counter --> <script
                            type="text/javascript"> (function (d, w, c) {
                            (w[c] = w[c] || []).push(function () {
                                try {
                                    w.yaCounter39653160 = new Ya.Metrika({
                                        id: 39653160,
                                        clickmap: true,
                                        trackLinks: true,
                                        accurateTrackBounce: true,
                                        webvisor: true,
                                        trackHash: true
                                    });
                                } catch (e) {
                                }
                            });
                            var n = d.getElementsByTagName("script")[0], s = d.createElement("script"),
                                f = function () {
                                    n.parentNode.insertBefore(s, n);
                                };
                            s.type = "text/javascript";
                            s.async = true;
                            s.src = "https://mc.yandex.ru/metrika/watch.js";
                            if (w.opera == "[object Opera]") {
                                d.addEventListener("DOMContentLoaded", f, false);
                            } else {
                                f();
                            }
                        })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img
                                    src="https://mc.yandex.ru/watch/39653160" style="position:absolute; left:-9999px;"
                                    alt=""/></div></noscript> <!-- /Yandex.Metrika counter --></span>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/admin/admin.js') }}"></script>
<script src="{{ asset('js/accounting/accounting.js') }}"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
        crossorigin="anonymous"></script>
<!-- Bootstrap JavaScript -->
<script type="text/javascript"
        src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>
<!-- toastr notifications -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

@stack('scripts')
</body>
</html>
