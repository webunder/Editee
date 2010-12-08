/**
 * Plugin to load ExpressionEngine CP sytles
 */  
var EditArea_ee= {
	/**
	 * Get called once this file is loaded (editArea still not initialized)
	 *
	 * @return nothing	 
	 */	 	 	
	init: function(){	
		editArea.load_css(this.baseURL+"css/style.css");
	}
};

// Adds the plugin class to the list of available EditArea plugins
editArea.add_plugin("ee", EditArea_ee);
