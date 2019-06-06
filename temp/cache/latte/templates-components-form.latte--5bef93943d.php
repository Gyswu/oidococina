<?php
// source: /var/www/proyecto/app/Presenters/templates/components/form.latte

use Latte\Runtime as LR;

class Template5bef93943d extends Latte\Runtime\Template
{
	public $blocks = [
		'form' => 'blockForm',
		'bootstrap-form' => 'blockBootstrap_form',
	];

	public $blockTypes = [
		'form' => 'html',
		'bootstrap-form' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
?>


<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			if (isset($this->params['error'])) trigger_error('Variable $error overwritten in foreach on line 4, 24');
			if (isset($this->params['input'])) trigger_error('Variable $input overwritten in foreach on line 8, 27');
			if (isset($this->params['name'])) trigger_error('Variable $name overwritten in foreach on line 27');
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockForm($_args)
	{
		extract($this->params);
		list($formName) = $_args + [NULL, ];
		$form = $_form = $this->global->formsStack[] = is_object($formName) ? $formName : $this->global->uiControl[$formName];
		?>	<form<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
		), false) ?>>
<?php
		ob_start(function () {});
?>	<ul class=error>
<?php
		ob_start();
		$iterations = 0;
		foreach ($form->ownErrors as $error) {
			?>		<li><?php echo LR\Filters::escapeHtmlText($error) /* line 4 */ ?></li>
<?php
			$iterations++;
		}
		$this->global->ifcontent = ob_get_flush();
?>	</ul>
<?php
		if (rtrim($this->global->ifcontent) === "") ob_end_clean();
		else echo ob_get_clean();
?>

	<table>
<?php
		$iterations = 0;
		foreach ($form->controls as $input) {
			if (!$input->getOption('rendered') && $input->getOption('type') !== 'hidden') {
				?>	<tr<?php if ($_tmp = array_filter([$input->required ? 'required' : null])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>>

		<th><?php
				$_input = is_object($input) ? $input : end($this->global->formsStack)[$input];
				if ($_label = $_input->getLabel()) echo $_label ?></th>
		<td><?php
				$_input = is_object($input) ? $input : end($this->global->formsStack)[$input];
				echo $_input->getControl() /* line 13 */ ?> <?php
				ob_start(function () {});
				?><span class=error><?php
				ob_start();
				echo LR\Filters::escapeHtmlText($input->error) /* line 13 */;
				$this->global->ifcontent = ob_get_flush();
				?></span><?php
				if (rtrim($this->global->ifcontent) === "") ob_end_clean();
				else echo ob_get_clean();
?>
</td>
	</tr>
<?php
			}
			$iterations++;
		}
?>
	</table>
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), false);
?>	</form>
<?php
	}


	function blockBootstrap_form($_args)
	{
		extract($this->params);
		list($formName) = $_args + [NULL, ];
		$form = $_form = $this->global->formsStack[] = is_object($formName) ? $formName : $this->global->uiControl[$formName];
		?>	<form class=form-horizontal<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
		'class' => NULL,
		), false) ?>>
<?php
		ob_start(function () {});
?>	<ul class=error>
<?php
		ob_start();
		$iterations = 0;
		foreach ($form->ownErrors as $error) {
			?>		<li><?php echo LR\Filters::escapeHtmlText($error) /* line 24 */ ?></li>
<?php
			$iterations++;
		}
		$this->global->ifcontent = ob_get_flush();
?>	</ul>
<?php
		if (rtrim($this->global->ifcontent) === "") ob_end_clean();
		else echo ob_get_clean();
?>

<?php
		$iterations = 0;
		foreach ($form->controls as $name => $input) {
			if (!$input->getOption('rendered') && $input->getOption('type') !== 'hidden') {
				?>	<div<?php if ($_tmp = array_filter(['form-group', $input->required ? 'required' : null, $input->error ? 'has-error' : null])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>>

		<div class="col-sm-2 control-label"><?php
				$_input = is_object($input) ? $input : end($this->global->formsStack)[$input];
				if ($_label = $_input->getLabel()) echo $_label ?></div>

		<div class="col-sm-10">
<?php
				if (in_array($input->getOption('type'), ['text', 'select', 'textarea'], true)) {
					?>				<?php
					$_input = is_object($input) ? $input : end($this->global->formsStack)[$input];
					echo $_input->getControl()->addAttributes(['class' => 'form-control']) /* line 35 */ ?>

<?php
				}
				elseif ($input->getOption('type') === 'button') {
					?>				<?php
					$_input = is_object($input) ? $input : end($this->global->formsStack)[$input];
					echo $_input->getControl()->addAttributes(['class' => "btn btn-default"]) /* line 37 */ ?>

<?php
				}
				elseif ($input->getOption('type') === 'checkbox') {
					?>				<div class="checkbox"><?php
					$_input = is_object($input) ? $input : end($this->global->formsStack)[$input];
					echo $_input->getControl() /* line 39 */ ?></div>
<?php
				}
				elseif ($input->getOption('type') === 'radio') {
					?>				<div class="radio"><?php
					$_input = is_object($input) ? $input : end($this->global->formsStack)[$input];
					echo $_input->getControl() /* line 41 */ ?></div>
<?php
				}
				else {
					?>				<?php
					$_input = is_object($input) ? $input : end($this->global->formsStack)[$input];
					echo $_input->getControl() /* line 43 */ ?>

<?php
				}
?>

<?php
				ob_start(function () {});
				?>			<span class=help-block><?php
				ob_start();
				echo LR\Filters::escapeHtmlText($input->error ?: $input->getOption('description')) /* line 46 */;
				$this->global->ifcontent = ob_get_flush();
?></span>
<?php
				if (rtrim($this->global->ifcontent) === "") ob_end_clean();
				else echo ob_get_clean();
?>
		</div>
	</div>
<?php
			}
			$iterations++;
		}
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), false);
?>	</form>
<?php
	}

}
