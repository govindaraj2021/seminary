@php
	use App\Model\Admin\Usergroup;
@endphp
<div class="dropdown-menu">
  <ul class="list-unstyled">
    <li class="divider"></li>
    <li>
      <a role="menuitem" tabindex="-1" href="{{route('admin.user.profile', Auth::id())}}"><i class="fas fa-user"></i> My Profile</a>
      @if(Auth::check() && !empty($company_profile))
        <li class="divider"></li>
        <li>
          <a role="menuitem" tabindex="-1" href="{{route('admin.company.create')}}"><i class="fas fa-building-o"></i>Company Profile</a>
        </li>
        @endif
    </li>

    <li class="divider"></li>
    <li>
      <a role="menuitem" tabindex="-1" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
          <i class="fas fa-power-off"></i>Logout
        </a>
      <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>
    </li>
  </ul>
</div>