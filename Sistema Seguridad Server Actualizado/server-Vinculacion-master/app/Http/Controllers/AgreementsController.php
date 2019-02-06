<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AgreementsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     * SELECT agreements.id, theme,entities.name, entity_types.name_type, entity_id, project_id, state
    FROM agreements
    INNER JOIN entities on entities.id = agreements.entity_id
    INNER JOIN projects on projects.id = agreements.project_id
    INNER JOIN entity_types on entity_types.id = entities.entity_type_id
     */
    public function __construct()
    {
        //
    }

    public function getAllAgreements(Request $request)
    {
        try {
            $sql = "SELECT agreements.id, theme,entities.name, entity_types.name_type, entity_id, project_id, state
                    FROM agreements
                        INNER JOIN entities on entities.id = agreements.entity_id
                        INNER JOIN projects on projects.id = agreements.project_id
                        INNER JOIN entity_types on entity_types.id = entities.entity_type_id
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

    public function createAgreement(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataAgreement = $data['agreement'];


            $sql = "INSERT INTO agreements(
                            entity_id, project_id, state, route_file1, route_file2, route_file3
                            )
                    VALUES ( ?, ?, ?, ?, ?, ? 
                        );";
            $parameters = [
                $dataAgreement['entity_id'],
                $dataAgreement['project_id'],
                $dataAgreement['state'],
                $dataAgreement ['route_file1'],
                $dataAgreement ['route_file2'],
                $dataAgreement ['route_file3'],

            ];

            $response = DB::select($sql, $parameters);

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

    function updateAgreement(Request $request)
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
