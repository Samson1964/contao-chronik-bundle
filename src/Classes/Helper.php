<?php

namespace Schachbulle\ContaoChronikBundle\Classes;
 
class Helper
{

	var $Fragmente;
	var $Chronikseite;

	/**
	 * Klasse initialisieren
	 */
	public function __construct()
	{
	 	// Ermittlung des Alias der Seite mit dem Chronik-Modul 
		$page = \PageModel::findByPK($GLOBALS['TL_CONFIG']['chronik_seite']); 
		$this->Chronikseite = $page->alias;
	}

	public function getChronikseite()
	{
	 	// Ermittlung des Alias der Seite mit dem Chronik-Modul 
		$page = \PageModel::findByPK($GLOBALS['TL_CONFIG']['chronik_seite']); 
		return $page->alias;
	}

	/**
	 * Hook-Funktion: 
	 * Wertet das URL-Parameter-Array aus und modifiziert es, wenn das Array für die Chronik bestimmt ist
	 *
	 * @return array
	 */
	public function getParamsFromUrl($arrFragments)
	{
		$log = "\nURL-Fragmente vorher:\n";
		$log .= print_r($arrFragments, true);
		//print_r($_SERVER['REQUEST_URI']);
		$args = count($arrFragments); // Anzahl Argumente

		if($args > 1)
		{
			// Es wurde mehr als nur der Alias übergeben
			if($arrFragments[0] == $this->Chronikseite)
			{
				// Alias der Chronikseite gefunden!
				if($arrFragments[1] == 'auto_item')
				{
					$var = 'year';
					$val = $arrFragments[2];
					$arrFragments[2] = $var;
					$arrFragments[3] = $val;
				}
				//$arrFragments[1] = 'year';
			}
			//elseif($arrFragments[2] == $this->Chronikseite && $arrFragments[1] == 'auto_item')
			//{
			//	// Contao 4 app_dev-Modus
			//	$arrFragments[1] = $this->Chronikseite;
			//	$arrFragments[2] = 'year';
			//}
		}

		//if($arrFragments[1] == 'app_dev')
		//{
		//	// Array('app_dev', 'chronik', '1750-1800')
		//	// app_dev-Modus aktiv (nur in Contao 4) - app_dev rauswerfen, da die Parameter durcheinanderkommen!
		//	if($arrFragments[1] == $this->Chronikseite)
		//	{
		//		// Parameter korrigieren
		//		$arrFragments[1] = 'year'; // Alias durch Parameter year ersetzen
		//		$arrFragments[0] = $this->Chronikseite; // app_dev mit Alias überschreiben
		//	}
		//}
		//if($args > 1 && $arrFragments[0] == $this->Chronikseite)
		//{
		//	// Array('chronik', 'auto_item', '1750-1800')
		//	// Parameter korrigieren
		//	$arrFragments[1] = 'year'; // auto_item durch Parameter year ersetzen
		//}
		
		
		$log .= "URL-Fragmente danach:\n";
		$log .= print_r($arrFragments, true);
		//print_r($GLOBALS['CHRONIKLINKS']);
		log_message($log, 'chronik-debug.log');
		return $arrFragments;
	}
}
