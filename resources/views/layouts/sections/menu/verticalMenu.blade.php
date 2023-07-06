@php
$configData = Helper::appClasses();
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <!-- ! Hide app brand if navbar-full -->
  @if(!isset($navbarFull))
  <div class="app-brand demo ">
    <a href="{{url('/')}}" class="app-brand-link">
      <span class="app-brand-logo demo">
        @include('_partials.macros',["width"=>220])
      </span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>
  @endif

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    @foreach ($menuData[0]->menu as $menu)

    {{-- adding active and open class if child is active --}}

    {{-- menu headers --}}
    @if (isset($menu->menuHeader))
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">{{ $menu->menuHeader }}</span>
    </li>

    @else

    {{-- active menu method --}}
    @php
    $activeClass = null;
    $currentRouteName = Route::currentRouteName();
    $active = isset($menu->submenu)? 'active open': 'active';

    $activeClass = isNavMenuActive($menu, $currentRouteName)? $active: null;
    
    if ($menu->permissions?? false) {
      $permissions = explode(',', $menu->permissions);
      if (! Auth::user()->canAny($permissions))
        continue;
    } elseif(!($menu->hasNoPermissions?? false) && !Auth::user()->hasRole('Super Admin')) {
      continue;
    }
    @endphp

    {{-- main menu --}}
    <li class="menu-item {{$activeClass}}">
      <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}" class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}" @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>
        @isset($menu->icon)
        <i class="{{ $menu->icon }}"></i>
        @endisset
        <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
      </a>

      {{-- submenu --}}
      @isset($menu->submenu)
      @include('layouts.sections.menu.submenu',['menu' => $menu->submenu])
      @endisset
    </li>
    @endif
    @endforeach
  </ul>

</aside>

@php
function isNavMenuActive($menu, $currentRouteName)
{
  if (! is_array($menu)) {
    if (isset($menu->submenu)) {
        return isNavMenuActive($menu->submenu, $currentRouteName);
    }
    // return (isset($menu->url) && '/'.request()->path() === explode('?', $menu->url)[0]) || (isset($menu->slug) && $currentRouteName === $menu->slug);
    return (isset($menu->url) && '/'.request()->path() .'?'.request()->getQueryString() === $menu->url) || (isset($menu->slug) && $currentRouteName === $menu->slug);
  }

  $isActive = false;
  foreach ($menu as $item) {
    $isActive = isNavMenuActive($item, $currentRouteName);
    if ($isActive) return true;
  }

  return false;
}
@endphp