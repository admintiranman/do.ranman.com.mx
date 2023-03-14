<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\CoreCompetence;
use App\Models\Experience;
use App\Models\JobCompetence;
use App\Models\Knowledge;
use DB;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = json_encode(Job::select('id', 'name')->orderBy('name', 'asc')->get());
        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {

        // arrays to autocomplete
        $array_core = json_encode(CoreCompetence::select('name')->distinct()->pluck('name'));
        $array_job = json_encode(JobCompetence::select('name')->distinct()->pluck('name'));
        $array_knowledge = json_encode(Knowledge::select('name')->distinct()->pluck('name'));
        $array_experiencias = json_encode(Experience::select('name')->distinct()->pluck('name'));

        // job's attrs
        $core_competencies = json_encode($job->core_competencies()->select('name')->get()->all());
        $job_competencies = json_encode($job->job_competencies()->select('name')->get()->all());
        $knowledges = json_encode($job->knowledge()->select('name')->get()->all());
        $experiencias = json_encode($job->experience()->select('name')->get()->all());

        return view('admin.jobs.edit', compact(
            'job', 
            'core_competencies', 
            'job_competencies', 
            'knowledges', 
            'experiencias', 
            'array_core', 
            'array_job', 
            'array_knowledge', 
            'array_experiencias'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }



    public function get_competencias(Job $job) {
        // job's attrs
        $core_competencies = $job->core_competencies()->select('name', 'notas')->get()->all();
        $job_competencies = $job->job_competencies()->select('name', 'notas')->get()->all();
        $knowledges = $job->knowledge()->select('name', 'notas')->get()->all();        
        $experience = $job->experience()->select('name', 'notas')->get()->all();        
        $data = [];
        $max = max([count($core_competencies), count($job_competencies), count($knowledges) , count($experience)]);
        for($i = 0; $i < $max; $i++) { 
            $data[] = [
                'core' => $core_competencies[$i] ?? ['name' => '', 'notas' => ''], 
                'knowledge' => $knowledges[$i]?? ['name' => '', 'notas' => ''], 
                'job' => $job_competencies[$i]?? ['name' => '', 'notas' => ''], 
                'experience' => $experience[$i] ?? ['name' => '', 'notas' => '']
            ];
        }
        return response()->json(['data' => $data]);
        
    }

    public function add_core_competence(Request $request, Job $job)
    {
        CoreCompetence::firstOrCreate([
            'name' => $request->name,
            'job_id' => $job->id
        ]);
        return response()->json(['success' => true]);
    }

    public function add_job_comptence(Request $request, Job $job)
    {
        JobCompetence::firstOrCreate([
            'name' => $request->name,
            'job_id' => $job->id
        ]);
        return response()->json(['success' => true]);
    }

    public function add_knowledge(Request $request, Job $job)
    {
        Knowledge::firstOrCreate([
            'name' => $request->name,
            'job_id' => $job->id
        ]);
        return response()->json(['success' => true]);
    }


    public function add_experience(Request $request, Job $job) {
        
        Experience::firstOrCreate([
            'name' => $request->name,
            'job_id' => $job->id
        ]);
        return response()->json(['success' => true]);

    }



    // Delete competencies 
    public function delete_core_competence(Job $job,  Request $request)
    {
        $txt = $request->name;
        CoreCompetence::where('name', $txt)->where('job_id', $job->id)->delete();
        return response()->json(['success' => true]);
    }

    public function delete_job_comptence(Job $job,  Request $request)
    {
        $txt = $request->name;
        JobCompetence::where('name', $txt)->where('job_id', $job->id)->delete();
        return response()->json(['success' => true]);
    }

    public function delete_knowledge(Job $job,  Request $request)
    {
        $txt = $request->name;
        Knowledge::where('name', $txt)->where('job_id', $job->id)->delete();
        return response()->json(['success' => true]);
    }

    public function delete_experience(Job $job,  Request $request)
    {
        $txt = $request->name;
        Experience::where('name', $txt)->where('job_id', $job->id)->delete();
        return response()->json(['success' => true]);
    }
}
