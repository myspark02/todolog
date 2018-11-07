@extends('layouts.app')

@section('title')
	프로젝트 생성
@endsection

@section('content')
	<div class="col-md-12">
		@if(count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif		
		<h3> 프로젝트 등록</h3>
		<form class="form-horizontal" role="form" method="POST"
			action="{{route('project.store')}}">
			@csrf
			<div class="form-group">
				<label for="pname">프로젝트 명</label>
				<div>
					<input type="text" class="form-control" name="name" id="pname"
						value="{{old('name')}}">
				</div>
			</div>
			<div class="form-group">
				<label for="desc">설명</label>
				<div>
					<textarea class="form-control" rows="5" name="description" id="desc"
						value="{{old('description')}}"></textarea>
				</div>				
			</div>
			<div class="form-group">
				<div>
					<button type="submit" class="btn btn-primary">
						등록
					</button>
				</div>				
			</div>
		</form>
	</div>
@endsection