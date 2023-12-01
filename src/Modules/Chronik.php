<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package   fh-counter
 * @author    Frank Hoppe
 * @license   GNU/LGPL
 * @copyright Frank Hoppe 2014
 */

namespace Schachbulle\ContaoChronikBundle\Modules;

/**
 * Class CounterRegister
 *
 * @copyright  Frank Hoppe 2014
 * @author     Frank Hoppe
 *
 * Basisklasse vom FH-Counter
 * Erledigt die Zählung der jeweiligen Contenttypen und schreibt die Zählerwerte in $GLOBALS
 */
class Chronik extends \Module
{

	protected $strTemplate = 'mod_chronik';

	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### CHRONIK ###';
			$von = $this->chronik_from ? ' von '.\Schachbulle\ContaoHelperBundle\Classes\Helper::getDate($this->chronik_from) : ' von ?';
			$bis = $this->chronik_to ? ' bis '.\Schachbulle\ContaoHelperBundle\Classes\Helper::getDate($this->chronik_to) : ' bis ?';
			$objTemplate->title = $this->name.$von.$bis;
			$objTemplate->id = $this->id;

			return $objTemplate->parse();
		}
		else
		{
			// FE-Modus: URL mit allen möglichen Parametern auflösen
			\Input::setGet('club', \Input::get('club')); // ID des Vereins
			\Input::setGet('player', \Input::get('player')); // ID des Spielers
			\Input::setGet('year', \Input::get('year')); // Jahre der Chronik
		}

		return parent::generate(); // Weitermachen mit dem Modul
	}

	/**
	 * Generate the module
	 */
	protected function compile()
	{
		$this->import('Database');

		// URL-Parameter modifizieren
		$club_id = \Input::get('club');
		$player_id = \Input::get('player');
		$year = \Input::get('year');
		$menu = array(); // Jahresmenü
		$chronikalias = \Schachbulle\ContaoChronikBundle\Classes\Helper::getChronikseite();

		// Jahresmenü generieren
		if($this->chronik_filter)
		{
			$von = $this->chronik_from;
			$bis = $this->chronik_from + $this->chronik_timerange - 1;
			for($jahr = $this->chronik_from; $jahr <= $this->chronik_to; $jahr++)
			{
				if($jahr == $bis)
				{
					// Ende des Zeitraums erreicht, deshalb im Menü sichern
					$menu[] = array
					(
						'von'  => $von,
						'bis'  => $bis,
						'name' => $von.'-'.$bis,
						'url'  => $chronikalias.'/'.$von.'-'.$bis.'.html'
					);
					// Neuen Zeitraum speichern
					$von = $jahr + 1;
					$bis = $jahr + $this->chronik_timerange;
				}
			}
			// Prüfen, ob Jahre fehlen
			$index = array_key_last($menu);
			if($menu[$index]['bis'] < $this->chronik_to)
			{
				$menu[] = array
				(
					'von'  => $menu[$index]['bis'] + 1,
					'bis'  => $this->chronik_to,
					'name' => ($menu[$index]['bis']+1).'-'.$this->chronik_to,
					'url'  => $chronikalias.'/'.($menu[$index]['bis']+1).'-'.$this->chronik_to.'.html'
				);
			}
		}

		//echo $objPage->alias;
		
		// Weiterleiten zur 1. Seite der Chronik, wenn keine Parameter gesetzt sind
		// PATCH: Funktioniert in Contao 4 nicht richtig - gesamtes Bundle umbauen
		//if(!$year && !$club_id && !$player_id) header('Location:/'.ALIAS_CHRONIK.'/'.$GLOBALS['CHRONIKLINKS'][0].'.html');

		// Zeitraum prüfen, wenn Chronikjahr angegeben, ggfs. korrigieren und weiterleiten
		// PATCH: Funktioniert in Contao 4 nicht richtig - gesamtes Bundle umbauen
		//if($year && !in_array($year, $GLOBALS['CHRONIKLINKS'])) header('Location:/'.ALIAS_CHRONIK.'/'.$GLOBALS['CHRONIKLINKS'][0].'.html');

		// ====================================================================================================
		// Parameter club_id gesetzt: Vereinschronik ausgeben
		// ====================================================================================================
		if($club_id)
		{
		}
		// ====================================================================================================
		// Parameter player_id gesetzt: Spielerchronik ausgeben
		// ====================================================================================================
		elseif($player_id)
		{
		}
		// ====================================================================================================
		// Parameter year gesetzt: Jahreschronik ausgeben
		// ====================================================================================================
		elseif($year)
		{
			// Zeitraum ermitteln
			$timerange = explode('-', $year);

			$objChronik = \Database::getInstance()->prepare('SELECT * FROM tl_chronik WHERE published = ? AND from_date >= ? AND from_date <= ? ORDER BY from_date ASC, to_date ASC')
			                                      ->execute(1, $timerange[0].'0000', $timerange[1].'1231');

			$daten = array();
			if($objChronik->numRows > 1)
			{
				// Datensätze anzeigen
				while($objChronik->next())
				{
					$daten[] = array
					(
						'titel'     => $objChronik->title,
						'zeitraum'  => \Schachbulle\ContaoHelperBundle\Classes\Helper::getDate($objChronik->from_date) . ($objChronik->to_date ? ' - '.\Schachbulle\ContaoHelperBundle\Classes\Helper::getDate($objChronik->to_date) : ''),
						'text'      => $objChronik->text,
						'vereine'   => $objChronik->clublist ? implode(', ', unserialize($objChronik->clublist)) : '',
						'spieler'   => $objChronik->playerlist ? implode(', ', unserialize($objChronik->playerlist)) : '',
						'quelle'    => $objChronik->url ? '<a href="'.$objChronik->url.'">'.$objChronik->source.'</a>' : $objChronik->source,
					);
				}
			}

		}

		$this->Template->active = $year;
		$this->Template->data = isset($daten) ? $daten : false;
		$this->Template->yearmenu = $menu;
			
	}

}
