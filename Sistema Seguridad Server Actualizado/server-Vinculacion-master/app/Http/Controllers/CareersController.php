<?php

namespace App\Http\Controllers;

use App\Career;
use Illuminate\Http\Request;


class CareersController extends Controller
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

    public function getAllCareers(Request $request){
        try {
            $careers = Career::get(); //->first()
            return response()->json($careers, 200);
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

    public function createCareer(Request $request)
    {
        try{
            //solo data si nio quiero enviar objetos
            $data = $request->json()->all();
            $dataCareer = $data['career'];
            //DB::beginTransaction();
            $career = Career::create([
                'name' => $dataCareer ['name'],//strtoupper($dataCareer['name'])
            ]);

            //DB::commit();
            return response()->json(['career' => $career], 201);

        }catch (ModelNotFoundException $e) {
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

    function updateCareer(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataCareer = $data['career'];
            $career = Career::findOrFail($dataCareer ['id'])->update([
                'name' => $dataCareer ['name'],
            ]);
            return response()->json($career, 201);
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
