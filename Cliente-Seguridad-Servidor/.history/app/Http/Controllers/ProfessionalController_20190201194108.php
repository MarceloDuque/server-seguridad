<?php

namespace App\Http\Controllers;

use App\Company;
use App\Professional;
use App\AcademicFormation;
use App\Ability;
use App\Language;
use App\Course;
use App\ProfessionalExperience;
use App\ProfessionalReference;
use Illuminate\Support\Facades\DB;
use App\Offer;
use Illuminate\Http\Request;
Use Exception;
Use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
Use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfessionalController extends Controller
{

    /* Metodo para filtrar a los profesionales*/
    function filterProfessionals(Request $request)
    {

        $data = $request->json()->all();
        $professionals = Professional::
        join('academic_formations', 'academic_formations.professional_id', '=', 'professionals.id')
            ->orWhere('academic_formations.professional_degree', 'like', $data['professional_degree'] . '%')
            ->orWhere('academic_formations.professional_degree', 'like', $data['professional_degree'] . '%')
            ->get();
        return $professionals;
        $professionals = Professional::orWhere('broad_field', 'like', $data['broad_field'] . '%')
            ->orWhere('specific_field', 'like', $data['specific_field'] . '%')
            ->orWhere('position', 'like', $data['position'] . '%')
            ->orWhere('remuneration', 'like', $data['remuneration'] . '%')
            ->orWhere('working_day', 'like', $data['working_day'] . '%')
            ->orderby($request->field, $request->order)
            ->paginate($request->limit);
        return response()->json([
            'pagination' => [
                'total' => $professionals->total(),
                'current_page' => $professionals->currentPage(),
                'per_page' => $professionals->perPage(),
                'last_page' => $professionals->lastPage(),
                'from' => $professionals->firstItem(),
                'to' => $professionals->lastItem()
            ], 'offers' => $professionals], 200);

    }

    /* Metodos para gestionar los datos personales*/
    function getProfessionals(Request $request)
    {
        $professionals = Professional::with('academicFormations')
            ->where('professionals.state', 'ACTIVE')
            ->orderby('professionals.' . $request->field, $request->order)
            ->paginate($request->limit);

        return response()->json([
            'pagination' => [
                'total' => $professionals->total(),
                'current_page' => $professionals->currentPage(),
                'per_page' => $professionals->perPage(),
                'last_page' => $professionals->lastPage(),
                'from' => $professionals->firstItem(),
                'to' => $professionals->lastItem()
            ], 'postulants' => $professionals], 200);

    }

    function getAllProfessionals()
    {
        $offers = Offer::where('state', 'ACTIVE')
            ->get();
        return response()->json(['offers' => $offers], 200);

    }

    function showProfessional($id)
    {
        try {
            $professional = Professional::where('user_id', $id)->first();
            return response()->json(['professional' => $professional], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException  $e) {
            return response()->json($e, 405);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    function updateProfessional(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataProfessional = $data['professional'];
            $professional = Professional::findOrFail($dataProfessional['id'])->update([
                'identity' => $dataProfessional['identity'],
                'first_name' => strtoupper($dataProfessional['first_name']),
                'last_name' => strtoupper($dataProfessional['last_name']),
                'email' => strtolower($dataProfessional['email']),
                'nationality' => strtoupper($dataProfessional['nationality']),
                'civil_state' => strtoupper($dataProfessional['civil_state']),
                'birthdate' => $dataProfessional['birthdate'],
                'gender' => strtoupper($dataProfessional['gender']),
                'phone' => $dataProfessional['phone'],
                'address' => strtoupper($dataProfessional['address']),
            ]);
            return response()->json($professional, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (QueryException $e) {
            return response()->json($e, 500);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    function deleteProfessional(Request $request)
    {
        try {
            $professional = Professional::findOrFail($request->id)->delete();
            return response()->json($professional, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }
    }

    
    function detachCompany(Request $request)
    {
        try {
            $data = $request->json()->all();
            $user = $data['user'];
            $company = $data['company'];
            $professional = Professional::where('user_id', $user['id'])->first();
            if ($professional) {
                $response = $professional->companies()->detach($company['company_id']);
                if ($response == 0) {
                    return response()->json($response, 404);
                } else {
                    return response()->json($response, 201);
                }

            } else {
                return response()->json(0, 404);
            }
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


}
