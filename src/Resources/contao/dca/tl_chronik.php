<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package News
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Table tl_chronik
 */
$GLOBALS['TL_DCA']['tl_chronik'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id'        => 'primary',
				'from_date' => 'index',
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('from_date ASC'),
			'panelLayout'             => 'filter;sort,search,limit',
		),
		'label' => array
		(
			'fields'                  => array('from_date'), // Wird nicht benötigt, es gibt keine Labels für die List-View
			'format'                  => '%s',
			'label_callback'          => array('tl_chronik', 'listHistory'),
			'group_callback'          => array('tl_chronik', 'groupFormat')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chronik']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chronik']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chronik']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chronik']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chronik']['toggle'],
				'attributes'           => 'onclick="Backend.getScrollOffset()"',
				'haste_ajax_operation' => array
				(
					'field'            => 'published',
					'options'          => array
					(
						array('value' => '', 'icon' => 'invisible.svg'),
						array('value' => '1', 'icon' => 'visible.svg'),
					),
				),
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chronik']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
			'clubs' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chronik']['clubs'],
				'icon'                => 'bundles/contaochronik/images/club_added.gif',
				'button_callback'     => array('tl_chronik', 'clubIcon')
			),
			'players' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chronik']['players'],
				'icon'                => 'bundles/contaochronik/images/player_added.png',
				'button_callback'     => array('tl_chronik', 'playerIcon')
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('addImage', 'clublist_incomplete', 'playerlist_incomplete', 'overwriteMeta'),
		'default'                     => '{chronik_legend},region,from_date,to_date,title,text;{source_legend:hide},source,url;{image_legend},addImage;{connect_legend:hide},clublist_incomplete,clublist,playerlist_incomplete,playerlist;{publish_legend:hide},published'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'addImage'                    => 'singleSRC,size,floating,fullsize,overwriteMeta',
		'overwriteMeta'               => 'alt,imageTitle,imageUrl,caption',
		'clublist_incomplete'         => 'clublist_failed',
		'playerlist_incomplete'       => 'playerlist_failed'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'region' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['region'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'maxlength'           => 255,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'from_date' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['from_date'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 12,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'maxlength'           => 10,
				'tl_class'            => 'w50 clr wizard',
				'rgxp'                => 'alnum',
				'datepicker'          => true,
				'mandatory'           => false
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
		),
		'to_date' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['to_date'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'maxlength'           => 10,
				'tl_class'            => 'w50 wizard',
				'rgxp'                => 'alnum',
				'datepicker'          => true,
				'mandatory'           => false
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
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'maxlength'           => 255,
				'tl_class'            => 'long clr'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'text' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['text'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array
			(
				'rte'                 => 'tinyMCE',
				'tl_class'            => 'clr',
				'mandatory'           => false
			),
			'explanation'             => 'insertTags',
			'sql'                     => "mediumtext NULL"
		),
		'addImage' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['addImage'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'singleSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['singleSRC'],
			'inputType'               => 'fileTree',
			'eval'                    => array
			(
				'fieldType'           => 'radio',
				'filesOnly'           => true,
				'extensions'          => '%contao.image.valid_extensions%',
				'mandatory'           => true,
				'tl_class'            => 'clr'
			),
			'sql'                     => "binary(16) NULL"
		),
		'size' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['MSC']['imgSize'],
			'inputType'               => 'imageSize',
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'eval'                    => array('rgxp'=>'natural', 'includeBlankOption'=>true, 'nospace'=>true, 'helpwizard'=>true, 'tl_class'=>'w50 clr'),
			'options_callback' => static function ()
			{
				return Contao\System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(Contao\BackendUser::getInstance());
			},
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'floating' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['floating'],
			'inputType'               => 'radioTable',
			'options'                 => array('above', 'left', 'right', 'below'),
			'eval'                    => array('cols'=>4, 'tl_class'=>'w50'),
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'sql'                     => "varchar(12) NOT NULL default 'above'"
		),
		'fullsize' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['fullsize'],
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50', 'type' => 'boolean'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'overwriteMeta' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['overwriteMeta'],
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50 clr', 'type' => 'boolean'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'alt' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['alt'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'imageTitle' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['imageTitle'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'imageUrl' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['imageUrl'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'dcaPicker'=>true, 'addWizardClass'=>false, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'caption' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['caption'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'allowHtml'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'source' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['source'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'url' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['url'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'clublist_incomplete' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['clublist_incomplete'],
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'default'                 => 1,
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default '1'"
		),
		'clublist_failed' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['clublist_failed'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>512, 'tl_class'=>'w50'),
			'sql'                     => "varchar(512) NOT NULL default ''"
		),
		'clublist' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['clublist'],
			'exclude'                 => true,
			'options_callback'        => array('tl_chronik', 'getVereine'),
			'inputType'               => 'select',
			'eval'                    => array('multiple'=>true, 'chosen'=>true, 'tl_class'=>'w50 clr'),
			'sql'                     => "blob NULL",
		),
		'playerlist_incomplete' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['playerlist_incomplete'],
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'default'                 => 1,
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50 clr'),
			'sql'                     => "char(1) NOT NULL default '1'"
		),
		'playerlist_failed' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['playerlist_failed'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>512, 'tl_class'=>'w50'),
			'sql'                     => "varchar(512) NOT NULL default ''"
		),
		'playerlist' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['playerlist'],
			'exclude'                 => true,
			'options_callback'        => array('Schachbulle\ContaoSpielerregisterBundle\Klassen\Helper', 'getRegister'),
			'inputType'               => 'select',
			'eval'                    => array
			(
				'includeBlankOption'  => true,
				'mandatory'           => false,
				'multiple'            => true,
				'chosen'              => true,
				'submitOnChange'      => false,
				'tl_class'            => 'w50 clr'
			),
			'sql'                     => "blob NULL",
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chronik']['published'],
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'default'                 => 1,
			'sql'                     => "char(1) NOT NULL default '1'"
		),
	)
);


/**
 * Class tl_chronik
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2014
 * @author     Leo Feyer <https://contao.org>
 * @package    News
 */
class tl_chronik extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	/**
	 * Datensätze auflisten
	 * @param array
	 * @return string
	 */
	public function listHistory($arrRow)
	{

		// Status der Sichtbarkeit für das CSS feststellen
		$key = $arrRow['published'] ? 'published' : 'unpublished';
		$text = $arrRow['from_date'] ? \Schachbulle\ContaoHelperBundle\Classes\Helper::getDate($arrRow['from_date']) : '';
		$text .= $arrRow['to_date'] ? ' - '.\Schachbulle\ContaoHelperBundle\Classes\Helper::getDate($arrRow['to_date']) : '';
		$text .= $arrRow['title'] ? ': '.$arrRow['title'] : '';

		$temp = '<div class="cte_type '.$key.'">'.$text.'</div>';
		$temp .= '<div class="limit_height '.(!Config::get('doNotCollapse') ? 'h40' : ''). '">';
		if($arrRow['text']) $temp .= strip_tags($arrRow['text']) . '<br><br>';
		if($arrRow['source']) $temp .= '[<i>Quelle: ' . $arrRow['source'] . '</i>]';
		$temp .= '</div>';
		$temp .= '</div>';
		return $temp;

	}

	public function clubIcon($row, $href, $label, $title, $icon, $attributes)
	{

		if($row['clublist_incomplete'])
		{
			$icon = 'bundles/contaochronik/images/club_red.gif';
			$title = 'Kein Verein zugeordnet';
		}

		return '<span>'.Image::getHtml($icon, $label).'</span> ';
	}

	public function playerIcon($row, $href, $label, $title, $icon, $attributes)
	{

		if($row['playerlist_incomplete'])
		{
			$icon = 'bundles/contaochronik/images/player_red.png';
			$title = 'Kein Spieler zugeordnet';
		}

		return '<span>'.Image::getHtml($icon, $label).'</span> ';
	}

	public function groupFormat($group, $sortingMode, $firstOrderBy, $row, $dc)
	{
		return \Schachbulle\ContaoHelperBundle\Classes\Helper::getDate($group);
	}

	public function getVereine(DataContainer $dc)
	{
		// Vereinsregister laden
		$objVereinsregister = $this->Database->prepare("SELECT * FROM tl_vereinsregister WHERE published = ?")
		                                     ->execute(1);
		$array = array();
		while($objVereinsregister->next())
		{
			$name = $objVereinsregister->name;
			if($objVereinsregister->timerange || $objVereinsregister->foundingDate || $objVereinsregister->resolutionDate)
			{
				$name .= ' [';
				$name .= $objVereinsregister->timerange ? $objVereinsregister->timerange : (($objVereinsregister->foundingDate || $objVereinsregister->resolutionDate) ? ' | '.\Schachbulle\ContaoHelperBundle\Classes\Helper::getDate($objVereinsregister->foundingDate).' - '.\Schachbulle\ContaoHelperBundle\Classes\Helper::getDate($objVereinsregister->resolutionDate) : '');
				$name .= ']';
			}
			$array[$objVereinsregister->id] = $name;
		}

		return $array;

	}

}
