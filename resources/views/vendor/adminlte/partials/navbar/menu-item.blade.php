@inject('menuItemHelper', \JeroenNoten\LaravelAdminLte\Helpers\MenuItemHelper::class)

{{-- @if ($menuItemHelper->isSearchBar($item)) --}}
@if ($item=='search')
    {{-- Search form --}}
    @include('adminlte::partials.navbar.menu-item-search-form')

@elseif ($menuItemHelper->isSubmenu($item))

    {{-- Dropdown menu --}}
    @include('adminlte::partials.navbar.menu-item-dropdown-menu')

@elseif ($menuItemHelper->isLink($item))


    {{-- Link --}}
    @include('adminlte::partials.navbar.menu-item-link')

@endif
