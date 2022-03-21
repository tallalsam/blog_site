<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('backend/assets/img/sidebar-1.jpg')}}">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo ml-5">
        @php
            $user = session()->get('user');
        @endphp
        @if($user)

        {{$user['name']}}</div>
        @endif
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            @if(session()->get('role') != 'admin' && session()->get('role') != 'user' && session()->get('role') != 'blogger' )
                <li class="nav-item {{ Request::is('get-admins') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('get-admins')}}">
                        <i class="material-icons">person</i><p>Admins<p>
                    </a>
                </li>
            @endif
            @if(session()->get('role') != 'user' && session()->get('role') != 'blogger' )
                <li class="nav-item {{ Request::is('get-users') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('get-users')}}">
                        <i class="material-icons">person</i>
                        <p>Users</p>
                    </a>
                </li>
            @endif
            @if(session()->get('role') != 'blogger' )
                <li class="nav-item {{ Request::is('get-bloggers') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('get-bloggers')}}">
                        <i class="material-icons">person</i>
                        <p>Bloggers</p>
                    </a>
                </li>
            @endif
            <li class="nav-item {{ Request::is('get-blogs') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('get-blogs')}}">
                    <i class="material-icons">Blogs</i>
                    <p>Blogs</p>
                </a>
            </li>
        </ul>
    </div>
</div>