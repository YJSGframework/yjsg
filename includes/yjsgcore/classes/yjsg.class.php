<?php
/*======================================================================*\
|| #################################################################### ||
|| # Package - Yjsg	Framework									        ||
|| # Copyright (C) 2010  Youjoomla.com. All Rights Reserved.            ||
|| # license - PHP files are licensed under  GNU/GPL V2                 ||
|| # license - CSS  - JS - IMAGE files  are Copyrighted material        ||
|| # bound by Proprietary License of Youjoomla.com                      ||
|| # for more information visit http://www.youjoomla.com/license.html   ||
|| # Redistribution and  modification of this software                  ||
|| # is bounded by its licenses                                         ||
|| # websites - http://www.youjoomla.com | http://www.yjsimplegrid.com  ||
|| #################################################################### ||
\*======================================================================*/

defined( '_JEXEC' ) or die( 'Restricted index access' );

/**
 * Yjsg class
 *
 * @package     Yjsg Framework
 * @since       2.0.0
 */
 
class Yjsg { 

    /**
     * Current version
     *
     * @return	string	- version
     * @since 2.0.0
     */	
	 
	public $version = "2.1.1";
	
    /**
     * Check update
     *
     * @return	string	- update
     * @since 2.0.0
     */	
	 
	public $hasupdate = 0;
	
	
    /**
     * Yjsg instance
     *
     * @return	Yjsg	- object
     * @since 2.0.0
     */		
	
	public static $_instance = null;

    /**
     * Current template version
     *
     * @return	string	- version
     * @since 2.0.0
     */	
	 
	public $tmplVersion = null;

    /**
     * Get application
     *
     * @since 2.0.0
     */
    
    public $app = null;
	
	
    /**
     * Get user object
     *
     * @since 2.0.0
     */	
	 
	 
	public $user = null;
	
    /**
     * Check file path
     *
     * @return	string
     * @since 2.0.0
     */		
	
	
	public $filepath = null;
	


    /**
     * Check legacy file path
     *
     * @return	string
     * @since 2.0.0
     */		
	
	
	public $filepathLegacy = null;

	   
    /**
     * Current template version
     *
     * @return	bool
     * @since 2.0.0
     */	
	 
	 	
	public $yjtmpl = false;

    
	/**
     * Current template name
     *
     * @return	assigned template name
     * @since 2.0.0
     */	

	public $currentTemplate = '';
   
   
    /**
     * Old files check
     *
     * @return boool
     * @since 2.0.0
     */
	public $cleanup = false;
	
	
    /**
     * Xml attribute value
     *
     * @return	string
     * @since 2.0.0
     */		
	 
	public $attrbvalue ='';
	
    /**
     * Template xml file
     *
     * @return	array
     * @since 2.0.0
     */	
	 
	public $defaultXMl = null;
	
	
	
    /**
     * Return template legacy version if exists
     *
     * @return	string
     * @since 2.0.0
     */	
	 
	public $yjsglegacy = false;
	



    /**
     * Check if we are using preplugin template
     *
     * @return	bool
     * @since 2.0.0
     */	
	 
	public $preplugin = false;


	


    /**
     * Create microdata tags
     *
     * @return	string
     * @since 2.0.0
     */	
	 
	public $yjsgmicrodata = '';
	
	
	
    /**
     * Construct
     *
     * @since 2.0.0
     */	
	
	public function __construct() {
		
		defined( 'YJDS' ) 		or define( 'YJDS', DIRECTORY_SEPARATOR );
		$this->app   =  JFactory::getApplication();
		$this->user  =  JFactory::getUser();
		
		
	}
	
	

    /**
     * Yjsg Instance
     *
     * @since 2.0.0
     */

		
	public static function getInstance() {
		if (self::$_instance == null) {
			self::$_instance = new Yjsg();
		}
		return self::$_instance;
	}
	
	
		
    /**
     * Return template legacy version
     *
	 * @return string
     * @since 2.0.0
     */

		
	public function yjsglegacy($tname ='') {
		
		if(!empty($tname)){
		
		
			$xml = $this->xmlFile($tname);
		
		}else{
			
			$xml = $this->xmlFile();
		}
		
		if(isset($xml->yjsglegacy)){

			
			$this->yjsglegacy = $xml->yjsglegacy;
		
		}
		
		return $this->yjsglegacy;
		
	}
	
	
    /**
     * Check if template is made before YJSG 2.0.0
     *
     * @return bool
     * @since 2.0.0
     */
	 
	public function preplugin($tname ='') {

		if(!empty($tname)){
	
			if($this->yjsglegacy($tname) == '1.0.16'){
				
				$this->preplugin = true;
				
			}
			
		}else{
			
			if($this->yjsglegacy() == '1.0.16'){
				
				$this->preplugin = true;
				
			}		
			
		}
		
		return $this->preplugin;
		
	}
	
	
    /**
     * Get Joomla body
     *
     * @return body
     * @since 2.0.0
     */
	 
	public static function getBody() {

		if (version_compare(JVERSION, '3.2', '=>')) {
			
			$getbody = JFactory::getApplication()->getBody();
			
		}else{
			
			$getbody = JResponse::getBody();
		}
		
		return $getbody;
		
	}
	
	
    /**
     * Joomla Tooltips
     *
     * @return tooltip
     * @since 2.0.1
     */
	 
	public static function yjsgtooltip() {

		if (version_compare(JVERSION, '3.0', '>')) {
			
			$jtooltip = JHtml::_('bootstrap.tooltip');
			
		}else{
			
			$jtooltip = JHtml::_('behavior.tooltip');
		}
		
		return $jtooltip;
		
	}
	
	
    /**
     * Set Joomla body
     *
     * @since 2.0.0
     */
	 
	public static function setBody( $content ) {

		if (version_compare(JVERSION, '3.2', '=>')) {
			
			JFactory::getApplication()->setBody( $content );
			
		}else{
			
			JResponse::setBody( $content );
		}
		
	}


    /**
     * Get template xml file
     *
	 * @attr  template name
     * @return array
     * @since 2.0.0
     */	

	public function xmlFile($tname ='') {
		
		if(empty($tname)){
			
			if($this->app->isSite()){
			
				$templatename = JFactory::getApplication()->getTemplate();
				
			}else{
				
				$templatename = $this->getDefaultTemplate();
			}
			
		}else{
			
			$templatename = $tname;
		}

		$this->defaultXMl = simplexml_load_file (JPATH_ROOT.YJDS.'templates'.YJDS.$templatename.YJDS.'templateDetails.xml', NULL, LIBXML_NOCDATA|LIBXML_NOBLANKS);		
		
		return $this->defaultXMl;
	}
	

	
	
    /**
     * Get node values from xml file
     * @attr  filed name | specific attribute | template name
     * @return	string
     * @since 2.0.0
     */
	 
	public function xmlAttribute($fieldname,$attribute = "",$tmplname = ""){

		
		$xml = $this->xmlFile($tmplname);
		
		$xmlFieldsets = $xml->config->fields->fieldset;
		
		foreach( $xmlFieldsets as $key => $fieldset) {
		
		  foreach($fieldset->field as $field){

				if(isset($field['name']) && !empty($field['name']) && empty($attribute)){
		
					$fkey = (string)$field['name'];
		
					$fieldDefValue[$fkey] = (string)$field['default'];
		
				}elseif(isset($field['name']) && !empty($field['name']) && !empty($attribute)){
					
					
					$fkey = (string)$field['name'];
		
					$fieldDefValue[$fkey] = (string)$field[$attribute];					
					
				}
				
		  }
		
		}
		
			
		$this->attrbvalue = (string) $fieldDefValue[$fieldname];
		return  $this->attrbvalue;
		
	}

	
    /**
     * Get template version from xml
     *
	 * @attr  template name
     * @return string
     * @since 2.0.0
     */	
	
	public function tmplVersion($tname ='') {


		$xml = $this->xmlFile($tname);
		
		if(isset($xml->description) && strstr($xml->description,'1.0.16')){
			
			$this->tmplVersion = '1.0.16';
				
		}elseif (isset($xml->yjsgversion)){
			
			$this->tmplVersion = (string)$xml->yjsgversion;
			
		}else{
			
			$this->tmplVersion = NULL;
		}

		return $this->tmplVersion;
		
	}	

    /**
     * Check if default template is YJ
     *
     * @return	bool
     * @since 2.0.0
     */

	public function yjtmpl($tmpl=""){
		
		
		if(!empty($tmpl)){
			
			$getTemplate = $tmpl;
			
		}else{
			
			$getTemplate = $this->getDefaultTemplate();
		}
		
		$yjdork = JPATH_ROOT.YJDS.'templates'.YJDS.$getTemplate.YJDS.'custom'.YJDS.'yjsg_template_custom.php';
		
		if(JFile::exists($yjdork)){
		
			$this->yjtmpl = true;
			
		}
		
		return $this->yjtmpl;
		
	}

    /**
     * Get the default frontend template name
     *
     * @return	string	- template name
     * @since 2.0.0
     */
    public static function getDefaultTemplate() {
        
        
        $db    = JFactory::getDbo();
        $query = $db->getQuery( true );
        
        $query->select( 'a.template' );
        $query->from( $db->quoteName( '#__template_styles' ) . ' AS a' );
        $query->where( 'client_id = 0 AND a.home = 1' );
        
        // Make sure there aren't any errors
		try{
			
			$db->setQuery($query);
			$defaulTemplate = $db->loadResult();
			return $defaulTemplate;
			
		}catch (RuntimeException $e){
			echo $e->getMessage();
			exit;
		}
    }
	

    /**
     * Get the current frontend template name
     *
     * @return	string	- template name
     * @since 2.0.0
     */
    public function getCurrentTemplate() {
        
		$jinput   = JFactory::getApplication()->input;
		$current  =  $jinput->getInt('Itemid');
		
        $db    = JFactory::getDbo();
		$query = $db->getQuery( true );
		
		$query
		->select($db->quoteName(array('m.template_style_id', 't.template')))
		->from($db->quoteName('#__menu', 'm'))
		->join('INNER', $db->quoteName('#__template_styles', 't') . ' ON (' . $db->quoteName('m.template_style_id') . ' = ' . $db->quoteName('t.id') . ')')
		->where($db->quoteName('m.id') . ' = '.$current.'');
		
        
        // Make sure there aren't any errors
		try{
			
			$db->setQuery($query);
			$currentTemplate = $db->loadObjectList();
			if($currentTemplate){
				$this->currentTemplate = $currentTemplate[0]->template;
			}
			//
			
		}catch (RuntimeException $e){
			echo $e->getMessage();
			exit;
		}
		
		return $this->currentTemplate;
    }
	
	

    /**
     * Old files check
     *
     * @return boool
     * @since 2.0.0
     */
	
	public function cleanup() {

	
		if ( $this->yjsglegacy() == '1.0.16' && JFile::exists(JPATH_ROOT.YJDS.'templates'.YJDS.$this->getDefaultTemplate().YJDS.'yjsgcore'.YJDS.'yjsg_core.php') ) {
			
			$this->cleanup = true;
			
		}
		return $this->cleanup;
		
	}
	
    /**
     * Update check
     *
     * @return string
     * @since 2.0.1
     */
	public function hasUpdate() {


	if (version_compare($this->version, $this->getUpdateVersion(),'<')) {

			
			$this->hasupdate = 1;
			
		}
		
		return $this->hasupdate;
		
	}	

    /**
     * Get the update version
     *
     * @return	string	- new version
     * @since 2.0.1
     */
    public static function getUpdateVersion() {
        
        
        $db    = JFactory::getDbo();
        $query = $db->getQuery( true );
        
        $query->select( 'version' );
        $query->from( $db->quoteName( '#__updates' ) );
        $query->where( 'element="yjsg"' );
       
        // Make sure there aren't any errors
		try{
			
			$db->setQuery($query);
			$newVersion = $db->loadResult();
			return $newVersion;
			
		}catch (RuntimeException $e){
			echo $e->getMessage();
			exit;
		}
    }
	
	
    /**
     * Get the template params from DB
	 *
	 * Since it varies from template to template
	 * we will use the edit id to get each DB params
     *
     * @return	array	- params
     * @since 2.0.0
     */
    public static function getDbParams( $templateId ) {
        
        
        $db    = JFactory::getDbo();
        $query = $db->getQuery( true );
        
        $query->select( 'params' );
        $query->from( $db->quoteName( '#__template_styles' ) );
        $query->where( 'id=' . $templateId . '' );
        
        // Make sure there aren't any errors
		try{
			
			$db->setQuery($query);
			$dbParams = $db->loadResult();
			return $dbParams;
			
		}catch (RuntimeException $e){
			echo $e->getMessage();
			exit;
		}
    }
	
	
    /**
     * Get template parameter
     *
     * @return	mixed.
     */
   public static function tplParam($param) {
        
        $template = JFactory::getApplication()->getTemplate(true);
        $params   = $template->params;
		
        return $params->get($param);
    }	
	
    /**
     * File path
     *
     * @return string
     * @since 2.0.0
     */
	public function filePath($file) {



		
		if ( is_file(YJSGTEMPLATEPATH.$file) ) {
			
			$this->filepath = YJSGSITE_BASEPATH.$file;
			
		}else{
			
			$this->filepath = YJSG_ASSETS.$file;
			
		}
		
		return $this->filepath;
		
	}
	
	
	
    /**
     * File path legacy
     *
     * @return string
     * @since 2.0.0
     */
	public function filepathLegacy($file) {



		
		if ( is_file(YJSGTEMPLATEPATH.$file) ) {
			
			$this->filepath = YJSGSITE_BASEPATH.$file;
			
		}else{
			
			$this->filepath = YJSG_BASEPATH.'legacy/'.$file;
			
		}
		
		return $this->filepath;
		
	}
	
    /**
     * Create microdata tags
     *
     * @return	string
     * @since 2.0.0
     */	
	 	
	
	public function mdata($mdata,$hits='') {
		
		
		//print_r($mdata);

		$enabled 				= $mdata->get('yjsg_microdata_enabeled');
		$enabledcat				= $mdata->get('yjsg_microdata_cat_enabeled');
		$dataType 				= $mdata->get('yjsg_article_microdata');
		
		
		// defaults
		$itemscope 				='';
		$itemtext  				='';
			
		// articles
		$itemtitle 				= ' itemprop="name"';
		$itemurl				= ' itemprop="url"';
		$itemgenre			   	='';
		$itemlang			   	='';
		$createdate			   	='';
		$modifydate			   	='';
		$published			   	='';
		$author			   	   	='';
		$authorname		   	   	='';
		$interaction		   	='';
		
		
		// events
		$eventstart 			='';
		$eventend  				='';
		$eventstreetadress  	='';
		$eventadresslocality 	='';
		$eventadressregion		='';
		$eventpostalcode		='';
		$eventprice				='';
		$eventtickets			='';
		$eventoffers			='';
		$eventprint				='';
		
		
		
		// recipe
		$preptime				='';
		$cooktime				='';
		$totaltime				='';
		$ingredients			='';
		$recipeprint			='';

		// movie			
		$directors				='';
		$writters				='';
		$moviestars				='';
		$movieprint				='';
		
		// video			
		$videolink				='';
		$videothumb				='';
		$videoduration			='';	
		$videoprint				='';
		
		// product			
		$productprice			='';
		$availability			='';
		$productprint			='';

		// book			
		$bookprice				='';
		$bookavailability		='';
		$bookoffers				='';
		$bookpages				='';
		$bookauthor				='';
		$bookpublisher			='';		
		$booklanguage			='';
		$bookprint				='';
			
		// featured and blog
		$category				='';		
				
				
		// all together
		$microdata				='';
		
		
		switch ($dataType) {
			case "Article":
			case "BlogPosting":
			case "NewsArticle":
			case "MedicalScholarlyArticle":
			case "TechArticle":
				$itemscope 		.= ' itemscope itemtype="http://schema.org/'.$dataType.'"';
				$itemtext 		.= ' itemprop="articleBody"';
				$itemgenre 		.= ' itemprop="genre"';
				$itemlang  		.= '<meta itemprop="inLanguage" content="'.JFactory::getConfig()->get('language').'" />';
				$createdate 	.=' itemprop="dateCreated"';
				$modifydate 	.=' itemprop="dateModified"';
				$published 		.=' itemprop="datePublished"';
				$author 		.=' itemprop="author" itemscope itemtype="http://schema.org/Person"';
				$authorname		.=' itemprop="name"';
				$interaction	.='<meta itemprop="interactionCount" content="UserPageVisits:'.$hits.'" />';	
				break;
				
			case "Event":
				$itemscope 				.= ' itemscope itemtype="http://schema.org/'.$dataType.'"';
				$itemtext  				.= ' itemprop="description"';
				if($mdata->get('yjsg_md_event_start')){
					$eventstart				.='<span class="yjsg-md-event-start"><i class="fa fa-bullhorn"></i> '.JText::_('YJSG_MD_EVENT_START').' ';
					$eventstart				.=JHtml::_('date', $mdata->get('yjsg_md_event_start'), 'DATE_FORMAT_LC2');
					$eventstart				.='</span>';
					$eventstart 			.= '<meta itemprop="startDate" content="'.JHtml::_('date', $mdata->get('yjsg_md_event_start'), 'c').'">';
				}
				if($mdata->get('yjsg_md_event_end')){
					$eventend				.='<span class="yjsg-md-event-end"><i class="fa fa-gavel"></i> '.JText::_('YJSG_MD_EVENT_END').' ';
					$eventend				.=JHtml::_('date', $mdata->get('yjsg_md_event_end'), 'DATE_FORMAT_LC2');
					$eventend				.='</span>';
					$eventend 	 			.= '<meta itemprop="endDate" content="'.JHtml::_('date', $mdata->get('yjsg_md_event_end'), 'c').'">';
				}
				if($mdata->get('yjsg_md_event_streetadress')){
					$eventstreetadress  	.= '<span itemprop="streetAddress">'.$mdata->get('yjsg_md_event_streetadress').'</span>';
				}
				if($mdata->get('yjsg_md_event_adresslocality')){
					$eventadresslocality 	.= '<span itemprop="addressLocality">'.$mdata->get('yjsg_md_event_adresslocality').'</span>';
				}
				if($mdata->get('yjsg_md_event_adressregion')){
					$eventadressregion		.= '<span itemprop="addressRegion">'.$mdata->get('yjsg_md_event_adressregion').'</span>';
				}
				if($mdata->get('yjsg_md_event_postalcode')){
					$eventpostalcode		.= '<span itemprop="postalCode">'.$mdata->get('yjsg_md_event_postalcode').'</span>';
				}
				if($mdata->get('yjsg_md_event_price')){
					$eventprice				.='<span class="yjsg-md-event-price" itemprop="price"><i class="fa fa-money"></i> ';
					$eventprice				.= ''.JText::_('YJSG_MD_PRICE').' '.$mdata->get('yjsg_md_event_price').'</span>';
				}
				if($mdata->get('yjsg_md_event_tickets')){
					$eventtickets			.='<span class="yjsg-md-tickects">';
					$eventtickets			.='<i class="fa fa-ticket"></i> ';
					$eventtickets			.= '<a itemprop="url" href="'.$mdata->get('yjsg_md_event_tickets').'" target="_blank">'.JText::_('YJSG_MD_TICKETS').'</a>';
					$eventtickets			.='</span> ';
				}
				if ($mdata->get('yjsg_md_event_price') || $mdata->get('yjsg_md_event_tickets')) {
					$eventoffers			.='<div class="yjsg-md-offers" itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
					$eventoffers			.= $eventprice;
					$eventoffers			.= $eventtickets;
					$eventoffers			.='</div>';
				}
				
					$eventprint ='<div class="yjsg-md-event">';
					$eventprint .=$eventstart;
					$eventprint .=$eventend;
					$eventprint .=$videoduration;
					$eventprint .='<div class="yjsg-md-event-venue" itemprop="location" itemscope itemtype="http://schema.org/Place">';
					$eventprint .='<div class="yjsg-md-event-address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';
					$eventprint .='<span class="yjsg-md-sep"><i class="fa fa-map-marker"></i> '.JText::_('YJSG_MD_LOCATION').'</span>';
					$eventprint .=$eventstreetadress;
					$eventprint .=$eventadresslocality;
					$eventprint .=$eventadressregion;
					$eventprint .=$eventpostalcode;
					$eventprint .='</div>';
					$eventprint .='</div>';
					$eventprint .=$eventoffers;
					$eventprint .='</div>';
				
				break;
				
				
			case "Recipe":
				$recipetimes = array(
					'H' => ' hour ',
					'M' => ' minutes'
				);
				$md_pt 					= $mdata->get('yjsg_md_recipe_preptime');
				$md_ct 					= $mdata->get('yjsg_md_recipe_cooktime');
				$md_tt 					= $mdata->get('yjsg_md_recipe_totaltime');
				$pt 					= strtr($md_pt,$recipetimes);
				$ct 					= strtr($md_ct,$recipetimes);
				$tt 					= strtr($md_tt,$recipetimes);
				$itemscope 				.= ' itemscope itemtype="http://schema.org/'.$dataType.'"';
				$itemtext  				.= ' itemprop="recipeInstructions"';
				$createdate 			.= ' itemprop="dateCreated"';
				$modifydate 			.= ' itemprop="dateModified"';
				$published 				.= ' itemprop="datePublished"';
				$author 				.= ' itemprop="author" itemscope itemtype="http://schema.org/Person"';
				$authorname				.= ' itemprop="name"';
				$interaction			.= '<meta itemprop="interactionCount" content="UserPageVisits:'.$hits.'" />';
				if($mdata->get('yjsg_md_recipe_preptime')){
					$preptime				.= '<span class="yjsg-md-preptime"><i class="fa fa-clock-o"></i> ';
					$preptime				.= JText::_('YJSG_MD_PREPTIME').' '.$pt.'<meta itemprop="prepTime" content="PT'.$md_pt.'">';
					$preptime				.='</span>';
				}
				if($mdata->get('yjsg_md_recipe_cooktime')){
					$cooktime				.= '<span class="yjsg-md-cooktime"><i class="fa fa-clock-o"></i> ';
					$cooktime				.=JText::_('YJSG_MD_COOKTIME').' '.$ct.'<meta itemprop="cookTime" content="PT'.$md_ct.'">';
					$cooktime				.='</span>';
				}
				if($mdata->get('yjsg_md_recipe_totaltime')){
					$totaltime				.= '<span class="yjsg-md-totaltime"><i class="fa fa-clock-o"></i> ';
					$totaltime				.= JText::_('YJSG_MD_TOTALTIME').' '.$tt.'<meta itemprop="totalTime" content="PT'.$md_tt.'">';
					$totaltime				.='</span>';
				}
				if($mdata->get('yjsg_md_recipe_ingredients')){
					
					$ingredientsArray 		= explode(PHP_EOL, $mdata->get('yjsg_md_recipe_ingredients'));
					
					foreach($ingredientsArray as $ingeredient){
						
								$ingr []= '<span class="yjsg-md-ingredients" itemprop="ingredients">'.$ingeredient.'</span>';
						
					}
					$ingredients = '<span class="yjsg-md-sep"><i class="fa fa-thumb-tack"></i> '.JText::_('YJSG_MD_INGREDIENTS').'</span>'.implode($ingr);
				}

				$recipeprint .='<div class="yjsg-md-recipe">';
				$recipeprint .=$preptime;
				$recipeprint .=$cooktime;
				$recipeprint .=$totaltime;
				$recipeprint .=$ingredients;
				$recipeprint .='</div>';

				break;


			case "Movie":
				$itemscope 		.= ' itemscope itemtype="http://schema.org/'.$dataType.'"';
				$itemtext 		.= ' itemprop="description"';
				$itemgenre 		.= ' itemprop="genre"';
				$createdate 	.= ' itemprop="dateCreated"';
				$modifydate 	.= ' itemprop="dateModified"';
				$published 		.= ' itemprop="datePublished"';
				$interaction	.= '<meta itemprop="interactionCount" content="UserPageVisits:'.$hits.'" />';
				$author 		.=' itemprop="author" itemscope itemtype="http://schema.org/Person"';
				$authorname		.=' itemprop="name"';				
				
				if($mdata->get('yjsg_md_movie_directors')){
					
					$directorsArray 		= explode(PHP_EOL, $mdata->get('yjsg_md_movie_directors'));
					
					foreach($directorsArray as $director){
						
								$dire []= '<div class="yjsg-md-director" itemprop="director" itemscope itemtype="http://schema.org/Person">';
								$dire []= '<span class="yjsg-md-director-name" itemprop="name">'.$director.'</span>';
								$dire []= '</div>';
					}
					$directors = '<span class="yjsg-md-sep"><i class="fa fa-film"></i> '.JText::_('YJSG_MD_DIRECTORS').'</span>'.implode($dire);
				}
				
				if($mdata->get('yjsg_md_movie_writters')){
					
					$writtersArray 		= explode(PHP_EOL, $mdata->get('yjsg_md_movie_writters'));
					
					foreach($writtersArray as $writter){
						
								$writ []= '<div class="yjsg-md-writter" itemprop="creator" itemscope itemtype="http://schema.org/Person">';
								$writ []= '<span class="yjsg-md-writter-name" itemprop="name">'.$writter.'</span>';
								$writ []= '</div>';
						
					}
					$writters = '<span class="yjsg-md-sep"><i class="fa fa-book"></i> '.JText::_('YJSG_MD_WRITTERS').'</span>'.implode($writ);
				}
				
				
				if($mdata->get('yjsg_md_movie_stars')){
					
					$moviestarsArray 		= explode(PHP_EOL, $mdata->get('yjsg_md_movie_stars'));
					
					foreach($moviestarsArray as $moviestar){
						
								$movs []= '<div class="yjsg-md-moviestar" itemprop="actor" itemscope itemtype="http://schema.org/Person">';
								$movs []= '<span class="yjsg-md-moviestar-name" itemprop="name">'.$moviestar.'</span>';
								$movs []= '</div>';
						
					}
					$moviestars = '<span class="yjsg-md-sep"><i class="fa fa-star"></i> '.JText::_('YJSG_MD_MOVIESTARS').'</span>'.implode($movs);
				}
				
				$movieprint .='<div class="yjsg-md-movie">';
				$movieprint .=$directors;
				$movieprint .=$writters;
				$movieprint .=$moviestars;
				$movieprint .='</div>';
					
				break;
				
				
				
			case "VideoObject":


				$itemscope 		 .= ' itemscope itemtype="http://schema.org/'.$dataType.'"';
				$itemtext 		 .= ' itemprop="description"';
				$itemgenre 		 .= ' itemprop="genre"';
				$itemlang  		 .= '<meta itemprop="inLanguage" content="'.JFactory::getConfig()->get('language').'" />';
				$createdate 	 .= ' itemprop="dateCreated"';
				$modifydate 	 .= ' itemprop="dateModified"';
				$published 		 .= ' itemprop="datePublished"';
				$author 		 .= ' itemprop="author" itemscope itemtype="http://schema.org/Person"';
				$authorname		 .= ' itemprop="name"';
				$interaction	 .= '<meta itemprop="interactionCount" content="UserPageVisits:'.$hits.'" />';
					
				if($mdata->get('yjsg_md_video_link') && $mdata->get('yjsg_md_video_thumb') && $mdata->get('yjsg_md_video_duration')){
					
					$videolink		.= '<span class="yjsg-md-video-link">';
					$videolink		.= '<a itemprop="url" href="'.$mdata->get('yjsg_md_video_link').'" target="_blank">';
					$videolink		.= '<img src="'.$mdata->get('yjsg_md_video_thumb').'" alt="video_thumbnail" />';
					$videolink		.= '</a>';
					$videolink		.= '</span>';
					$videothumb		.= '<meta itemprop="thumbnail" content="'.$mdata->get('yjsg_md_video_thumb').'" />';
					$videoduration	.= '<meta itemprop="duration" content="'.$mdata->get('yjsg_md_video_duration').'" />';
					
					$videoprint 	.='<div class="yjsg-md-video">';
					$videoprint 	.=$videolink;
					$videoprint 	.=$videothumb;
					$videoprint 	.=$videoduration;
					$videoprint 	.='</div>';
				}
				

				
				break;

			case "Product":
			if($mdata->get('yjsg_md_product_price')){
					$textstring		= strtoupper($mdata->get('yjsg_md_product_availability'));
					$itemscope 		.= ' itemscope itemtype="http://schema.org/'.$dataType.'"';
					$itemtext 		.= ' itemprop="description"';
					
					
					$productprice	.='<span class="yjsg-md-product-price" itemprop="price"><i class="fa fa-money"></i> ';
					$productprice	.= ''.JText::_('YJSG_MD_PRICE').' '.$mdata->get('yjsg_md_product_price').'</span>';
					
					if($mdata->get('yjsg_md_product_availability') !=='na'){
						$availability		.= '<span itemprop="availability" itemscope itemtype="http://schema.org/'.$mdata->get('yjsg_md_product_availability').'">';
						$availability		.= '<i class="fa fa-info-circle"></i> ';
						$availability		.= JText::_('YJSG_MD_'.$textstring).'</span>';
					}	
					
					
					$productprint 	.='<div class="yjsg-md-product">';
					$productprint 	.='<div class="yjsg-md-offers" itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
					$productprint 	.=$productprice;
					$productprint 	.=$availability;
					$productprint 	.='</div>';
					$productprint 	.='</div>';
			}	
	
				break;		
				
				
			case "Book":
			if($mdata->get('yjsg_md_book_price')){
				
				$textstring		= strtoupper($mdata->get('yjsg_md_book_availability'));
				$itemscope 		.= ' itemscope itemtype="http://schema.org/'.$dataType.'"';
				$itemtext 		.= ' itemprop="description"';
				
				
				$bookprice		.='<span class="yjsg-md-book-price"><i class="fa fa-money"></i> ';
				$bookprice		.= ''.JText::_('YJSG_MD_PRICE').' <span itemprop="price">'.$mdata->get('yjsg_md_book_price').'</span></span>';
				
				if($mdata->get('yjsg_md_book_availability') !=='na'){
					$bookavailability		.= '<span itemprop="availability" itemscope itemtype="http://schema.org/'.$mdata->get('yjsg_md_book_availability').'">';
					$bookavailability		.= '<i class="fa fa-info-circle"></i> ';
					$bookavailability		.= JText::_('YJSG_MD_'.$textstring).'</span>';
				}	
				
				
				$bookoffers				.='<div class="yjsg-md-offers" itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
				$bookoffers				.=$bookprice;
				$bookoffers				.=$bookavailability;
				$bookoffers				.='</div>';
				
				$bookpages				.='<span class="yjsg-md-book-pages">';
				$bookpages				.='<i class="fa fa-files-o"></i> '.JText::_('YJSG_MD_PAGES').' ';
				$bookpages				.='<span itemprop="numberOfPages">';
				$bookpages				.=$mdata->get('yjsg_md_book_pages');
				$bookpages				.='</span>';
				$bookpages				.='</span>';
				
				$bookauthor				.='<span class="yjsg-md-book-author">';
				$bookauthor				.='<i class="fa fa-book"></i> '.JText::_('YJSG_MD_AUTHOR').' ';
				$bookauthor				.='<span itemprop="author">';
				$bookauthor				.=$mdata->get('yjsg_md_book_author');
				$bookauthor				.='</span>';
				$bookauthor				.='</span>';
				
				$bookpublisher			.='<span class="yjsg-md-book-publisher">';
				$bookpublisher			.='<i class="fa fa-print"></i> '.JText::_('YJSG_MD_PUBLISHER').' ';
				$bookpublisher			.='<span itemprop="publisher">';
				$bookpublisher			.=$mdata->get('yjsg_md_book_publisher');
				$bookpublisher			.='</span>';
				$bookpublisher			.='</span>';
				
				$booklanguage			.='<span class="yjsg-md-book-language">';
				$booklanguage			.='<i class="fa fa-comment"></i> '.JText::_('YJSG_MD_LANGUAGE').' ';
				$booklanguage			.='<span itemprop="inLanguage">';
				$booklanguage			.=$mdata->get('yjsg_md_book_language');
				$booklanguage			.='</span>';
				$booklanguage			.='</span>';
				
				
	
				$bookprint .='<div class="yjsg-md-book">';
				$bookprint .=$bookoffers;
				$bookprint .=$bookauthor;
				$bookprint .=$bookpublisher;
				$bookprint .=$bookpages;
				$bookprint .=$booklanguage;
				$bookprint .='</div>';
			}
	
				break;	
				
										
				
			   default;
					$itemscope ='';
					$itemtext  ='';
				break;
		}
		
		// featured and blog
		if($enabledcat	== 1){
			$category = ' itemscope itemtype="http://schema.org/CreativeWork"';
		}		
		// articles
		$this->yjsgmicrodata ['itemscope'] 			= $itemscope;
		$this->yjsgmicrodata ['itemtitle'] 			= $itemtitle;
		$this->yjsgmicrodata ['itemurl'] 			= $itemurl;
		$this->yjsgmicrodata ['itemtext'] 			= $itemtext;
		$this->yjsgmicrodata ['itemgenre'] 			= $itemgenre;
		$this->yjsgmicrodata ['itemlang'] 			= $itemlang;
		$this->yjsgmicrodata ['createdate'] 		= $createdate;
		$this->yjsgmicrodata ['modifydate'] 		= $modifydate;
		$this->yjsgmicrodata ['published'] 			= $published;
		$this->yjsgmicrodata ['author'] 			= $author;
		$this->yjsgmicrodata ['authorname'] 		= $authorname;
		$this->yjsgmicrodata ['interaction'] 		= $interaction;
		
		// event
		$this->yjsgmicrodata ['eventstart'] 		= $eventstart;
		$this->yjsgmicrodata ['eventend'] 			= $eventend;
		$this->yjsgmicrodata ['eventadress']		= $eventstreetadress;
		$this->yjsgmicrodata ['eventlocality']		= $eventadresslocality;
		$this->yjsgmicrodata ['eventregion']		= $eventadressregion;
		$this->yjsgmicrodata ['eventpostal']		= $eventpostalcode;
		$this->yjsgmicrodata ['eventprice']			= $eventprice;
		$this->yjsgmicrodata ['eventtickets']		= $eventtickets;
		$this->yjsgmicrodata ['eventoffers']		= $eventoffers;
		$this->yjsgmicrodata ['eventprint']			= $eventprint;
		
		// recipe
		$this->yjsgmicrodata ['preptime'] 			= $preptime;
		$this->yjsgmicrodata ['cooktime'] 			= $cooktime;
		$this->yjsgmicrodata ['totaltime'] 			= $totaltime;
		$this->yjsgmicrodata ['ingredients'] 		= $ingredients;
		$this->yjsgmicrodata ['recipeprint'] 		= $recipeprint;
		
		// movie
		$this->yjsgmicrodata ['directors'] 			= $directors;
		$this->yjsgmicrodata ['writters'] 			= $writters;
		$this->yjsgmicrodata ['moviestars'] 		= $moviestars;
		$this->yjsgmicrodata ['movieprint'] 		= $movieprint;
		
		// video
		$this->yjsgmicrodata ['videolink'] 			= $videolink;
		$this->yjsgmicrodata ['videothumb'] 		= $videothumb;
		$this->yjsgmicrodata ['videoduration'] 		= $videoduration;
		$this->yjsgmicrodata ['videoprint'] 		= $videoprint;
		
		// product
		$this->yjsgmicrodata ['productprice'] 		= $productprice;
		$this->yjsgmicrodata ['availability'] 		= $availability;
		$this->yjsgmicrodata ['productprint'] 		= $productprint;
		
		// book
		$this->yjsgmicrodata ['bookprice']			= $bookprice;
		$this->yjsgmicrodata ['bookavailability']	= $bookavailability;
		$this->yjsgmicrodata ['bookoffers']			= $bookoffers;
		$this->yjsgmicrodata ['bookpages']			= $bookpages;
		$this->yjsgmicrodata ['bookauthor']			= $bookauthor;
		$this->yjsgmicrodata ['bookpublisher']		= $bookpublisher;		
		$this->yjsgmicrodata ['booklanguage']		= $booklanguage;
		$this->yjsgmicrodata ['bookprint']			= $bookprint;
		
		// featured and blog
		$this->yjsgmicrodata ['category']			= $category;
		
		// all together
		$this->yjsgmicrodata ['microdata']			= $videoprint.$eventprint.$productprint.$recipeprint.$movieprint.$bookprint;
		
		
		if($enabled == 1 || $enabledcat	== 1){
			
			return (object) $this->yjsgmicrodata;
			
		}else{
			
			return (object) array_fill_keys(array_keys($this->yjsgmicrodata), null);
			
			
		}
		
		
		
		
	}
	
	
    /**
     * Clean pageclass_sfx
     *
     * @return void
     * @since 2.1.1
     */
	 
	public function yjsgCleanPageSfx() {
		
		
			
		$menu 					= $this->app->getMenu();
		
		if(isset($menu->getActive()->params)){
			$activeparams		= $menu->getActive()->params;
			$pageclass_sfx		= $activeparams->get('pageclass_sfx');
			
			if(!empty($pageclass_sfx)){
				$activeparams->set('pageclass_sfx',' ' .trim($pageclass_sfx));
			}
			
		}
		
	}	
}



class JDocumentRendererHtmlclass extends JDocumentRenderer{
    /**
     * Renders the html class name depending on the page
     *
     * @param   string  $name     Not used.
     * @param   array   $params   Not used.
     * @param   string  $content  Not used.
     *
     * @return  string  
     *
     * @since   11.1
     */
    public function render( $name, $params = array(), $content = null )
    {

    	$app 				= JFactory::getApplication();
		$menu 				= $app->getMenu();
		$tparams			= $app->getTemplate(true)->params;
		$html_class			= array();
		$top_menu_location	= $tparams->get('top_menu_location',0);
		$pageclass_sfx		= '';
		
		if(isset($menu->getActive()->params)){
			$pageclass_sfx		= $menu->getActive()->params->get('pageclass_sfx');
		}
		
		
		if($app->isSite()){
			
			//  bootstrap version
			if($tparams->get('bootstrap_version','bootstrapoff')){
				
				$html_class[]		= $tparams->get('bootstrap_version','bootstrapoff');
				
			}
			// active itemid, if homepage, class is homepage	
			if ($menu->getActive() == $menu->getDefault()) {
				
				$html_class[] ='homepage';
				
			}else{
				
				$html_class[] 		= 'itemid-'.$app->input->get( 'Itemid','','INT' );
				
			}
			
			// component
			if($app->input->get( 'option' )){
				
				$html_class[] 		= $app->input->get( 'option' );
				
			}
			
			// component view
			if($app->input->get( 'view' )){
				
				$html_class[]		= 'view-'.$app->input->get( 'view' );
				
			}
			
			//  menu position
			if($top_menu_location == 0){
				
				$html_class[]		= 'top_menu_flexible';
				
			}else{
				
				$html_class[]		= 'top_menu_inheader';
				
			}
			
			// rtl 
			
			global $text_direction;
			
			if($text_direction == 1){
				
				$html_class[]		='yjsgrtl';
			}
			
			
			// pageclass_sfx 
			
			if(!empty($pageclass_sfx)){
				
				$html_class[]		=trim($pageclass_sfx);
			}
		}
		
		// explode them all
        return implode(' ',$html_class);
		
    }
}