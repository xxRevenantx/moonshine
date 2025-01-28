<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Models\User;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf as pdf;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $levels = Level::get();

        $data = [
            'levels' => $levels
        ];

        $pdf = PDF::loadView('myPDF', $data);

        return $pdf->stream("archivo.pdf");
    }
}
