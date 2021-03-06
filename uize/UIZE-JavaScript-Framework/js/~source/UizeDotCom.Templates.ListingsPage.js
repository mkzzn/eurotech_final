/*
	This is an automatically generated module, compiled from the JavaScript template file:
		UizeDotCom.Templates.ListingsPage.js.jst
*/

/*ScruncherSettings Mappings="=" LineCompacting="TRUE"*/

Uize.module ({
	name:'UizeDotCom.Templates.ListingsPage',
	required:[
		'Uize.String.Lines',
		'Uize.Xml'
	],
	builder:function () {
		var _package = function () {};

		/*** Public Static Methods ***/
			_package.process = function (input) {
				var output = [];
				output.push ('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n	<title>',input .title,' | UIZE JavaScript Framework</title>\r\n	<meta name="keywords" content="UIZE JavaScript Framework"/>\r\n	<meta name="description" content="',Uize.Xml.toAttributeValue (input .metaDescription),'"/>\r\n	<link rel="alternate" type="application/rss+xml" title="UIZE JavaScript Framework - Latest News" href="http://www.uize.com/latest-news.rss"/>\r\n	<link rel="stylesheet" href="',input .pathToRoot,'css/page.css"/>\r\n	<link rel="stylesheet" href="',input .pathToRoot,'css/page.simpledoc.css"/>\r\n	<link rel="stylesheet" href="',input .pathToRoot,'css/page.listings.css"/>\r\n</head>\r\n\r\n<body>\r\n\r\n<script type="text/javascript" src="',input .pathToRoot,'js/Uize.js"></script>\r\n\r\n<h1 class="document-title">\r\n	<a id="page-homeLink" href="',input .pathToRoot,'index.html" title="UIZE JavaScript Framework home"></a>\r\n	',input.displayTitle || input.title,'\r\n</h1>\r\n\r\n<div class="main">\r\n\r\n<div class="preamble">',input .preamble,'</div>\r\n');

					for (
						var
							listingNo = -1,
							listings = input.listings,
							listingsLength = listings.length,
							imageFolder = input.imageFolder || input.title.toLowerCase ()
						;
						++listingNo < listingsLength;
					) {
						var
							listing = listings [listingNo],
							listingName = listing.fullName,
							listingSubTitle = listing.subTitle || '',
							listingNamePlusSubTitle = listingName + (listingSubTitle && ' - ') + listingSubTitle,
							moreInfoLink = listing.link
						;

				output.push ('\r\n<div class="heading1">',listingNamePlusSubTitle,'</div>\r\n<div class="infoRow">\r\n	');
				 if (moreInfoLink) {
				output.push ('<a href="',moreInfoLink,'" target="_blank" class="imageLink">');
				 }
				output.push ('<img src="',input .pathToRoot,'images/',imageFolder,'/',listingName.toLowerCase ().replace (/ /g,'-'),'.png" alt="',Uize.Xml.toAttributeValue (listingNamePlusSubTitle),'"/>');
				 if (moreInfoLink) {
				output.push ('</a>');
				 }
				 for (
						var lineNo = -1, lines = Uize.String.Lines.split (listing.text), linesLength = lines.length;
						++lineNo < linesLength;
					) {
				output.push ('\r\n	<p>',lines [lineNo],'</p>');
				 }

						if (moreInfoLink) {
				output.push ('\r\n	<p class="more">more info at... <a href="',moreInfoLink,'" target="_blank">',moreInfoLink,'</a></p>');
				 }
				output.push ('\r\n	<br class="end"/>\r\n</div>');
				 }
				output.push ('\r\n\r\n</div>\r\n\r\n<script type="text/javascript">\r\n\r\nUize.module ({\r\n	required:\'UizeDotCom.Page.library\',\r\n	builder:function () {(window.page = UizeDotCom.Page ()).wireUi ()}\r\n});\r\n\r\n</script>\r\n\r\n</body></html>\r\n');
				return output.join ('');
			};

		/*** Public Static Properties ***/
			_package.input = {
				title:'string',
				displayTitle:'string',
				pathToRoot:'string',
				imageFolder:'string',
				metaDescription:'string',
				preamble:'string',
				listings:'array'
			};

		return _package;
	}
});

