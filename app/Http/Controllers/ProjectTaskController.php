<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projectId)
    {
        $proj = \App\Project::findOrFail($projectId);
        $tasks = $proj->tasks()->get();

        return view('project.task.index')->with('tasks', $tasks)
                                        ->with('proj', $proj);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($projectId)
    {
        $proj = \App\Project::findOrFail($projectId);

        return view('project.task.create')->with('proj', $proj);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $projectId)
    {
        $task = new \App\Task([
            'name'=> $request->get('name'),
            'description' =>$request->get('description'),
            'priority' =>$request->get('priority'),
            'status' =>$request->get('status'),
            'due_date' =>$request->get('due_date'),
        ]);

        $task->project()->associate($projectId);
        $task->save();

        return redirect(route('project.task.index', $task->project->id))->with('message', $task->name . '가 생성되었습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($projectId, $taskId)
    {
        $user = \Auth::user();
        
        /*
        $proj = \App\Project::findOrFail($projectId);

        if($proj->user_id != $user->id) {
            abort(403, '잘못된 프로젝트 접근입니다.')
        }
        */

        $task = \App\Task::findOrFail($taskId);
        if ($task->project_id != $projectId) {
            abort(403, '잘못된 태스크 접근입니다.');
        }

        return view('project.task.show')->with('task', $task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($projectId, $taskId)
    {
        $user = \Auth::user();
        
        /*
        $proj = \App\Project::findOrFail($projectId);

        if($proj->user_id != $user->id) {
            abort(403, '잘못된 프로젝트 접근입니다.')
        }
        */

        $task = \App\Task::findOrFail($taskId);
        if ($task->project_id != $projectId) {
            abort(403, '잘못된 태스크 접근입니다.');
        }

        $projects = $user->projects()->get();

        return view('project.task.edit')
                            ->with('projects', $projects)
                            ->with('task', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $projectId, $taskId)
    {
        $task = \App\Task::findOrFail($taskId);

        $update2Pid = $request->get('project_id');

        if($projectId != $update2Pid) {
            $project = \App\Project::findOrFail($update2Pid);
            $task->project()->associate($project);
        }

        $task->update([
            'name' => $request->get('name'),
            'description'=>$request->get('description'),
            'priority' =>$request->get('priority'),
            'status' =>$request->get('status'),
            'due_date' => $request->get('due_date'),
        ]);

        return redirect(route('project.task.index', $task->project->id))->with('message', $task->name . '가 수정되었습니다.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($projectId, $taskId)
    {
        $task = \App\Task::findOrFail($taskId);

        if ($task->project->id != $projectId) {
             abort(403, '잘못된 태스크 접근입니다.');
        }
        $task->delete();

        return redirect(route('project.task.index', $task->project->id))
                ->with('message', 'Task ' . $task->name . ' 이 삭제되었습니다.');
    }
}
