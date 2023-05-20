<?php

namespace App\Http\Controllers;  
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Http\Request;

class EquipementController extends Controller
{

    public function index()
    {
        $file_path = public_path('excel.xlsx');
        
        // Création de l'objet PhpSpreadsheet
        $spreadsheet = IOFactory::load($file_path);
        
        // Récupération de la première feuille du classeur
        $worksheet = $spreadsheet->getActiveSheet();
        
        // Récupération des données de la feuille

        $data = array();
        foreach ($worksheet->getRowIterator() as $row) {
            $rowData = array();
            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }
            $data[] = $rowData;
        }

        // Supprimez la première ligne qui contient les noms de colonnes
        array_shift($data);

        // Insérez les données dans la base de données
        foreach ($data as $row) {
            DB::table('equipement')->insert([
                'num_equipement' => $row[0],
                // Ajoutez d'autres colonnes selon le nombre de colonnes dans votre table
            ]);
}







        // $data = [];
        // foreach ($worksheet->getRowIterator() as $row) {
        //     $rowData = [];
        //     foreach ($row->getCellIterator() as $cell) {
        //         $rowData[] = $cell->getValue();
        //     }
        //     $data[] = $rowData;
        // }


        // DB::table('equipement')->insert($data);

        
       


    }
}

