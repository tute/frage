<script type="text/javascript" src="/frage/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
$(function(){
	$('#add-question').click(function(){
		// Add question
	});
	$('.delete-question').click(function(){
		var fieldset = $(this).parent().parent().parent();
		fieldset.fadeOut(function(){ fieldset.remove() });
	});
});
</script>

<div class="frage form">
<?= $form->create('Encuesta') ?>
<fieldset>
<legend><?php __('Agregar / Editar Encuesta') ?></legend>
<?php
echo $form->input('id');
echo $form->input('nombre');
if (isset($this->data['Pregunta']))
foreach ($this->data['Pregunta'] as $k => $p) {
	echo $this->element('pregunta', array('id' => $k));
}
?>
</fieldset>
<p><a href="#" id="add-question">Agregar nueva pregunta</a>.</p>
<?= $form->end('Enviar') ?>
</div>
