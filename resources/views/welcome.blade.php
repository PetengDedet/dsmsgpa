<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
        <style type="text/css">
            #caljs {
                position: absolute;
                bottom: 20px;
                right: 20px;
            }
            .caljsnumber {
                width: 40;
                height: 40;
                margin: 2px;
                background: #fff;
                border: 1px solid #333;
                /*-webkit-box-shadow: 2px 2px 18px -6px rgba(0,0,0,0.9);
                -moz-box-shadow: 2px 2px 18px -6px rgba(0,0,0,0.9);
                box-shadow: 2px 2px 18px -6px rgba(0,0,0,0.9);*/
            }
            .caljsoperator {
                width: 40;
                height: 40;
                margin: 2px;
                background: #fff;
                border: 1px solid #333;
            }
        </style>
        <div id="caljs">
            <form id="caljsform">
                <table class="tg">
                  <tr>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                  </tr>
                  <tr>
                    <td class=""><button type="button" class="btn btn-xs btn-default">AC</button></td>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                  </tr>
                  <tr>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                  </tr>
                  <tr>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                  </tr>
                  <tr>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                  </tr>
                </table>
            </form>
        </div>
        <script type="text/javascript">
            
        </script>
    </body>
</html>
