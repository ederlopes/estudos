<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LynX39\LaraPdfMerger\Facades\PdfMerger;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $pdfMerger;

    public function __construct()
    {
        $this->pdfMerger =  PdfMerger::init();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function index()
    {

        $name_file    = storage_path('app/public/DIRF_COMPLETA.pdf');
        $totalPaginas = $this->countPage($name_file);

        for ($i=1;$i<=$totalPaginas;$i++)
        {
            try
            {
                $new_name_pdf = $i.'.pdf';
                $this->pdfMerger->addPDF($name_file, $i);
                $this->pdfMerger->merge();
                $this->pdfMerger->save(storage_path('app/public/'.$new_name_pdf));
            }catch (\Exception $exception){

            }
        }

    }

    public function countPage($name_file='')
    {
        $name_file    = storage_path('app/public/DIRF_COMPLETA.pdf');
        $parser = new \Smalot\PdfParser\Parser();
        $pdf    = $parser->parseFile($name_file);
        return count($pdf->getPages());
    }


    public function renameArchivePdf()
    {
        $parser = new \Smalot\PdfParser\Parser();
        for ($i=1;$i<=76;$i++)
        {
            try
            {
                $pdf    = $parser->parseFile( storage_path('app/public/'.$i.'.pdf'));
                $cpf = preg_replace("/\D/", '', substr($pdf->getText(), 744, 15));
                echo 'CPF: '.$cpf.'<br>';
                rename( storage_path('app/public/'.$i.'.pdf'), storage_path('app/public/'.$cpf.'.pdf'));
            }catch (\Exception $exception){

            }
        }

    }


    public function downloadPDF(Request $request)
    {
        return response()->download( storage_path('app/public/'.$request->cpf.'.pdf'), $request->cpf.'.pdf', [], 'inline');
    }

}
