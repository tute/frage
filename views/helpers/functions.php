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

	function listar_preguntas($pregs, $show_options = true) {
		if (count($pregs) > 0) {
			echo "\n    <ul>\n";
			foreach ($pregs as $p) {
				echo '      <li>' . $p['pregunta']
				 . $this->show_options($p['tipo'], $p['id'], $p['multiple'])
				 . "</li>\n";
			}
			echo '    </ul>';
		}
	}

	function listar_preguntas_admin($pregs, $show_options = true) {
		App::import('Helper', 'Html');
		$html = new HtmlHelper();

		if (count($pregs) > 0) {
			echo "\n    <ul>\n";
			foreach ($pregs as $p) {
				echo '      <li><a href="/frage/preguntas/edit/'.$p['id'].'">' . $p['pregunta'] . "</a> "
				 . $this->abm($p['id'], 'preguntas')
				 . $this->show_options($p['tipo'], $p['id'])
				 . "</li>\n";
			}
			echo '    </ul>';
		}
	}

	function show_options($tipo, $pid, $multiple) {
		$options = ClassRegistry::init('Opcion')->find('all', array(
			'conditions' => array('Opcion.tipo' => $tipo)
		));
		$opts = "<div>\n";
		$k = 0;
		foreach ($options as $i => $opt) {
			/* Options (multiple?) */
			if ($tipo == 1 or $tipo == 2) {
				$opts .= "<input type=\"hidden\" id=\"Encuesta{$pid}PreguntasVotoFrOpcionId\" name=\"data[$pid][PreguntasVoto][fr_opcion_id]\" value=\"{$opt['Opcion']['id']}\"> ";
				if ($multiple > 0) {
					$opts .= "<label><input type=\"checkbox\" id=\"Encuesta{$pid}PreguntasVotoValor$k\" name=\"data[$pid][PreguntasVoto][valor][$k]\" value=\"{$opt['Opcion']['id']}\"> {$opt['Opcion']['opcion']}</label> ";
				} else {
					$sel = ($i == 0 ? ' checked="checked"' : '');
					$opts .= "<label><input type=\"radio\" id=\"Encuesta{$pid}PreguntasVotoValor\" name=\"data[$pid][PreguntasVoto][valor]\" value=\"{$opt['Opcion']['id']}\"$sel> {$opt['Opcion']['opcion']}</label> ";
				}
			}
			/* Text field */
			if ($tipo == 3)
				$opts .= "<label><input type=\"text\" id=\"Encuesta{$pid}PreguntasVotoValor\" name=\"data[$pid][PreguntasVoto][valor]\"></label> ";
			$k++;
		}
		$opts .= "<input type=\"hidden\" id=\"Encuesta{$pid}PreguntasVotoFrPreguntaId\" name=\"data[$pid][PreguntasVoto][fr_pregunta_id]\" value=\"$pid\"> ";
		return $opts . "</div>\n";
	}

}
?>
