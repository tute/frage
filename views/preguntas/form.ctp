<div class="frage form">
<?= $form->create('Pregunta') ?>
<fieldset>
<legend><?php __('Agregar / Editar Pregunta') ?></legend>
<?php
echo $form->input('id');
echo $form->input('fr_encuesta_id');
echo $form->input('pregunta');
echo $form->input('tipo', array('type' => 'radio', 'options' => $PREGUNTAS_TIPOS,
	'separator' => '<br>'));
?>
</fieldset>
<?= $form->end('Enviar') ?>
</div>
