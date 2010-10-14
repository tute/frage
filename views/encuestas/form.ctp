<script type="text/javascript" src="/frage/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
function max(array) {
	var i, m=0;
	for(i=0; i < array.length; i++) {
		if(array[i] > array[m])
			m=i;
	}
	return array[m];
}

function max_pregunta_id() {
	var ids = new Array;
	$("[id]").filter(function() {
		var matched = this.id.match(/pregunta-\d+/);
		if (matched)
			ids.push( this.id.split('pregunta-')[1] );
		return matched;
	});
	return max(ids);
}

$(function(){
	$('#add-question').click(function(){
		var next_id = max_pregunta_id()+1;
		/* Build next_id form */
		$.get('/frage/encuestas/next_question/k:' + next_id, function(data) {
			$('#EncuestaEditForm fieldset').first().append(data);
			// FIXME: add_events to new question ($('.delete-question').click for now)
		});
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
<p><a href="#add-question" id="add-question">Agregar nueva pregunta</a>.</p>
<?= $form->end('Enviar') ?>
</div>
