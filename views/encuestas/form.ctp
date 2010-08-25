<div class="frage form">
<?= $form->create('Encuesta') ?>
<fieldset>
<legend><?php __('Agregar / Editar Encuesta') ?></legend>
<?php
echo $form->input('id');
echo $form->input('nombre');
if (isset($this->data['Pregunta'])) {
foreach ($this->data['Pregunta'] as $k => $p) {
	echo '<fieldset>';
	echo $form->input("Pregunta.$k.id");
	echo $form->input("Pregunta.$k.pregunta");
	echo $form->input("Pregunta.$k.tipo", array('type' => 'select', 'options' => $PREGUNTAS_TIPOS));
	// echo $form->input("Pregunta.$k.multiple", array('type' => 'checkbox', 'label' => 'Múltiple'));
	echo '</fieldset>';
}
}
?>
</fieldset>
<?= $form->end('Enviar') ?>
</div>
