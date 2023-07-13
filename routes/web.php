<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BiController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\SubSummaryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ObjectiveController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PlanDesarrolloIndividualController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\EvaluationResponseController;
use App\Http\Controllers\RetroalimentacionController;
use App\Http\Controllers\EvaluacionPerfilController;
use App\Http\Controllers\EvControlController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\LDAPController;
use App\Http\Controllers\UserController;
// use Illuminate\Support\Facades\Auth;

Route::group([

    'middleware'  => 'guest'

], function () {
    Route::get('/login', function() {
        return view('auth.login');
    });
    Route::post('/login', [LDAPController::class, 'login'])->name('login');
});

// Auth::routes();


Route::group([
    'middleware' => 'auth'
], function () {    

    Route::post('/logout', [LDAPController::class, 'logout'])->name('logout');
    Route::get('/documentation', [DocumentationController::class, 'index'])->name('documentation.index');
    Route::get('/documentation/pdi', [DocumentationController::class, 'pdi'])->name('documentation.pdi');
    Route::get('/documentation/competencias', [DocumentationController::class, 'competencias'])->name('documentation.competencias');
    Route::get('/documentation/interpretacion', [DocumentationController::class, 'interpretacion'])->name('documentation.interpretacion');

    Route::get('/documentation/retroalimentacion', [DocumentationController::class, 'retroalimentacion'])->name('documentation.retroalimentacion');
    Route::get('/documentation/coaching', [DocumentationController::class, 'coaching'])->name('documentation.coaching');

    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::get('/survey/{survey}/clonar/form', [SurveyController::class, 'get_clonar'])->name('survey.get_clonar');
    Route::post('/survey/{survey}/clonar', [SurveyController::class, 'clonar'])->name('survey.clonar');
    Route::get('/objetivo/{objective}/edit/{txt}', [ObjectiveController::class, 'edit'])->name('objetivo.edit');
    Route::get('/objetivo/{objective}/{txt}', [ObjectiveController::class, 'show'])->name('objetivo.show');
    // Route::resource('evaluacion', EvaluationResponseController::class);
    Route::get('/instrucciones', function () {
        return view('instrucciones');
    });
    Route::get('/', function () {
        return redirect()->route('home');
    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('survey', SurveyController::class)->scoped(['survey' => 'slug']);
    Route::resource('survey.summary', SummaryController::class)->scoped(['survey' => 'slug']);
    Route::resource('survey.summary.subsummary', SubsummaryController::class)->scoped(['survey' => 'slug']);
    Route::resource('subsummary.question', QuestionController::class);

    Route::get('/bi/9box', [BiController::class, 'nine_box'])->name('bi.9box');

    Route::resource('objectives', ObjectiveController::class);
    Route::get('objective/pdf/{objective}/{txt}', [ObjectiveController::class, 'show_pdf'])->name('objective.pdf');
    Route::get('/team', [TeamController::class, 'index'])->name('team.index');
    


    // UserController 

    Route::resource('user', UserController::class);
    Route::get('export/users', [UserController::class, 'export'])->name('user.export');
    Route::post('import/users', [UserController::class, 'import'])->name('user.import');
    
    
    // Route::resource('profile', ProfileController::class)->only(['show']);
    Route::get('/organigrama', [TeamController::class, 'organigrama'])->name('team.organigrama');
    Route::get('/organigrama/chart', [TeamController::class, 'chart'])->name('organigrama.chart');    

    Route::get('/evaluacion/{evaluacion}', [EvaluationResponseController::class, 'edit'])->name('evaluacion.edit');
    Route::get('/evaluacion', [EvaluationResponseController::class, 'index'])->name('evaluacion.index');
    Route::put('/evaluacion/{evaluacion}', [EvaluationResponseController::class, 'update'])->name('evaluacion.update');    
    // Route::resource('profile.retroalimentacion', RetroalimentacionController::class);

    Route::get('/retroalimentacion/{id}/edit', [RetroalimentacionController::class, 'edit'])->name('retro.edit');
    Route::put('/retro/{retroalimentacion}', [RetroalimentacionController::class, 'update'])->name('retro.update');

    // Evaluaciones 
    // Route::resource('/evaluacion', Evaluation::class)->scoped(['evaluation' => 'uuid']);

    // Evaluaciones de perfil
    Route::resource('evaluacion-de-perfil', EvaluacionPerfilController::class);
    Route::resource('pdi', PlanDesarrolloIndividualController::class);

    // Route::post('/pdi/practica', [PdiPracticaController::class, 'store']);
    // Route::post('/pdi/guia', [PdiGuiaController::class, 'store']);
    // Route::post('/pdi/formacion', [PdiFormacionController::class, 'store']);



});


// Routes admin controller
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth'
], function () {


    Route::get('/organigrama/{grupo}', [AdminController::class, 'organigrama'])->name('organigrama');
    Route::get('/organigrama/chart/{grupo}', [AdminController::class, 'organigrama_chart'])->name('organigrama_chart');
    
    // Exports Excel
    Route::get('/export/objetivos', [ExportController::class, 'objetivos'])->name('export.objetivos');
    Route::get('/export/evaluaciones', [ExportController::class, 'evaluaciones'])->name('export.evaluaciones');
    Route::get('/export/retroalimentaciones', [ExportController::class, 'retroalimentaciones'])->name('export.retroalimentaciones');
    Route::get('/export/pdi', [ExportController::class, 'pdi'])->name('export.pdi');    
    Route::get('/export/organigrama', [ExportController::class, 'organigrama'])->name('export.organigrama');

    // Route::get('/export/report/evaluaciones', [ExportController::class, 'report_evaluations'])->name('exports.evaluations');




    Route::get('/dashboard', [DashboardController::class, 'get'])->name('dashboard.index');
    Route::get('/dashboard/objetivos', [DashboardController::class, 'objectives'])->name('dashboard.objectives');
    Route::get('/dashboard/evaluaciones', [DashboardController::class, 'evaluaciones'])->name('dashboard.evaluaciones');
    Route::get('/dashboard/retroalimentaciones', [DashboardController::class, 'retro'])->name('dashboard.retroalimentaciones');


    // Route ev show
    Route::get('/ev/{uuid}/show', [DashboardController::class, 'ev_show'] )->name('dashboard.ev.show');

    // PDI
    Route::get('/dashboard/pdi', [DashboardController::class, 'pdi'])->name('dashboard.pdi');
    Route::get('/dashboard/pdi/{id}/show', [DashboardController::class, 'pdi_show'])->name('dashboard.pdi_show');

    
    Route::get('/objetivos/create', [ObjectiveController::class, 'create'])->name('objetivos.create');
    Route::get('/objetivos/index', [ObjectiveController::class, 'index'])->name('objetivos.index');

    Route::post('/objetivos/update', [ObjectiveController::class, 'change_permisos']);

    Route::resource('jobs', JobController::class);
    Route::resource('evaluaciones', EvControlController::class);
    Route::post('evaluaciones/refresh/{id}', [EvControlController::class, 'refresh_evaluation'])->name('control.refresh');
    // Route::resource('evaluations', EvaluationController::class);
    Route::post('/jobs/{job}/add/core/competence', [JobController::class, 'add_core_competence'])->name('job.add_core_competence');
    Route::post('/jobs/{job}/add/job/competence', [JobController::class, 'add_job_comptence'])->name('job.add_job_competence');
    Route::post('/jobs/{job}/add/knowledge', [JobController::class, 'add_knowledge'])->name('job.add_knowledge');
    Route::post('/jobs/{job}/add/experience', [JobController::class, 'add_experience'])->name('job.add_experience');

    Route::put('/jobs/{job}/delete/core/competence', [JobController::class, 'delete_core_competence'])->name('job.delete_core_competence');
    Route::put('/jobs/{job}/delete/job/competence', [JobController::class, 'delete_job_comptence'])->name('job.delete_job_competence');
    Route::put('/jobs/{job}/delete/knowledge', [JobController::class, 'delete_knowledge'])->name('job.delete_knowledge');
    Route::put('/jobs/{job}/delete/experience', [JobController::class, 'delete_experience'])->name('job.delete_experience');

    Route::get('/job/competences/{job}', [JobController::class, 'get_competencias'])->name('job.get_competences');


    
    // Agregar usuario a las evaluaciones 
    Route::post('evaluaciones/{id}/add-user', [EvControlController::class, 'addUser'])->name('evControl.addUser');

});