(function($)
{
var LiveChat =
{
	init: function()
	{
		this.signInWithLiveChat();
		this.resetLink();
		this.hideInstalledNotification();
		this.settingsForm();
	},

    bindEvent: function(element, eventName, eventHandler) {
        if (element.addEventListener){
            element.addEventListener(eventName, eventHandler, false);
        } else if (element.attachEvent) {
            element.attachEvent('on' + eventName, eventHandler);
        }
    },

    signInWithLiveChat: function () {
        var logoutButton = document.getElementById('resetAccount'),
            iframeEl = document.getElementById('login-with-livechat');

        LiveChat.bindEvent(window, 'message', function (e) {
            if(e.data.startsWith('{')) {
                var lcDetails = JSON.parse(e.data);
                switch (lcDetails.type) {
                    case 'logged-in':
                        var licenseForm = $('div#wordpress-livechat-container div#useExistingAccount form#licenseForm');
                        licenseForm.find('input#licenseEmail').val(lcDetails.email);
                        licenseForm.find('input#licenseNumber').val(lcDetails.license);
                        licenseForm.submit();
                        break;
                    case 'signed-out':
                        $('#login-with-livechat').css('display', 'block');
                        $('#logout').css('display', 'none');
                        break;
                }
            }
        });

        if(logoutButton) {
            LiveChat.bindEvent(logoutButton, 'click', function (e) {
                sendMessage('logout');
            });
        }

        var sendMessage = function(msg) {
            iframeEl.contentWindow.postMessage(msg, '*');
        };
    },

	resetLink: function()
	{
		$('#reset_settings a').click(function()
		{
			return confirm('This will reset your LiveChat plugin settings. Continue?');
		})
	},

	hideInstalledNotification: function () {
        var notificationElement = $('.updated.installed');
        $('#installed-close').click(function () {
            notificationElement.slideUp();
        });
        setTimeout(function () {
            notificationElement.slideUp();
        }, 3000);
    },

    setSettings: function(settings) {
        $.ajax({
            url: '?page=livechat_settings',
            type: "POST",
            data: settings,
            dataType: 'json',
            cache: false,
            async: false,
            error: function () {
                alert('Something went wrong. Please try again or contact our support team.');
            }
        });
    },
    settingsForm: function() {
        $('.settings .title').click(function() {
            $(this).next('.onoffswitch').children('label').click();
        });
        $('.onoffswitch-checkbox').change(function() {
            var settings = {};
            $('.onoffswitch-checkbox').each(function(){
                var paramName = $(this).attr('id');
                if ($(this).is(':checked')) {
                    settings[paramName] = 1;
                } else {
                    settings[paramName]= 0;
                }
            });

            LiveChat.setSettings(settings);
        });
    }
};

$(document).ready(function()
{
	LiveChat.init();
});
})(jQuery);