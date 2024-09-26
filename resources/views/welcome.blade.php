<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Trang chủ</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="antialiased">
        <div style="text-align: center;color: red;margin-top: 100px;font-size: 26px">
            Đây là trang chủ
        </div>
        <script>
            window.addEventListener("beforeunload", function () {
                navigator.sendBeacon('/update-leave-time');
            });
        </script>
    </body>
</html>
