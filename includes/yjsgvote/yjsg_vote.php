<?php
/*======================================================================*\
|| #################################################################### ||
|| # Package - YJSG Framework                							||
|| # Copyright (C) since 2007  Youjoomla.com. All Rights Reserved.      ||
|| # license - PHP files are licensed under  GNU/GPL V2                 ||
|| # license - CSS  - JS - IMAGE files  are Copyrighted material        ||
|| # bound by Proprietary License of Youjoomla.com                      ||
|| # for more information visit http://www.youjoomla.com/license.html   ||
|| # Redistribution and  modification of this software                  ||
|| # is bounded by its licenses                                         || 
|| # websites - http://www.youjoomla.com | http://www.yjsimplegrid.com  ||
|| #################################################################### || 
\*======================================================================*/
// no direct access 
defined('_JEXEC') or die;

function yjsg_vote( $article, $params ){
	
	$html = '';

	if ($params->get('show_vote'))
	{
		$rating = intval(@$article->rating);
		$rating_count = intval(@$article->rating_count);

		$view = JRequest::getString('view', '');
		$icon = '';
		$rateclass = '';
		$AggregateRating 	='';
		$ratingType 		='';
		$bestRating 		='';
		$ratingCount 		='';
		$richsnippets 		= $article->params->get('yjsg_microdata_enabeled');
		$ratingCountType	= $article->params->get('yjsg_microdata_ratingtype');
		$microdata			= $article->params->get('yjsg_article_microdata');
		
		
		// make sure they dont harm themselves by seting reviewCount on those types
		// only if there are reviews this could be allowed. Need comments in core. 
		switch ($microdata) {
				case "Article":
				case "BlogPosting":
				case "NewsArticle":
				case "MedicalScholarlyArticle":
				case "TechArticle":
				case "VideoObject":
				case "Event":
				if($ratingCountType = 'reviewCount'){
					$ratingCountType ='ratingCount';
				}
				break;
		}		
	
		
		if ( $view == 'article' && $article->state == 1){
			
			$rateclass 			='yjsg-rate ';
			if($richsnippets == 1 && $ratingCountType != 'none'){
				
				$AggregateRating 	=' itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating"';
				$ratingType 		='<span itemprop="ratingValue">'.$rating.'</span> '.JText::_('YJSG_OUT_OF').' ';
				$bestRating 		='<span itemprop="bestRating">5</span> ';
				$ratingCount 		=' itemprop="'.$ratingCountType.'"';	
				
			}
			
			
		}

		for ($i=0; $i < $rating; $i++) {
			$datarating= $i + 1;
			$icon .= '<span class="'.$rateclass.'fa fa-star rated" data-rating="'.$datarating.'"></span> ';
		}
		for ($i=$rating; $i < 5; $i++) {
			$datarating= $i + 1;
			$icon .= '<span class="'.$rateclass.'fa fa-star" data-rating="'.$datarating.'"></span> ';
		}
		
		
		$html .= '<div class="yjsg-rating">';
		$html .= $icon;
		$html .= '<span class="yjsg-rating-count"'.$AggregateRating.'>';
		$html .= $ratingType;
		$html .= $bestRating;
		$html .='( <span class="fa fa-user"></span> ';
		$html .='<span'.$ratingCount.'>';
		$html .=$rating_count;
		$html .='</span>';
		$html .=' )</span>';
		$html .= '</div >';

		if ( $view == 'article' && $article->state == 1){
			
			$uri = JFactory::getURI();
			$uri->setQuery($uri->getQuery().'&hitcount=0');

			$html .= '<form method="post" class="yjsg-rating-form" action="' . htmlspecialchars($uri->toString()) . '">';
			$html .= '<input class="yjsg-user-rating" type="text" name="user_rating" value="" />';
			$html .= '<input type="hidden" name="task" value="article.vote" />';
			$html .= '<input type="hidden" name="hitcount" value="0" />';
			$html .= '<input type="hidden" name="url" value="'.  htmlspecialchars($uri->toString()) .'" />';
			$html .= JHtml::_('form.token');
			$html .= '</form>';
		}
	}

	return $html;
}