<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_finder
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;
?>

<script type="text/javascript">
	window.addEvent('domready', function() {
<?php if ($this->params->get('show_advanced', 1)): ?>
		/*
		 * This segment of code adds the slide effect to the advanced search box.
		 */
		if (document.id('advanced-search') != null) {
			var searchSlider = new Fx.Slide('advanced-search');

			<?php if (!$this->params->get('expand_advanced', 0)): ?>
			searchSlider.hide();
			<?php endif; ?>

			document.id('advanced-search-toggle').addEvent('click', function(e) {
				e = new Event(e);
				e.stop();
				searchSlider.toggle();
			});
		}

		/*
		 * This segment of code disables select boxes that have no value when the
		 * form is submitted so that the URL doesn't get blown up with null values.
		 */
		if (document.id('finder-search') != null) {
			document.id('finder-search').addEvent('submit', function(e){
				e = new Event(e);
				e.stop();

				if (document.id('advanced-search') != null) {
					// Disable select boxes with no value selected.
					document.id('advanced-search').getElements('select').each(function(s){
						if (!s.getProperty('value')) {
							s.setProperty('disabled', 'disabled');
						}
					});
				}

				document.id('finder-search').submit();
			});
		}
<?php endif; ?>
		/*
		 * This segment of code sets up the autocompleter.
		 */
<?php if ($this->params->get('show_autosuggest', 1)): ?>
	<?php JHtml::script('com_finder/autocompleter.js', false, true); ?>
	var url = '<?php echo JRoute::_('index.php?option=com_finder&task=suggestions.display&format=json&tmpl=component', false); ?>';
	var completer = new Autocompleter.Request.JSON(document.id('q'), url, {'postVar': 'q'});
<?php endif; ?>
	});
</script>

<form id="finder-search" action="<?php echo JRoute::_($this->query->toURI()); ?>" method="get" class="yjsg-form-inline">
	<?php echo $this->getFields(); ?>

	<?php
	/*
	 * DISABLED UNTIL WEIRD VALUES CAN BE TRACKED DOWN.
	 */
	if (false && $this->state->get('list.ordering') !== 'relevance_dsc'): ?>
		<input type="hidden" name="o" value="<?php echo $this->escape($this->state->get('list.ordering')); ?>" />
	<?php endif; ?>

	<fieldset class="word form-fieldset">
		<div class="yjsg-form-group-inline">
		<label for="q">
			<?php echo JText::_('COM_FINDER_SEARCH_TERMS'); ?>
		</label>
		<div class="yjsg-element-holder">
			<input type="text" name="q" id="q" size="30" value="<?php echo $this->escape($this->query->input); ?>" class="yjsg-form-element" />
		</div>
		<?php if ($this->escape($this->query->input) != '' || $this->params->get('allow_empty_search')):?>
			<div class="yjsg-element-holder">
				<button name="Search" type="submit" class="button"><span class="icon-search icon-white"></span> <?php echo JText::_('JSEARCH_FILTER_SUBMIT');?></button>
			</div>
		<?php else: ?>
			<div class="yjsg-element-holder">
				<button name="Search" type="submit" class="button disabled"><span class="icon-search icon-white"></span> <?php echo JText::_('JSEARCH_FILTER_SUBMIT');?></button>
			</div>
		<?php endif; ?>
		<?php if ($this->params->get('show_advanced', 1)): ?>
			<div class="yjsg-element-holder">
				<a href="#advancedSearch" data-toggle="collapse" class="button"><span class="icon-list"></span> <?php echo JText::_('COM_FINDER_ADVANCED_SEARCH_TOGGLE'); ?></a>
			</div>
		<?php endif; ?>
		</div>
</fieldset>

	<?php if ($this->params->get('show_advanced', 1)): ?>
		<div id="advancedSearch" class="collapse">
			<hr />
			<?php if ($this->params->get('show_advanced_tips', 1)): ?>
				<div class="advanced-search-tip">
					<?php echo JText::_('COM_FINDER_ADVANCED_TIPS'); ?>
				</div>
				<hr />
			<?php endif; ?>
			<div id="finder-filter-window" class="com_finder_filter">
				<?php echo JHtml::_('filter.select', $this->query, $this->params); ?>
			</div>
		</div>
	<?php endif; ?>
</form>
