<?php
/**
 * Created by PhpStorm.
 * User: vicha
 * Date: 10/06/2019
 * Time: 18:26
 */

namespace App\Presenters;

use Latte\Engine;
use Mpdf\Mpdf;

class TicketPresenter extends BasePresenter {
    
    
    public function renderVer( ) {
        
    
        $this->template->mesa = $this->orm->mesas->getById(5);
        
        
        
    
        
    }
    
    
    public function actionPdf(){
    
        //esta variable tiene que contener por ejemplo la mesa, y dentro en ver.latte hay que procesarla
        //dentro es $mesa
        $vars = [
            'mesa' => $this->orm->mesas->getById(5)
        ];
        $latte = new Engine();
        $body = $latte->renderToString(_APPDIR.'/presenters/templates/Ticket/ver.latte', $vars);
        
        $config = [
            'mode' => 'utf-8',
            'format' => [82, 152],
            'margin_left' => 3,
            'margin_right' => 3,
            'margin_top' => 3,
            'margin_bottom' => 3,
            'margin_header' => 0,
            'margin_footer' => 0,
        ];
    
        $pdf = new \Mpdf\Mpdf($config);
        $pdf->SetDisplayMode('fullpage');
        $pdf->WriteHTML($body);
        $pdf->Output();
        
    }
    
    
}