<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        //$projects = $user->projects();
        $projects = \App\Project::where('user_id', $user->id)->orderBy('updated_at', 'desc')->get();

        return view('project.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:20',
        ]);

        $proj = new \App\Project([
            'name' => $request->get('name'), 
            'description' => $request->get('description'),
        ]);

        $user = \Auth::user();

        $proj->user_id = $user->id;

        $proj->save();

        $drv = \Config::get('cache.default');

        if ($drv == 'redis') {
            \Redis::incr('project:count');
        }

        return redirect('/project')->with('message', $proj->name . " 이 생성되었습니다.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proj = \App\Project::find($id);
        if($proj == null) {
            abort(404, $id . ' 모델을 찾을 수 가 없습니다.');
        }

        return view('project.show')->with('proj', $proj);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proj = \App\Project::findOrFail($id);

        return view('project.edit')->with('proj', $proj);
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $proj = \App\Project::findOrFail($id);

       $proj->update([
            'name' =>$request->get('name'),
            'description' => $request->get('description'),
       ]);

       return redirect('/project')->with('message', $proj->name . '프로젝트가 수정되었습니다.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proj = \App\Project::findOrFail($id);

        foreach($proj->tasks as $task) {
            $task->delete();
        }

        $proj->delete();

        $drv = \Config::get('cache.default');

        if ($drv == 'redis') {
            \Redis::decr('project:count');
        }       

        return redirect('/project')->with('message', '프로젝트 ' . $proj->name . ' 이 삭제되었습니다.');
    }
}
