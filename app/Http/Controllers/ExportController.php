<?php

namespace App\Http\Controllers;

use App\Models\Pregnant;
use Barryvdh\DomPDF\Facade\Pdf;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;


class ExportController extends Controller
{
    public function reportPdf()
    {
        $user = 'Todos';
        $pregants = Pregnant::all();

        $pdf = Pdf::loadView(
            'exports.report-pregants',
            compact('pregants')
        );

        // return $pdf->stream('reportePagos.pdf');
        return $pdf->download('invoice.pdf');
    }

    public function reportExcel()
    {
        return (new FastExcel(Pregnant::all()))->download('file.xlsx', function ($pregant) {
            return [
                'Cui' => $pregant->cui,
                'Nombres' => $pregant->nombres,
                'Apellidos' => $pregant->apellidos,
                'direccion' => $pregant->direccion,
                'Fecha De Nacimiento' => $pregant->fecha_de_nacimiento,
                'Tipo De Examen' => $pregant->tipo_de_examen,
                'Fecha' => $pregant->ultima_regla,
                'peso' => $pregant->peso,
                'altura' => $pregant->altura,
                'cmb' => $pregant->cmb,
            ];
        });
    }
}
