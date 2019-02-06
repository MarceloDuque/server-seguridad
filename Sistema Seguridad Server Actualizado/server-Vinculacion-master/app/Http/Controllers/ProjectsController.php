<?php

namespace App\Http\Controllers;

use App\Career;
use App\Coordinator;
use App\Project;
use App\Student;
use App\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProjectsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getAllProjects(Request $request){
        try {
            $projects = Project::get(); //
            return response()->json($projects, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 409);
        } catch (\PDOException $e) {
            return response()->json($e, 409);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function createProject(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataProject = $data['project'];
            /*$student = Student::where('id', $dataProject['student_id'])->first();
            $tutor = Tutor::where('id', $dataProject['tutor_id'])->first();
            $coordinator = Coordinator::where('id', $dataProject['coordinator_id'])->first();
            if ($student && $coordinator && $tutor) {
                /$project = Project::create([
                    'theme' => $dataProject ['theme'],
                    'hours' => $dataProject ['hours'],
                    'start_date' => $dataProject ['start_date'],
                    'end_date' => $dataProject ['end_date'],
                    'route_file' => $dataProject ['route_file'],
                ]);
                $project->student()->attach($dataProject['student_id']);
                $project->tutor()->attach($dataProject['student_id']);
                $project->coordinator()->attach($dataProject['student_id']);*/

                $sql="INSERT INTO projects (student_id, tutor_id, coordinator_id, theme, hours, start_date, end_date, route_file)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $parameters=[
                    $dataProject['student_id'],
                    $dataProject['tutor_id'],
                    $dataProject['coordinator_id'],
                    $dataProject ['theme'],
                    $dataProject ['hours'],
                    $dataProject ['start_date'],
                    $dataProject ['end_date'],
                    $dataProject ['route_file']
                ];

                $response = DB::select($sql, $parameters );

                return response()->json($response, 201);

        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    function updateProject(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataEntity = $data['entity'];
            $entity = Entity::findOrFail($dataEntity ['id'])->update([
                'name' => $dataEntity ['name'],
                'address' => $dataEntity ['address'],
                'email' => $dataEntity ['email'],
                'telephone' => $dataEntity ['telephone'],
            ]);
            return response()->json($entity, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    //
}
