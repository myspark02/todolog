@extends('layouts.app')

@section('title')
	태스크 생성
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
		<form class="form-horizontal" role="form" method="POST" 
				action="{{route('project.task.store', [$proj->id])}}">
				@csrf

			<div class="form-group">
				<label for="tname">태스크 명</label>
				<div>
					<input type="text" class="form-control" name="name" 
						id = "tname" value="{{old('name')}}">
				</div>
			</div>
			
			<div class="form-group">
				<label for="desc">설명</label>
				<div>
					<textarea class="form-control" name="description" id="desc" rows="3">{{old('description')}}</textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label for="priority">우선순위</label>
				<div>
					<select class="form-control" name="priority" id="priority">
						@foreach(['낮음', '보통', '높음', '즉시'] as $p)
							<option value="{{$p}}" {{old('priority')==$p ? 'selected':''}}>{{$p}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<lable for="status">상태</lable>
				<div>
					<select class="form-control" name="status" id="status">
						@foreach(['등록', '진행', '완료'] as $s) 
							<option value="{{$s}}" {{old('status')==$s?'selected':''}}>
								{{$s}}
							</option>
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label for="due">기한</label>
				<div class="input-group date" id="due">
					<input type="text" name="due_date" class="form-control" >
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
				<script type="text/javascript">
					$(function(){
						$("#due").datepicker({
							locale:'ko',
							defaultDate: '{{old('due_date')?old('due_date'):\Carbon\Carbon::now()}}',
							format: 'YYYY-MM-D HH:mm:ss'
						});
					});
				</script>
			</div>
		
			<div class="form-group">
				<div>
					<button type="submit" class="btn btn-primary">생성</button>
				</div>
			</div>
		</form>
	</div>
@endsection