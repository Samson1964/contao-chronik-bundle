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

namespace Schachbulle\ContaoChronikBundle\Classes;

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

	protected $strTemplate = 'chronik_list';

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
			$objTemplate->title = $this->name;
			$objTemplate->id = $this->id;

			return $objTemplate->parse();
		}
		else
		{
			// FE-Modus: URL mit allen möglichen Parametern auflösen
			\Input::setGet('club', \Input::get('club')); // ID des Vereins
			\Input::setGet('player', \Input::get('player')); // ID des Spielers
			\Input::setGet('year', \Input::get('year')); // Jahr der Chronik
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
		// Weiterleiten zur 1. Seite der Chronik, wenn keine Parameter gesetzt sind
		if(!$year && !$club_id && !$player_id) header('Location:/'.ALIAS_CHRONIK.'/'.$GLOBALS['CHRONIKLINKS'][0].'.html');
		// Zeitraum prüfen, wenn Chronikjahr angegeben, ggfs. korrigieren und weiterleiten
		if($year && !in_array($year, $GLOBALS['CHRONIKLINKS'])) header('Location:/'.ALIAS_CHRONIK.'/'.$GLOBALS['CHRONIKLINKS'][0].'.html');
		
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
			
			$objChronik = $this->Database->prepare('SELECT * FROM tl_chronik WHERE published = ? AND from_date >= ? AND from_date <= ? ORDER BY from_date ASC, to_date ASC')
			                             ->execute(1, $timerange[0].'0000', $timerange[1].'0000');

			$daten = array();
			if($objChronik->numRows > 1)
			{
				// Datensätze anzeigen
				while($objChronik->next()) 
				{
					$daten[] = array
					(
						'titel'     => $objChronik->title,
						'zeitraum'  => \Schachbulle\ContaoChronikBundle\Classes\Helper::getDateString($objChronik->from_date) . ($objChronik->to_date ? ' - '.\Schachbulle\ContaoChronikBundle\Classes\Helper::getDateString($objChronik->to_date) : ''),
						'text'      => $objChronik->text,
						'vereine'   => $objChronik->clublist ? implode(', ', unserialize($objChronik->clublist)) : '',
						'spieler'   => $objChronik->playerlist ? implode(', ', unserialize($objChronik->playerlist)) : '',
						'quelle'    => $objChronik->url ? '<a href="'.$objChronik->url.'">'.$objChronik->source.'</a>' : $objChronik->source,
					);
				}
			}

			$this->Template->active = $year;
			$this->Template->data = $daten;
		}

	}


}
