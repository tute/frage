<div id="frage">
<h2><?= $encuesta['Encuesta']['nombre'] ?></h2>
<?
echo $form->create('Pregunta', array('action' => 'completar/' . $encuesta['Encuesta']['id']));
echo $form->hidden('Encuesta.id', array('value' => $encuesta['Encuesta']['id']));
$functions->listar_preguntas($encuesta['Pregunta']);
echo $form->end('Enviar');
?>
</div>
