<?php
// source: /var/www/proyecto/app/Presenters/templates/Pedidos/comanda.latte

use Latte\Runtime as LR;

class Templatecc8e4fa0ef extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			if (isset($this->params['plato'])) trigger_error('Variable $plato overwritten in foreach on line 52, 99');
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
    <div class="container">
        <div class="row">
            <div class="col col-lg-6">
                <h2>Comanda <?php echo LR\Filters::escapeHtmlText($pedido->id) /* line 5 */ ?> de la <a href="<?php
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Mesas:ver", [$pedido->mesa->id])) ?>">Mesa
                        <?php echo LR\Filters::escapeHtmlText($pedido->mesa->nombre) /* line 6 */ ?></a></h2>
            </div>
            <div class="col col-lg-6">
<?php
		if ($pedido->mesa->estado == 0) {
?>
                    Mesa Libre<br>
                    <a class="btn
                    btn-primary" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Pedidos:reservar", [$pedido->id, $pedido->mesa->id])) ?>">Ocupar</a>
<?php
		}
		if ($pedido->mesa->estado == 1) {
?>
                    Mesa ocuapada - Esperando pedido<br>
                    <a class="btn
                    btn-warning" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Pedidos:yaPedido", [$pedido->id, $pedido->mesa->id])) ?>">Realizar Pedido</a>
<?php
		}
		if ($pedido->mesa->estado == 2 && $pedido->estado == 1) {
?>
                    Esperando que los cocineros preparen el pedido
<?php
		}
		if ($pedido->mesa->estado == 2 && $pedido->estado == 2) {
?>
                    Esperando preparado y pendiente de servicio<br>
                    <a class="btn
                    btn-success" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Pedidos:servido", [$pedido->id, $pedido->mesa->id])) ?>">Pedido Servido</a>
<?php
		}
		if ($pedido->mesa->estado == 3) {
?>
                    <a class="btn
                    btn-danger" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Pedidos:pagado", [$pedido->id, $pedido->mesa->id])) ?>">Pagado</a>
<?php
		}
?>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th>
                        Nombre
                    </th>
                    <th>
                        Precio
                    </th>
                    <th>
                        Categoria
                    </th>
                    <th>
                        Acciones
                    </th>
                </tr>
                </thead>
                <tbody>
<?php
		$iterations = 0;
		foreach ($pedido->platos as $plato) {
?>
                    <tr>
                        <td>
                            <?php echo LR\Filters::escapeHtmlText($plato->nombre) /* line 55 */ ?>

                        </td>
                        <td>
                            <?php echo LR\Filters::escapeHtmlText($plato->precio) /* line 58 */ ?>€
                        </td>
                        <td>
                            <?php echo LR\Filters::escapeHtmlText($plato->categoria->nombre) /* line 61 */ ?>


                        </td>
                        <td>
                            <a class="btn btn-success" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Pedidos:ver", [$pedido->id])) ?>">Pedir de
                                nuevo</a>
                            <a
                                    class="btn
                            btn-danger" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Pedidos:cancelarPlato", [$plato->id, $pedido->id,
				$pedido->mesa->id])) ?>">Cancelar</a>
                        </td>
                    </tr>
<?php
			$iterations++;
		}
?>
                </tbody>
            </table>
        </div>

        <div class="row">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th>
                        Nombre
                    </th>
                    <th>
                        Precio
                    </th>
                    <th>
                        Categoria
                    </th>
                    <th>
                        Acciones
                    </th>
                </tr>
                </thead>
                <tbody>
<?php
		$iterations = 0;
		foreach ($platos as $plato) {
?>
                    <tr>
                        <td>
                            <?php echo LR\Filters::escapeHtmlText($plato->nombre) /* line 102 */ ?>

                        </td>
                        <td>
                            <?php echo LR\Filters::escapeHtmlText($plato->precio) /* line 105 */ ?>€
                        </td>
                        <td>
                            <?php echo LR\Filters::escapeHtmlText($plato->categoria->nombre) /* line 108 */ ?>

                        </td>
                        <td>
                            <a class="btn
                            btn-success" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Pedidos:comanda", [$pedido->id, 'mesaID' => $mesa->id,
				'platoID' => $plato->id])) ?>">Añadir</a>

                        </td>
                    </tr>
<?php
			$iterations++;
		}
?>
                </tbody>
            </table>
        </div>
    </div>
<?php
	}

}