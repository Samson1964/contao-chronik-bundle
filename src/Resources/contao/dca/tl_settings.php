<?php

/**
 * palettes
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{chronik_legend:hide},chronik_seite';

/**
 * fields
 */

// Seite für das Chronik-Modul
$GLOBALS['TL_DCA']['tl_settings']['fields']['chronik_seite'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['chronik_seite'],
	'exclude'                 => true,
	'inputType'               => 'pageTree',
	'foreignKey'              => 'tl_page.title',
	'eval'                    => array
	(
		'mandatory'           => true,
		'fieldType'           => 'radio',
		'tl_class'            => 'w50 clr'
	),
	'relation'                => array
	(
		'type'                => 'hasOne',
		'load'                => 'lazy'
	)
); 
