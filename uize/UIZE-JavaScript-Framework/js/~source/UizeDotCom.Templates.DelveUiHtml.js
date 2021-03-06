/*
	This is an automatically generated module, compiled from the JavaScript template file:
		UizeDotCom.Templates.DelveUiHtml.js.jst
*/

/*ScruncherSettings Mappings="=" LineCompacting="TRUE"*/

Uize.module ({
	name:'UizeDotCom.Templates.DelveUiHtml',
	builder:function () {
		var _package = function () {};

		/*** Public Static Methods ***/
			_package.process = function (input) {
				var output = [];
				output.push ('<h1 class="document-title">\r\n	<a id="page-homeLink" href="index.html" title="UIZE JavaScript Framework home"></a>\r\n	<span class="breadcrumb breadcrumbWithArrow">DELVE</span>\r\n	<span id="page-windowInspected" class="windowInspected"></span>\r\n	<div class="pageActions">\r\n		<a id="page-refresh" href="javascript://" class="buttonLink" title="Re-synchronize to the page being inspected">REFRESH</a>\r\n		<a id="page-getWidgetFromNodeId" href="javascript://" class="buttonLink" title="Find the widget that owns a particular implied node">GET WIDGET FROM NODE ID</a>\r\n		<a id="page-help" href="javascript://" class="buttonLink" title="Tips on using the DELVE tool">HELP</a>\r\n		<a id="page-close" href="javascript://" class="buttonLink" title="Close the DELVE tool">X</a>\r\n	</div>\r\n</h1>\r\n\r\n<div id="infoTooltip" class="info-tooltip"></div>\r\n\r\n<div class="leftPane">\r\n	<div class="paneChrome">\r\n		<div class="paneInputOuterShell">\r\n			<div class="paneInputShell">\r\n				<select id="page-treeListDropdown" class="paneInput"></select>\r\n			</div>\r\n		</div>\r\n		<div class="treeListActions">\r\n			<a id="page-expandTreeListOneLevel" href="javascript://" title="expand the tree to just one level deep">1 level</a>\r\n			<span class="separator">|</span>\r\n			<a id="page-expandTreeListTwoLevels" href="javascript://" title="expand the tree to two levels deep">2 levels</a>\r\n			<span class="separator">|</span>\r\n			<a id="page-expandTreeListThreeLevels" href="javascript://" title="expand the tree to three levels deep">3 levels</a>\r\n			<span class="separator">|</span>\r\n			<a id="page-expandTreeListAll" href="javascript://" title="expand the entire tree">expand all</a>\r\n			<span class="separator">|</span>\r\n			<a id="page-getTreeListItemsAsReport" href="javascript://" title="get all the items as a plain text report in a popup window">as report</a>\r\n			<span class="separator">|</span>\r\n			<a id="page-getAllQueriesSummary" href="javascript://" title="get a summary of all available queries as a plain text report in a popup window">uber summary</a>\r\n		</div>\r\n		<div id="page_treeList-shell" class="tree-list-shell"></div>\r\n	</div>\r\n</div>\r\n<div class="rightPane">\r\n	<div class="paneChrome">\r\n		<div class="paneInputOuterShell">\r\n			<div class="paneInputShell">\r\n				<input id="page_objectEntry-input" type="text" class="paneInput"/>\r\n			</div>\r\n		</div>\r\n		<div class="tabShell">\r\n			<div class="tabStubShell">\r\n				<a id="page_objectInspectorTabs_option0" class="tabStub" href="javascript://">SUMMARY</a>\r\n				<a id="page_objectInspectorTabs_option1" class="tabStub" href="javascript://">STATE</a>\r\n				<a id="page_objectInspectorTabs_option2" class="tabStub" href="javascript://">FEATURES</a>\r\n				<a id="page_objectInspectorTabs_option3" class="tabStub" href="javascript://">DOCUMENTATION</a>\r\n				<a id="page_objectInspectorTabs_option4" class="tabStub" href="javascript://">EVENTS</a>\r\n				<br style="clear:left;"/>\r\n			</div>\r\n			<div class="tabBodyShell">\r\n				<div id="page_objectInspectorTabs-option0TabBody" class="tabBodyInactive">\r\n					<div id="page_objectInspectorSummary" class="tabBodyContentsShell objectInspectorSummary"></div>\r\n				</div>\r\n				<div id="page_objectInspectorTabs-option1TabBody" class="tabBodyInactive">\r\n					<div id="page_objectInspectorState" class="tabBodyContentsShell objectInspectorSummary"></div>\r\n				</div>\r\n				<div id="page_objectInspectorTabs-option2TabBody" class="tabBodyInactive">\r\n					<div id="page_objectInspectorFeatures" class="tabBodyContentsShell objectInspectorFeatures"></div>\r\n				</div>\r\n				<div id="page_objectInspectorTabs-option3TabBody" class="tabBodyInactive">\r\n					<div class="tabBodyContentsShell objectInspectorDocumentationShell">\r\n					<iframe id="page-documentation" src="javascript:\'&lt;html&gt;&lt;body&gt;---&lt;/body&gt;&lt;/html&gt;\'" class="objectInspectorDocumentation" frameborder="0"></iframe>\r\n				</div>\r\n				</div>\r\n				<div id="page_objectInspectorTabs-option4TabBody" class="tabBodyInactive">\r\n					<div id="page_objectInspectorEventsLog-messages" class="tabBodyContentsShell"></div>\r\n					<a id="page_objectInspectorEventsLog_clear" href="javascript://" class="objectInspectorEventsLogClearButton button">CLEAR</a>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</div>\r\n\r\n');
				return output.join ('');
			};

		/*** Public Static Properties ***/
			_package.input = {};

		return _package;
	}
});

