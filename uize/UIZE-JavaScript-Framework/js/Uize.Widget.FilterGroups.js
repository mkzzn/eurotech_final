/*
	UIZE JAVASCRIPT FRAMEWORK 2012-01-10

	http://www.uize.com/reference/Uize.Widget.FilterGroups.html
	Available under MIT License or GNU General Public License -- http://www.uize.com/license.html
*/
Uize.module({name:'Uize.Widget.FilterGroups',required:['Uize.Widget.Options.FilterGroup','Uize.Data'],builder:function(c_a){var c_b=true,c_c=null;var c_d=c_a.subclass(c_c,function(){var c_e=this;c_e.c_f=c_e.c_g;}),c_h=c_d.prototype;c_h.c_i=function(c_j){for(var c_k= -1,c_l=this.c_m.length,c_n=this.children;++c_k<c_l;)if(c_j(c_n['filterGroup'+c_k],c_k)===false)break;;};c_h.c_o=function(){var c_e=this;if(c_e.isWired){var c_p=[];c_e.c_i(function(c_q){c_p.push(c_q.valueOf())});if(!Uize.Data.clones(c_p,c_e.c_f)){c_e.c_f=c_p;c_e.set({c_g:c_p});}}};c_h.c_r=function(){var c_e=this;if(c_e.isWired){var c_p=c_e.c_g,c_s=c_e.c_m,c_n=c_e.children,c_t={};c_e.c_i(function(c_q){var c_u=c_c;for(var c_v= -1;++c_v<c_p.length;){var c_w=c_p[c_v];if(!c_t[c_w]&&c_q.getValueNoFromValue(c_w)> -1){c_u=c_w;c_t[c_w]=c_b;break;}}c_q.set({value:c_u});});}};c_h.updateCounts=function(c_x){var c_e=this,c_y=c_x.length;if(c_e.isWired){c_x&&c_y&&c_e.c_i(function(c_q,c_z){c_z<c_y&&c_q.updateCounts(c_x[c_z])});}};c_h.wireUi=function(){
var c_e=this;if(!c_e.isWired){var c_p=c_e.c_g,c_s=c_e.c_m;for(var c_z= -1;++c_z<c_s.length;)c_e.addChild('filterGroup'+c_z,Uize.Widget.Options.FilterGroup,Uize.clone(c_s[c_z])).wire('Changed.value',function(){c_e.c_o()});c_a.prototype.wireUi.call(c_e);c_e.c_r();c_e.c_o();}};c_d.registerProperties({c_A:{name:'allowMultiple',onChange:function(){var c_e=this;!c_e.c_A&&c_e.c_g.length>1&&c_e.set({c_g:c_e.c_g.splice(0,1)});},value:c_b},c_g:{name:'value',conformer:function(c_g){c_g=Uize.isArray(c_g)?c_g:[];return this.c_A||c_g.length==1?c_g:c_g.splice(0,1);},onChange:c_h.c_r,value:[]},c_m:{name:'values',value:[]}});return c_d;}});