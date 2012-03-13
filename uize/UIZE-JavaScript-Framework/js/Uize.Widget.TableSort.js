/*
	UIZE JAVASCRIPT FRAMEWORK 2012-01-10

	http://www.uize.com/reference/Uize.Widget.TableSort.html
	Available under MIT License or GNU General Public License -- http://www.uize.com/license.html
*/
Uize.module({name:'Uize.Widget.TableSort',required:'Uize.Node',builder:function(c_a){var c_b,c_c=null,c_d=true,c_e=false,c_f=Uize.Node;function c_g(c_h,c_i){var c_j=[],c_k=c_h.childNodes,c_l=c_k.length;for(var c_m= -1;++c_m<c_l;){var c_n=c_k[c_m];c_n.tagName==c_i&&c_j.push(c_n);}return c_j;}function c_o(c_h){return c_f.getById(c_h).getElementsByTagName('tbody')[0];}function c_p(c_q){var c_r=c_g(c_q,'TD');if(!c_r.length)c_r=c_g(c_q,'TH');return c_r;}var c_s=c_a.subclass(),c_t=c_s.prototype;c_t.c_u=function(c_v){var c_w=this;return(c_v==c_w.c_x? !c_w.c_y:((c_w.c_z&&c_w.c_z[c_v])||c_w.c_A)=='ascending');};c_t.c_B=function(c_v){var c_w=this;if(c_w.isWired){var c_C=c_w.c_D[c_v];c_C.className=(c_v==c_w.c_x?c_w.c_E:(c_v==c_w.c_F?c_w.c_G:c_w.c_H[c_v]))||'';c_C.title=c_w.c_u(c_v)?c_w.c_I:c_w.c_J;}};c_t.c_K=function(c_q){var c_w=this;if(c_w.isWired&&c_q)c_q.className=(c_q==c_w.c_L?c_w.c_M:c_q.Uize_TableSort_a)||'';};c_t.c_N=function(c_v){var c_w=this;c_w.c_O();c_w.c_F=c_v;c_w.c_B(c_v);};c_t.c_O=function(){var c_w=this;
if(c_w.c_F!=c_c){var c_P=c_w.c_F;c_w.c_F=c_c;c_w.c_B(c_P);}};c_t.c_Q=function(c_q){var c_w=this;c_w.c_R();c_w.c_L=c_q;c_w.c_K(c_q);};c_t.c_R=function(){var c_w=this;if(c_w.c_L){var c_S=c_w.c_L;c_w.c_L=c_c;c_w.c_K(c_S);}};c_t.sort=function(c_v){var c_w=this,c_T=c_w.getNode();if(c_T){var c_U=c_o(c_T),c_V=c_g(c_U,'TR'),c_W=c_V.length,c_X=[],c_Y=[],c_Z=c_d,c_0=c_d;c_w.c_y=c_w.c_u(c_v);for(var c_1= -1;++c_1<c_W;){c_Y[c_1]=c_1;if(c_1!=c_w.c_2){var c_r=c_p(c_V[c_1]);if(c_r.length==c_w.c_D.length){var c_3=c_f.getText(c_r[c_v]);if(c_3){c_0=c_0&& !isNaN(+new Date(c_3));c_Z=c_Z&&/\d/.test(c_3);c_X[c_1]=c_3;}}}}function c_4(c_5,c_6){return c_5==c_6?0:(c_5<c_6? -1:1);}var c_7=c_4,c_8=c_0||c_Z,c_9=c_8?c_7:c_4,c_ba=c_w.c_y?1: -1;function c_bb(c_bc){return c_X[c_Y[c_bc]]===c_b;}if(c_8){for(var c_1= -1;++c_1<c_W;){if(!c_bb(c_1))c_X[c_1]=c_0? +new Date(c_X[c_1]): +c_X[c_1].replace(/[^\d\.]/g,'');}}var c_bd=c_W-1;for(var c_be= -1;++c_be<c_bd;){if(!c_bb(c_be)){for(var c_bf=c_be;++c_bf<c_W;){if(!c_bb(c_bf)){if(c_ba==c_9(
c_X[c_Y[c_be]],c_X[c_Y[c_bf]])){var c_bg=c_Y[c_be];c_Y[c_be]=c_Y[c_bf];c_Y[c_bf]=c_bg;}}}}}for(var c_1= -1;++c_1<c_W;)c_U.appendChild(c_V[c_Y[c_1]]);if(c_v!=c_w.c_x){if(c_w.c_x!=c_c){var c_bh=c_w.c_x;c_w.c_x=c_c;c_w.c_B(c_bh);}c_w.c_x=c_v;c_w.c_B(c_v);}}};c_t.updateUi=function(){var c_w=this;if(c_w.isWired){for(var c_v= -1;++c_v<c_w.c_D.length;)c_w.c_B(c_v);c_w.c_K(c_w.c_L);}};c_t.wireUi=function(){var c_w=this;if(!c_w.isWired){c_w.c_D=[];c_w.c_H=[];c_w.c_F=c_w.c_x=c_w.c_L=c_c;c_w.c_y=c_d;var c_T=c_w.getNode();if(c_T){var c_U=c_o(c_w.getNode()),c_bi=c_g(c_U,'TR');var c_bj=0,c_bk=c_bi.length;for(var c_1= -1;++c_1<c_bk;)c_bj=Math.max(c_bj,c_p(c_bi[c_1]).length);function c_bl(c_V){for(var c_1= -1,c_W=c_V.length;++c_1<c_W;){var c_bm=c_p(c_V[c_1]);if(c_bm.length==c_bj){c_w.c_D=c_bm;c_w.c_2=c_1;break;}}}var c_bn=c_T.getElementsByTagName('thead');if(c_bn.length>0){var c_bo=c_g(c_bn[0],'TR');if(!c_bo.length)c_bo=[c_bn[0]];c_bl(c_bo);}c_w.c_2= -1;c_w.c_D.length||c_bl(c_bi);Uize.forEach(c_w.c_D,function(c_C,c_bp){
c_w.c_H[c_bp]=c_C.className;c_w.wireNode(c_C,{mouseover:function(){c_w.c_N(c_bp)},mouseout:function(){c_w.c_O()},click:function(){c_w.sort(c_bp)}});});var c_bq=Uize.map(c_w.c_D,function(c_C){return c_f.getText(c_C)});function c_br(c_q){c_q.Uize_TableSort_a=c_q.className;c_w.wireNode(c_q,{mouseover:function(){c_w.c_Q(c_q)},mouseout:function(){c_w.c_R()}});}for(var c_1= -1,c_bk=c_bi.length;++c_1<c_bk;){if(c_1!=c_w.c_2){var c_q=c_bi[c_1],c_r=c_p(c_q);c_r.length==c_w.c_D.length&&c_br(c_q);for(var c_bs= -1;++c_bs<c_r.length;){if(c_w.c_bt&&c_bs in c_w.c_bt?c_w.c_bt[c_bs]:c_w.c_bu)c_r[c_bs].title=c_bq[c_bs];}}}}c_a.prototype.wireUi.call(c_w);}};var c_bv='updateUi';c_s.registerProperties({c_bu:{name:'cellTooltips',value:c_d},c_bt:'cellTooltipsByColumn',c_A:{name:'dominantSortOrder',value:'ascending'},c_z:'dominantSortOrderByColumn',c_G:{name:'headingOverClass',onChange:c_bv},c_E:{name:'headingLitClass',onChange:c_bv},c_I:{name:'languageSortAscending',onChange:c_bv,value:'Click to sort in ascending order'},c_J:{
name:'languageSortDescending',onChange:c_bv,value:'Click to sort in descending order'},c_M:{name:'rowOverClass',onChange:c_bv}});return c_s;}});