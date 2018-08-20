<?php

require_once('LiveChatHelper.class.php');

class SettingsHelper extends LiveChatHelper
{
	public function render()
	{

	    $license_email = LiveChat::get_instance()->get_login();
		$settings = LiveChat::get_instance()->get_settings();

		$notification = '';

		if (isset($_GET['actionType']) && $_GET['actionType'] === 'install') {
			$notification = '<div class="updated installed">
	<p>
		LiveChat is now installed on your website!
	</p>
	<span id="installed-close">x</span>
</div>';
		}

		echo $notification;
?>
        <div id="wordpress-livechat-container">
        <?php if (LiveChat::get_instance()->is_installed() == false) { ?>
            <div class="wordpress-livechat-column-left">
                <div class="login-box-header">
                    <img src="<?php echo plugins_url('wp-live-chat-software-for-wordpress').'/plugin_files/images/livechat-wordpress@2x.png'; ?>" alt="LiveChat + Wordpress" class="logo">
                </div>
                <div id="useExistingAccount">
                    <p class="login-with-livechat"><br>
                        <iframe id="login-with-livechat" src="https://addons.livechatinc.com/sign-in-with-livechat" > </iframe>
                    </p>
                    <p class="lc-or">or<br>
                        <a href="https://my.livechatinc.com/signup?a=wordpress&utm_source=wordpress.org&utm_medium=integration&utm_campaign=wordpress_plugin" target="_blank" class="livechat-signup a-important">
                            create an account
                        </a>
                    </p>
                    <form id="licenseForm" action="?page=livechat_settings&actionType=install" method="post">actionType=install
                        <input type="hidden" name="licenseEmail" id="licenseEmail">
                        <input type="hidden" name="licenseNumber" id="licenseNumber">
                    </form>
                </div>
            </div>
            <div class="wordpress-livechat-column-right">
                <p><img src="<?php echo plugins_url('wp-live-chat-software-for-wordpress').'/plugin_files/images/livechat-app.png'; ?>" alt="LiveChat apps" class="livechat-app"></p>
                <p class="apps-link">Check out our apps for <a href="https://www.livechatinc.com/applications/?utm_source=wordpress.org&utm_medium=integration&utm_campaign=wordpress_plugin" target="_blank" class="a-important">desktop or mobile!</a></p>
            </div>
            <?php } ?>

            <?php if (LiveChat::get_instance()->is_installed()): ?>
            <div class="wordpress-livechat-column-left">
                <div class="account">
                    Currently you are using your<br>
                    <strong><?php echo $license_email ?></strong><br>
                    LiveChat account.
                </div>
                <p class="webapp">
                    <a href="https://my.livechatinc.com/?utm_source=wordpress.org&utm_medium=integration&utm_campaign=wordpress_plugin" target="_blank">
                        Open web application
                    </a>
                </p>
                <div class="settings">
                    <p class="login-with-livechat"><br>
                        <iframe id="login-with-livechat" src="https://addons.livechatinc.com/sign-in-with-livechat" > </iframe>
                    </p>
                    <div>
                        <div class="title">
                            <span>Hide chat on mobile</span>
                        </div>
                        <div class="onoffswitch">
                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="disableMobile" <?php echo ($settings['disableMobile']) ? 'checked': '' ?>>
                            <label class="onoffswitch-label" for="disableMobile">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <div class="title">
                            <span>Disable chat window sounds</span>
                        </div>
                        <div class="onoffswitch">
                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="disableSounds" <?php echo ($settings['disableSounds']) ? 'checked': '' ?>>
                            <label class="onoffswitch-label" for="disableSounds">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <div class="title">
                            <span>Hide chat for Guest visitors</span>
                        </div>
                        <div class="onoffswitch">
                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="disableGuests" <?php echo ($settings['disableGuests']) ? 'checked': '' ?>>
                            <label class="onoffswitch-label" for="disableGuests">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <p class="disconenct">
                    Something went wrong? <a id="resetAccount" href="?page=livechat_settings&reset=1" style="display: inline-block">
                        Disconect your account.
                    </a>
                </p>
            </div>
            <div class="wordpress-livechat-column-right">
                <p><img src="<?php echo plugins_url('wp-live-chat-software-for-wordpress').'/plugin_files/images/livechat-app.png'; ?>" alt="LiveChat apps" class="livechat-app"></p>
                <p class="apps-link">Check out our apps for <a href="https://www.livechatinc.com/applications/?utm_source=wordpress.org&utm_medium=integration&utm_campaign=wordpress_plugin" target="_blank" class="a-important">desktop or mobile!</a></p>
            </div>
            <?php endif; ?>
        </div>
<?php
	}
}