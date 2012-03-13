/*
	UIZE JAVASCRIPT FRAMEWORK 2012-01-10

	http://www.uize.com/reference/Uize.Doc.Sucker.html
	Available under MIT License or GNU General Public License -- http://www.uize.com/license.html
*/
Uize.module({name:'Uize.Doc.Sucker',required:['Uize.Scruncher','Uize.String','Uize.String.Lines','Uize.Data.Simple','Uize.Doc.Simple','Uize.Util.Oop'],builder:function(){var _a=function(){};var _b=/^\/\*\?/,_c={Method:'Methods',Property:'Properties'};_a.suckDoc=function(_d,_e,_f,_g){var _h=[];for(var _i= -1,_j,_k=Uize.Scruncher.scrunch(_d).comments,_l=_k.length;++_i<_l;){_b.test(_j=_k[_i])&&_h.push(Uize.String.Lines.normalizeIndent(_j.replace(_b,'').replace(/\*\/$/,'')));}if(_e){var _m=Uize.Util.Oop.getClassName(_e),_n=Uize.Util.Oop.isUizeClass(_e);var _o={'Instance Methods':[],'Instance Properties':[],'Set-get Properties':[],'Static Methods':[],'Static Properties':[]},_p=_e.nonInheritableStatics;for(var _q= -1,_r=Uize.Util.Oop.getFeatures(_e),_s=_r.length,_t;++_q<_s;)(_t=_r[_q]).access=='Public'&&_c[_t.type]&&_o[_t.context+' '+_c[_t.type]].push(_t);for(_u in _o){var _r=_o[_u],_s=_r.length;if(_s){_h.push(_u+'\n');for(var _q= -1;++_q<_s;){var _t=_r[_q],_v=_t.introducedIn,_w=Uize.Util.Oop.getClassName(_v),
_x=_t.overriddenIn,_y=Uize.Util.Oop.getClassName(_x);_h.push('\t'+_t.name+'\n'+(_x!=_e?('\t\tInherited from ='+_y+'='+(_v!=_x?', but introduced in ='+_w+'=':'')+'.\n'):'')+'\n'+'\t\tIMPLEMENTATION INFO\n'+'\t\t- '+(_v==_e?'this feature was introduced in this module':((_x==_e?'this is an override of an inherited feature':'this is an inherited feature')+(' ('+'implementation is in '+(_x!=_e?('='+_y+'='):'this module')+', first introduced in '+(_v!=_e?('='+_w+'='):'this module')+')')))+'\n'+(_n&&_t.context=='Static'?'\t\t- this static feature is '+(_p[_t.shortName]?'*not*':'')+' inherited by subclasses\n':''));}}}_h.push('Introduction\n'+'\tExamples\n'+(_g&&_g.length?('\t\tThe following example pages are good showcases for the ='+_m+'= module...\n'+Uize.map(_g,'"\\t\\t- [[" + value.url + "][" + value.title + "]] - " + value.description + "\\n"').join('')):'\t\tThere are no dedicated showcase example pages for the ='+_m+'= module.\n')+'\n'+'\t\tSEARCH FOR EXAMPLES\n'+
'\t\tUse the link below to search for example pages on the *uize.com* Web site that reference the ='+_m+'= module...\n'+'\t\t[[http://www.google.com/search?hl=en&safe=off&domains=uize.com%2Fexamples&sitesearch=uize.com%2Fexamples&q=%22'+_m+'%22][SEARCH]]\n'+'\n');var _z=_n&&Uize.Util.Oop.getInheritanceChain(_e);_h.push('Introduction\n'+'\tImplementation Info\n'+'\t\tThe ='+_m+'= module defines the ='+_m+'= '+(_n?'class':/\.x[A-Z0-9_$][a-zA-Z0-9_$]*$/.test(_m)?'extension module':Uize.Util.Oop.isPackage(_e)?'package':'object')+(_n?(_e!=Uize?', which is a subclass of ='+Uize.Util.Oop.getClassName(_e.superclass)+'=':''):_m.indexOf('.')> -1?' under the ='+_m.slice(0,_m.lastIndexOf('.'))+'= namespace':'')+'.\n'+'\n'+(_n?('\t\tINHERITANCE CHAIN\n'+'\t\t'+Uize.map(_z,'"=" + value.moduleName + "="').join(' -> ')+'\n'+'\n'):''));function _A(_B,_C,_D,_E){var _F,_G=[];for(_u in _o){for(var _q= -1,_r=_o[_u],_s=_r.length,_H=[],_t;++_q<_s;){_t=_r[_q];if(_t.introducedIn==_e?_B=='introduced':_t.overriddenIn==_e
?_B=='overridden':_B=='inherited')_H.push(_t);}if(_H.length){_F=true;_G.push('\t\t\t'+_u.toUpperCase()+'\n'+'\t\t\t'+Uize.map(_H,'"=" + value.name + "="').join(' | ')+'\n'+'\n');}}_h.push(_C,_F?_D:_E,'\n',_G.join(''));}_A('introduced','\t\tFeatures Introduced in This Module\n','\t\t\tThe features listed in this section have been introduced in this module.\n','\t\t\tNo features have been introduced in this module.\n');_A('overridden','\t\tFeatures Overridden in This Module\n','\t\t\tThe features listed in this section have been overridden in this module.\n'+'\n'+'\t\t\tThe module that an overridden feature was initially introduced in will be noted in the IMPLEMENTATION INFO notes for the feature.\n','\t\t\tNo features have been overridden in this module.\n');_A('inherited','\t\tFeatures Inherited From Other Modules\n','\t\t\tThe features listed in this section have been inherited from other modules.\n'+'\n'+
'\t\t\tThe module that an inherited feature was initially introduced in will be noted in the IMPLEMENTATION INFO notes for the feature.\n','\t\t\tThis module has no inherited features.\n');if(_f){var _I=_f;for(var _J= -1,_K=_m.split('.'),_L=_K.length;++_J<_L;)_I=_I[_K[_J]];var _M=Uize.keys(_I);_h.push('\t\tModules Directly Under This Namespace\n'+'\t\t\t'+(_M.length?Uize.String.hugJoin(_M,'='+_m+'.','=',' | '):'There are no modules directly under this namespace.')+'\n'+'\n');}if(_f){var _N=_m.split('.',1)[0]+'.Test.'+_m;_h.push('\t\tUnit Tests\n'+'\t\t\t'+((function(){var mt=_f;try{return eval('mt.'+_N)!=undefined}catch(_O){}})()?'The ='+_m+'= module is unit tested by the ='+_N+'= test module.':'There is no dedicated unit tests module for the ='+_m+'= module.')+'\n'+'\n');}}return _h.join('\n');};_a.toDocument=function(_d,_P){function _Q(_R){var _S;if(_R in _P){_S=_P[_R];delete _P[_R];}return _S;}return(Uize.Doc.Simple.build(Uize.copyInto({data:_a.suckDoc(_d,_Q('module'),_Q('modulesTree'),_Q('examples')),
sectionsToSort:['Instance Methods','Static Methods','Instance Properties','Static Properties','Set-get Properties','Instance Events','Static Events','Child Widgets','Implied Nodes','Deprecated Features']},_P)));};return _a;}});