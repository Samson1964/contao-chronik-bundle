<?php

namespace Schachbulle\ContaoChronikBundle\Classes;
 
class Helper
{

	var $Fragmente;

	/**
	 * Klasse initialisieren
	 */
	public function __construct()
	{
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

		//if($arrFragments[1] == 'app_dev')
		//{
		//	// Array('app_dev', 'chronik', '1750-1800')
		//	// app_dev-Modus aktiv (nur in Contao 4) - app_dev rauswerfen, da die Parameter durcheinanderkommen!
		//	if($arrFragments[1] == ALIAS_CHRONIK)
		//	{
		//		// Parameter korrigieren
		//		$arrFragments[1] = 'year'; // Alias durch Parameter year ersetzen
		//		$arrFragments[0] = ALIAS_CHRONIK; // app_dev mit Alias überschreiben
		//	}
		//}
		//if($args > 1 && $arrFragments[0] == ALIAS_CHRONIK)
		//{
		//	// Array('chronik', 'auto_item', '1750-1800')
		//	// Parameter korrigieren
		//	$arrFragments[1] = 'year'; // auto_item durch Parameter year ersetzen
		//}
		
		//if($args == 1)
		//{
		//	if($arrFragments[0] == ALIAS_CHRONIK)
		//	{
		//		// auto_item wird nicht mehr mitgeliefert im app_prod-Modus
		//		$arrFragments[1] = 'year';
		//	}
		//}
		//elseif($args > 1)
		//{
		//	if($arrFragments[0] == ALIAS_CHRONIK && $arrFragments[1] == 'auto_item')
		//	{
		//		// In [0] steht das Seitenalias, ab [1] die Parameter
		//		$arrFragments[1] = 'year';
		//	}
		//	elseif($arrFragments[2] == ALIAS_CHRONIK && $arrFragments[1] == 'auto_item')
		//	{
		//		// Contao 4 app_dev-Modus
		//		$arrFragments[1] = ALIAS_CHRONIK;
		//		$arrFragments[2] = 'year';
		//	}
		//}
		
		$log .= "URL-Fragmente danach:\n";
		$log .= print_r($arrFragments, true);
		//print_r($GLOBALS['CHRONIKLINKS']);
		log_message($log, 'chronik-debug.log');
		return $arrFragments;
	}
}
