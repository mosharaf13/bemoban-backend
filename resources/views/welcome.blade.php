<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BemoBan</title>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
                height: 100%;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <board></board>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
