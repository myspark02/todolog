@extends('layouts.app')

@section('title')
	프로젝트 정보
@endsection

@section('content')
	<div class="col-md-8">
		<div class="form-group">
			<label for="name">프로젝트 명</label>
			<div>
				<input type="text" class="form-control" id="name" name="name" 
						value="{{$proj->name}}" readonly="true">
			</div>
		</div>

		<div class="form-group">
			<label for="desc">설명</label>
			<div>
				<textarea class="form-control" rows="3" id="desc" name="description"
						readonly="true">{{$proj->description}}</textarea>
			</div>
		</div>

		<div class="form-group">
			<label for="created">생성일</label>
			<div>
				<input type="text" class="form-control" name="created_at" id="created"
					value="{{$proj->created_at}}" readonly="true">
			</div>
		</div>

		<div class="form-group">
			<label for="modified">수정일</label>
			<div>
					<input type="text" class="form-control" name="updated_at" id="updated"
						value="{{$proj->updated_at}}" readonly="true">
			</div>
		</div>

		<p>
				<a href="{{route('project.task.index', $proj->id)}}" class="btn btn-info">Task 목록</a>
		</p>
	</div>
@endsection