jQuery(document).ready(function ($) {
	
    // Smooth Scrolling for ID anchors
    function filterPath(string) {
        return string
            .replace(/^\//, '')
            .replace(/(index|default).[a-zA-Z]{3,4}$/, '')
            .replace(/\/$/, '');
    }

    var locationPath = filterPath(location.pathname);
    var scrollElem = scrollableElement('html', 'body');

    $('a[href*="#"].anchor').each(function () {
        $(this).click(function (event) {
            var thisPath = filterPath(this.pathname) || locationPath;
            if (locationPath == thisPath
                && (location.hostname == this.hostname || !this.hostname)
                && this.hash.replace(/#/, '')) {
                var $target = $(this.hash), target = this.hash;
                if (target && $target.length != 0) {
                    var targetOffset = $target.offset().top;
                    event.preventDefault();
                    $(scrollElem).animate({scrollTop: targetOffset}, 400, function () {
                        location.hash = target;
                        if ($("body").hasClass("mobile-menu-opened")) {
                            $("body").toggleClass("mobile-menu-opened");
                            $('.mobile-menu-toggle').toggleClass('collapsed');
                        }
                    });
                }
            }
        });
    });

    // use the first element that is "scrollable"
    function scrollableElement(els) {
        for (var i = 0, argLength = arguments.length; i < argLength; i++) {
            var el = arguments[i],
                $scrollElement = $(el);
            if ($scrollElement.scrollTop() > 0) {
                return el;
            } else {
                $scrollElement.scrollTop(1);
                var isScrollable = $scrollElement.scrollTop() > 0;
                $scrollElement.scrollTop(0);
                if (isScrollable) {
                    return el;
                }
            }
        }
        return [];
    }

    $('.mobile-menu-toggle, #mobile-navbar-overlay').on('click', function (e) {
        $('.mobile-menu-toggle').toggleClass('collapsed');
        $('body').toggleClass('mobile-menu-opened');
    });

    function floatLabel(inputType){
		$(inputType).each(function(){
			var $input = $(this).children(".form-control"),
                $label = $(this).children(".form-label");
			// on focus add cladd active to label
			$input.focus(function(){
				$label.addClass("label-active");
			});
			//on blur check field and remove class if needed
			$input.blur(function(){
				if($input.val() === ''){
					$label.removeClass("label-active");
				}
			});
		});
	}
	if ($(".float-label").length) {
        floatLabel(".float-label");
	}
    var captchaId;
    var siteKey;

	$("#currentYear").text(new Date().getFullYear());

    // Contact form submit
    $('#contactForm').on('submit', function(e) {
    	e.preventDefault();

        var $form = $(this),
        	$submitButton = $form.find('button'),
        	submitUrl = $form.attr("action"),
        	submitButtonClass = $submitButton.find('i').attr("class"),
			submitButtonClassSpin = "fa fa-circle-notch fa-spin mr-1";

        // submit the form
        $form.ajaxSubmit({
            url: submitUrl,
            type: 'post',
            dataType: 'text',
            beforeSubmit: function() {
                $submitButton.attr('disabled','disabled');
                $submitButton.find('i').removeClass().addClass(submitButtonClassSpin);
            },
			success: function (response, status, xhr, form) {
                window.grecaptcha.reset(captchaId);
                if(response === 'ok') {
                    // mail sent ok - display sent message
                    showInputMessage('Your message was successfully sent.', 'success');
                    // clear the form
                    $form[0].reset();
                }
                else {
                    for(var error in response.messages) {
                        showInputMessage(response.messages[error], 'danger');
                    }
                }
                $submitButton.removeAttr('disabled');
				$submitButton.find('i').removeClass().addClass(submitButtonClass);
            },
			error: function (response) {
                window.grecaptcha.reset(captchaId);
                var message = 'An error occurred while sending your message. Code: ' + response.status;
                showInputMessage(message, 'danger');
                $submitButton.removeAttr('disabled');
				$submitButton.find('i').removeClass().addClass(submitButtonClass);
            }
        });
        return false;
    });

    window.onloadCallback = function onloadCallback() {
        if (window.grecaptcha && $('#captcha').length) {
            siteKey = $('#captcha').attr('data-hidden-key');
            if (captchaId == null) {
                captchaId = window.grecaptcha.render('captcha',
                    {
                        'sitekey': siteKey
                    }
                );
            }
        }
    }

    function reCaptchaOnFocus() {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        var lang = window.lang ? window.lang : 'en';
        script.src = `https://www.google.com/recaptcha/api.js?&onload=onloadCallback&render=explicit&hl=${lang}`;
        script.async = true;
        script.defer = true;

        $('head')[0].appendChild(script);
        $('#contactForm #name').off('focus', reCaptchaOnFocus);
        $('#contactForm #email').off('focus', reCaptchaOnFocus);
        $('#contactForm #message').off('focus', reCaptchaOnFocus);
    }


    $('#contactForm #name').on('focus', reCaptchaOnFocus);
    $('#contactForm #email').on('focus', reCaptchaOnFocus);
    $('#contactForm #message').on('focus', reCaptchaOnFocus);

    function showInputMessage(message, status) {
        $('#messages').empty();
        $('#messages').append('<div class="alert alert-' + status + '" role="alert">' + message + '</div>');
    }

	/* Passing utm parameters from landing to the main site */
	var hostname = location.hostname.split('.').reverse()[1] + "." + location.hostname.split('.').reverse()[0];
	function setCookie(name, val, hostname) {
		var myDate = new Date();
		myDate.setUTCHours(myDate.getUTCHours() + 72);
		document.cookie = name + "=" + val + "; domain=" + hostname + "; path=/; expires=" + myDate + ";";
	}

	if (location.search) {
		setCookie('utm_search', location.search, hostname);
	}

	if (document.referrer) {
		var parser = document.createElement('a');
		parser.href = document.referrer;
		if (!parser.hostname.endsWith(hostname)) {
			setCookie('referrer', document.referrer.substring(0, 512), hostname);
		}
    }

    // number formatting functions

    window.numberWithSeparator = function(value, sep) {
        var stringValue = typeof value === 'string' ? value : value.toString();
        return stringValue.replace(/\B(?=(\d{3})+(?!\d))/g, sep);
    }

    window.formatAmount = function(value, sep, len) {
        len = len || 3;
        return '$' + numberWithSeparator(value.toFixed(len), sep);
    }
});
