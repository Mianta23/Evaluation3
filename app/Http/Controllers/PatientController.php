<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use DateTime;

class PatientController extends Controller
{

    public function form()
    {
       return view('crud/patient/Form');
    }

    public function listePatient()
     {
        $bloc = 100;
        $page = request()->query('page',1); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = 1;

        $liste = Patient::orderBy("idpatient", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $liste->lastPage();

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/patient/Liste',[
            'liste' => $liste,
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }

     public function pagination(Request $request)
     {
        $bloc = 100;
        $page = request()->query('page',request('numero')); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = request('numero');

        $liste = Patient::orderBy("idpatient", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $liste->lastPage();

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/patient/Liste',[
            'liste' => $liste,
            'currentPage' => request('numero'),
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }

     public function ajouter(Request $request)
     {
         $data = $request->all();
         Patient::create($data);
         return redirect("listePatient")->with('success', 'Patient ajoute avec succes !');
     }


     public function versmodifier($id)
     {
        $data = Patient::find($id);
        return view('crud/patient/modifier',[
            'data' => $data
        ]);
     }

     public function supprimer()
     {
       $id = Patient::find(request('id'));
       $id->delete();
       return redirect("listePatient")->with('suppression', 'Suppression avec succes !');
     }

     public function modifier(Request $request)
     {
        $data2 = $request->all();
        $item = Patient::findOrFail(request('idpatient'));
        $item->update($data2);
        return redirect("listePatient")->with('modification', 'Modification effectué avec succes !');
     }

     public function recherche(Request $request)
{
    $keyword = $request->input('motcle'); // récupérer le mot clé de la requête

    $results = DB::table('patient')
        ->where(function($query) use ($keyword) {
            $query->where('patient', 'LIKE', '%'.$keyword.'%');
        })
        ->get();

        $currentPage = 1;

        $lastPage = 3;

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/Patient/Liste',[
            'liste' => $results,
            'currentPage' => 1,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
}

}
