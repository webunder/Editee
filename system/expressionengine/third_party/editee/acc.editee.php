<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
* Editee, Code Editor Accessory for ExpressionEngine 2
*
* @package			Editee
* @version			1.0.5
* @author			Cem Meric <http://webunder.com.au> - Managing Director, Webunder
* @copyright		Copyright (c) 2002-2011 Webunder <http://http://webunder.com.au>
* @license			Attribution-ShareAlike 3.0 Unported <http://creativecommons.org/licenses/by-sa/3.0>
* @category			Accessories
* @purpose			Editee is a source code editor for Templates, Template Notes, Snippets, Global Variables, Database Query Form, User Message, Communicate, System Offline and Email Notification Templates textareas using EditArea scriptscript for ExpressionEngine 2
* @link				http://webunder.com.au/weblog/editee-code-editor-for-expressionengine
* @inspiration	Gabriel Schwardy <http://caleydon.com/en/project/cm-template-editor>
*/


class Editee_acc
{
	var $name			= 'Editee';
	var $id				= 'editee';
	var $version		= '1.0.5';
	var $description	= 'Source code editor for Templates, Template Notes, Snippets, Global Variables and Database Query Form textareas using EditArea script';
	var $sections		= array();
	
/**
 * SCRIPT LOCATION
 *---------------------------------------------------------------
 * You'll need to download the EditArea - javascript editor, from <http://sourceforge.net/projects/editarea/> and place the script on server and update below path with your server location
 *
 */
	private $location	= '/library/scripts/edit_area/';


/**
 * SCRIPT INCLUDE TYPE
 *---------------------------------------------------------------
 * In order to make EditArea work on a webpage, you must include one external javascript file and call an init function for each textarea you want to convert with options below
 * 
 * "edit_area_full.js"
 * "edit_area_compressor.php"
 * "edit_area_compressor.php?plugins" (recommended option)
 * "edit_area_full.gz"
 *
 * For more info <http://www.cdolivet.com/editarea/editarea/docs/include.html>
 */
	private $script_type	= 'edit_area_compressor.php?plugins';


/**
 * ACTIVATE SCRIPT
 *---------------------------------------------------------------
 * Define which areas you want to activate the EditArea script for code editing
 *
 * options are 'true' or 'false'
 */
	private $editarea_id_template_data				= 'true';	// Activate EditArea for TEMPLATES Textarea
	
	private $editarea_id_template_notes				= 'true';	// Activate EditArea for TEMPLATE NOTES Textarea

	private $editarea_id_thequery					= 'true';	// Activate EditArea for DATABASE QUERY FORM Textarea

	private $editarea_id_variable_data				= 'true';	// Activate EditArea for GLOBAL VARIABLES Textarea

	private $editarea_id_snippet_contents			= 'true';	// Activate EditArea for SNIPPETS Textarea

	private $editarea_id_user_message				= 'true';	// Activate EditArea for USER MESSAGE Textarea

	private $editarea_id_tools_communicate			= 'true';	// Activate EditArea for COMMUNICATE Textarea

	private $editarea_id_system_offline				= 'true';	// Activate EditArea for SYSTEM OFFLINE Textarea

	private $editarea_id_edit_email_notification	= 'true';	// Activate EditArea for EMAIL NOTIFICATION TEMPLATES Textarea
	

/**
 * CONFIGURATION (OPTINAL SETTINGS)
 *---------------------------------------------------------------
 * For further information on these settings please read the documentation at <http://www.cdolivet.com/editarea/editarea/docs/configuration.html>
 *
 */
	
	// Define the toolbar that will be displayed, each element
	private $toolbar					= 'syntax_selection, |, select_font, |, undo,redo, |, charmap, |, go_to_line, search, highlight, change_smooth_selection, reset_highlight, |, fullscreen, word_wrap';
	
	// Allowed syntax definitions for web
	private $syntax_selection_allow		= 'css,html,js,php,xml,sql';
	
	// Should contain a code of the syntax definition file that must be used for the highlight mode
	private $syntax						= 'html';
	
	// Set if the editor should start with highlighted syntax displayed
	private $start_highlight			= 'true';
	
	// Should contain a code of the language pack to be used for translation
	private $language					= 'en';
	
	// Define one with axis the editor can be resized by the user ("no" (no resize allowed), "both" (x and y axis), "x", "y")
	private $allow_resize				= 'n';
	
	// Loaded plugins. Refer to http://www.cdolivet.com/editarea/editarea/docs/customization_plugin.html for making other plugins
	// To change EditArea style to suit ExpressionEngine Control Panel you'll need to place "ee" under EditArea plugins folder 
	private $plugins					= 'charmap,ee';
	
	// Plugin default view
	private $charmap_default			= 'arrows';
	
	// Options "onload" or "later", specify when the textarea will be converted into an editor. If set to "later", the toogle button will be displayed to allow later conversion
	private $display					= 'later';
	
	// Define the minimum height of the editor 
	private $min_height					= '300';
	
	// Define the font-size used to display the text in the editor
	private $font_size					= '10';
	
	// Define the font-familly used to display the text in the editor or download my favorite code editor font "DejaVu Sans Mono" via http://dejavu-fonts.org/wiki/Download 
	private $font_family				= 'Monaco';

	// Define the number of spaces that will replace tabulations (\t) in text. If tabulation should stay tabulation, set this option to false.
	private $replace_tab_by_spaces		= '3';
	
/**
 * END OF USER CONFIGURABLE SETTINGS
 *---------------------------------------------------------------
 */	
 
 
 
/**
 * SET SECTIONS
 *---------------------------------------------------------------
 * Add JavaScript Header calling the scripts
 *
 */
	function set_sections()
	{
		$EE =& get_instance();
		
		$this->EE =& get_instance();
		
		$this->EE->load->library('javascript');


/**
 * ADD JAVASCRIPT HEADER TO
 *---------------------------------------------------------------
 * Edit Template Textareas
 *
 */
		if ($this->editarea_id_template_data == "true"){
			if ($this->EE->input->get('M') == "edit_template" ||
				$this->EE->input->get('M') == "update_template" ||
				$this->EE->input->get('M') == "create_new_template" ) {
				$EE->cp->add_to_head('			
				<script language="javascript" type="text/javascript" src="'. $this->location . $this->script_type .'"></script>
				<script language="javascript" type="text/javascript">
					editAreaLoader.init({
						id : "template_data",
						toolbar: "'. $this->toolbar .'", 
						syntax: "'. $this->syntax .'", 
						start_highlight: "'. $this->start_highlight .'", 
						language: "'. $this->language .'", 
						allow_resize: "'. $this->allow_resize .'", 
						syntax_selection_allow: "'. $this->syntax_selection_allow .'", 
						plugins: "'. $this->plugins .'", 
						charmap_default: "'. $this->charmap_default .'", 
						display: "'. $this->display .'", 
						min_height: "'. $this->min_height .'", 
						font_family: "'. $this->font_family .'", 
						font_size: "'. $this->font_size .'",
						replace_tab_by_spaces: "'. $this->replace_tab_by_spaces .'"
					});
				</script>');
			}
		}


/**
 * ADD JAVASCRIPT HEADER TO
 *---------------------------------------------------------------
 * Edit Template Notes Textareas
 *
 */ 
		if ($this->editarea_id_template_notes == "true" && $this->editarea_id_template_data == "false"){
			$EE->cp->add_to_head('			
			<script language="javascript" type="text/javascript" src="'. $this->location . $this->script_type .'"></script>');
		}

		if ($this->editarea_id_template_notes == "true"){
			if ($this->EE->input->get('M') == "edit_template" ||
				$this->EE->input->get('M') == "update_template" ||
				$this->EE->input->get('M') == "create_new_template" ) {
				$EE->cp->add_to_head('			
				<script language="javascript" type="text/javascript">
					editAreaLoader.init({
						id : "template_notes",
						toolbar: "'. $this->toolbar .'", 
						syntax: "'. $this->syntax .'", 
						start_highlight: "'. $this->start_highlight .'", 
						language: "'. $this->language .'", 
						allow_resize: "'. $this->allow_resize .'", 
						syntax_selection_allow: "'. $this->syntax_selection_allow .'", 
						plugins: "'. $this->plugins .'", 
						charmap_default: "'. $this->charmap_default .'", 
						display: "'. $this->display .'", 
						min_height: "'. $this->min_height .'", 
						font_family: "'. $this->font_family .'", 
						font_size: "'. $this->font_size .'",
						replace_tab_by_spaces: "'. $this->replace_tab_by_spaces .'"
					});
				</script>');
			}
		}


/**
 * ADD JAVASCRIPT HEADER TO
 *---------------------------------------------------------------
 * Database Query Form Textarea
 *
 */
		if ($this->EE->input->get('M') == "sql_query_form" && $this->editarea_id_thequery == "true") {
			$EE->cp->add_to_head('	
			<script language="javascript" type="text/javascript" src="'. $this->location . $this->script_type .'"></script>
			<script language="javascript" type="text/javascript">
				editAreaLoader.init({
					id: "thequery", 
					toolbar: "'. $this->toolbar .'", 
					syntax: "'. $this->syntax .'", 
					start_highlight: "'. $this->start_highlight .'", 
					language: "'. $this->language .'", 
					allow_resize: "'. $this->allow_resize .'", 
					syntax_selection_allow: "'. $this->syntax_selection_allow .'", 
					plugins: "'. $this->plugins .'", 
					charmap_default: "'. $this->charmap_default .'", 
					display: "'. $this->display .'", 
					min_height: "'. $this->min_height .'", 
					font_size: "'. $this->font_size .'", 
					font_family: "'. $this->font_family .'", 
					replace_tab_by_spaces: "'. $this->replace_tab_by_spaces .'"
				});
			</script>');
		}
/**
 * ADD JAVASCRIPT HEADER TO
 *---------------------------------------------------------------
 * Global Variable Update Textarea
 *
 */
		if (($this->EE->input->get('M') == "global_variables_update" || $this->EE->input->get('M') == "global_variables_create") && $this->editarea_id_variable_data == "true") {
			$EE->cp->add_to_head('	
			<script language="javascript" type="text/javascript" src="'. $this->location . $this->script_type .'"></script>
			<script language="javascript" type="text/javascript">
				editAreaLoader.init({
					id: "variable_data", 
					toolbar: "'. $this->toolbar .'", 
					syntax: "'. $this->syntax .'", 
					start_highlight: "'. $this->start_highlight .'", 
					language: "'. $this->language .'", 
					allow_resize: "'. $this->allow_resize .'", 
					syntax_selection_allow: "'. $this->syntax_selection_allow .'", 
					plugins: "'. $this->plugins .'", 
					charmap_default: "'. $this->charmap_default .'", 
					display: "'. $this->display .'", 
					min_height: "'. $this->min_height .'", 
					font_size: "'. $this->font_size .'", 
					font_family: "'. $this->font_family .'", 
					replace_tab_by_spaces: "'. $this->replace_tab_by_spaces .'"
				});
			</script>');
		}
	

/**
 * ADD JAVASCRIPT HEADER TO
 *---------------------------------------------------------------
 * Edit Snippet Textarea
 *
 */
		if ($this->EE->input->get('M') == "snippets_edit" && $this->editarea_id_snippet_contents == "true") {
			$EE->cp->add_to_head('	
			<script language="javascript" type="text/javascript" src="'. $this->location . $this->script_type .'"></script>
			<script language="javascript" type="text/javascript">
				editAreaLoader.init({
					id: "snippet_contents", 
					toolbar: "'. $this->toolbar .'", 
					syntax: "'. $this->syntax .'", 
					start_highlight: "'. $this->start_highlight .'", 
					language: "'. $this->language .'", 
					allow_resize: "'. $this->allow_resize .'", 
					syntax_selection_allow: "'. $this->syntax_selection_allow .'", 
					plugins: "'. $this->plugins .'", 
					charmap_default: "'. $this->charmap_default .'", 
					display: "'. $this->display .'", 
					min_height: "'. $this->min_height .'", 
					font_size: "'. $this->font_size .'", 
					font_family: "'. $this->font_family .'", 
					replace_tab_by_spaces: "'. $this->replace_tab_by_spaces .'"
				});
			</script>');
		}

		
/**
 * ADD JAVASCRIPT HEADER TO
 *---------------------------------------------------------------
 * User Message Textarea
 *
 */
		if ($this->EE->input->get('M') == "user_message" && $this->editarea_id_user_message == "true") {
			$EE->cp->add_to_head('	
			<script language="javascript" type="text/javascript" src="'. $this->location . $this->script_type .'"></script>
			<script language="javascript" type="text/javascript">
				editAreaLoader.init({
					id: "template_data", 
					toolbar: "'. $this->toolbar .'", 
					syntax: "'. $this->syntax .'", 
					start_highlight: "'. $this->start_highlight .'", 
					language: "'. $this->language .'", 
					allow_resize: "'. $this->allow_resize .'", 
					syntax_selection_allow: "'. $this->syntax_selection_allow .'", 
					plugins: "'. $this->plugins .'", 
					charmap_default: "'. $this->charmap_default .'", 
					display: "'. $this->display .'", 
					min_height: "'. $this->min_height .'", 
					font_size: "'. $this->font_size .'", 
					font_family: "'. $this->font_family .'", 
					replace_tab_by_spaces: "'. $this->replace_tab_by_spaces .'"
				});
			</script>');
		}

		
/**
 * ADD JAVASCRIPT HEADER TO
 *---------------------------------------------------------------
 * Communicate Textarea
 *
 */
		if ($this->EE->input->get('M') == "tools_communicate" && $this->editarea_id_tools_communicate == "true") {
			$EE->cp->add_to_head('	
			<script language="javascript" type="text/javascript" src="'. $this->location . $this->script_type .'"></script>
			<script language="javascript" type="text/javascript">
				editAreaLoader.init({
					id: "message", 
					toolbar: "'. $this->toolbar .'", 
					syntax: "'. $this->syntax .'", 
					start_highlight: "'. $this->start_highlight .'", 
					language: "'. $this->language .'", 
					allow_resize: "'. $this->allow_resize .'", 
					syntax_selection_allow: "'. $this->syntax_selection_allow .'", 
					plugins: "'. $this->plugins .'", 
					charmap_default: "'. $this->charmap_default .'", 
					display: "'. $this->display .'", 
					min_height: "'. $this->min_height .'", 
					font_size: "'. $this->font_size .'", 
					font_family: "'. $this->font_family .'", 
					replace_tab_by_spaces: "'. $this->replace_tab_by_spaces .'"
				});
			</script>');
		}

		
/**
 * ADD JAVASCRIPT HEADER TO
 *---------------------------------------------------------------
 * System Offline Template Textarea
 *
 */
		if ($this->EE->input->get('M') == "system_offline" && $this->editarea_id_system_offline == "true") {
			$EE->cp->add_to_head('	
			<script language="javascript" type="text/javascript" src="'. $this->location . $this->script_type .'"></script>
			<script language="javascript" type="text/javascript">
				editAreaLoader.init({
					id: "template_data", 
					toolbar: "'. $this->toolbar .'", 
					syntax: "'. $this->syntax .'", 
					start_highlight: "'. $this->start_highlight .'", 
					language: "'. $this->language .'", 
					allow_resize: "'. $this->allow_resize .'", 
					syntax_selection_allow: "'. $this->syntax_selection_allow .'", 
					plugins: "'. $this->plugins .'", 
					charmap_default: "'. $this->charmap_default .'", 
					display: "'. $this->display .'", 
					min_height: "'. $this->min_height .'", 
					font_size: "'. $this->font_size .'", 
					font_family: "'. $this->font_family .'", 
					replace_tab_by_spaces: "'. $this->replace_tab_by_spaces .'"
				});
			</script>');
		}

		
/**
 * ADD JAVASCRIPT HEADER TO
 *---------------------------------------------------------------
 * Email Notification Templates Textareas
 *
 */
		if ($this->EE->input->get('M') == "edit_email_notification" && $this->editarea_id_edit_email_notification == "true") {
			$EE->cp->add_to_head('	
			<script language="javascript" type="text/javascript" src="'. $this->location . $this->script_type .'"></script>
			<script language="javascript" type="text/javascript">
				editAreaLoader.init({
					id: "template_data", 
					toolbar: "'. $this->toolbar .'", 
					syntax: "'. $this->syntax .'", 
					start_highlight: "'. $this->start_highlight .'", 
					language: "'. $this->language .'", 
					allow_resize: "'. $this->allow_resize .'", 
					syntax_selection_allow: "'. $this->syntax_selection_allow .'", 
					plugins: "'. $this->plugins .'", 
					charmap_default: "'. $this->charmap_default .'", 
					display: "'. $this->display .'", 
					min_height: "'. $this->min_height .'", 
					font_size: "'. $this->font_size .'", 
					font_family: "'. $this->font_family .'", 
					replace_tab_by_spaces: "'. $this->replace_tab_by_spaces .'"
				});
			</script>');
		}


/**
 * REMOVE ACCESSORY TAB
 *---------------------------------------------------------------
 */
		$str = <<<END
		
		$("#editee.accessory").remove();
		$("#accessoryTabs").find("a.editee").parent("li").remove();
END;
		
		$this->EE->javascript->output($str);

	}
}
/* Location: ./system/expressionengine/third_party/editee/acc.editee.php */ 