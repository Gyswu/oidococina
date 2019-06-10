<?php

namespace App\Presenters;

use Latte\Engine;

class TicketPresenter extends BasePresenter {
    
    public function renderVer( $mesaID, $pedidoID ) {
        
        $total = 0;
        $mesa = $this->orm->mesas->getById($mesaID);
        $pedido = $mesa->getLastPedido();
        $this->template->mesa = $mesa;
        $this->template->pedido = $pedido;
        foreach( $pedido->pedidoPlatos as $pedidoPlato ) {
            $total = $total + $pedidoPlato->plato->precio;
        }
        $this->template->total = $total;
        $this->template->numPedido = $pedidoID;
    }
    
    public function actionPdf( $mesaID ) {
        $total = 0;
        $pedido = $this->orm->mesas->getById($mesaID)->getLastPedido();
        foreach( $pedido->pedidoPlatos as $pedidoPlato ) {
            $total = $total + $pedidoPlato->plato->precio;
        }
        $this->template->total = $total;
        $vars = [
            'mesa'      => $this->orm->mesas->getById($mesaID),
            'pedido'    => $pedido,
            'total'     => $total,
            'numPedido' => $pedido->id,
        ];
        $latte = new Engine();
        $body = $latte->renderToString(_APPDIR . '/Presenters/templates/Ticket/ver.latte', $vars);
        $config = [
            'mode'          => 'utf-8',
            'format'        => [ 82, 152 ],
            'margin_left'   => 3,
            'margin_right'  => 3,
            'margin_top'    => 3,
            'margin_bottom' => 3,
            'margin_header' => 0,
            'margin_footer' => 0,
        ];
        $pdf = new \Mpdf\Mpdf($config);
        $pdf->SetDisplayMode('fullpage');
        $pdf->WriteHTML($body);
        $pdf->Output();
    }
    
    public function actionPdfHistorico( $mesaID, $pedidoID ) {
        $total = 0;
        $pedido = $this->orm->pedidos->getById($pedidoID);
        foreach( $pedido->pedidoPlatos as $pedidoPlato ) {
            $total = $total + $pedidoPlato->plato->precio;
        }
        $this->template->total = $total;
        $vars = [
            'mesa'      => $this->orm->mesas->getById($mesaID),
            'pedido'    => $pedido,
            'numPedido' => $pedidoID,
            'total'     => $total,
        ];
        $latte = new Engine();
        $body = $latte->renderToString(_APPDIR . '/Presenters/templates/Ticket/ver.latte', $vars);
        $config = [
            'mode'          => 'utf-8',
            'format'        => [ 82, 152 ],
            'margin_left'   => 3,
            'margin_right'  => 3,
            'margin_top'    => 3,
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