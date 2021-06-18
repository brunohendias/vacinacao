<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
        <link rel="icon" href="https://imunizarvacinas.com.br/wp-content/uploads/2018/02/Icon-seringa-03.png" 
            type="image/x-icon" />
        <script src="{{ mix('/js/app.js') }}" defer></script>
        <title>Centro de Vacinação</title>
    </head>
    <body>
        @inertia
    </body>
</html>
