<?php

namespace App\Http\Controllers;

use App\Career;
use App\Entity_type;
use Illuminate\Http\Request;


class EntityTypesController extends Controller
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

    public function getAllTypes(Request $request){
        try {
            $entity_types = Entity_type::get();
            return response()->json($entity_types, 200);
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

    public function createEntityType(Request $request)
    {
        try{
            //solo data si nio quiero enviar objetos
            $data = $request->json()->all();
            $dataEntityType = $data['entity_type'];
            //DB::beginTransaction();
            $entityType= Entity_type::create([
                'name_type' => strtoupper($dataEntityType['name_type']) //$dataEntityType['name']
            ]);

            //DB::commit();
            return response()->json(['entity_type' => $entityType], 201);

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

    function updateEntityType(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataEntityType = $data['entity_type'];
            $entityType = Entity_type::findOrFail($dataEntityType ['id'])->update([
                'name_type' => $dataEntityType ['name_type'],
            ]);
            return response()->json($entityType, 201);
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
