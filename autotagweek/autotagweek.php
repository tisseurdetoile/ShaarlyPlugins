<?php
/**
 * autotagweek Plugin.
 *
 * This plugin add the weeknumber as a tag of a link
 */

/**
 * Initialization function.
 * It will be called when the plugin is loaded.
 * This function can be used to return a list of initialization errors.
 *
 * @param $conf ConfigManager instance.
 *
 * @return array List of errors (optional).
 */
function autotagweek_init($conf)
{
    return null;
}
	
/*
 * DATA SAVING HOOK.
 */

/**
 * Hook savelink.
 *
 * Triggered when a link is save (new or edit).
 * All new links now contain a 'stuff' value.
 *
 * Add the weeknumber in the tags
 * And remove/rewite it when editing 
 *
 * @param array $data contains the new link data.
 *
 * @return array altered $data.
 */
function hook_autotagweek_save_link($data)
{
	$date = new DateTime();
	$week = '['. $date->format("YW") . ']';
	
	if (!empty($data['tags'])) {
		$pattern = '/\[\d{4}(\d|([0-4]\d)|(5[0123]))\]/';

		if (!preg_match($pattern, $data['tags'])) {
		   $data['tags'] .= ' ' . $week;
		}
	} else {
		$data['tags'] = $week;
	}
	
	$data['auto_tags'] = $week;
	
    return $data;
}

