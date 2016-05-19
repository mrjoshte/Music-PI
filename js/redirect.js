function redirect()
{
	link = window.location + ":6680/mopify";
	link = link.replace("/admin.html:",":");
	link = link.replace("/admin:",":");
	window.location = link;
}
