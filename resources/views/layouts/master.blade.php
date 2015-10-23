<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    {!! Html::style('css/style.css') !!}
    @section('title')
    @show
  </head>
  <body>
      @section('navigation')
        <a href="/">Home</a>
        <a href="http://www.lipsum.com/">About</a>
      @show
      <div class="container">
          @yield('content')
      </div>
      <div class="response">
	  @yield('response')
      </div>
  </body>
  {!! Html::script('js/script.js') !!}
</html>

