<?php

namespace App\Http\Controllers;

use App\Career;
use App\Person;
use App\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TutorsController extends Controller
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

    public function getAllTutors(Request $request){
        try {
            $sql = "SELECT  tutors.id, last_name, name, dni, age, address, cellphone, email
                      FROM tutors
                        INNER JOIN people on people.id = tutors.person_id order by last_name
            ";

            $response = DB::select($sql);

            return response()->json($response, 200);
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

    public function createTutor(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataPerson = $data['person'];
            //$dataCoordinator = $data['coordinator'];
            //DB::beginTransaction();
            $person = Person::create([
                'name' => strtoupper($dataPerson['name']),
                'lastname' => $dataPerson['lastname'],
                'dni' => $dataPerson['dni'],
                'age' => $dataPerson['age'],
                'address' => $dataPerson['address'],
                'cellphone' => $dataPerson['cellphone'],
                'email' => $dataPerson['email'],
            ]);
            $response=$person->tutor()->create([

            ]);

            // DB::commit();

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

    function updateTutor(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataPerson = $data['person'];
            $person = Person::findOrFail($dataPerson ['id'])->update([
                'name' => strtoupper($dataPerson['name']),
                'last_name' => $dataPerson['lastname'],
                'dni' => $dataPerson['dni'],
                'age' => $dataPerson['age'],
                'address' => $dataPerson['address'],
                'cellphone' => $dataPerson['cellphone'],
                'email' => $dataPerson['email'],
            ]);
            return response()->json($person, 201);
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
