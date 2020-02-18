// The root URL for the RESTful services 
var _appKey = 'A1902D1C-B6FA-4AF9-9119-9A5B314ED159';// 'F362477E-B11F-4FE9-BB81-AC85BF8CA64C';//swtapisp.dev0001@gmail.com
var _appCode = 'testApp';

(function ($) {
    /****************************************************************
     * Function name        : $.ajaxExec
     * Function overview    : Load JSON data by HTTP communication
     *                        Response is assumed to be JSON.
     * Parameter            : url    : 	Request URL
     *                        data   : The values to send to the server (default: "")
     * Return               : N/A
     ****************************************************************/
    $.ajaxExec = function (config) {
        // The default value of the argument
        config = jQuery.extend({
        	root: "",
            data: "",
            mask: true,
            type: 'GET',
            success: function () { },
            error: function () { },
            complete: function () { },
        }, config);

        $.log('>>> Start call: ' + config.url);
        var currentSecond = new Date().getTime() / 1000;
        var token_key = $.getAccessTokenFromCookie();
        if (token_key == "" || token_key == null) {
        	token_key = accessKey;
        }
        if (config.root == 'omp') {
        	token_key = '6d3ad16eee0f9ade4ec8e2fde53efe6';
        }
        $.log('>>> Start call with Access Token: ' + token_key);
        var deviceID = DefaultDeviceId;
        var installationId = '';
        var admin = $.getIsAdminLoginFromCookie();
        console.log(admin);
        if (admin == '1') {
        	installationId = '';
        } else {
        	installationId = defaultInstallationId;
        }
		                
        // Send ajax request
        $.ajax({
            contentType: "application/json",
            headers: {
                authorization: "Bearer " + token_key,
                DeviceId: deviceID,
                InstallationId: installationId,
                AppId: DefaultAppId
            },
            type: config.type,
            url: config.url,
            data: config.data,
            dataType: "json",
            timeout: 0,
            crossDomain: true,
            cache: false,
            // When success response
            success: function (obj) {
                // Call success method
                // Call success method
                if (obj.Status == '000000') {
                	if (obj.DataObject != null) {
                		config.success(obj.DataObject);
                	} else if (obj.ListOfObjects != null) {
                		config.success(obj.ListOfObjects);
                	} else {
                		config.success(obj);
                	}
                } else {
                	config.success(obj);
                }
            },
            // When error response
            error: function (xhr, url, func) {
                //not success
                if (xhr.status != 200) {
                    $.log('-------------------------------------------------------------------------');
                    $.log('>> complete-error ' + func + ' complete - detected through the complete handler');
                    $.log('>> complete-error xhr.status: ' + xhr.status);
                    $.log('>> complete-error xhr.statusText: ' + xhr.statusText);
                    $.log('>> complete-error xhr.responseText: ' + xhr.responseText);

                    var msg = 'An error occurred when calling API: ' + url + '\n\n' + 'something went wrong please try again later';
                    if (xhr.responseText != 'undefined') {
                        try {
                            var err = eval("(" + xhr.responseText + ")");
                            var msg = 'An error occurred when calling API: ' + url + '\n\n' + err.Message;
                        } catch (err) {
                            // Nothing todo for this case
                        }
                    }

                    // Call success method
                    if (xhr.status == 500 || xhr.status == 400 || xhr.status == 401) {
                        config.error(xhr.responseText);
                    }
                }
            },
            // To do when request completed
            complete: function (XMLHttpRequest, textStatus) {
                // Write log debug
                $.log('<<< Call: ' + config.url + ' complete.');
                config.complete(XMLHttpRequest);
            }
        });
    };

    /****************************************************************
     * Function name        : $.ajaxExecLogin
     * Function overview    : Load JSON data by HTTP communication
     *                        Response is assumed to be JSON.
     * Parameter            : url    : 	Request URL
     *                        data   : The values to send to the server (default: "")
     * Return               : N/A
     ****************************************************************/
    $.ajaxExecLogin = function (config) {
        // The default value of the argument
        config = jQuery.extend({
            data: "",
            mask: true,
            type: 'POST',
            success: function () { },
            error: function () { },
            complete: function () { },
        }, config);

        $.log('>>> Start call: ' + config.url);

        // Send ajax request
        $.ajax({
            contentType: "application/x-www-form-urlencoded",
            headers: {
                authorization: "Basic " + config.authorizationKey,
                "X-MP-Authorization": "Basic " + config.authorizationKey
            },
            type: config.type,
            url: config.url,
            data: config.data,
            dataType: "json",
            timeout: 0,
            crossDomain: true,
            cache: false,
            // When success response
            success: function (obj) {
                // Call success method
                config.success(obj);
            },
            // When error response
            error: function (xhr, url, func) {
                //not success
                if (xhr.status != 200) {
                    $.log('-------------------------------------------------------------------------');
                    $.log('Request: ' + xhr);
                    $.log('>> complete-error ' + func + ' complete - detected through the complete handler');
                    $.log('>> complete-error xhr.status: ' + xhr.status);
                    $.log('>> complete-error xhr.statusText: ' + xhr.statusText);
                    $.log('>> complete-error xhr.responseText: ' + xhr.responseText);

                    var msg = 'An error occurred when calling API: ' + url + '\n\n' + 'something went wrong please try again later';
                    if (xhr.responseText != 'undefined') {
                        try {
                            var err = eval("(" + xhr.responseText + ")");
                            var msg = 'An error occurred when calling API: ' + url + '\n\n' + err.Message;
                        } catch (err) {
                            // Nothing todo for this case
                        }
                    }

                    // Call success method
                    config.error(xhr.responseText);
                }
            },
            // To do when request completed
            complete: function (XMLHttpRequest, textStatus) {
                // Write log debug
                $.log('<<< Call: ' + config.url + ' complete.');
                config.complete(XMLHttpRequest);
            }
        });
    };

    /// --------------------------------------------------------------------------------------------------------
    /// Login to API
    /// --------------------------------------------------------------------------------------------------------
    $.Authenticate = function (username, password, callback) {
        if (username == '' || password == '') {
            noty({ "text": "Username and password is not empty.", "layout": "top", "type": "error" });
            return;
        }
        var param = {
            grant_type: 'password',
            username: username,
            password: password,
            scope: 'PRODUCTION'
        };
        var paramStr = JSON.stringify(param);
        $.ajaxExecLogin({
            url: APP_TOKEN_URL,
            data: "grant_type=password&username=" + encodeURI(username) + "&password=" + encodeURI(password) + "&scope=PRODUCTION",
            authorizationKey: authorizationKey,
            success: function (data) {
                if (data.access_token.length > 0) {
                	var currentSecond = new Date().getTime() / 1000;
                	var accessTokenObject = {
                		"access_token": data.access_token,
                		"token_type": data.token_type,
                		"refresh_token": data.refresh_token,
                		"username": username,
                		"expires_in": data.expires_in,
                		"access_time": currentSecond
                	};
                	$.setCookie("access_token", accessTokenObject);
                	
                    // Call back after login
                    callback();
                } else {
                }
            },
            error: function () {
                noty({ "text": "Username or password is not matched. Please input correct your username and password!", "layout": "top", "type": "error" });
            }
        });
    }

    /// --------------------------------------------------------------------------------------------------------
    /// Login to API
    /// --------------------------------------------------------------------------------------------------------
    $.GetAccessTokenKey = function (callback) {
        $.ajaxExecLogin({
            url: APP_TOKEN_URL,
            data: "grant_type=client_credentials&scope=PRODUCTION",
            authorizationKey: authorizationKey,
            success: function (data) {
                if (data.access_token.length > 0) {
					var currentSecond = new Date().getTime() / 1000;
                	var accessTokenObject = {
                		"access_token": data.access_token,
                		"token_type": data.token_type,
                		"refresh_token": '',
                		"username": '',
                		"expires_in": data.expires_in,
                		"access_time": currentSecond
                	};
                	$.setCookie("access_token", accessTokenObject);

                    // Call back after login
                    callback();
                } else {
                }
            },
            error: function () {
                alert("Username or password is not matched. Please input correct your username and password!");
            }
        });
    }

    /****************************************************************
     * Function name        : $.log
     * Function overview    : Log message to console mode for debug
     * Parameter            : message    : 	The error message
     *                        
     * Return               : N/A
     ****************************************************************/
    $.log = function (message) {
        if (window.console) {
            console.log(message);
        }
    }

    /****************************************************************
     * Function name        : $.FormatCurrency
     * Function overview    : Format currentcy value
     * Parameter            : message    : 	The error message
     *                        
     * Return               : N/A
     ****************************************************************/
    $.FormatCurrency = function (value, decimal) {
        if (decimal == null) {
            decimal = 2;
        }
        if (decimal == 0) {
            value = parseFloat(value).toFixed(2);
            value = $.ReplaceAll(value, ',', '');
            value = value.replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
            value = value.substr(0, value.length - 3);
            return value;
        } else {
            value = parseFloat(value).toFixed(decimal);
            value = $.ReplaceAll(value, ',', '');
            return value.replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
        }

    }

    /****************************************************************
    * Function name        : $.ReplaceAll
    * Function overview    : Replace all old value by new value
    * Parameter            : The string after replaced
    *                        
    * Return               : N/A
    ****************************************************************/
    $.ReplaceAll = function (str, oldVal, newVal) {
        var re = new RegExp(oldVal, 'g');
        return str.replace(re, newVal);
    }

    /****************************************************************
     * Function name        : $.checkAccessToken
     * Function overview    : check access token when user logged in
     * Parameter            : 
     *                        
     * Return               : N/A
     ****************************************************************/
    $.checkAccessToken = function () {
        accessToken = $.getAccessTokenFromCookie();
        //tokenType = $.cookie("token_type");
        //refreshToken = $.cookie("refresh_token");

        if (accessToken && refreshToken) {
            // do nothing
        } else {
            // redirect to login page.
            window.location = "index.html";
        }
    }


    /// --------------------------------------------------------------------------------------------------------
    /// Get ServiceProvider Session Info to API
    /// --------------------------------------------------------------------------------------------------------
    $.getSessionInfo = function (config) {
        // The default value of the argument
        config = jQuery.extend({
            success: function () { },
            error: function () { }
        }, config);
        var accessToken = $.getAccessTokenFromCookie();
        var getSessionStatus_url_updated = UserManagement_User_Url + '/GetSessionStatus';
        $.ajaxExec({
            url: getSessionStatus_url_updated,
            success: function (data) {
                if (data.SessionKey.length > 0) {
                    $('#txtAPIKey').val(data.SessionKey);
                    _apikey = data.SessionKey;
                    $('#icon_user_content').html('&nbsp' + data.ServiceProvider);
                    config.success();
                } else {
                    // window.location = "index.html";
                }
            }
        });
    }

    /****************************************************************
     * Function name        : $.getParameterByName
     * Function overview    : Get parametter by name from URI
     * Parameter            : name    : 	The name of parametter
     *                        
     * Return               : N/A
     ****************************************************************/
    $.getParameterByName = function (name) {
        name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
        var regexS = "[\\?&]" + name + "=([^&#]*)";
        var regex = new RegExp(regexS);
        var results = regex.exec(window.location.href);
        if (results == null) {
            return "";
        } else {
            return decodeURIComponent(results[1].replace(/\+/g, " "));
        }
    }
    
    // Set JSON object to cookie
	$.setCookie = function(key, object) {
		$.cookie.json = true;
		$.cookie(key, JSON.stringify(object), { expires: 1, path: '/' });
	}
	
	// Get access token from cookie
	$.getAccessTokenFromCookie = function() {
		$.cookie.json = true;
		var cookieStr = $.cookie('access_token');
		if (cookieStr == 'undefined' || cookieStr == null) {
			console.log('Can not get access token object from cookie');
			return '';
		}
		var cookieObject = JSON.parse(cookieStr);
		return cookieObject['access_token'];
	}
	// Get is admin login from cookie
	$.getIsAdminLoginFromCookie = function() {
		$.cookie.json = true;
		var cookieStr = $.cookie('access_token');
		if (cookieStr == 'undefined' || cookieStr == null) {
			console.log('Can not get access token object from cookie');
			return '';
		}
		var cookieObject = JSON.parse(cookieStr);
		return cookieObject['is_admin_login'];
	}
})(jQuery);
