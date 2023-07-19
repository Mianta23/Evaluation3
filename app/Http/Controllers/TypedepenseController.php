<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Typedepense;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use DateTime;

class TypedepenseController extends Controller
{

    public function form()
    {
       return view('crud/typedepense/Form');
    }

    public function listeTypedepense()
     {
        $bloc = 10;
        $page = request()->query('page',1); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = 1;

        $liste = Typedepense::orderBy("idtypedepense", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $liste->lastPage();

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/typedepense/Liste',[
            'liste' => $liste,
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }

     public function pagination(Request $request)
     {
        $bloc = 10;
        $page = request()->query('page',request('numero')); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = request('numero');

        $liste = Typedepense::orderBy("idtypedepense", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $liste->lastPage();

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/typedepense/Liste',[
            'liste' => $liste,
            'currentPage' => request('numero'),
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }

     public function ajouter(Request $request)
     {
         $data = $request->all();
         Typedepense::create($data);
         return redirect("listeTypedepense")->with('success', 'Typedepense ajoute avec succes !');
     }


     public function versmodifier($id)
     {
        $data = Typedepense::find($id);
        return view('crud/typedepense/modifier',[
            'data' => $data
        ]);
     }

     public function supprimer()
     {
       $id = Typedepense::find(request('id'));
       $id->delete();
       return redirect("listeTypedepense")->with('suppression', 'Suppression avec succes !');
     }

     public function modifier(Request $request)
     {
        $data2 = $request->all();
        $item = Typedepense::findOrFail(request('idtypedepense'));
        $item->update($data2);
        return redirect("listeTypedepense")->with('modification', 'Modification effectué avec succes !');
     }

     public function recherche(Request $request)
{
    $keyword = $request->input('motcle'); // récupérer le mot clé de la requête

    $results = DB::table('typedepense')
        ->where(function($query) use ($keyword) {
            $query->where('typedepense', 'LIKE', '%'.$keyword.'%');
        })
        ->get();

        $currentPage = 1;

        $lastPage = 3;

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/Typedepense/Liste',[
            'liste' => $results,
            'currentPage' => 1,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
}

}
