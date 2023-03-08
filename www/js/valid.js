// @license magnet:?xt=urn:btih:1f739d935676111cfff4b4693e3816e664797050&dn=gpl-3.0.txt GPL-v3-or-Later
function isUrl()
{
	let url = document.submit_form.url.value;
	/* In no way a verbose way of checking */
	let regex = /[http|https]:\/\/.*\.+.*/;
	return regex.test(url);
}

function isTitle()
{
	let title = document.submit_form.title.value;
	return title.length < 33;
}

function isValid()
{
	var error_msg = "";
	var input_box;
	if(!isUrl())
	{
		error_msg += "\r\nURL's must have http(s)://";
		input_box = document.submit_form.url;
	}

	if(!isTitle())
	{
		error_msg += "\r\nTitle must be less than 32 characters";
		input_box = document.submit_form.title;
	}

	if(error_msg == "") return true;

	alert("The following error's were found in submission form: " + error_msg);
	input_box.focus();

	return false;
}
// @license-end
