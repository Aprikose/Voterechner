<?php

	/* Changelog
		V 2.2:
			- Namensunterstützung
			- Anpassungen für neue Saison
			- Collabs
		V 2.1:
			- WBB4-Kompatibilität
		V 2.0:
			- Komplette Änderung des Interfaces
			- ausführliche Fehlerausgabe
			- strikterer Umgang mit Input-Daten
			- Einfügen von Abgabennamen ermöglicht
		V 1.1:
			- Output-Tabelle erweitert (Feld für Votes und für Punkte)
			- Spannpunkte sind jetzt standardmäßig aktiviert
		V 1.03:
			- Fehlerausgabe, wenn vergebene Votepunkte nicht der Norm entsprechen
		V 1.02:
			- Umstrukturierungen
			- neues (lebensnahes) Beispiel: WB03/2014
			- Bugfix und Fertigstellung des Selbstvote-Erkenners
		V 1.01:
			- Korrektur der Userverlinkungen
			- Fehlerbehebungen
		V 1.0:
			- Neustrukturierung des Codes
			- Erstellung des Designs
			- Beispiel- und Zurücksetzen-Feature eingefügt
		V 0.9:
			- erste Version
	*/
	
	// O U T P U T

	function formOutput() {
		

		// V A R I A B L E N E R S T E L L U N G
		
		if (isset($_POST['beispiel'])) {

			$br = '
';
			$data = array(

				'zahlAbgaben' => 19,

				'usernamen' => '',

				'abgabennamen' =>
					'Team Galaktik'.$br.'Giovanni\'s Ressurection (Giovannis Auferstehung) '.$br.
					'Mordskampf'.$br.'Von Hochmut und Fall'.$br.'Der Silberberg'.$br.'Schatten der Vergangenheit'
					.$br.'Pikachu, diesmal kriegen wir dich (geklont)!'.$br.'Leia'.$br.'Das Schicksalstreffen²'
					.$br.'Douleur de coeur (Herzschmerz)'.$br.'Kontinuum'.$br.'Zeitenr&uuml;uber'.$br.'Die letzte Reise'
					.$br.'Phantomschmerz'.$br.'Neumondträume'.$br.'Triumpf und Scheitern'.$br.'Der Überfall'.$br.
					'So möge es denn enden in Feuer und Rauch'.$br.'Eine von vielen Geschichten',

				'teilnehmerids' => 
					'98435'.$br.'99718'.$br.'83241'.$br.'67941'.$br.'87558'.$br.'26771'.$br.'98383'
					.$br.'24440'.$br.'58930'.$br.'29857'.$br.'6949'.$br.'27919'.$br.'97324'
					.$br.'97938'.$br.'72746'.$br.'63684'.$br.'61186'.$br.'33256'.$br.'99327',

				'votefeldanzahl' => '14',

				'v1' => 'ID: 74184'.$br.'A3: 1'.$br.'A4: 3'.$br.'A8: 1'.$br.'A9: 2'.$br.'A11: 1'.$br.'A12: 1'.$br.'A14: 2'.$br.'A18: 1',
				'v2' => 'ID: 99718'.$br.'A4: 2'.$br.'A5: 1'.$br.'A6: 3'.$br.'A8: 1'.$br.'A9: 1'.$br.'A11: 1'.$br.'A14: 2'.$br.'A18: 1',
				'v3' => 'ID: 101233'.$br.'A3: 1'.$br.'A4: 3'.$br.'A6: 2'.$br.'A7: 2'.$br.'A9: 1'.$br.'A10: 3',
				'v4' => 'ID: 6949'.$br.'A15: 3'.$br.'A6: 3'.$br.'A12: 2'.$br.'A8: 2'.$br.'A14: 1'.$br.'A18: 1',
				'v5' => 'ID: 90951'.$br.'A3: 1'.$br.'A4: 3'.$br.'A5: 2'.$br.'A12: 2'.$br.'A14: 1'.$br.'A18: 2'.$br.'A19: 1',
				'v6' => 'ID: 62252'.$br.'A4: 2'.$br.'A11: 1'.$br.'A10: 2'.$br.'A13: 3'.$br.'A14: 4',
				'v7' => 'ID: 87558'.$br.'A4: 2'.$br.'A6: 3'.$br.'A8: 1'.$br.'A10: 1'.$br.'A12: 1'.$br.'A13: 2'.$br.'A18: 1'.$br.'A19: 1',
				'v8' => 'ID: 67941'.$br.'A5: 3'.$br.'A18: 3'.$br.'A12: 2'.$br.'A3: 1'.$br.'A13: 1'.$br.'A14: 1'.$br.'A19: 1',
				'v9' => 'ID: 41234'.$br.'A3: 1'.$br.'A4: 3'.$br.'A8: 1'.$br.'A13: 7',
				'v10' => 'ID: 25329'.$br.'A17: 4'.$br.'A12: 4'.$br.'A3: 1'.$br.'A4: 1'.$br.'A14: 1'.$br.'A16: 1',
				'v11' => 'ID: 40725'.$br.'A11: 2'.$br.'A16: 2'.$br.'A18: 5'.$br.'A19: 3',
				'v12' => 'ID: 91331'.$br.'A4: 3'.$br.'A5: 3'.$br.'A11: 2'.$br.'A14: 2'.$br.'A18: 2',
				'v13' => 'ID: 67932'.$br.'A3: 2'.$br.'A4: 2'.$br.'A5: 2'.$br.'A7: 1'.$br.'A9: 1'.$br.'A10: 1'.$br.'A13: 1'.$br.'A14: 1'.$br.'A16: 1',
				'v14' => 'ID: 16'.$br.'A8: 2'.$br.'A10: 2'.$br.'A12: 2'.$br.'A5: 1'.$br.'A6: 1'.$br.'A7: 1'.$br.'A11: 1'.$br.'A14: 1'.$br.'A16: 1',

			);

		} else if (isset($_POST['clear'])) {
			$data = array();
		} else {
			$data = array_map('htmlentities', $_POST);
			if (isset($data['votefeldanzahl']) && intval($data['votefeldanzahl']) > 99) {
				$data['votefeldanzahl'] = 99;
			}
		}

		// GLOBALS
		
		if (isset($data["activateSpanpoints"]) && $data["activateSpanpoints"] == 'No') {
			define("spanpointsOn",  false);
		} else {
			define("spanpointsOn",  true);
		}

		if (isset($data["collabCheck"]) && $data["collabCheck"] == 'Collab') {
			define("isCollab",  true);
		} else {
			define("isCollab",  false);
		}

		$checkbox = createCheckbox("collab");

		define("FORMBUTTONS", 
			'<br /><br />'.$checkbox.'<br /><input type="submit" value="Weiter">
			<input type="submit" name="beispiel" value="Beispiel berechnen">
			<input type="submit" name="clear" value="Zur&uuml;cksetzen">'
		);

		if (isset($data['zahlAbgaben'])) {
			define("ABGABENANZAHL", $data['zahlAbgaben']);
		} else {
			define("ABGABENANZAHL", 0);
		}

		if (ABGABENANZAHL != 0) {
			if (ABGABENANZAHL & 1) {	// CHECK IF ODD
				define('POINTS_PER_VOTE', ((ABGABENANZAHL + 1) / 2) + 2);
			} else {
				define('POINTS_PER_VOTE', (ABGABENANZAHL / 2) + 2);
			}
		} else {
			define('POINTS_PER_VOTE', 0);
		}

		$scores = array(
			'givenVotes' => 0,
			'points' => array('spanpoints' => 0),
			'spanpointList' => array(),
			'v_id' => array(),
		);
		
		$scores['abgabennamen'] = isset($data['abgabennamen']) ? getLines($data['abgabennamen'], 0) : $scores['abgabennamen'] = array();
		$scores['teilnehmerIDs'] = isset($data["teilnehmerids"]) ? getLines($data["teilnehmerids"], 1) : $scores['teilnehmerIDs'] = array();
		$scores['teilnehmerIDs2'] = isset($data["teilnehmerids2"]) ? getLines($data["teilnehmerids2"], 1) : $scores['teilnehmerIDs2'] = array();		
		$scores['usernamen'] = isset($data['usernamen']) ? getLines($data['usernamen'], 0) : $scores['usernamen'] = array();
		$scores['anzahlabgaben'] = count(array_unique($scores['teilnehmerIDs']));
		
		$collabIdPass = true;
		if (isCollab == true) {
			$scores['anzahlzweitIDs'] = count(array_unique($scores['teilnehmerIDs2']));
			if (ABGABENANZAHL != $scores['anzahlzweitIDs'] || ABGABENANZAHL != count(array_diff($scores['teilnehmerIDs'], $scores['teilnehmerIDs2']))) {
				$collabIdPass = false;
			}
		}

		$scores = getPointsList($scores, $data);

		$spanpoints = (spanpointsOn === true) ? $scores['points']['spanpoints'] : $spanpoints = 0;
		// errechnet die Gesamtzahl der vergebenen Punkte
		$scores['votepunkte_gesamt'] = POINTS_PER_VOTE * $scores['givenVotes'] + $spanpoints;
		$scores['votepunkte_reduziert'] = POINTS_PER_VOTE * ($scores['givenVotes'] - 1) + $spanpoints;
		$scores['votepunkte_doppelt_reduziert'] = POINTS_PER_VOTE * ($scores['givenVotes'] - 2) + $spanpoints;


		// GENERATE PAGE	

		if (ABGABENANZAHL == 0) {
		
			return '<h1>Wie viele Abgaben hat der Wettbewerb?</h1>
				<form action="" method="POST">
					<div class="input">
						<input type="number" name="zahlAbgaben" min="1" max="99">
						'.FORMBUTTONS.'
					</div>
				</form>';
			
		} else {

			$output = '<h1>Wie viele Abgaben hat der Wettbewerb?</h1>
			
			<form action="" method="POST">
				<div class="input">
					<input type="number" name="zahlAbgaben" min="1" max="99" value="'.ABGABENANZAHL.'"></div>';

			if(!isset($data['teilnehmerids'])) {
			
				$output .= formTeilnehmerids(0, 0, 0, 0, false, false);

				return $output;
				
			} else if($scores['anzahlabgaben'] != ABGABENANZAHL) {
			
				$output .=
					formTeilnehmerids($data['teilnehmerids'], $data['teilnehmerids2'], $data['abgabennamen'], $data['usernamen'], true, false)
					.'<br /><div class="alert"><font color="red">Fehler:</font> '
					.'Die Zahl der Abgaben stimmt nicht mit der Zahl der Teilnehmer-IDs '
					.'&uuml;berein oder es kommen einzelne Teilnehmer-IDs mehrfach vor.</div>';

				return $output;
					
			} else if($collabIdPass == false) {

				$output .=
					formTeilnehmerids($data['teilnehmerids'], $data['teilnehmerids2'], $data['abgabennamen'], $data['usernamen'], true, false)
					.'<br /><div class="alert"><font color="red">Fehler:</font> '
					.'Es konnte nicht jeder Teilnehmer-ID eine Partner-ID zugeordnet werden,'
					.' oder einige IDs kommen in beiden ID-Listen vor, '
					.' oder der Wettbewerb wurde fehlerhaft als Collab angegeben.';

				return $output;

			} else if(!isset($data['votefeldanzahl'])) {
			
				$output .= 
					formTeilnehmerids($data['teilnehmerids'], $data['teilnehmerids2'], $data['abgabennamen'], $data['usernamen'], false, false)
					.formVotezahl(0);

				return $output;
				
			} else if (voteErrors($data, $scores) < 5 || $scores['givenVotes'] === 0){

				$output .=
					formTeilnehmerids($data['teilnehmerids'], $data['teilnehmerids2'], $data['abgabennamen'], $data['usernamen'], false, false)
					.formVotezahl($data['votefeldanzahl'])
					.formVoteFelder($data)
					.formButtonsAndErrors($data, $scores);

				return $output;

			} else {
			
				$output .= 
					formTeilnehmerids($data['teilnehmerids'], $data['teilnehmerids2'], $data['abgabennamen'], $data['usernamen'], false, $scores)
					.formVotezahl($data['votefeldanzahl'])
					.formVoteFelder($data)
					.formButtonsAndErrors($data, $scores);


				// ERSTELLUNG DES BB-CODES FUER AUSWERTUNGSPOST

				$output .= 
						'<br /><strong>BB-Tags f&uuml;r Auswertungspost:</strong>'
						.'<div class="container"><textarea readonly rows="25" width="100%">';

				$bbcode = 
					'[align=center][table][tr][td][align=center]Platzierung[/align][/td]'.
					'[td][align=center]Titel[/align][/td][td][align=center]Autor[/align][/td]'.
					'[td][align=center]Punkte[/align][/td][td][align=center]Vote[/align][/td]'.
					'[td][align=center]Prozent[/align][/td][td][align=center]Saisonpunkte[/align][/td][/tr]';

				$percentscore = getPercentscore($scores);
				$scoreSort = $percentscore;
				arsort($scoreSort);

				$scores_counter = count($percentscore);
				for ($a_count = 1; $a_count <= $scores_counter; $a_count++) {
					$ranker[$a_count] = $a_count;
				} 

				$ranking = array_combine($ranker, $scoreSort);
				
				if (count($scores['teilnehmerIDs']) == count($scores['usernamen'])) {
					$usernames = array_map('trim', array_combine($scores['teilnehmerIDs'], $scores['usernamen']));		
				} else {
					$empty_array = array_fill(1, count($scores['teilnehmerIDs']), '');
					$usernames = array_combine($scores['teilnehmerIDs'], $empty_array);
				}

				
				for ($a_count = 1; $a_count <= ABGABENANZAHL; $a_count++) {
					
					$idlines = $scores['teilnehmerIDs']; 
					$linestart = '[tr][td][align=center]';
					$multiplaces = 0;
					
					if (count(array_keys($percentscore, $ranking[$a_count])) != 1) {
						
						// bei Doppel- und Mehrfachplatzierungen
						
						$multiplaces = count(array_keys($percentscore, $ranking[$a_count])) - 1;
					
					}
					
					if (ABGABENANZAHL >= 10) {
						$overpowered = ABGABENANZAHL - $a_count - $multiplaces;
					} else {
						$overpowered = 10 - $a_count - $multiplaces;
					}

					
					for ($b_count = 0; $b_count <= $multiplaces; $b_count++) {
					
						$scouter = array_keys($percentscore, $ranking[$a_count]);
						$abgabennummer = $scouter[$b_count];

						$voted = (in_array($scores['teilnehmerIDs'][$abgabennummer - 1], $scores['v_id']) ? 'Ja' : 'Nein');
						$punkte = (isset($scores['points'][$abgabennummer]) ? $scores['points'][$abgabennummer] : 0);

						$abgabenbezeichnung = 'Abgabe '.$abgabennummer;
						if (count($scores['abgabennamen']) == count($scores['teilnehmerIDs']))
							$abgabenbezeichnung .= ': '.trim($scores['abgabennamen'][$abgabennummer - 1]);
						

						if ($usernames[$idlines[$abgabennummer - 1]] != '') {
							$username = " @'".$usernames[$idlines[$abgabennummer - 1]]."'";
						} else {
							$username = 
								'[url=\'http://www.bisaboard.de/index.php/User/'
								.$idlines[$abgabennummer - 1].'/\'][b][size=14][color=#999900]USERNAME[/color][/size][/b][/url]';
						}


							
						switch ($a_count + $multiplaces) {

							case 1:
								$bbcode .=
									$linestart.'[b][size=14][color=#999900]'.$a_count.
									'.[/color][/size][/b][/align][/td][td][align=center][b][size=14][color=#999900]'.$abgabenbezeichnung.
									'[/color][/size][/b][/align][/td][td][align=center]'.$username.' ';
								break;

							case 2: 
								$bbcode .= 
									$linestart.'[b][size=12][color=#999999]'.$a_count.
									'.[/color][/size][/b][/align][/td][td][align=center][b][size=12][color=#999999]'
									.$abgabenbezeichnung.'[/color][/size][/b][/align][/td][td][align=center]'
									.$username.' ';
								break;

							case 3:
								$bbcode .= 
									$linestart.'[color=#660000][b]'
									.$a_count.'.[/b][/color][/align][/td][td][align=center][b][color=#660000]'
									.$abgabenbezeichnung.'[/color][/b][/align][/td][td][align=center]'
									.$username.' ';
								break;

							default:
								$bbcode .= 
									$linestart.$a_count.'.[/align][/td][td][align=center]'
									.$abgabenbezeichnung.'[/align][/td][td][align=center]'
									.$username.' ';

						}
						
						$bbcode .= 
							'[/align][/td][td][align=center]'.$punkte.
							'[/align][/td][td][align=center]'.$voted.
							'[/align][/td][td][align=center]'.round($ranking[$a_count], 2, PHP_ROUND_HALF_UP).
							'%[/align][/td][td][align=center]'.$overpowered.' + 2 MP[/align][/td][/tr]';
					}
					
					$a_count = $a_count + $multiplaces;

				}
				
				$bbcode .= '[/table][/align]';
				$output .= $bbcode.'</textarea></div><br /><br />';

				return $output;

			}
		}
		
	}
	
	
	// O U T P U T - F U N K T I O N E N
	

	function formTeilnehmerids($idfeld, $idfeld2, $abgabennamen, $usernamen, $error, $addScoresInfo) {
		
		$abgabennummern = '';		// Abgaben-Nummerierung im ersten Textfeld
		for ($counter = 1; $counter <= ABGABENANZAHL; $counter++) {
			$abgabennummern .= $counter;
			if ($counter != ABGABENANZAHL) {
				$abgabennummern .= '&#13;&#10;';
			}
		}

		if ($error != 0 || $idfeld == 0) {
			$submit = FORMBUTTONS;
			$endform = '</form>';
		} else {
			$submit = '';
			$endform = '';
		}

		if (isCollab == true) {
			$idfeld2 = '				<div style="float:left;padding:0 5px;">User-ID 2<br />
					<textarea name="teilnehmerids2" rows="'.ABGABENANZAHL.'" cols="7">'.$idfeld2.'</textarea></div>';
		} else { 
			$idfeld2 = '';
		}

		$output = '<h1>Bitte gib die IDs der Teilnehmer (erforderlich) und die Namen ihrer Abgaben (optional) an.</h1>
			
			<div class="input">
				<div style="float:left;padding:0 5px;"><br />
					<textarea readonly disabled rows="'.ABGABENANZAHL.'" cols="0">'.$abgabennummern.'</textarea></div>
				
				<div style="float:left;padding:0 5px;">User-ID<br />
					<textarea name="teilnehmerids" rows="'.ABGABENANZAHL.'" cols="7">'.$idfeld.'</textarea></div>
				'.$idfeld2.'
				<div style="float:left;padding:0 5px;">Username(n)<br />
					<textarea name="usernamen" rows="'.ABGABENANZAHL.'" cols="15">'.$usernamen.'</textarea></div>
				
				Abgabenname<br />
				<div style="width:20%;float:left;padding:0 5px;">
					<textarea name="abgabennamen" rows="'.ABGABENANZAHL.'" cols="0"  wrap="off">'.$abgabennamen.'</textarea>
				</div><div style="clear:both"><br />'.$submit.'</div>	
			</div>'.$endform;

			
		if ($addScoresInfo !== false) {
		
			$info = '';
			$addScoresInfo['percentscore'] = getPercentscore($addScoresInfo);
			for ($a_count = 1; $a_count <= $addScoresInfo['anzahlabgaben']; $a_count++) {
				if (isset($addScoresInfo['points'][$a_count])) {
					$score = $addScoresInfo['points'][$a_count];
				} else {
					$score = 0;
				} if (isset($addScoresInfo['cheat'][$a_count - 1]) && $addScoresInfo['cheat'][$a_count - 1] === 'yes') {
					$percentscore[$a_count] = 0;
					$info .= 'A'.$a_count.': 0% (disqualifiziert wegen Selbstvote)&#13;&#10;';
				} else {
					if (in_array($addScoresInfo['teilnehmerIDs'][$a_count - 1], $addScoresInfo['v_id'])) {	
						$info .= 'A'.$a_count.': ['.$score.' P.] Hat gevotet&#13;&#10;';
					} else {		// wenn der Teilnehmer nicht selbst gevotet hat
						$percentscore[$a_count] = 100 * ($score / $addScoresInfo['votepunkte_gesamt']);
						$info .= 'A'.$a_count.': ['.$score.' P.] &#13;&#10;';
					}
				}
			}
			
			$info_output = '<div style="float:left;padding:0 5px;">
						<textarea name="info" readonly rows="'.ABGABENANZAHL.'" cols="25" wrap="off">'.$info.'</textarea>
						<div style="clear:both"><br /></div></div>
					</div>';

			$posSUBMIT = strpos($output, '<div style="clear:both"><br /></div>');
			$output = substr_replace($output, $info_output, $posSUBMIT);
		}

		return $output;
	
	}


	

	function formVotezahl($votezahl) {
	
		if ($votezahl != 0) {
		
			return '<h1>Bitte gib die Zahl der g&uuml;ltigen Votes an:</h1>
			
				<form action="" method="POST">
					<div class="input">
						<input required type="number" name="votefeldanzahl" min="1" max="99" value="'.$votezahl.'"></div>';
				
		} else {
			
			return '<h1>Bitte gib die Zahl der g&uuml;ltigen Votes an:</h1>
				
				<form action="" method="POST">
					<div class="input">
						<input required type="number" name="votefeldanzahl" min="1" max="99">'.FORMBUTTONS.'</div>
				</form>';
				
		}
	}

	
	
	function formVoteFelder($data) {
			
		if (isset($data['votefeldanzahl']) && $data['votefeldanzahl'] != 0) {
			
			$votefeldanzahl = intval($data['votefeldanzahl']);
			$output = '<h1>Kopiere eine Voteschablone in jedes Feld:</h1>
			<form action="" method="POST"><div class="input"><table><tr>';
			
			for ($v_count = 1; $v_count <= $votefeldanzahl; $v_count++) {
			
				if (isset($data['v'.$v_count])) {
				
					$errorMessage = checkVote($data['v'.$v_count], $data["teilnehmerids"]);
					if(isCollab == true && strstr($errorMessage, 'Selbstvote') == false) {
						$errorMessage2 = checkVote($data['v'.$v_count], $data["teilnehmerids2"]);
						if ($errorMessage != $errorMessage2) {
							$errorMessage = $errorMessage2;
						}
					}
					$data['v'.$v_count] = substr($data['v'.$v_count],0,200).'';

					$output .=
						'<td>'.$v_count.$errorMessage.'<br /><textarea name="v'
						.$v_count.'" rows="10" cols="11">'.$data['v'.$v_count].'</textarea></td>';

					
				} else {
				
					$output .= 
						'<td>'.$v_count.'<br /><textarea name="v'.$v_count.
						'" rows="10" cols="11"></textarea></td>';
				
				}
				
				if ($v_count % 6 == 0) {
				
					$output .= '</tr><tr>';
					
				}
			} 
		
		$output .= '</tr></table>';
		
		return $output;
		
		}
	}	

	function checkVote($voteInput, $teilnehmerIDs) {
	
		$output = '';
		$givenpoints = 0;
		$volines = getLines($voteInput, 2);
		$teilnehmerIDs = getLines($teilnehmerIDs, 1);
		
		if (strpos($volines[0], 'ID:') !== 0) {
			
			if (preg_match("/A(\d+): (\d+)/", $volines[0])) {
			
				$output .= '. ID fehlt';
				$vote_id = 0;
			
			} else {
			
				$output .= '. Vote eingeben!';
				$vote_id = 0;
			
			}
				
		}
			
		if (!isset($vote_id)) { 
			$vote_id = numExtract($volines[0], 1);
			
			foreach ($volines as $value) {
			
				$addpoints = numExtract($value, 3);
				$givenpoints += $addpoints;
				
				$a_num = numExtract($value, 2) - 1;
				$a_id_check = isset($teilnehmerIDs[$a_num]) ? $teilnehmerIDs[$a_num] : false;
				if ($vote_id == $a_id_check) {
					
					return '. <font color="red">Selbstvote</font>';
					
				}
			}
		}
			
		if ($givenpoints != POINTS_PER_VOTE && $givenpoints != 0) {
			$output .= '<br />Punktefehler';
		}
		
		return $output;
		
	}


	function voteErrors($data, $scores) {
			
		if (strpos(formVoteFelder($data), 'Selbstvote') !== false) {
			
			return 1;
			
		} else if (strpos(formVoteFelder($data), 'Vote eingeben!') !== false) {
			
			return 2;
			
		} else if (strpos(formVoteFelder($data), 'ID fehlt') !== false) {
			
			return 3;
			
		} else if (count($scores['v_id']) != count(array_unique($scores['v_id']))) {	
			
			return 4;
			
		} else if (strpos(formVoteFelder($data), 'Punktefehler') !== false) {
			
			return 5;
			
		} else {
			
			return 6;
		
		}
	}


	function formButtonsAndErrors($data, $scores) {
			
			$error_num = voteErrors($data, $scores);
			$fehler_format = '<p class="alert"><font color="red">Fehler:</font> ';
			$hinweis_format = '<p class="alert"><font color="red">Hinweis:</font> ';
			
			switch($error_num) {
				
				case 1:
					$error_message = $fehler_format.
						'Mindestens ein User hat f&uuml;r sich selbst gevotet (siehe Votefelder).</p>';
					break;
					
				case 2:
					$error_message = $fehler_format.
						'Bitte zum Fortfahren in jedes Feld einen g&uuml;ltigen Vote eingeben.</p>';
					break;
					
				case 3:
					$error_message = $fehler_format.
						'Bei mindestens einem Vote fehlt die User-ID (siehe Vote-Felder).</p>';
					break;
					
				case 4:
					$error_message = $fehler_format.
						'Mindestens ein User scheint mehrfach gevotet zu haben. Bitte korrigieren.</p>';
					break;
					
				case 5:
					$error_message = $hinweis_format.
						'Mindestens ein Vote folgt nicht dem Voteschema, die Berechnung erfolgt dennoch.</p>';
					break;
					
				case 6:
					$error_message = '';
					break;
			
			}


			// fügt die Checkbox für Aktivierung der Spannpunkteberechnung ein
			
			$checkboxes = createCheckbox("spanpoint").createCheckbox("collab");

			$output = 
				'<div style="clear:both;"><br />'
				.$error_message.'<br />'.$checkboxes.'<br />
				<input type="submit" value="Aktualisieren">
				<input type="submit" name="beispiel" value="Beispiel berechnen">
				<input type="submit" name="clear" value="Zur&uuml;cksetzen"></form>
				</div><br /></div></div></form>';
			
			return $output;
			
	}

	function createCheckbox($type) {

		if ($type == spanpoint) {
			if (spanpointsOn == false)
			{
				return 
					'<input type="checkbox" name="activateSpanpoints" value="No" checked />'
					.'Spannpunkte ignorieren<br /><br /><div class="alert"><font color="red">'
					.'Hinweis:</font> Die Berechnung erfolgt ohne Spannpunkte.</div><br />';

			} else {
				return 
					'<input type="checkbox" name="activateSpanpoints" value="No" />'
					.'Spannpunkte ignorieren<br />';
			}  
		} else if ($type == collab) {
			if (isCollab == false)
			{
				return 
					'<input type="checkbox" name="collabCheck" value="Collab" />Collab-Wettbewerb<br />';

			} else {
				return 
					'<input type="checkbox" name="collabCheck" value="Collab" checked />Collab-Wettbewerb<br />';
			} 
		}
		echo 'ERROR FUNCTION CALL createCheckbox';

	}

	function getPointsList($scores, $data) {
		
		$id_counter = 0;
		if (isset($data['votefeldanzahl']) && $data['votefeldanzahl'] != 0) {
			for ($votenummer = 1; $votenummer <= $data['votefeldanzahl']; $votenummer++) {
				if (array_key_exists('v'.$votenummer, $data)) {
					$volines = getLines($data['v'.$votenummer], 2);
					if (strpos($volines[0], 'ID:') === 0) {
						$scores['v_id'][$id_counter] = numExtract($volines[0], 1);
						if (preg_match("/A(\d+): (\d+)/", $volines[1])) {

							$scores['givenVotes']++;
							$spancount = 0;
							$givenpoints = 0;

							foreach ($volines as $value) {
							
								$a_id = numExtract($value, 2);
								if (isset($scores['points'][$a_id])) {
									$former_score = $scores['points'][$a_id];
								} else {
									$former_score = 0;
								}
								
								$addpoints = numExtract($value, 3);
								$givenpoints += $addpoints;
								if ($addpoints != 0) {
									$spancount++;
									if (spanpointsOn === true) {
										$scores['points'][$a_id] = $former_score + $addpoints + 1;
										$scores['points']["spanpoints"]++;
									} else {
										$scores['points'][$a_id] = $former_score + $addpoints;
									} 
								}
							}
							$scores['spancount'] = $spancount;						
							$scores['spanpointList'][trim($scores['v_id'][$id_counter])] = 
								(spanpointsOn === true) ? $scores['spancount'] : 0;
						} $id_counter++;
					}
				}
			}
		}
		
		return $scores;
		
	}
	
	
	
	
	// U T I L I T I E S
	
	function getLines($input, $parameter) {
	
		//  Teilt den Input eines Textfeldes zeileinweise in einen Array
		
		$input = substr($input,0,1000).'';
		$lines = explode("\n", $input);
		if ($parameter == 1) {				// <--- für das Teilnehmer-IDs-Feld
			$lines = array_map('intval', $lines);
		}
		
		return $lines;
	}
	
	
	function numExtract($voline, $parameter) {
		
		$pattern = '/A(\d+): (\d+)/';
		$get_id = '$1';
		
		if ($parameter == 1) {
			$pattern = '/ID: (\d+)/';
		} else if ($parameter == 3) {
			$get_id = '$2';
		}
		$output = intval(preg_replace($pattern,$get_id,$voline));
		
		return $output;
	}
	

	function getPercentscore($scores) {
		
		if ($scores['votepunkte_reduziert'] > 0) {
			for ($a_count = 1; $a_count <= ABGABENANZAHL; $a_count++) {
			
				if (isset($scores['points'][$a_count])) {
					$score = $scores['points'][$a_count];
				} else {
					$score = 0;
				} 
				
				if (isCollab == true) {

						$spanpoints = $scores['spanpointList'];
						$idlines = $scores['teilnehmerIDs'];
						$idlines2 = $scores['teilnehmerIDs2'];

					if (in_array($scores['teilnehmerIDs'][$a_count - 1], $scores['v_id']) && in_array($scores['teilnehmerIDs2'][$a_count - 1], $scores['v_id'])) {
						if (isset($spanpoints[$idlines[$a_count - 1]]) && isset($spanpoints[$idlines2[$a_count - 1]])) {
							$percentscore[$a_count] = 100 * ($score / ($scores['votepunkte_doppelt_reduziert'] - $spanpoints[$idlines[$a_count - 1]] - $spanpoints[$idlines2[$a_count - 1]]));	
						} else {
							$percentscore[$a_count] = 0;
						}
					} else if (in_array($scores['teilnehmerIDs'][$a_count - 1], $scores['v_id'])) {
						if (isset($spanpoints[$idlines[$a_count - 1]])) {
							$percentscore[$a_count] = 100 * ($score / ($scores['votepunkte_reduziert'] - $spanpoints[$idlines[$a_count - 1]]));	
						} else {
							$percentscore[$a_count] = 0;
						}
					} else if (in_array($scores['teilnehmerIDs2'][$a_count - 1], $scores['v_id'])) {
						if (isset($spanpoints[$idlines2[$a_count - 1]])) {
							$percentscore[$a_count] = 100 * ($score / ($scores['votepunkte_reduziert'] - $spanpoints[$idlines2[$a_count - 1]]));	
						} else {
							$percentscore[$a_count] = 0;
						}
					} else {
						$percentscore[$a_count] = 100 * ($score / $scores['votepunkte_gesamt']);
					}
					
				} else {

					if (in_array($scores['teilnehmerIDs'][$a_count - 1], $scores['v_id'])) {	// wenn der Teilnehmer selbst auch gevotet hat
						$spanpoints = $scores['spanpointList'];
						$idlines = $scores['teilnehmerIDs'];
						if (isset($spanpoints[$idlines[$a_count - 1]])) {
							$percentscore[$a_count] = 100 * ($score / ($scores['votepunkte_reduziert'] - $spanpoints[$idlines[$a_count - 1]]));	
						} else {
							$percentscore[$a_count] = 0;
						}
					} else {	// wenn der Teilnehmer nicht selbst gevotet hat
						$percentscore[$a_count] = 100 * ($score / $scores['votepunkte_gesamt']);
					}

				}


			} 
			return $percentscore;
		}
	}
	
?>
