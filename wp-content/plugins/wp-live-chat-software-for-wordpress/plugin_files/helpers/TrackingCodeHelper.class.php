<?php

require_once('LiveChatHelper.class.php');

class TrackingCodeHelper extends LiveChatHelper
{
	public function render()
	{
		$tracking = '';

		if (LiveChat::get_instance()->is_installed())
		{
			$license_number = LiveChat::get_instance()->get_license_number();
			$settings = LiveChat::get_instance()->get_settings();
			$check_mobile = LiveChat::get_instance()->check_mobile();
			$check_logged = LiveChat::get_instance()->check_logged();
			$visitor = LiveChat::get_instance()->get_user_data();

			if (!$settings['disableMobile'] || ($settings['disableMobile'] && !$check_mobile)) {
				if (!$settings['disableGuests'] || ($settings['disableGuests'] && $check_logged)) {
					$tracking = <<<TRACKING_CODE_START
<script type="text/javascript">
	window.__lc = window.__lc || {};
	window.__lc.license = {$license_number};

TRACKING_CODE_START;

					$tracking .= <<<VISITOR_DATA
	window.__lc.visitor = {
		name: '{$visitor['name']}',
		email: '{$visitor['email']}'
	};

VISITOR_DATA;

					$tracking .= <<<TRACKING_CODE_LOAD
	(function() {
		var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
		lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
	})();

TRACKING_CODE_LOAD;
					if ($settings['disableSounds']) {
						$tracking .= <<<DISABLE_SOUNDS
	
	var LC_API = LC_API || {};
	
	LC_API.on_after_load = function () {
		LC_API.disable_sounds();
	}

DISABLE_SOUNDS;
					}

					$tracking .= '</script>';
				}
			}
		}

		return $tracking;
	}
}