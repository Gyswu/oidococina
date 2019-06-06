<?php
// source: /var/www/proyecto/app/Presenters/templates/@layout.latte

use Latte\Runtime as LR;

class Templateb045aa59aa extends Latte\Runtime\Template
{
	public $blocks = [
		'head' => 'blockHead',
		'sidebar' => 'blockSidebar',
		'usuario' => 'blockUsuario',
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'head' => 'html',
		'sidebar' => 'html',
		'usuario' => 'html',
		'scripts' => 'html',
	];


	function main()
	{
		extract($this->params);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php
		if (isset($this->blockQueue["title"])) {
			$this->renderBlock('title', $this->params, function ($s, $type) {
				$_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($_fi, 'html', $this->filters->filterContent('striphtml', $_fi, $s));
			});
			?> | <?php
		}
?>Oidocosina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 16 */ ?>/css/style.css">
    <?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('head', get_defined_vars());
?>
</head>

<body>
<?php
		$this->renderBlock('sidebar', get_defined_vars());
		$this->renderBlock('usuario', get_defined_vars());
?>
<div class=container>
<?php
		$iterations = 0;
		foreach ($flashes as $flash) {
			?>    <div<?php if ($_tmp = array_filter(['alert', 'alert-' . $flash->type])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>><?php
			echo LR\Filters::escapeHtmlText($flash->message) /* line 43 */ ?></div>
<?php
			$iterations++;
		}
?>

<?php
		$this->renderBlock('content', $this->params, 'html');
?>
</div>

<?php
		$this->renderBlock('scripts', get_defined_vars());
?>
</body>
</html>
<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			if (isset($this->params['flash'])) trigger_error('Variable $flash overwritten in foreach on line 43');
		}
		$this->createTemplate('components/form.latte', $this->params, "import")->render();
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockHead($_args)
	{
		
	}


	function blockSidebar($_args)
	{
		
	}


	function blockUsuario($_args)
	{
		extract($_args);
?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:default")) ?>">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Mesas:default")) ?>">Mesas<span
                                class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
<?php
	}


	function blockScripts($_args)
	{
		extract($_args);
?>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://nette.github.io/resources/js/3/netteForms.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 54 */ ?>/js/main.js"></script>

    <script>
        $(document).ready(function () {
            $(".del").click(function () {
                confirm('¿Seguro que lo quieres borrar?')
            });
        });
    </script>
<?php
	}

}
