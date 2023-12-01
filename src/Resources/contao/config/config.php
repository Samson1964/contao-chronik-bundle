<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package   bdf
 * @author    Frank Hoppe
 * @license   GNU/LGPL
 * @copyright Frank Hoppe 2014
 */

$GLOBALS['BE_MOD']['content']['chronik'] = array
(
	'tables'         => array('tl_chronik'),
	'icon'           => 'bundles/contaochronik/images/icon.png',
	'stylesheet'     => 'bundles/contaochronik/style.css'
);

/**
 * Frontend-Module
 */
$GLOBALS['FE_MOD']['chronik'] = array
(
	'chronik'        => 'Schachbulle\ContaoChronikBundle\Modules\Chronik'
);

// http://de.contaowiki.org/Strukturierte_URLs
$GLOBALS['TL_HOOKS']['getPageIdFromUrl'][] = array('Schachbulle\ContaoChronikBundle\Classes\Helper', 'getParamsFromUrl');
