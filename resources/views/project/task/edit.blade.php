@extends('layouts.app')

@section('title')
	태스크 수정
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
		<form class="form-horizontal" role="form" method="POST" id="updateForm"
				action="{{route('project.task.update', [$task->project_id, $task->id])}}">
				@method('PUT')
				@csrf
			
			<div class="form-group">
				<label for="pid">프로젝트</label>
				<div>
					<select class="form-control" name="project_id" id="pid">
						@foreach($projects as $proj)
							<option value="{{$proj->id}}" {{$proj->id==$task->project_id? 'selected' : ''}}>
								{{$proj->name}}
							</option>
						@endforeach		
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="tname">태스크 명</label>
				<div>
					<input type="text" class="form-control" name="name" 
						id = "tname" value="{{$task->name}}">
				</div>
			</div>
			
			<div class="form-group">
				<label for="desc">설명</label>
				<div>
					<textarea class="form-control" name="description" id="desc" rows="3">{{$task->description}}</textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label for="priority">우선순위</label>
				<div>
					<select class="form-control" name="priority" id="priority">
						@foreach(['낮음', '보통', '높음'] as $p)
							<option value="{{$p}}" {{$task->priority==$p ? 'selected':''}}>{{$p}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<lable for="status">상태</lable>
				<div>
					<select class="form-control" name="status" id="status">
						@foreach(['등록', '진행', '완료'] as $s) 
							<option value="{{$s}}" {{$task->status==$s?'selected':''}}>
								{{$s}}
							</option>
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label for="due">기한</label>
				<div class="input-group date" id="due">
					<input type="text" name="due_date" class="form-control" value="{{$task->due_date}}">
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
				<script type="text/javascript">
					$(function(){
						$("#due").datepicker({
							locale:'ko',
							defaultDate: '{{$task->due_date}}',
							format: 'YYYY-MM-D HH:mm:ss'
						});
					});
				</script>
			</div>

			<div class="form-group">
				<label for="cdate">생성일</label>
				<div>
					<input type="text"class="form-control" name="created_at" value="{{$task->created_at}}" readonly="true">
				</div>
			</div>
		</form>
		<div>
			<div class="form-group">
				<button type="button" 
					class="btn btn-success" onclick="update()">수정</button>
				<button type="button" class="btn btn-primary" 
					onclick="location.href='{{route('project.task.index', [$task->project->id])}}'">Task 목록보기
				</button>
			</div>
		</div>	
	</div>
	<script>
		function update() {
			$('#updateForm').submit();
		}
	</script>
@endsection