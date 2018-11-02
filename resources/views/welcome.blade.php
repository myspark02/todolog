@extends('layouts.app')

@section('title')
웹컴 페이지
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="card">
                    <div class="card-header">
                      <h5>라라벨 Todo 사이트</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                        총 가입자 수: {{$total['user']}}
                        </li>
                        <li class="list-group-item">
                        프로젝트  수: {{$total['project']}}
                        </li>
                        <li class="list-group-item">
                        Task    수: {{$total['task']}}
                        </li>  
                    </ul>
                </div>
            </div> 
        </div>
    </div>    
@endsection