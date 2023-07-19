<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\v_facturerecette;
use App\Models\v_recette;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use DateTime;

class PDFController extends Controller
{
    public function pdf($id){
        $data = [
            'facture' => v_facturerecette::where('idfacturerecette','=',$id)->first(),
            'detailfacture' =>v_recette::where('idfacturerecette', $id)->get(),
        ];

        // Création d'une nouvelle instance de Dompdf
        $dompdf = new Dompdf();

        // Récupération du contenu de la vue en passant la variable
        $html = View::make('pdf', $data)->render();

        // Chargement du contenu HTML dans Dompdf
        $dompdf->loadHtml($html);

        // Génération du PDF
        $dompdf->render();

        // Envoi du PDF en tant que réponse HTTP
        return $dompdf->stream('facture.pdf');
    }

}
