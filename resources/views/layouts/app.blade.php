<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>

    <div id="app">

        @include('layouts.navbar')


        <main class="py-4" style="display: flex; flex-direction:row;">

            <div class="col-md-2" style="margin-right:50px">
                @include('layouts.sidenav')
            </div>

            <div class="container">

                <div class="row">
                    <div class="col-md-11">

                        @yield('content')

                    </div>
                </div>

            </div>
        </main>

    </div>

    @yield('modals')

    @yield('scripts')

    <script>
        let allLinks = document.querySelectorAll('.nav-pills .nav-link');
        allLinks.forEach(li => {
            // console.log(li)
            li.addEventListener('click',moveActive)
        });
        function moveActive(e){
            document.querySelector('.nav-pills .active').classList.remove('active');
            let linkText = window.location.pathname.split('/')[1];
            // console.log(linkText)
            if(! linkText){
                return allLinks[0].classList.add('active');
            }
            allLinks.forEach(link=>{

                if(link.innerText.toLowerCase() == linkText.toLowerCase()){

                    return link.classList.add('active');
                }
            })
        };
        moveActive()
    </script>
</body>
</html>
