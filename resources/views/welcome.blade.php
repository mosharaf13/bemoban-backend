<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BemoBan</title>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <div class="bla" style="width: 100px; height:100px; background: red">
                <board></board>
            </div>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
