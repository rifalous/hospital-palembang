<li id="menuItem_{{ $menu->id }}" {{ !$menu->is_showed ? 'class=disabled' : '' }}>
	<div>
		<span data-id="{{ $menu->id }}"> <i class="{{ $menu->icon }}"></i> &nbsp; {{ $menu->name }}</span>
		<span class="right-toggle">
			<button class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah" onclick="on_edit({{ $menu->id }})"><i class="mdi mdi-pencil"></i></button>
			<button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete({{ $menu->id }})"><i class="mdi mdi-close"></i></button>
		</span>
	</div>
	@if (count($menu->children) > 0)
	<ol>
		@foreach($menu->children as $menu)
			@include('pages.menu.partial', $menu)
		@endforeach
	</ol>
	@endif
</li>