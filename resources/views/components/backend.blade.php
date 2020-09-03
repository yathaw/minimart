<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Unique </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{csrf_token()}}" >

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('backend/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{asset('backend/vendor/font-awesome/css/font-awesome.min.css')}}">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="{{asset('backend/css/font.css')}}">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('backend/css/style.default.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('backend/css/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('favicon.png')}}">

     <link rel="stylesheet" type="text/css" href="{{ asset('icon/icofont/icofont.min.css') }}">
       <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <style type="text/css">
        @font-face{
            font-family:'Unicode';
            src: url('https://cdn.rawgit.com/LeonarAung/MyanmarFont/6cf1262f/mon3.woff') format('woff'), url('https://cdn.rawgit.com/LeonarAung/MyanmarFont/6cf1262f/mon3.ttf') format('ttf');
        }

        .mmfont{
            font-family: 'Unicode';
        }

    </style>
  </head>
  <body>
    <header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
          <div class="search-inner d-flex align-items-center justify-content-center">
            <div class="close-btn">Close <i class="fa fa-close"></i></div>
            <form id="searchForm" action="#">
              <div class="form-group">
                <input type="search" name="search" placeholder="What are you searching for...">
                <button type="submit" class="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header-->
                <a href="/" class="navbar-brand">
                    <div class="brand-text brand-big visible text-uppercase">
                        <img src="{{ asset('logo.png') }}" class="img-fluid" style="width: 150px;">
                    </div>
                    <div class="brand-text brand-sm">
                        <strong class="text-primary">U</strong><strong>N</strong>
                    </div>
                </a>
                    <!-- Sidebar Toggle Btn-->
                <button class="sidebar-toggle">
                    <i class="fa fa-long-arrow-left"></i>
                </button>
      
            </div>
            @role('staff')
                <form class="form-inline" style="" action="javascript:void(0)">
                    <input class="form-control form-control-sm ml-3 w-95 searchBtnn" type="text" placeholder="Enter CodeNumber" id="searchItemm" 
                    aria-label="Search" name="search">
                </form>

            @endrole

            <div class="right-menu list-inline no-margin-bottom">    
                <div class="list-inline-item"><a href="#" class="search-open nav-link"><i class="icon-magnifying-glass-browser"></i></a></div>
            

                <!-- Log out -->


                <div class="list-inline-item logout">           
                    <a href="{{route('logout')}}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
                    <span class="d-none d-sm-inline">Logout </span><i class="icon-logout"></i></a>

                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>


            </div>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="{{asset('backend/img/avatar-6.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5"> {{ Auth::user()-> name}} </h1>
            <p> {{ Auth::user()->roles()->pluck('name')[0] }} </p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus-->
        <span class="heading">Main</span>
        <ul class="list-unstyled">
            @role('admin|manager')
                <li class="{{ Request::segment(1) ==='dashboard' ? 'active' :'' }}"><a href="{{ route('dashboard.index') }}"> <i class="icon-home"></i>Home </a></li>

                <li class="{{ Request::segment(1) ==='report' ? 'active' :'' }}"><a href="{{ route('report.index') }}"> <i class="icon-padnote"></i> Sale Report </a></li>
            @endrole

            @role('manager')

                <li><a href="#exampledropdownDropdownOne" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i> Stock List </a>
                  <ul id="exampledropdownDropdownOne" class="collapse list-unstyled ">
                    {{-- <li><a href="{{ route('debit.index') }}" class="mmfont text-secondary"> လက်ဝယ်ရှိကုန်ပစ္စည်းစာရင်း </a></li> --}}
                    <li><a href="{{ route('debit.index') }}" class="mmfont text-secondary"> လက်ကျန်ကုန်ပစ္စည်းစာရင်း </a></li>
                    <li><a href="{{ route('return.index') }}" class="mmfont text-secondary"> ဒိတ်လွန်ပစ္စည်းစာရင်း </a></li>
                  </ul>
                </li>
            @endrole


          @role('admin|manager')
            <li class="{{ Request::segment(1) ==='user' ? 'active' :'' }}"><a href="{{ route('user.index') }}"> <i class="icon-padnote"></i> Users Registration </a></li>
          @endrole

          @role('admin')

          <li class="{{ Request::segment(1) ==='shop' ? 'active' :'' }}"><a href="{{ route('shop.index') }}"> <i class="icon-padnote"></i> Shops Registration  </a></li>
          @endrole
          @role('manager')
          <li  class= "{{ Request::segment(1) ==='category' ? 'active' :'' }}"><a href="{{ route('category.index') }}"> <i class="icon-grid"></i>Category </a></li>
          <li class="{{ Request::segment(1) ==='brand' ? 'active' :'' }}"><a href="{{ route('brand.index') }}"><i class="icofont-brand-ferrari"></i>Supplier </a></li>
          <li class="{{ Request::segment(1) ==='product' ? 'active' :'' }}"><a href="{{ route('product.index') }}"> <i class="icon-padnote"></i>Products </a></li>

          @endrole
         
            @role('staff')


            <li>
                <a href="#exampledropdownDropdown" aria-expanded="true" data-toggle="collapse"> <i class="icon-windows"></i>
                    Choose Category
                </a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled collapse show">
                    @foreach($data[1] as $category)
                        <li><a href="javascript:void(0)" class="selectCategory" data-categoryid={{ $category->id }}> {{ $category->name }} </a></li>
                    @endforeach
                </ul>
            </li>
            @endrole

        </nav>     

      <!-- Sidebar Navigation end-->
        <div class="page-content">
            {{ $slot }}

            <footer class="footer">

                <div class="footer__block block no-margin-bottom">
                    <div class="container-fluid text-center">

                        <p class="no-margin-bottom">2020 &copy; Your unique company. Design by <a href="https://bootstrapious.com/p/bootstrap-4-dark-admin">Kaung Myat Naing</a>.</p>
                    </div>
                </div>
            </footer>

        </div>

    </div>



    <!-- JavaScript files-->
    <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('backend/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('backend/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <!-- <script src="{{asset('backend/js/charts-home.js')}}"></script> -->
    <script src="{{asset('backend/js/front.js')}}"></script>
    <script src="{{asset('shoppingcart.js')}}"></script>
    <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>

    
      </body>
</html>