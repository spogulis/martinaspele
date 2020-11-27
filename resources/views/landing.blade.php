<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="csrf-token" content="{{csrf_token()}}">
     <title>Home page title</title>
     <link href="{{ asset('css/vendor/fontawesome/all.css') }}" rel="stylesheet">
     <link href="{{ mix('css/app.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
</head>
<body>
     <div id="app">
          <app></app>
     </div>
     <script src="{{ mix('js/bootstrap.js') }}"></script>
     <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>
