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
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'chronik_filter';
$GLOBALS['TL_DCA']['tl_module']['palettes']['chronik'] = '{title_legend},name,type;{options_legend},chronik_from,chronik_to,chronik_filter;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['chronik_filter'] = 'chronik_timerange';

$GLOBALS['TL_DCA']['tl_module']['fields']['chronik_from'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['chronik_from'],
	'inputType'               => 'text',
	'eval'                    => array
	(
		'maxlength'           => 4,
		'tl_class'            => 'w50 wizard',
		'rgxp'                => 'alnum',
		'datepicker'          => true,
		'mandatory'           => true
	),
	'sql'                     => "int(4) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['chronik_to'] = array
(
	'label'            => &$GLOBALS['TL_LANG']['tl_module']['chronik_to'],
	'inputType'               => 'text',
	'eval'                    => array
	(
		'maxlength'           => 4,
		'tl_class'            => 'w50 wizard',
		'rgxp'                => 'alnum',
		'datepicker'          => true,
		'mandatory'           => true
	),
	'sql'                     => "int(4) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['chronik_filter'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['chronik_filter'],
	'inputType'               => 'checkbox',
	'filter'                  => true,
	'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'clr'),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['chronik_timerange'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['chronik_timerange'],
	'inputType'               => 'text',
	'default'                 => 10,
	'eval'                    => array
	(
		'maxlength'           => 3,
		'tl_class'            => 'w50',
		'rgxp'                => 'alnum',
	),
	'sql'                     => "int(3) unsigned NOT NULL default '10'"
);
