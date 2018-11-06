@extends('layouts.app')

@section('title')
	태스크 상세정보
@endsection

@section('content')
	<div class="container">			
		<div class="form-group">
			<label for="pname">프로젝트</label>
			<input type="text" class="form-control" name="pname" 
				id = "pname" readonly="true" 
				value="{{$task->project->name}}">
		</div>

		<div class="form-group">
			<label for="tname">태스크 명</label>
			<input type="text" class="form-control" name="name" 
				id = "tname" readonly="true" 
				value="{{$task->name}}">
		</div>
		
		<div class="form-group">
			<label for="desc">설명</label>
			<textarea class="form-control" name="description" 
			id="desc" rows="3" readonly="true">{{$task->description}}</textarea>
		</div>
		
		<div class="form-group">
			<label for="priority">우선순위</label>
			<input type="text" name="priority" class="form-control" 
				value="{{$task->priority}}" readonly="true">
		</div>

		<div class="form-group">
			<lable for="status" class="control-label">상태</lable>
			<input type="text" name="status" class="form-control" 
				value="{{$task->status}}" readonly="true">
		</div>
		
		<div class="form-group">
			<label for="due" class="control-label">기한</label>
			<input type="text" name="due_date" class="form-control" 
				value="{{$task->due_date}}" readonly="true">
		</div>

		<div class="form-group">
			<label for="cdate" class="control-label">생성일</label>
			<input type="text"class="form-control" name="created_at" value="{{$task->created_at}}" readonly="true">
			
		</div>

		<div class="form-group">
			<button type="button" class="btn btn-primary" 
			onclick="location.href='{{route('project.task.index', [$task->project->id])}}'">Task 목록보기</button>
		</div>
		
	</div>
@endsection