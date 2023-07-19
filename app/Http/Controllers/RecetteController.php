<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recette;
use App\Models\v_recette;
use App\Models\Typerecette;
use App\Models\Facture_recette;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use DateTime;

class RecetteController extends Controller
{

    public function form()
    {
        $data=Typerecette::all();
        $dataa=Facture_recette::all();
       return view('crud/recette/Form',[
            'data' =>$data,
            'dataa' => $dataa
       ]);


    }

    public function listeRecette()
     {
        $bloc = 100;
        $page = request()->query('page',1); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = 1;

        $liste = v_recette::orderBy("idrecette", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $liste->lastPage();

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/recette/Liste',[
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

        $liste = Recette::orderBy("idrecette", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $liste->lastPage();

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/recette/Liste',[
            'liste' => $liste,
            'currentPage' => request('numero'),
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }

     public function ajouter(Request $request)
     {
         $data = $request->all();
         Recette::create($data);
         return redirect("listeRecette")->with('success', 'Recette ajoute avec succes !');
     }


     public function versmodifier($id)
     {
        $data = Recette::find($id);
        $data1= Typerecette::all();
        $data2= Facture_recette::all();
        return view('crud/recette/modifier',[
            'data' => $data,
            'data1' => $data1,
            'data2' => $data2
        ]);

     }

     public function supprimer()
     {
       $id = Recette::find(request('id'));
       $id->delete();
       return redirect("listeRecette")->with('suppression', 'Suppression avec succes !');
     }

     public function modifier(Request $request)
     {
        $data2 = $request->all();
        $item = Recette::findOrFail(request('idrecette'));
        $item->update($data2);
        return redirect("listeRecette")->with('modification', 'Modification effectué avec succes !');
     }

     public function recherche(Request $request)
{
    $keyword = $request->input('motcle'); // récupérer le mot clé de la requête

    $results = DB::table('recette')
        ->where(function($query) use ($keyword) {
            $query->where('recette', 'LIKE', '%'.$keyword.'%');
        })
        ->get();

        $currentPage = 1;

        $lastPage = 3;

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/Recette/Liste',[
            'liste' => $results,
            'currentPage' => 1,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
}

}
