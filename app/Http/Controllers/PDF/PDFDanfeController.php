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
    function danfe(Request $request, $slicer, $id)
    {
        list($firstPage, $rush) = explode("-", $slicer);

        // Configuração do Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial'); // Define uma fonte padrão
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $ObjXML = new DanfeModel($id);

        $codigobarra = (string) Util::getBarCode($ObjXML->chNFe);

        $htmlContent = '';

        //SEPARAÇÃO DOS PRODUTOS EM ARRAY
        $produtosPaginados = [];
        
        // Pega os primeiros produtos para a primeira página definidos no modal
        $produtosPaginados[] = array_slice($ObjXML->produtos, 0, $firstPage);
        
        // Remove os primeiros 12 produtos da lista
        $produtosRestantes = array_slice($ObjXML->produtos, $firstPage);
        
        // Divide o restante dos produtos em blocos de 30
        while (count($produtosRestantes) > 0) {
            $produtosPaginados[] = array_slice($produtosRestantes, 0, $rush);
            $produtosRestantes = array_slice($produtosRestantes, $rush);
        }
        $totalPaginas = count($produtosPaginados);

        for ($paginaAtual = 0; $paginaAtual < $totalPaginas; $paginaAtual++) {
            $produtosPagina = $produtosPaginados[$paginaAtual];

            //obtém view
            $html = view('pdf.danfe', compact('ObjXML', 'produtosPagina', 'codigobarra', 'totalPaginas', 'paginaAtual'))->render();

            // Adiciona o conteúdo gerado ao HTML final
            $htmlContent .= $html;
        }
        // instancia o dompdf
        $dompdf = new Dompdf($options);

        // Carrega o HTML
        $dompdf->loadHtml($htmlContent);

        // (Opcional) Defina o tamanho e a orientação do papel
        $dompdf->setPaper('A4', 'portrait');

        // Renderiza o PDF
        $dompdf->render();

        // Envia o PDF para o navegador para download
        return $dompdf->stream('danfe.pdf', ['Attachment' => false]);
    }
}
