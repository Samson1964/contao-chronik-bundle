<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

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

define('ALIAS_CHRONIK', 'chronik'); // Alias der Chronikseite

// Array mit zulässigen Zeitabschnitten für Links, Index 0 ist der Standardwert
$GLOBALS['CHRONIKLINKS'] = array
(
	'1750-1800',
	'1801-1850',
	'1851-1900',
	'1901-1905',
	'1906-1910',
	'1911-1915',
	'1916-1920',
	'1921-1925',
	'1926-1930',
	'1931-1935',
	'1936-1940',
	'1941-1945',
	'1946-1950',
	'1951-1955',
	'1956-1960',
	'1961-1965',
	'1966-1970',
	'1971-1975',
	'1976-1980',
	'1981-1985',
	'1986-1990',
	'1991-1995',
	'1996-2000',
	'2001-2005',
	'2006-2010',
);

$GLOBALS['BE_MOD']['dsb']['chronik'] = array
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
	'chronik'        => 'Schachbulle\ContaoChronikBundle\Classes\Chronik'
);

// http://de.contaowiki.org/Strukturierte_URLs
$GLOBALS['TL_HOOKS']['getPageIdFromUrl'][] = array('Schachbulle\ContaoChronikBundle\Classes\Helper', 'getParamsFromUrl');

