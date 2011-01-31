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
	if (max(ids) >= 0)
		return parseInt(max(ids));
	else
		return -1;
}

function add_events() {
	$('.delete-question').unbind('click').click(function(){
		var fieldset = $(this).parent().parent().parent();
		fieldset.fadeOut(function(){ fieldset.remove() });
	});
}

$(function(){
	$('#add-question').click(function(){
		var next_id = max_pregunta_id()+1;
		/* Build next_id form */
		$.get('/frage/encuestas/next_question/k:' + next_id, function(data) {
			$('#EncuestaAddForm fieldset, #EncuestaEditForm fieldset').first().append(data);
			add_events();
		});
	});
	add_events();
});
</script>

<div class="frage form">
<?= $form->create('Encuesta') ?>
<fieldset>
<legend><?php __('Agregar / Editar Encuesta') ?></legend>
<?php
echo $form->input('id');
echo $form->input('nombre');
echo $form->input('publicar', array('type' => 'checkbox'));
if (isset($this->data['Pregunta']))
	foreach ($this->data['Pregunta'] as $k => $p)
		echo $this->element('pregunta', array('id' => $k));
?>
</fieldset>
<p><a href="#add-question" id="add-question">Agregar nueva pregunta</a>.</p>
<?= $form->end('Enviar') ?>
</div>
