<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e54abc54b9.js" crossorigin="anonymous"></script>
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
 
    var availableTags = [];
    $.ajax({
        method: "GET",
        url: "/search",
        data:"",
        dataType:"",
        success: function(response){
            console.log(response);
            startAutoComplete(response);
        }
    })

    function startAutoComplete(availableTags){
            $( "#search_members" ).autocomplete({
            source: availableTags
        });
    }
    
  </script>

    <!--<title>Admin Dashboard Panel</title>--> 
</head>
<body>
@if (session('success'))
<div
    class="cart-popup-success"
    >
    {{ session('success') }}
    </div>
@endif
@if (session('error'))
<div
    class="cart-popup-error"
    >
    {{ session('error') }}
    </div>
@endif
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="/assets/trans-logo.png" alt="">
            </div>

            <span class="logo_name">Christ Convent</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="/home" id="active">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="{{ route('members') }}">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">All Members</span>
                </a></li>
                <li><a href="{{ route('children') }}">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">All Children</span>
                </a></li>
                <li><a href="{{ route('registerMember') }}">
                    <i class="uil uil-user-plus"></i>
                    <span class="link-name">Add Member</span>
                </a></li>
                <li><a href="{{ route('registerChild') }}">
                    <i class="uil uil-plus"></i>
                    <span class="link-name">Add Child</span>
                </a></li>
                <li><a href="{{ route('registerAdmin') }}">
                    <i class="uil uil-lock-access"></i>
                    <span class="link-name">Add Admin</span>
                </a></li>
            </ul>
            

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <ul class="logout-mode">
                <li><a href="">
                    <i class="uil uil-user-check"></i>
                    <span class="link-name">{{ Auth::user()->name }}</span>
                </a></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a>
                </li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <form action="{{ route('searchMembers') }}" method="POST">
        @csrf
        
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="search-box">
                <select name="type_search" id="type_search">
                    <option value="members">Members</option>
                    <option value="children">Children</option>
                </select>
                <button type="submit"><i class="uil uil-search"></i></button>
                <input type="search" id="search_members" placeholder="Search here..." name="members_name">
            </div>
            
            <!--<img src="images/profile.jpg" alt="">-->
        </div>
        </form>

        <div class="dash-content">
            @yield('content')
        </div>
    </section>

    <script src="{{ asset('js/user.js') }}"></script>
</body>
</html>
