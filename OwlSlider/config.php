<?php if (!defined('PLX_ROOT')) exit; 
# Control du token du formulaire
plxToken::validateFormToken($_POST);
if(!empty($_POST)) {
	$plxPlugin->setParam('dir', $_POST['dir'], 'cdata');
	$plxPlugin->setParam('color_bar', $_POST['color_bar'], 'cdata');
	$plxPlugin->setParam('time', $_POST['time'], 'cdata');
	$plxPlugin->setParam('time_slider', $_POST['time_slider'], 'cdata');
	$plxPlugin->setParam('pagination', $_POST['pagination'], 'cdata');
	$plxPlugin->setParam('hover', $_POST['hover'], 'cdata');
	$plxPlugin->setParam('script', $_POST['script'], 'cdata');
	$plxPlugin->saveParams();
	header('Location: parametres_plugin.php?p=OwlSlider');
	exit;
}
?>

<p>
	<h2><?php echo $plxPlugin->getInfo("description") ?></h2>
</p>

<p><?php $plxPlugin->lang('INFO') ?></p>

<code>&lt;?php eval($plxShow->callHook('OwlSlider')); ?&gt;</code>

<style>
	input, textarea {border-radius: 5px;width: 40%}
	input.numeric{width: 100px}
	textarea {min-height: 50px}
	label{font-style: italic}
</style>

<?php 
	$pagination =  $plxPlugin->getParam('pagination');
	$hover =  $plxPlugin->getParam('hover');
	$script = $plxPlugin->getParam('script');
?>

<form action="parametres_plugin.php?p=OwlSlider" method="post">

	<p>
		<label for="dir"><?php $plxPlugin->lang('LABEL1') ?></label>
		<input id="dir" name="dir"  maxlength="255" value="<?php echo $plxPlugin->getParam("dir"); ?>">
	</p>

	<p>
		<label for="color_bar"><?php $plxPlugin->lang('LABEL2') ?></label>
		<input class="numeric" id="color_bar" name="color_bar"  maxlength="255" value="<?php echo $plxPlugin->getParam("color_bar"); ?>">
	</p>

	<p>
		<label for="time"><?php $plxPlugin->lang('LABEL3') ?></label>
		<input class="numeric" id="time" name="time"  maxlength="255" value="<?php echo $plxPlugin->getParam("time"); ?>">
	</p>

	<p>
		<label for="time_slider"><?php $plxPlugin->lang('LABEL4') ?></label>
		<input class="numeric" id="time_slider" name="time_slider"  maxlength="255" value="<?php echo $plxPlugin->getParam("time_slider"); ?>">
	</p>

	<p>
		<label for="pagination"><?php $plxPlugin->lang('LABEL5') ?></label>
		<select name="pagination" id="pagination">
			<option value="true"  <?php if ($pagination == 'true') { echo'selected';}?> >Oui</option>
			<option value="false" <?php if ($pagination == 'false') { echo'selected';}?> >Non</option>
		</select>
	</p>

	<p>
		<label for="hover"><?php $plxPlugin->lang('LABEL6') ?></label>
		<select name="hover" id="hover">
			<option value="true"  <?php if ($hover == 'true') { echo'selected';}?> >Oui</option>
			<option value="false" <?php if ($hover == 'false') { echo'selected';}?> >Non</option>
		</select>
	</p>

	<p>
		<label for="script">Activer jQuery 2.1.3 ?</label>
		<select name="script" id="script">
		   <option value="true" <?php if ($script == 'true') { echo'selected';}?>>Oui</option>
		   <option value="false" <?php if ($script == 'false') { echo'selected';}?>>Non</option>
		</select>
	</p>


	
	<p class="in-action-bar">
		<?php echo plxToken::getTokenPostMethod() ?>
		<input type="submit" name="submit" value="<?php $plxPlugin->lang('SUBMIT') ?>" />
	</p>

</form>
