<?php

namespace App\Http\Middleware;

use Closure;

class OwnerCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard=null)
    {
        if(\Auth::guard($guard)->check()) { // logined or not
            //$pid = \Route::current()->getParameter('project');
            $pid = $request->route('project');
            
            \Log::debug('project id from route', ['project_id' => $pid]);

            if(isset($pid)) {
                $project = \App\Project::find($pid);

                $user = \Auth::user();
                if($project->user->id != $user->id) {
                    \Log::error('잘못된 프로젝트 접근 시도:', [
                      'user_id' => $user->id, 
                      'name' => $user->name, 
                      'project_id' => $project->id,       
                    ]);

                    return redirect('/')
                            ->with('message', '인증 실패: 소유한 프로젝트만 접근 가능합니다.');
                }
            }
        }
        return $next($request);
    }
}
