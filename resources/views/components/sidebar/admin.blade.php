<li class="menu-item
    {{ Request::is('user*') | Request::is('menu2*') | Request::is('menu3*') | Request::is('menu4*') ? 'active open' : '' }}
    ">
  <a href="javascript:void(0);" class="menu-link menu-toggle">
    <i class="menu-icon tf-icons bx bx-box"></i>
    <div class="text-truncate">Layouts</div>
  </a>

  <ul class="menu-sub">

    <li class="menu-item {{ Request::is('user*') ? 'active' : '' }}">
      <a href="{{ route('user.index') }}" class="menu-link">
        <div class="text-truncate">Data User</div>
      </a>
    </li>

    <li class="menu-item ">
      <a href="#" class="menu-link">
        <div class="text-truncate">Menu 2</div>
      </a>
    </li>

    <li class="menu-item ">
      <a href="#" class="menu-link">
        <div class="text-truncate">Menu 3</div>
      </a>
    </li>

  </ul>
</li>
