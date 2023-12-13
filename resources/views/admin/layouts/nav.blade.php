  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

      @if(Request::is('admin*'))
      <li class="nav-item">
        <a href="{{ url('admin/dashboard')}}" class="nav-link {{ request()->is('*/dashboard*') ? 'active' : ' '}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.categories.index')}}" class="nav-link {{ request()->is('*/categories*') ? 'active' : ' '}}">
         <i class="nav-icon fas fa-th"></i>
          <p>
            Category
          </p>
        </a>
      </li>


      <li class="nav-item">
        <a href="{{ route('admin.tags.index')}}" class="nav-link {{ request()->is('*/tags*') ? 'active' : ' '}}">
            <i class="nav-icon fas fa-th"></i>
          <p>
            Tag
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.posts.index')}}" class="nav-link {{ request()->is('*/posts*') ? 'active' : ' '}}">
            <i class="nav-icon fas fa-th"></i>
          <p>
            Post
          </p>
        </a>
      </li>



      <li class="nav-item">
        <a href="{{ url('/admin/pending')}}" class="nav-link {{ request()->is('*/pending*') ? 'active' : ' '}}">
            <i class="nav-icon fas fa-th"></i>
          <p>
            Pending Post
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('/admin/favorite/post')}}" class="nav-link {{ request()->is('*/favorite*') ? 'active' : ' '}}">
            <i class="nav-icon fas fa-heart"></i>
          <p>
            Favorite Post
          </p>
        </a>
      </li>


      <li class="nav-item">
        <a href="{{ route('admin.subscribes.index')}}" class="nav-link {{ request()->is('*/subscribes*') ? 'active' : ' '}} ">
            <i class="nav-icon fas fa-bell"></i>
          <p>
            Subscribe
          </p>
        </a>
      </li>


      <li class="nav-item">
        <a href="{{ url('admin/comment')}}" class="nav-link {{ request()->is('*/comment*') ? 'active' : ' '}} ">
            <i class="nav-icon fas fa-comment"></i>
          <p>
            Comment
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('admin/reply')}}" class="nav-link {{ request()->is('*/reply*') ? 'active' : ' '}} ">
            <i class="nav-icon fas fa-comment"></i>
          <p>
            Comment Reply
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('admin/setting')}}" class="nav-link {{ request()->is('*/setting*') ? 'active' : ' '}} ">
            <i class="nav-icon fas fa-cog"></i>
          <p>
           Setting
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('admin/contact')}}" class="nav-link {{ request()->is('*/contact*') ? 'active' : ' '}} ">
            <i class="nav-icon fas fa-phone"></i>
          <p>
           Contact
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.users.index')}}" class="nav-link {{ request()->is('*/users*') ? 'active' : ' '}}">
            <i class="nav-icon fas fa-user"></i>
          <p>
            User
          </p>
        </a>
      </li>

      <li class="nav-header">Your Account</li>
      <li class="nav-item">
        <a href="{{ url('/admin/profiles')}}" class="nav-link {{ request()->is('*/profiles*') ? 'active' : ' '}}">
            <i class="nav-icon fas fa-user"></i>
          <p>
            Profile
          </p>
        </a>
      </li>
      @endif

      @if(Request::is('author*'))
      <li class="nav-item">
        <a href="{{ url('author/dashboard')}}" class="nav-link {{ request()->is('*/dashboard*') ? 'active' : ' '}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('author.posts.index')}}" class="nav-link {{ request()->is('*/posts*') ? 'active' : ' '}}">
            <i class="nav-icon fas fa-th"></i>
          <p>
            Post
          </p>
        </a>
      </li>


      <li class="nav-item">
        <a href="{{ url('/author/favorite/post')}}" class="nav-link {{ request()->is('*/favorite*') ? 'active' : ' '}}">
            <i class="nav-icon fas fa-heart"></i>
          <p>
            Favorite Post
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('author/comment')}}" class="nav-link {{ request()->is('*/comment*') ? 'active' : ' '}} ">
            <i class="nav-icon fas fa-comment"></i>
          <p>
            Comment
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('author/reply')}}" class="nav-link {{ request()->is('*/reply*') ? 'active' : ' '}} ">
            <i class="nav-icon fas fa-comment"></i>
          <p>
            Comment Reply
          </p>
        </a>
      </li>

      <li class="nav-header">Your Account</li>
      <li class="nav-item">
        <a href="{{ url('/author/profiles')}}" class="nav-link {{ request()->is('*/profiles*') ? 'active' : ' '}}">
            <i class="nav-icon fas fa-user"></i>
          <p>
            Profile
          </p>
        </a>
      </li>

      @endif

    </ul>
  </nav>
  <!-- /.sidebar-menu -->
