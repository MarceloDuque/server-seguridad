<?php

namespace App\Http\Controllers;

use App\Career;
use App\Coordinator;
use App\Entity;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CoordinatorsController extends Controller
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

    public function getAllCoordinators(Request $request){
        try {
            $sql = "SELECT  coordinators.id, last_name, name, dni, age, address, cellphone, email
                      FROM coordinators
                        INNER JOIN people on people.id = coordinators.person_id order by last_name
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

    public function createCoordinator(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataPerson = $data['person'];
            //$dataCoordinator = $data['coordinator'];
            //DB::beginTransaction();
            $person = Person::create([
                'name' => strtoupper($dataPerson['name']),
                'last_name' => $dataPerson['last_name'],
                'cellphone' => $dataPerson['cellphone'],
                'email' => $dataPerson['email'],
                'password' => $dataPerson['password'],
            ]);
            $response=$person->coordinator()->create([

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

    function updateCoordinator(Request $request)
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

    public function login(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataPerson = $data['person'];

            $person = Person::where('name', $dataPerson['name'])
            ->orWhere('email', $dataPerson['email'])
            ->select('people.name', 'people.email', 'people.password')
            ->first();

            if ($person && check($dataPerson['password'], $person->password)) {
                return response()->json($person, 200);
            } else {
                return response()->json([], 401);
            }
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (QueryException $e) {
            return response()->json($e, 500);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }
    }

    function logout(Request $request)
    {
        $data = $request->json()->all();
        $dataUser = $data['user'];
        try {
            User::where('user_name', $dataUser['user_name'])->update(['api_token' => str_random(60),]);
            return response()->json([], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException  $e) {
            return response()->json($e, 405);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }

    }
}
