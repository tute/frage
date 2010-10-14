<div id="pregunta-<?= $id ?>">
<fieldset>
  <?= $form->input("Pregunta.$id.id") ?>
  <?= $form->input("Pregunta.$id.pregunta") ?>
  <?= $form->input("Pregunta.$id.tipo", array('type' => 'select', 'options' => $PREGUNTAS_TIPOS)) ?>
  <?= $form->input("Pregunta.$id.multiple", array('type' => 'checkbox', 'label' => 'Múltiple')) ?>
<p><a href="#" class="delete-question">[Delete]</a></p>
</fieldset>
</div>
