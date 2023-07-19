<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depense;
use App\Models\v_depense;
use App\Models\Typedepense;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;
use DateTime;

class DepenseController extends Controller
{

    public function form()
    {
        $data=Typedepense::all();
       return view('crud/depense/Form1',[
            'data' =>$data
       ]);
    }

    public function create(Request $request)
    {
        $mois=$request->input('mois');
        foreach($mois as $mois){
            if(checkdate($mois,$request->input('jour'),$request->input('annee'))==false){
                return redirect()->back()->with('erreur','Le jour entree est invalide');
            }
        }
        $m=$request->input('mois');

        foreach($m as $mois){
            $timestamp = Carbon::create($request->input('annee'), $mois, $request->input('jour'));
            $depense=depense::create([
                        'idtypedepense' =>$request->input('idtypedepense'),
                        'montant'=>$request->input('montant'),
                        'nombre'=>$request->input('nombre'),
                        'datedepense'=>$timestamp
            ]);
        }

        return redirect()->back()->with('success','Information enregistree');

    }

    // public function create(Request $request)
    // {
    //     $mois = $request->input('mois');
    //     $isValid = true; // Flag to track if all selected months and days are valid

    //     foreach ($mois as $mois) {
    //         // Vérifier que le mois est valide (entre 1 et 12)
    //         if ($mois < 1 || $mois > 12) {
    //             return redirect()->back()->with('error', 'Mois invalide');
    //         }

    //         // Obtenir le nombre de jours dans le mois sélectionné
    //         $daysInMonth = Carbon::create($request->input('annee'), $mois)->daysInMonth;

    //         // Vérifier que le jour est valide pour le mois sélectionné
    //         if ($request->input('jour') < 1 || $request->input('jour') > $daysInMonth) {
    //             $isValid = false; // Set the flag to indicate at least one month is invalid
    //             break; // No need to check other months, we already found an invalid day
    //         }
    //     }

    //     if (!$isValid) {
    //         return redirect()->back()->with('error', 'Au moins un des mois sélectionnés a un jour invalide');
    //     }

    //     // If all months and days are valid, create expenses
    //     foreach ($mois as $mois) {
    //         $timestamp = Carbon::create($request->input('annee'), $mois, $request->input('jour'));
    //         $depense = depense::create([
    //             'idtypedepense' => $request->input('idtypedepense'),
    //             'montant' => $request->input('montant'),
    //             'nombre' => $request->input('nombre'),
    //             'datedepense' => $timestamp
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Information enregistrée');
    // }





    public function listeDepense()
     {
        $bloc = 100;
        $page = request()->query('page',1); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = 1;

        $liste = v_depense::orderBy("iddepense", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $liste->lastPage();

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/depense/Liste',[
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

        $liste = v_depense::orderBy("iddepense", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $liste->lastPage();

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/depense/Liste',[
            'liste' => $liste,
            'currentPage' => request('numero'),
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }

     public function ajouter(Request $request)
     {
         $data = $request->all();
         Depense::create($data);
         return redirect("listeDepense")->with('success', 'Depense ajoute avec succes !');
     }


     public function versmodifier($id)
     {
        $data = Depense::find($id);
        $data1= Typedepense::all();
        return view('crud/depense/modifier',[
            'data' => $data,
            'data1' => $data1
        ]);
     }

     public function supprimer()
     {
       $id = Depense::find(request('id'));
       $id->delete();
       return redirect("listeDepense")->with('suppression', 'Suppression avec succes !');
     }

     public function modifier(Request $request)
     {
        $data2 = $request->all();
        $item = Depense::findOrFail(request('iddepense'));
        $item->update($data2);
        return redirect("listeDepense")->with('modification', 'Modification effectué avec succes !');
     }

     public function recherche(Request $request)
{
    $keyword = $request->input('motcle'); // récupérer le mot clé de la requête

    $results = DB::table('depense')
        ->where(function($query) use ($keyword) {
            $query->where('depense', 'LIKE', '%'.$keyword.'%');
        })
        ->get();

        $currentPage = 1;

        $lastPage = 3;

        $listeNumeroPage = range(1, $lastPage);

        return view('crud/Depense/Liste',[
            'liste' => $results,
            'currentPage' => 1,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
}

public function importCSV(Request $request)
    {
        if ($request->hasFile('csv')) {
            $file=$request->file('csv');
            $handle=fopen($file->getPathname(), 'r');
            $table_data=array();
            while(($data=fgetcsv($handle, 0, ';')) !==false) {
                $values=explode(';',$data[0]);
                $moment=Carbon::createFromFormat('d/m/Y',$values[0])->format('Y-m-d');
                $type=Typedepense::firstWhere('code',$values[1]);
                // dd($type->id);
                $table_data[]=[
                    'idtypedepense'=> $type->idtypedepense,
                    'montant'=>$values[2],
                    'datedepense'=>$moment
                ];
            }
            fclose($handle);
            DB::table('depense')->insert($table_data);
            return redirect()->back()->with('succes','Enregistrer');

        }
        else  return redirect()->back()->with('succes','Enregistrer');
    }



}
