<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\pdf\DanfeModel;
use App\Models\Util;
use Dompdf\Dompdf;
use Dompdf\Options;

class PDFDanfeController extends Controller
{
    function danfe(Request $request, $id)
    {
        $ObjXML = new DanfeModel($id);

        $codigobarra = (string) Util::getBarCode($ObjXML->chNFe);
        
        // Carregue a view e passe os dados
        $html = view('pdf.danfe', compact('ObjXML','codigobarra'))->render();

        // Configuração do Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial'); // Define uma fonte padrão
        $dompdf = new Dompdf($options);

        // Carrega o HTML
        $dompdf->loadHtml($html);

        // (Opcional) Defina o tamanho e a orientação do papel
        $dompdf->setPaper('A4', 'portrait');

        // Renderiza o PDF
        $dompdf->render();

        // Envia o PDF para o navegador para download
        return $dompdf->stream('danfe.pdf', ['Attachment' => true]);
    }
}
