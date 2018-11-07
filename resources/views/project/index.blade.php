@extends('layouts.app');

@section('title')
 프로젝트 목록
@endsection

@section('content')
	<div class="col-md-12">
		<p>
			<a href="{{route('project.create')}}" class="btn btn-success">프로젝트 생성</a>
		</p>
	

		<table class="table table-stiped">
			<thead>
				<tr>
					<td>이름</td>
					<td>Description</td>
					<td>생성일</td>
				</tr>
			</thead>
			<tbody>
				@foreach($projects as $proj)
					<tr>
						<td>
							<a href="{{route('project.show', [$proj->id])}}">{{$proj->name}}</a>
						</td>
						<td>
							{{$proj->description}}
						</td>
						<td>
							{{$proj->created_at}}
						</td>
						<td>
							<a class="btn btn-success" 
								href="{{route('project.edit', [$proj->id])}}">
								편집
							</a>
						</td>
						<td>
							<form action="{{route('project.destroy', $proj->id)}}" method="POST">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">삭제</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection