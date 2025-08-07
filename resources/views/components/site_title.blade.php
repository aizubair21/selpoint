<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
    <title>
        @isset($title)
           @yield('title')
        @else 
           {{config('app.name', 'Sel Point')}}
        @endisset
     </title>
</div>