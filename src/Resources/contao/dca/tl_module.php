<?php
/**
 * Avatar for Contao Open Source CMS
 *
 * Copyright (C) 2013 Kirsten Roschanski
 * Copyright (C) 2013 Tristan Lins <http://bit3.de>
 *
 * @package    Avatar
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Add palette to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['chronik'] = '{title_legend},name,type;{options_legend},chronik_from,chronik_to;{expert_legend:hide},cssID,align,space';

$GLOBALS['TL_DCA']['tl_module']['fields']['chronik_from'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['chronik_from'],
	'inputType'               => 'text',
	'eval'                    => array
	(
		'maxlength'           => 10,
		'tl_class'            => 'w50 wizard',
		'rgxp'                => 'alnum',
		'datepicker'          => true,
		'mandatory'           => true
	),
	'load_callback'           => array
	(
		array('\Schachbulle\ContaoHelperBundle\Classes\Helper', 'getDate')
	),
	'save_callback' => array
	(
		array('\Schachbulle\ContaoHelperBundle\Classes\Helper', 'putDate')
	),
	'sql'                     => "int(8) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['chronik_to'] = array
(
	'label'            => &$GLOBALS['TL_LANG']['tl_module']['chronik_to'],
	'inputType'               => 'text',
	'eval'                    => array
	(
		'maxlength'           => 10,
		'tl_class'            => 'w50 wizard',
		'rgxp'                => 'alnum',
		'datepicker'          => true,
		'mandatory'           => true
	),
	'load_callback'           => array
	(
		array('\Schachbulle\ContaoHelperBundle\Classes\Helper', 'getDate')
	),
	'save_callback' => array
	(
		array('\Schachbulle\ContaoHelperBundle\Classes\Helper', 'putDate')
	),
	'sql'                     => "int(8) unsigned NOT NULL default '0'"
);
