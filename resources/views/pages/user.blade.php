@extends('layouts.master')

@section('title')
	User
@endsection

@section('content')

@php($active = 'user')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">User</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li class="active">
                        User
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
		</div>
	</div>
    <!-- end row -->

    <div class="row">
        <div class="col-sm-4">
             <a href="{{ url('user/create') }}" class="btn btn-pink btn-bordered waves-effect waves-light m-b-20"><i class="mdi mdi-account-plus"></i> Tambah User</a>
        </div><!-- end col -->

        <div class="col-sm-8 text-right">
            <form id="form-search" action="{{ route('user.index') }}" method="get">
                <div class="input-group">
                  <input type="text" name="keyword" class="form-control" placeholder="Search ...">
                  <span class="input-group-btn">
                    <button class="btn btn-default btn-bordered waves-effect waves-light" type="submit"><i class="mdi mdi-magnify"></i></button>
                  </span>
                </div><!-- /input-group -->                
            </form>
        </div>

        <div class="col-xs-12 text-right">
            <button class="btn btn-primary btn-bordered waves-effect waves-light m-b-20" onclick="on_import()"><i class="mdi mdi-upload"></i> Import</button>
            <a href="{{ route('user.export') }}" class="btn btn-custom btn-bordered waves-effect waves-light m-b-20"><i class="mdi mdi-download"></i> Eksport</a>
        </div>

    </div>

    @if (!$users->isEmpty())

        @if (!empty(request()->keyword))

            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <span>{{ $users->total() }} data ditemukan dengan kata kunci {{ request()->keyword }}</span>
            </div>

        @endif

        @foreach ($users->chunk(3) as $chunk)

        <div class="row">

            @foreach ($chunk as $user)

            <div class="col-md-4">
                <div class="text-center card-box">
                    <div class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                            <h3 class="m-0 text-muted"><i class="mdi mdi-dots-horizontal"></i></h3>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('user.edit', $user->id) }}">Edit</a></li>
                            <li><a href="{{ route('user.show', $user->id) }}">View</a></li>
                            <li><a href="javascript:void(0)" onclick="on_delete({{ $user->id }})">Delete</a></li>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" id="form-delete-{{ $user->id}}" style="display:none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <div class="member-card">
                        <div class="thumb-xl member-thumb m-b-10 center-block">
                            <img src="{{ $user->photo }}" class="img-circle img-thumbnail" alt="profile-image">
                        </div>

                        <div class="">
                            <h4 class="m-b-5">{{ $user->name }}</h4>
                            <p class="text-pink">{{ $user->email }}</p>
                            <small class="text-muted">
                            @if ($user->roles()->count() > 0)
                                <span class="text-primary">{{ $user->roles()->pluck('display_name')->implode(', ') }} </span>
                            @endif
                            </small>

                        </div>

                    </div>

                </div>

            </div> <!-- end col -->

            @endforeach

        </div>

        @endforeach

        <div class="row">
            <div class="col-md-12 text-right">
                {{ $users->appends(request()->input())->links() }}
            </div>
        </div>
    @else

        <center><h1 class="text-muted">Data tidak ditemukan</h1></center>

    @endif

</div> <!-- container -->


<!-- Modal for question -->
<div class="modal fade in" tabindex="-1" role="dialog" id="modal-delete-confirm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Apakah anda yakin?</h4>
            </div>
            <div class="modal-body">Data yang dipilih akan dihapus, apakah anda yakin?</div>
            <div class="modal-footer">
                <button type="submit" id="btn-confirm" class="btn btn-danger btn-bordered waves-effect waves-light">Hapus</button>
                <button type="button" class="btn btn-default btn-bordered waves-effect waves-light" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal for import -->
<div class="modal fade in" tabindex="-1" role="dialog" id="modal-import">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Import Data</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('user.import') }}" method="post" enctype="multipart/form-data" id="form-import">
                            @csrf
                            <div class="form-group">
                                <label class="control-label">Pilih File</label>
                                <input type="file" name="file" class="form-control" accept=".xls">
                                <label class="text-muted">*) File format .xls</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn-import" class="btn btn-primary btn-bordered waves-effect waves-light">Import</button>
                <button type="button" class="btn btn-default btn-bordered waves-effect waves-light" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>



@endsection

@push('js')
    @if (session()->has('message'))
    <script type="text/javascript">
        show_notification("{{ session('title') }}","{{ session('type') }}","{{ session('message') }}");
    </script>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script type="text/javascript">
                show_notification("Error","error","{{ $error }}");
            </script>
        @endforeach
    @endif

    <script src="{{ url('assets/js/pages/user.js') }}"></script>

@endpush