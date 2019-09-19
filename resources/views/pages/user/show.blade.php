@extends('layouts.master')
@section('title')
	{{ $user->name }}
@endsection
@section('content')

@php($active = 'user')

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
	            <h4 class="page-title">{{ $user->name }} </h4>
	            <ol class="breadcrumb p-0 m-0">
	                <li>
	                    <a href="{{ route('user.index') }}">User </a>
	                </li>
	                <li class="active">
	                    {{ $user->name }}
	                </li>
	            </ol>
	            <div class="clearfix"></div>
	        </div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-4 col-md-5">
            <div class="text-center card-box">
                <div class="member-card">
                    <div class="thumb-xl member-thumb m-b-10 center-block">
                        <img src="../{{ $user->photo }}" class="img-circle img-thumbnail" alt="profile-image">
                    </div>
                    <div>
                        <h4 class="m-b-5">{{ $user->name }}</h4>
                        <p class="text-muted"><span>{{ $user->email}}</span></p>
                    </div>
                 	<hr>

                </div>
            </div> <!-- end card-box -->
        </div>
        <div class="col-md-7 col-lg-8">
        	<div class="row">
        		<div class="col-md-12">
       
        			<div class="row mb-30">
        				<div class="col-md-12">
		        			<table class="table">
	        					<tr>
	        						<th>Name</th>
	        						<th>:</th>
	        						<td>{{ $user->name }}</td>
	        					</tr>

	        					<tr>
	        						<th>Email</th>
	        						<th>:</th>
	        						<td>{{ $user->email }}</td>
	        					</tr>

		        			</table>
		        		</div>
	        		</div>
        		</div>
        	</div>
        </div>
	</div>

</div>
@endsection