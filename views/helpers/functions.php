<?php
class FunctionsHelper extends AppHelper {
	/* Botones para editar y eliminar. */
	function abm($id, $controller, $enclosed = null) {
		/* Load HTML helper */
		App::import('Helper', 'Html');
		$html = new HtmlHelper();

		$abm = ' ';

		if ($enclosed) $abm .= "<$enclosed>";
		$abm .= $html->link(__('[Edit]', true), array('controller' => $controller, 'action' => 'edit', $id)) . ' ';
		$abm .= $html->link(__('[×]', true), array('controller' => $controller, 'action' => 'delete', $id), null, sprintf(__('Are you sure you want to delete # %s?', true), $id));
		if ($enclosed) $abm .= "</$enclosed>";
		return $abm;
	}

	function listar_preguntas($pregs) {
		/* Load HTML helper */
		App::import('Helper', 'Html');
		$html = new HtmlHelper();

		if (count($pregs) > 0) {
			echo "\n    <ul>\n";
			foreach ($pregs as $p) {
				echo '      <li><a href="/frage/preguntas/edit/'.$p['id'].'">' . $p['pregunta'] . "</a> "
				 . $this->abm($p['id'], 'preguntas') . "</li>\n";
			}
			echo '    </ul>';
		}
	}

	function show_options($tipo) {
		pr(ClassRegistry::init('Opcion')->find('all', array(
			'conditions' => array('Opcion.tipo' => $tipo)
		)));
	}

}
?>
