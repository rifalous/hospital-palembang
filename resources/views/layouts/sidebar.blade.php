
<!--- Sidemenu -->
<div id="sidebar-menu">
    <ul>
		<li class="menu-title">Navigation</li>

		@foreach (App\Menu::list(0)->get() as $menu)


			@if (count($menu->children) > 0)
                            @if (auth()->user()->can($menu->method))
				<li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect {{ explode('/', $active)[0] == $menu->url ? 'active subdrop' : '' }}"><i class="{{ $menu->icon }}"></i> {{ $menu->name }} <span class="menu-arrow"></span> </a>
                                    <ul class="list-unstyled">
                                            @foreach ($menu->children as $child)
                                                @if (auth()->user()->can($child->method))
                                                    <li class="{{ $active == $child->url ? 'active' : '' }}"><a href="{{ url($child->url) }}">{{ $child->name }}</a></li>
                                                @endif
                                            @endforeach
                                    </ul>
				</li>
                            @endif

			@else
                            @if (auth()->user()->can($menu->method))
                                    <li>
                                    <a href="{{ url($menu->url) }}" class="waves-effect {{ $active == $menu->url ? 'active' : '' }}"><i class="{{ $menu->icon }}"></i> <span> {{ $menu->name }} </span> </a>
                                </li>
                            @endif

			@endif

		@endforeach

	</ul>
</div>
<!-- Sidebar -left -->