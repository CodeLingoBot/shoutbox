<?php
/**
* @package    JJ_Shoutbox
* @copyright  Copyright (C) 2011 - 2015 JoomJunk. All rights reserved.
* @license    GPL v3.0 or later http://www.gnu.org/licenses/gpl-3.0.html
*/


defined('JPATH_PLATFORM') or die;

/**
 * Form Field to hide public and private keys fields if maths question is selected
 *
 * @package     JJ_Shoutbox
 * @since       3.0.0
 */
class ShoutboxFormFieldFade extends JFormField
{
	/**
	 * @var string
	 */
	protected $type = 'fade';

	/**
	 * @return string
	 */
	protected function getLabel()
	{
		$doc = JFactory::getDocument();
		$app = JFactory::getApplication();

		// Import jQuery
		if (version_compare(JVERSION, '3.0.0', 'ge'))
		{
			JHtml::_('jquery.framework');
		}
		else
		{
			if (!$app->get('jquery'))
			{
				$app->set('jquery', true);
				$doc->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js');
				JHtml::_('script', 'mod_shoutbox/jquery-conflict.js', false, true);
			}
		}

		if (version_compare(JVERSION, '3.0.0', 'ge'))
		{
			$parent = '.control-group';
		}
		else
		{
			$parent = 'li';
		}
		
		
		$js = '		
			jQuery(document).ready(function($) {

				var securityType  = $("#jform_params_securitytype");
				var public  = $("#jform_params_recaptcha_public-lbl").parents("' . $parent . '");
				var private = $("#jform_params_recaptcha_private-lbl").parents("' . $parent . '");
				
				if( securityType.val() == 0 || securityType.val()  == 2 ) {
					public.hide();
					private.hide();
				}

				securityType.on("change", function() {

					var value = this.value;

					if( value == 0 || value == 2 ) {						
						public.fadeOut();
						private.fadeOut();
					}
					else {						
						public.fadeIn();
						private.fadeIn();						
					}

				});
				
				
				
				var nameRequired  	= $("#jform_params_namerequired");
				var genericName 	= $("#jform_params_genericname-lbl").parents("' . $parent . '");
				
				if( nameRequired.val() == 1 ) {
					genericName.hide();
				}

				nameRequired.on("change", function() {

					var value = this.value;

					if( value == 0 ) {						
						genericName.fadeIn();
					}
					else {						
						genericName.fadeOut();						
					}

				});

			});			
		';

		$doc->addScriptDeclaration($js);

		if (version_compare(JVERSION, '3.0.0', 'ge'))
		{
			return '<hr>';
		}

		return '';
	}

	/**
	 * @return mixed
	 */
	protected function getInput()
	{
        return;
	}

}
