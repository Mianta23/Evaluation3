<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture_recette;
use App\Models\v_facturerecette;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use DateTime;

class FacturerecetteController extends Controller
{

    public function form()
    {
        $data=Patient::all();
       return view('crud/facturerecette/Form',[
            'data' =>$data
       ]);
    }


    public function listeFacturerecette()
     {
        $bloc = 5;
        $page = request()->query('page',1); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = 1;

        $liste = v_facturerecette::orderBy("idfacturerecette", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $liste->lastPage();

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/facturerecette/Liste',[
            'liste' => $liste,
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }

     public function pagination(Request $request)
     {
        $bloc = 5;
        $page = request()->query('page',request('numero')); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = request('numero');

        $liste = v_facturerecette::orderBy("idfacturerecette", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $liste->lastPage();

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/facturerecette/Liste',[
            'liste' => $liste,
            'currentPage' => request('numero'),
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }

     public function ajouter(Request $request)
     {
         $data = $request->all();
         Facture_recette::create($data);
         return redirect("listeFacturerecette")->with('success', 'Facture_recette ajoute avec succes !');
     }


     public function versmodifier($id)
     {
        $data = Facturerecette::find($id);
        $data1= Patient::all();
        return view('crud/facturerecette/modifier',[
            'data' => $data,
            'data1' => $data1
        ]);
     }

     public function supprimer()
     {
       $id = Facture_recette::find(request('id'));
       $id->delete();
       return redirect("listeFacturerecette")->with('suppression', 'Suppression avec succes !');
     }

     public function modifier(Request $request)
     {
        $data2 = $request->all();
        $item = Facture_recette::findOrFail(request('idfacturerecette'));
        $item->update($data2);
        return redirect("listeFacturerecette")->with('modification', 'Modification effectué avec succes !');
     }

     public function recherche(Request $request)
{
    $keyword = $request->input('motcle'); // récupérer le mot clé de la requête

    $results = DB::table('facture_recette')
        ->where(function($query) use ($keyword) {
            $query->where('facturerecette', 'LIKE', '%'.$keyword.'%');
        })
        ->get();

        $currentPage = 1;

        $lastPage = 3;

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/facturerecette/Liste',[
            'liste' => $results,
            'currentPage' => 1,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
}

}
