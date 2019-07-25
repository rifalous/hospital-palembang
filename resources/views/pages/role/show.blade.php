@extends('layouts.master')
@section('title')
	{{ $role->display_name }}
@endsection

@section('content')

@php($active = 'settings/role')
	
	<div class="container">

        <div class="row">
			<div class="col-xs-12">
				<div class="page-title-box">
                    <h4 class="page-title">{{ $role->display_name }}</h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="{{ route('role.index') }}">Peran</a>
                        </li>
                        <li class="active">
                            {{ $role->display_name }}
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
			</div>
		</div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel-content">
                    <table class="table table-primary table-custom">
                        <tr class="info">
                            <td colspan="2">Peran Informasi</td>
                            <td style="width: 350px">Izin</td>
                        </tr>
                        <tr>
                            <td>Nama Peran</td>
                            <td>{{ $role->display_name }} ({{ $role->name }})</td>
                            <td rowspan="2">
                                {!! '<span class="label label-primary" style="margin: 5px">'.$role->perms()->pluck('display_name')->implode('</span><span class="label label-primary" style="margin: 5px">') !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>{{ $role->description }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    
    </div>

@endsection