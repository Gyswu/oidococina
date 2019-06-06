<?php
// source: /var/www/proyecto/app/Presenters/templates/Homepage/default.latte

use Latte\Runtime as LR;

class Templatebae53c7ee3 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'tittle' => 'blockTittle',
	];

	public $blockTypes = [
		'content' => 'html',
		'tittle' => 'html',
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
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
	<div class="container">
<?php
		$this->renderBlock('tittle', get_defined_vars());
?>
	</div>

<?php
	}


	function blockTittle($_args)
	{
		extract($_args);
?>		<h1>Bueno ya voy mejor</h1>
<?php
	}

}
