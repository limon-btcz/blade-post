<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ getErrorPageTitle($exception) }}</title>
    @vite('resources/css/app.css')
  </head>
  <body>
    @yield('children')
  </body>
</html>
<!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->