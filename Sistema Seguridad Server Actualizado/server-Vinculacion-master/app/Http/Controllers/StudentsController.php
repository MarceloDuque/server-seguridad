<?php

namespace App\Http\Controllers;

use App\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StudentsController extends Controller
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

    public function createCareer(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataPerson = $data['person'];
            $dataStudent = $data['student'];
            //DB::beginTransaction();
            $person = Person::create([
                'name' => strtoupper($dataPerson['name']),
                'last_name' => $dataPerson['lastname'],
                'dni' => $dataPerson['dni'],
                'age' => $dataPerson['age'],
                'address' => $dataPerson['address'],
                'cellphone' => $dataPerson['cellphone'],
                'email' => $dataPerson['email'],
            ]);
            $response = $person->student()->create([

            ]);

            // DB::commit();

            return response()->json($response, 201);

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

    public function getAllStudents(Request $request)
    {
        try {
            $sql = "SELECT  students.id, last_name, name, dni, age, address, cellphone, email
              FROM students
                INNER JOIN people on people.id = students.person_id order by last_name
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
    //
}
