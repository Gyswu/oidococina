<?php
// source: /var/www/proyecto/app/Presenters/templates/Mesas/default.latte

use Latte\Runtime as LR;

class Templateec8e26d410 extends Latte\Runtime\Template
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
			if (isset($this->params['mesa'])) trigger_error('Variable $mesa overwritten in foreach on line 25');
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Listado de mesas</h2>
            </div>
        </div>
        <div>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th>
                        Nombre
                    </th>
                    <th>
                        Estado
                    </th>
                    <th>
                        Acciones
                    </th>
                </tr>
                </thead>
                <tbody>
<?php
		$iterations = 0;
		foreach ($mesas as $mesa) {
?>
                    <tr>
                        <td>
                            <?php echo LR\Filters::escapeHtmlText($mesa->nombre) /* line 28 */ ?>

                        </td>
                        <td>
<?php
			$this->global->switch[] = ($mesa->estado);
			if (false) {
			}
			elseif (end($this->global->switch) === (0)) {
?>
                                Libre
<?php
			}
			elseif (end($this->global->switch) === (1)) {
?>
                                Ocupada
<?php
			}
			elseif (end($this->global->switch) === (2)) {
?>
                                Esperando Pedido
<?php
			}
			elseif (end($this->global->switch) === (3)) {
?>
                                Servida
<?php
			}
			else {
?>
                                Not working
<?php
			}
			array_pop($this->global->switch) ?>
                        </td>
                        <td>
                            <a class="btn btn-xs
                            btn-primary" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Pedidos:comanda", ['mesaID' => $mesa->id])) ?>">Pedir</a>
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
