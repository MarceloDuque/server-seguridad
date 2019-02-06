<?php

namespace App\Http\Controllers;

use App\Career;
use App\Entity;
use App\Entity_type;
use Illuminate\Http\Request;


class EntitiesController extends Controller
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

    public function getAllEntities(Request $request){
        try {
            $entities = Entity::get(); //
            return response()->json($entities, 200);
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

    public function createEntity(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataEntity = $data['entity'];
            $entity_type = Entity_type::where('id', $dataEntity['entity_type_id'])->first();
            if ($entity_type) {
                $response = $entity_type->entities()->create([
                    'name' => $dataEntity ['name'],
                    'address' => $dataEntity ['address'],
                    'email' => $dataEntity ['email'],
                    'telephone' => $dataEntity ['telephone'],
                ]);
                return response()->json($response, 201);
            } else {
                return response()->json(null, 404);
            }
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

    function updateEntity(Request $request)
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
