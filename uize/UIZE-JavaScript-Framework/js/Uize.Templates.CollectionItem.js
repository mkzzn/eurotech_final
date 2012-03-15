/*
	UIZE JAVASCRIPT FRAMEWORK 2012-01-10

	http://www.uize.com/reference/Uize.Templates.CollectionItem.html
	Available under MIT License or GNU General Public License -- http://www.uize.com/license.html
*/
Uize.module({name:'Uize.Templates.CollectionItem',builder:function(){var _a=function(){};_a.process=function(input){var output=[];output.push('<div id="',input.idPrefix,'" class="collectionItem">\r\n	<div class="collectionItemActions">\r\n		<a id="',input.idPrefix,'_remove" href="javascript://" title="Click to remove this item">delete</a>\r\n	</div>\r\n	<div id="',input.idPrefix,'-previewShell" class="collectionItemPreview">\r\n		<a href="javascript://" class="collectionItemPreviewLink">\r\n			<img id="',input.idPrefix,'-preview" src="',input.previewUrl,'" class="collectionItemPreviewImage"/>\r\n		</a>\r\n	</div>\r\n	<div class="collectionItemInfo">\r\n		<div id="',input.idPrefix,'_select" class="collectionItemSelect" title="click to select / unselect">\r\n			<div class="collectionItemSelectCheck"></div>\r\n		</div>\r\n		<div id="',input.idPrefix,'-title" class="collectionItemInfoTitle"></div>\r\n	</div>\r\n</div>\r\n\r\n');return output.join('');};_a.input={idPrefix:'string'};return _a;}});