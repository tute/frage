<div class="frage form">
<?= $form->create('Pregunta') ?>
<fieldset>
<legend><?php __('Agregar / Editar Pregunta') ?></legend>
<?php
echo $form->input('id');
echo $form->input('fr_encuesta_id');
echo $form->input('pregunta');
?>
</fieldset>
<?= $form->end('Enviar') ?>
</div>
