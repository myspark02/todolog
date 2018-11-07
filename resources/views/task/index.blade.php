@extends('layouts.app')

@section('title')
	태스크 목록
@endsection

@section('content')
	<div class="container">
		<form action="{{route('task.index')}}" role="form" class="form-inline">
			
					<div class="form-group col-md-3">
						<label for="start_date" class="control-label">시작일:&nbsp </label>
						<div class="input-group date" id="start_date">
							<input type="text" class="date form-control" id="start_date"
							placeholder="YYYY-MM-DD" name="start_date" value="{{$start_date}}">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				

				
					<div class="form-group  col-md-3">
						<label for="end_date" class="control-label">종료일:&nbsp </label>
						<div class="input-group date" id="end_date">
							<input type="text" class="date form-control"  id="end_date"
							placeholder="YYYY-MM-DD" name="end_date" value="{{$end_date}}">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				

				
					<div class="form-group  col-md-2">
						<label for="priority" class="control-label">우선순위:&nbsp </label>
						<select name="priority" id="priority" class="form-control">
							@foreach(['all', '낮음', '보통', '높음'] as $p)
								<option value="{{$p}}" {{$p==$priority?'selected':''}}>
									{{$p}}
								</option>
							@endforeach
						</select>
					</div>
				

				
					<div class="form-group  col-md-2">
						<label for="status" class="control-label">상태: &nbsp</label>
						<select name="status" id="status" class="form-control">
							@foreach(['all', '등록', '진행', '완료'] as $s)
								<option value="{{$s}}" {{$s==$status?'selected':''}}>
									{{$s}}
								</option>
							@endforeach
						</select>
					</div>
				
					<div class="form-group  col-md-2">						
							<button class="btn btn-primary" type="submit">
								찾기
							</button>						
					</div>
				

			
		</form>
	</div>
		<script>
			$('#start_date').datetimepicker({  
					defaultDate: '{{$start_date}}',
       				format: 'YYYY-MM-DD HH:mm:ss'

     		});  
		</script>

		<h3></h3>
		<table class="table table-striped">
			<thead>
				<tr>
					<td>프로젝트</td>
					<td>태스크</td>
					<td>우선순위</td>
					<td>상태</td>
					<td>기한</td>
				</tr>
			</thead>
			<tobody>
				@foreach($tasks as $task)
				<tr>
					<td>
						{{$task->project->name}}
					</td>
					<td>
						<a href="{{route('project.task.show',[$task->project->id, $task->id])}}">
							{{$task->name}}
						</a>
					</td>
					<td>
						{{$task->priority}}
					</td>
					<td>
						{{$task->status}}
					</td>
					<td>
						{{$task->due_date}}
					</td>
					<td>
						<a class="btn btn-success" href="{{route('project.task.edit', [$task->project->id, $task->id])}}">
							편집
						</a>
					</td>
					<td>
						<form method="POST" action="{{route('project.task.destroy',[$task->project->id, $task->id])}}">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-danger">
								삭제
							</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tobody>
		</table>
		<div class="text-center">
			{{$tasks->appends(['start_date'=>$start_date, 'end_date'=>$end_date, 'status'=>$status, 'priority'=>$priority])->links()}}
		</div>	

@endsection