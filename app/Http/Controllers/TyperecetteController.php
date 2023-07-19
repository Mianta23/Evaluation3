<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeRecette;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use DateTime;

class TyperecetteController extends Controller
{

    public function form()
    {
       return view('crud/typerecette/Form');
    }

    public function listeTyperecette()
     {
        $bloc = 20;
        $page = request()->query('page',1); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = 1;

        $liste = TypeRecette::orderBy("idtyperecette", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $liste->lastPage();

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/typerecette/Liste',[
            'liste' => $liste,
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }

     public function pagination(Request $request)
     {
        $bloc = 20;
        $page = request()->query('page',request('numero')); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = request('numero');

        $liste = TypeRecette::orderBy("idtyperecette", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $liste->lastPage();

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/typerecette/Liste',[
            'liste' => $liste,
            'currentPage' => request('numero'),
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }

     public function ajouter(Request $request)
     {
         $data = $request->all();
         TypeRecette::create($data);
         return redirect("listeTyperecette")->with('success', 'TypeRecette ajoute avec succes !');
     }


     public function versmodifier($id)
     {
        $data = TypeRecette::find($id);
        return view('crud/typerecette/modifier',[
            'data' => $data
        ]);
     }

     public function supprimer()
     {
       $id = TypeRecette::find(request('id'));
       $id->delete();
       return redirect("listeTyperecette")->with('suppression', 'Suppression avec succes !');
     }

     public function modifier(Request $request)
     {
        $data2 = $request->all();
        $item = TypeRecette::findOrFail(request('idtyperecette'));
        $item->update($data2);
        return redirect("listeTyperecette")->with('modification', 'Modification effectué avec succes !');
     }

     public function recherche(Request $request)
{
    $keyword = $request->input('motcle'); // récupérer le mot clé de la requête

    $results = DB::table('typerecette')
        ->where(function($query) use ($keyword) {
            $query->where('typerecette', 'LIKE', '%'.$keyword.'%');
        })
        ->get();

        $currentPage = 1;

        $lastPage = 3;

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/TypeRecette/Liste',[
            'liste' => $results,
            'currentPage' => 1,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
}

}
