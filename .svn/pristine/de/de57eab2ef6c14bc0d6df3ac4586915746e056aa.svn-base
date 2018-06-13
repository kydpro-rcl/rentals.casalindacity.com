
/* 
 ================================================
 PVII Image Rotator Magic scripts
 Copyright (c) 2010 Project Seven Development
 www.projectseven.com
 Version: 1.2.1 -build 22
 ================================================
 
*/

var p7IRMctl=[],p7IRMi=false,p7IRMa=false;
function P7_IRMset(){
	var h,sh,hd;
	if (!document.getElementById){
		return;
	}
	sh='.p7IRMpaginator {display:block !important;}\n';
	sh+='.p7IRMimage {display:block;margin:0 auto;}';
	if (document.styleSheets){
		h='\n<st' + 'yle type="text/css">\n' + sh + '\n</s' + 'tyle>';
		document.write(h);
	}
	else{
		h=document.createElement('style');
		h.type='text/css';
		h.appendChild(document.createTextNode(sh));
		hd=document.getElementsByTagName('head');
		hd[0].appendChild(h);
	}
}
P7_IRMset();
function P7_opIRM(){
	if(!document.getElementById){
		return;
	}
	p7IRMctl[p7IRMctl.length]=arguments;
}
function P7_IRMaddLoad(){
	if(!document.getElementById){
		return;
	}
	if(window.addEventListener){
		document.addEventListener("DOMContentLoaded",P7_initIRM,false);
		window.addEventListener("load",P7_initIRM,false);
		window.addEventListener("unload",P7_IRMrf,false);
	}
	else if(document.addEventListener){
		document.addEventListener("load",P7_initIRM,false);
	}
	else if(window.attachEvent){
		window.attachEvent("onload",P7_initIRM);
	}
	else if(typeof window.onload=='function'){
		var p7vloadit=onload;
		window.onload=function(){
			p7vloadit();
			P7_initIRM();
		};
	}
	else{
		window.onload=P7_initIRM;
	}
}
P7_IRMaddLoad();
function P7_IRMrf(){
	return;
}
function P7_initIRM(){
	var i,j,tD,x=0,tA,k,sn,d,dD,tL,tC,tP,tW,tV,iM;
	if(p7IRMi){
		return;
	}
	p7IRMi=true;
	document.p7irmpre=[];
	for(j=0;j<p7IRMctl.length;j++){
		tD=document.getElementById(p7IRMctl[j][0]);
		if(tD){
			tD.p7opt=p7IRMctl[j];
			if(navigator.appVersion.indexOf("MSIE 5")>-1){
				tD.p7opt[1]=0;
			}
			k=-1;
			tD.p7slides=[];
			tD.numPlays=1;
			tD.irmDirection='right';
			tD.irmFaderRunning=false;
			tD.irmCurrentPanelID=tD.id.replace('_','dv_');
			tD.irmPrevPanelID=tD.id.replace('_','sdv_');
			tW=document.getElementById(tD.id.replace('_','w_'));
			P7_IRMsetSt(tW);
			tV=document.getElementById(tD.id.replace('_','dv_'));
			P7_IRMsetSt(tV);
			d=tD.id.replace("_","dsw_");
			dD=document.getElementById(d);
			dD.p7status='closed';
			dD.style.visibility='hidden';
			d=tD.id.replace("_","dsopw_");
			dD=document.getElementById(d);
			dD.p7status='closed';
			dD.style.visibility='hidden';
			P7_IRMbuild(tD.id);
			tL=document.getElementById(tD.id.replace('_','list_'));
			tA=tL.getElementsByTagName('A');
			for(i=0;i<tA.length;i++){
				if(tA[i].parentNode.nodeName=="LI"){
					k++;
					tD.p7slides[k]=tA[i];
					tA[i].irmDiv=tD.id;
					document.p7irmpre[x]=new Image();
					document.p7irmpre[x].cmp=false;
					document.p7irmpre[x].onload=function(){
						this.cmp=true;
					};
					document.p7irmpre[x].onerror=function(){
						this.cmp=true;
						this.width=300;
						this.height=300;
					};
					tA[i].p7imindex=x;
					x++;
				}
			}
			if(tD.p7opt[8]==1){
				tD.irmDescStatus='open';
			}
			else{
				tD.irmDescStatus='closed';
			}
			d=tD.id.replace("_","dsclose_");
			dD=document.getElementById(d);
			if(dD){
				dD.onclick=function(){
					return P7_IRMcloseDesc(this);
				};
			}
			d=tD.id.replace("_","dsopen_");
			dD=document.getElementById(d);
			if(dD){
				dD.onclick=function(){
					return P7_IRMopenDesc(this);
				};
			}
			if(tD.p7opt[9]==1){
				document.oncontextmenu=function(evt){
					var tg,m=true;
					evt=(evt)?evt:event;
					tg=(evt.target)?evt.target:evt.srcElement;
					if(tg.id&&tg.id.indexOf('p7IRM'===0)){
						m=false;
					}
					return m;
				};
			}
			tD.currentSlideNum=0;
			tD.irmSlideNums=tD.p7slides.length;
			tD.irmPaginators=[];
			d=tD.id.replace("_","pg_");
			tP=document.getElementById(d);
			if(tP){
				tA=tP.getElementsByTagName('A');
				if(tA){
					for(k=0;k<tA.length;k++){
						if(tA[k].id&&tA[k].id.indexOf('p7IRMpg')===0){
							if(tA[k].id.indexOf('p7IRMpgpp_')<0){
								tA[k].irmDiv=tD.id;
								tA[k].irmSlideNum=P7_IRMparsePN(tA[k].id);
								tD.irmPaginators[tD.irmPaginators.length]=tA[k].id;
								tA[k].onclick=function(){
									return P7_IRMpaginator(this);
								};
							}
						}
					}
				}
			}
			tD.irmControls=new Array(12);
			d=tD.id.replace("_","tools_");
			tC=document.getElementById(d);
			tD.irmControls[2]=P7_IRMsetCC(tD.id,'rf_','first');
			tD.irmControls[3]=P7_IRMsetCC(tD.id,'rp_','prev');
			d=tD.id.replace('_','rpp_');
			tC=document.getElementById(d);
			if(tC){
				tC.p7state='pause';
				tC.irmDiv=tD.id;
				tD.irmControls[4]=tC;
				tC.onclick=function(){
					return P7_IRMpausePlay(this);
				};
			}
			tD.irmControls[5]=P7_IRMsetCC(tD.id,'rn_','next');
			tD.irmControls[6]=P7_IRMsetCC(tD.id,'rl_','last');
			d=tD.id.replace('_','pgpp_');
			tC=document.getElementById(d);
			if(tC){
				tC.p7state='pause';
				tC.irmDiv=tD.id;
				tD.irmControls[12]=tC;
				tC.onclick=function(){
					return P7_IRMpausePlay(this);
				};
			}
			if(tD.p7opt[11]==1){
				tD.irmResume=false;
				tW.onmouseover=function(){
					var tD,d=this.id.replace('w','');
					tD=document.getElementById(d);
					if(tD.irmMode=='play'){
						tD.irmResume=true;
						P7_IRMpause(d);
					}
				};
				tD.onmouseout=function(evt){
					if(this.irmResume){
						var tg,pp,m=true,d;
						d=this.id;
						evt=(evt)?evt:event;
						tg=(evt.toElement)?evt.toElement:evt.relatedTarget;
						if(tg){
							pp=tg;
							while(pp){
								if(pp.id&&pp.id.indexOf(d)===0){
									m=false;
									break;
								}
								pp=pp.parentNode;
							}
						}
						if(m){
							this.irmResume=false;
							if(this.irmShowTimer){
								clearTimeout(this.irmShowTimer);
							}
							this.irmMode='play';
							P7_IRMsetPlay(this.irmControls[4]);
							P7_IRMsetPlay(this.irmControls[12]);
							if(this.irmShowTimer){
								clearTimeout(this.irmShowTimer);
							}
							this.irmShowTimer=setTimeout("P7_IRMcontrol('"+this.id+"','play')",1000);
						}
					}
				};
			}
			sn=tD.p7opt[2];
			if(sn===0){
				tD.p7slides.sort(P7_IRMrandomize);
				sn=1;
			}
			P7_IRMcontrol(tD.id,sn,1);
			P7_IRMurl(tD.id);
			if(tD.p7opt[3]==1){
				tD.irmMode='play';
				P7_IRMsetPlay(tD.irmControls[4]);
				P7_IRMsetPlay(tD.irmControls[12]);
				if(tD.irmShowTimer){
					clearTimeout(tD.irmShowTimer);
				}
				tD.irmShowTimer=setTimeout("P7_IRMcontrol('"+tD.id+"','play')",tD.p7opt[4]);
			}
		}
	}
	p7IRMa=true;
	P7_IRMautoToggle();
}
function P7_IRMopenDesc(d,v){
	var a,tD,dSW,dOP,sn,tA,an=false;
	if(typeof(d)=='object'){
		a=d;
		d=a.id.replace('dsopen','');
	}
	tD=document.getElementById(d);
	if(tD){
		if(tD.p7opt[1]>0){
			an=true;
		}
		sn=tD.currentSlideNum;
		tA=tD.p7slides[sn-1];
		dSW=document.getElementById(tD.id.replace('_','dsw_'));
		dOP=document.getElementById(tD.id.replace('_','dsopw_'));
		if(!v){
			tD.irmDescStatus='open';
		}
		if(tA&&tA.irmDesc){
			if(tD.irmDescStatus=='closed'){
				if(an){
					P7_IRMglideHeight(dSW.id,'hide');
					P7_IRMglideHeight(dOP.id,'show');
				}
				else{
					dSW.style.visibility='hidden';
					dSW.p7status='closed';
					dOP.style.visibility='visible';
					dOP.p7status='open';
				}
			}
			else{
				if(an){
					P7_IRMglideHeight(dSW.id,'show');
					P7_IRMglideHeight(dOP.id,'hide');
				}
				else{
					dSW.style.visibility='visible';
					dSW.p7status='open';
					dOP.style.visibility='hidden';
					dOP.p7status='closed';
				}
			}
		}
		else{
			if(an){
				P7_IRMglideHeight(dSW.id,'hide');
				P7_IRMglideHeight(dOP.id,'hide');
			}
			else{
				dSW.style.visibility='hidden';
				dSW.p7status='closed';
				dOP.style.visibility='hidden';
				dOP.p7status='closed';
			}
		}
	}
	return false;
}
function P7_IRMcloseDesc(d,v){
	var a,tD,dSW,dOP,sn,tA,an;
	if(typeof(d)=='object'){
		a=d;
		d=a.id.replace('dsclose','');
	}
	tD=document.getElementById(d);
	if(tD){
		if(p7IRMa&&tD.p7opt[1]>0){
			an=true;
		}
		sn=tD.currentSlideNum;
		tA=tD.p7slides[sn-1];
		dSW=document.getElementById(tD.id.replace('_','dsw_'));
		dOP=document.getElementById(tD.id.replace('_','dsopw_'));
		if(!v){
			tD.irmDescStatus='closed';
		}
		if(tA&&tA.irmDesc){
			if(tD.irmDescStatus=='closed'){
				if(an){
					P7_IRMglideHeight(dSW.id,'hide');
					P7_IRMglideHeight(dOP.id,'show');
				}
				else{
					dSW.style.visibility='hidden';
					dOP.style.visibility='visible';
				}
			}
			else{
				if(an){
					P7_IRMglideHeight(dSW.id,'hide');
					P7_IRMglideHeight(dOP.id,'hide');
				}
				else{
					dSW.style.visibility='hidden';
					dOP.style.visibility='hidden';
				}
			}
		}
		else{
			if(dSW.style.visibility!='hidden'){
				if(an){
					P7_IRMglideHeight(dOP.id,'hide');
					P7_IRMglideHeight(dSW.id,'hide');
				}
				else{
					dOP.style.visibility='hidden';
					dSW.style.visibility='hidden';
					dOP.p7status='closed';
					dSW.p7status='closed';
				}
			}
		}
	}
	return false;
}
function P7_IRMctrl(dv,ac){
	return P7_IRMcontrol(dv,ac);
}
function P7_IRMcontrol(dv,ac,bp){
	var tD,cs,ts,op,sn=0,m=false;
	tD=document.getElementById(dv);
	if(tD&&tD.p7slides){
		cs=tD.currentSlideNum;
		ts=tD.irmSlideNums;
		op=tD.p7opt;
		if(ac=='pause'){
			P7_IRMpause(tD.id);
			return m;
		}
		if(!bp){
			P7_IRMpause(tD.id);
		}
		if(tD.irmFaderRunning||tD.irmAnimRunning){
			if(!bp){
				return m;
			}
		}
		if(ac=='play'){
			tD.irmMode='play';
			P7_IRMsetPlay(tD.irmControls[4]);
			P7_IRMsetPlay(tD.irmControls[12]);
			ac='next';
		}
		if(ac=='openDesc'){
			P7_IRMopenDesc(dv);
			return m;
		}
		if(ac=='closeDesc'){
			P7_IRMcloseDesc(dv);
			return m;
		}
		if(ac=='first'){
			sn=1;
		}
		else if(ac=='prev'){
			sn=cs-1;
		}
		else if(ac=='next'){
			sn=cs+1;
			if(tD.irmMode=='play'){
				if(tD.irmDirection=='left'){
					sn=cs-1;
				}
				if(sn>ts){
					tD.numPlays++;
					if(tD.p7opt[7]>0&&tD.numPlays>tD.p7opt[7]){
						tD.numPlays=0;
						sn=(tD.p7opt[12]==1)?1:tD.irmSlideNums;
						tD.irmDirection='right';
						P7_IRMpause(tD.id);
					}
					else{
						if(tD.p7opt[6]==0){
							sn=cs-1;
							tD.irmDirection='left';
						}
						else{
							sn=1;
						}
					}
				}
				if(sn<1){
					tD.numPlays++;
					tD.irmDirection='right';
					if(tD.p7opt[7]>0&&tD.numPlays>tD.p7opt[7]){
						tD.numPlays=0;
						sn=(tD.p7opt[12]==1)?1:tD.irmSlideNums;
						P7_IRMpause(tD.id);
					}
					else{
						sn=cs+1;
					}
				}
			}
		}
		else if(ac=='last'){
			sn=ts;
		}
		else{
			sn=ac;
		}
		sn=(sn<1)?1:sn;
		sn=(sn>tD.irmSlideNums)?tD.irmSlideNums:sn
		if(sn==tD.currentSlideNum&&bp!=1){
			return m;
		}
		P7_IRMshowImage(tD.id,sn,bp);
	}
	return m;
}
function P7_IRMshowImage(dv,sn,bp){
	var i,tD,tA,tI,zn,dS;
	zn=sn-1;
	tD=document.getElementById(dv);
	P7_IRMcloseDesc(tD.id,true);
	tD.currentSlideNum=sn;
	tA=tD.p7slides[zn];
	document.p7irmpre[tA.p7imindex].src=tA.href;
	P7_IRMsetControlStates(tD.id);
	P7_IRMsetPaginators(tD.id);
	bp=(bp)?bp:null;
	if(bp!=1&&p7IRMa&&tD.p7opt[1]>0){
		setTimeout("P7_IRMloadImage('"+dv+"',"+tA.p7imindex+","+bp+")",250);
	}
	else{
		P7_IRMloadImage(dv,tA.p7imindex,bp);
	}
}
function P7_IRMdsp_1(dv,bp){
	var i,tD,sn,tA,tI,cP,pP,sI,tDD,tDE,dy=30,stp,dur,fr,dh=100;
	tD=document.getElementById(dv);
	sn=tD.currentSlideNum;
	tA=tD.p7slides[sn-1];
	tI=document.getElementById(tD.id.replace('_','im_'));
	if(bp!=1&&p7IRMa&&tD.p7opt[1]==1){
		pP=document.getElementById(tD.id.replace('_','sdv_'));
		cP=document.getElementById(tD.id.replace('_','dv_'));
		sI=document.getElementById(tD.id.replace('_','sim_'));
		sI.src=tI.src;
		sI.height=tI.height;
		sI.width=tI.width;
		pP.style.width=cP.offsetWidth+'px';
		pP.style.display='block';
		cP.style.visibiliyt="hidden";
		tI.src=tA.href;
		tI.height=document.p7irmpre[tA.p7imindex].height;
		tI.width=document.p7irmpre[tA.p7imindex].width;
		tI.setAttribute('alt',tA.innerHTML);
		pP.irmOpacity=100;
		if(!pP.filters){
			pP.style.opacity=0.99;
		}
		else{
			pP.style.filter='alpha(opacity=99)';
		}
		cP.irmOpacity=1;
		if(!cP.filters){
			cP.style.opacity=0.01;
		}
		else{
			cP.style.filter='alpha(opacity=1)';
		}
		cP.style.visibiliyt="visible";
		dur=tD.p7opt[10];
		dur=(dur)?dur:1000;
		stp=dur/dy;
		fr=parseInt(dh/stp,10);
		fr=(fr<=1)?1:fr;
		tD.irmFaderFrameRate=fr;
		if(!tD.irmFaderRunning){
			tD.irmFaderRunning=true;
			tD.irmFader=setInterval("P7_IRMfader('"+tD.id+"')",dy);
		}
	}
	else{
		tI.src=tA.href;
		tI.height=document.p7irmpre[tA.p7imindex].height;
		tI.width=document.p7irmpre[tA.p7imindex].width;
		tI.setAttribute('alt',tA.innerHTML);
		P7_IRMdsp_2(dv,bp);
	}
}
function P7_IRMdsp_2(dv,bp){
	var i,tD,sn,tA,dS,dSW,tDD,tDE,tP,tL,dL,ml=false,rl;
	tD=document.getElementById(dv);
	sn=tD.currentSlideNum;
	tA=tD.p7slides[sn-1];
	tDD=tA.parentNode.getElementsByTagName('DIV');
	dS=document.getElementById(tD.id.replace('_','ds_'));
	dSW=document.getElementById(tD.id.replace('_','dsw_'));
	dS.innerHTML='';
	dSW.style.visibility='hidden';
	dL=document.getElementById(tD.id.replace('_','lk_'));
	if(tDD){
		for(i=0;i<tDD.length;i++){
			if(tDD[i].className){
				if(tDD[i].className=='p7irm_link'){
					tL=tDD[i].getElementsByTagName('A');
					if(tL&&tL[0]&&tL[0].href){
						dL.href=tL[0].href;
						dL.setAttribute('title',tL[0].innerHTML);
						ml=true;
						if(tL[0].getAttribute('target')){
							dL.setAttribute('target',tL[0].getAttribute('target'));
						}
						else{
							dL.removeAttribute('target');
						}
						rl=tL[0].getAttribute('rel');
						if(rl&&rl=='new'){
							dL.onclick=function(){
								return P7_IRMopenWin(this);
							};
						}
						else{
							dL.onclick=null;
						}
					}
					else{
						dL.onclick=null;
					}
				}
				if(tDD[i].className=='p7irm_desc'){
					dS.innerHTML=tDD[i].innerHTML;
					tA.irmDesc=true;
					dSW.style.height='auto';
				}
				else{
					tA.irmDesc=false;
				}
			}
		}
	}
	if(!ml){
		dL.removeAttribute('href');
	}
	P7_IRMopenDesc(tD.id,true);
	P7_IRMdsp_3(dv,bp);
}
function P7_IRMdsp_3(dv,bp){
	var tD;
	tD=document.getElementById(dv);
	if(tD.irmMode=='play'&&bp!=1){
		if(!tD.irmResume){
			if(tD.irmShowTimer){
				clearTimeout(tD.irmShowTimer);
			}
			tD.irmShowTimer=setTimeout("P7_IRMcontrol('"+tD.id+"','next',2)",tD.p7opt[5]);
		}
	}
}
function P7_IRMloadImage(dv,ix,bp){
	var tD,im=document.p7irmpre[ix];
	tD=document.getElementById(dv);
	if(im.cmp){
		im.comp=true;
		P7_IRMdsp_1(dv,bp);
	}
	else{
		if(document.p7irmwait){
			clearTimeout(document.p7irmwait);
		}
		tD.p7irmwait=setTimeout("P7_IRMloadImage('"+dv+"',"+ix+","+bp+")",60);
	}
}
function P7_IRMbuild(d){
	var tB,im,a,dv;
	tB=document.getElementById(d.replace('_','w_'));
	im=document.createElement('img');
	im.setAttribute("id",d.replace('_','sim_'));
	im.className='p7IRMimage';
	a=document.createElement('a');
	a.setAttribute("id",d.replace('_','slk_'));
	a.className='p7IRMlink';
	dv=document.createElement('div');
	dv.setAttribute("id",d.replace('_','sdv_'));
	dv.className='p7IRMdv';
	a.appendChild(im);
	dv.appendChild(a);
	dv.style.position="absolute";
	dv.style.zIndex=10;
	dv.style.top='0px';
	dv.style.display='none';
	dv.style.border='0';
	dv.style.padding='0';
	dv.style.margin='0';
	tB.appendChild(dv);
}
function P7_IRMfader(dv){
	var tD,cP,pP,co,po,ulm=99,llm=1,fr;
	tD=document.getElementById(dv);
	fr=tD.irmFaderFrameRate;
	cP=document.getElementById(tD.irmCurrentPanelID);
	pP=document.getElementById(tD.irmPrevPanelID);
	co=cP.irmOpacity;
	po=pP.irmOpacity;
	co+=fr;
	po-=fr;
	if(cP.id==pP.id){
		po=llm;
	}
	co=(co >= ulm)?ulm:co;
	po=(po<=llm)?llm:po;
	cP.irmOpacity=co;
	pP.irmOpacity=po;
	if(!cP.filters){
		cP.style.opacity=(co / 100);
		if(cP.id!=pP.id){
			pP.style.opacity=(po / 100);
		}
	}
	else{
		cP.style.filter='alpha(opacity='+(co)+')';
		if(cP.id!=pP.id){
			pP.style.filter='alpha(opacity='+(po)+')';
		}
	}
	if(co==ulm&&po==llm){
		tD.irmFaderRunning=false;
		clearInterval(tD.irmFader);
		pP.style.display='none';
		if(cP.filters){
			cP.style.filter='';
			pP.style.filter='';
		}
		else{
			pP.style.opacity=1;
			cP.style.opacity=1;
		}
		P7_IRMdsp_2(dv);
	}
}
function P7_IRMglideHeight(d,ac){
	var tD,ch,th,dh,frh,stp,dur=150,dy=15;
	tD=document.getElementById(d);
	if(tD){
		if(ac=='show'){
			if(tD.p7status&&tD.p7status=='open'){
				return;
			}
			else{
				tD.p7status='open';
			}
		}
		else{
			if(tD.p7status&&tD.p7status=='closed'){
				return;
			}
			else{
				tD.p7status='closed';
			}
		}
		if(ac=='show'){
			tD.style.visibility='hidden';
			tD.style.height='auto';
			tD.style.display='block';
		}
		tD.irmTargetLeft=0;
		tD.irmFrameRate=10;
		tD.irmDelay=dy;
		th=(ac=='show')?tD.offsetHeight:0;
		ch=(ac=='show')?0:tD.offsetHeight;
		tD.style.height=ch+'px';
		tD.style.visibility='visible';
		dur=(ac=='show')?250:200;
		stp=dur/dy;
		dh=Math.abs(Math.abs(th)-Math.abs(ch));
		frh=parseInt(dh/stp,10);
		frh=(frh<=1)?1:frh;
		tD.irmTargetHeight=th;
		tD.irmFrameRateHeight=frh;
		if(!tD.irmAnimRunning){
			tD.irmAnimRunning=true;
			tD.irmGlider=setInterval("P7_IRMglider('"+tD.id+"')",tD.irmDelay);
		}
	}
}
function P7_IRMglider(d){
	var tD,tl,th,cl,ch,fr,frh,dy,nl=0,nh=0,op,tt,tp,pc=0.15,m=false;
	tD=document.getElementById(d);
	tl=tD.irmTargetLeft;
	cl=parseInt(tD.style.left,10);
	if(!cl){
		cl=tl;
	}
	fr=tD.irmFrameRate;
	dy=tD.irmDelay;
	th=tD.irmTargetHeight;
	ch=parseInt(tD.style.height,10);
	if(!ch&&ch!==0){
		ch=tD.offsetHeight;
	}
	frh=tD.irmFrameRateHeight;
	if(tl<cl){
		nl=cl-fr;
		nl=(nl<=tl)?tl:nl;
		tD.style.left=nl+'px';
		m=true;
	}
	else if(tl>cl){
		nl=cl+fr;
		nl=(nl>=tl)?tl:nl;
		tD.style.left=nl+'px';
		m=true;
	}
	if(th<ch){
		nh=ch-frh;
		nh=(nh<=th)?th:nh;
		tD.style.height=nh+'px';
		m=true;
	}
	else if(th>ch){
		nh=ch+frh;
		nh=(nh>=th)?th:nh;
		tD.style.height=nh+'px';
		m=true;
	}
	if(!m){
		clearInterval(tD.irmGlider);
		tD.irmAnimRunning=false;
		tD.style.height='auto';
		if(th===0){
			tD.style.visibility="hidden";
		}
	}
}
function P7_IRMpaginator(pG){
	P7_IRMcontrol(pG.irmDiv,pG.irmSlideNum);
	return false;
}
function P7_IRMsetPaginators(d){
	var tD,tA,i,a;
	tD=document.getElementById(d);
	tA=tD.irmPaginators;
	for(i=0;i<tA.length;i++){
		a=document.getElementById(tA[i]);
		if(a){
			P7_IRMremClass(a,'down');
			if(a.irmSlideNum==tD.currentSlideNum){
				P7_IRMsetClass(a,'down');
			}
		}
	}
}
function P7_IRMsetPlay(bt){
	if(bt){
		bt.p7state='play';
		bt.className='pause';
		if(bt.tagName&&bt.tagName=='A'){
			if(bt.firstChild&&bt.firstChild.nodeType==3){
				bt.firstChild.nodeValue='Pause';
			}
		}
	}
}
function P7_IRMsetPause(bt){
	if(bt){
		bt.p7state='pause';
		bt.className='play';
		if(bt.tagName&&bt.tagName=='A'){
			if(bt.firstChild&&bt.firstChild.nodeType==3){
				bt.firstChild.nodeValue='Play';
			}
		}
	}
}
function P7_IRMpausePlay(bb){
	var ac=(bb.p7state=='play')?'pause':'play';
	P7_IRMcontrol(bb.irmDiv,ac);
	return false;
}
function P7_IRMpause(d){
	var tD=document.getElementById(d);
	if(tD){
		tD.irmMode='pause';
		if(tD.irmShowTimer){
			clearTimeout(tD.irmShowTimer);
		}
		P7_IRMsetPause(tD.irmControls[4]);
		P7_IRMsetPause(tD.irmControls[12]);
	}
}
function P7_IRMsetControlStates(d){
	var cs,ts,cl,tD;
	tD=document.getElementById(d);
	cl='off';
	cs=tD.currentSlideNum;
	ts=tD.irmSlideNums;
	if(cs==1){
		P7_IRMsetClass(tD.irmControls[2],cl);
		P7_IRMsetClass(tD.irmControls[3],cl);
	}
	else{
		P7_IRMremClass(tD.irmControls[2],cl);
		P7_IRMremClass(tD.irmControls[3],cl);
	}
	if(cs==ts){
		P7_IRMsetClass(tD.irmControls[5],cl);
		P7_IRMsetClass(tD.irmControls[6],cl);
	}
	else{
		P7_IRMremClass(tD.irmControls[5],cl);
		P7_IRMremClass(tD.irmControls[6],cl);
	}
}
function P7_IRMsetCC(dd,rp,ac){
	var d,tC;
	d=dd.replace('_',rp);
	tC=document.getElementById(d);
	if(tC){
		tC.onclick=function(){
			return P7_IRMcontrol(dd,ac);
		};
	}
	return tC;
}
function P7_IRMsetClass(ob,cl){
	if(ob){
		var cc,nc,r=/\s+/g;
		cc=ob.className;
		nc=cl;
		if(cc&&cc.length>0){
			if(cc.indexOf(cl)==-1){
				nc=cc+' '+cl;
			}
			else{
				nc=cc;
			}
		}
		nc=nc.replace(r,' ');
		ob.className=nc;
	}
}
function P7_IRMremClass(ob,cl){
	if(ob){
		var cc,nc,r=/\s+/g;
		cc=ob.className;
		if(cc&&cc.indexOf(cl>-1)){
			nc=cc.replace(cl,'');
			nc=nc.replace(r,' ');
			nc=nc.replace(/\s$/,'');
			ob.className=nc;
		}
	}
}
function P7_IRMsetSt(d){
	d.style.position='relative';
	d.style.border='0';
	d.style.padding='0';
	d.style.margin='0';
}
function P7_IRMurl(dv){
	var i,h,s,x,d='irm',pn,n=dv.replace("p7IRM_","");
	if(document.getElementById){
		h=document.location.search;
		if(h){
			h=h.replace('?','');
			s=h.split(/[=&]/g);
			if(s&&s.length){
				for(i=0;i<s.length;i+=2){
					if(s[i]==d){
						x=s[i+1];
						if(n!=x.charAt(0)){
							x=false;
						}
						if(x&&x.length>2){
							P7_IRMcontrol(dv,P7_IRMparsePN(x),1);
						}
					}
				}
			}
		}
		h=document.location.hash;
		if(h){
			x=h.substring(1,h.length);
			if(n!=x.charAt(3)){
				x=false;
			}
			if(x&&x.indexOf(d)===0&&x.length>5){
				P7_IRMcontrol(dv,P7_IRMparsePN(x),1);
			}
		}
	}
}
function P7_IRMparsePN(d){
	var x=d.lastIndexOf('_');
	return parseInt(d.substr(x+1));
}
function P7_IRMopenWin(a){
	if(a&&a.href){
		window.open(a.href,'irmwin');
	}
	return false;
}
function P7_IRMrandomize(){
	return 0.5-Math.random();
}
function P7_IRMautoToggle(){
	var i,tA,rel,tB,cl,m=false;
	tA=document.getElementsByTagName("A");
	for(i=0;i<tA.length;i++){
		m=false;
		rel=tA[i].getAttribute('rel');
		if(rel&&rel.indexOf('p7IRM_')==0){
			tA[i].onmousedown=function(){
				var r,j,tD,r,d,md;
				r=this.getAttribute('rel');
				d=document.getElementById(r);
				for(j=0;j<p7IRMctl.length;j++){
					tD=document.getElementById(p7IRMctl[j][0]);
					if(r!=tD.id){
						if(tD.irmMode=='play'){
							tD.irmToggleResume=true;
							P7_IRMctrl(tD.id,'pause');
						}
					}
				}
				if(d.irmToggleResume){
					d.irmToggleResume=false;
					d.irmMode='play';
					P7_IRMsetPlay(d.irmControls[4]);
					P7_IRMsetPlay(d.irmControls[12]);
					if(d.irmShowTimer){
						clearTimeout(d.irmShowTimer);
					}
					d.irmShowTimer=setTimeout("P7_IRMcontrol('"+d.id+"','play')",(d.p7opt[5]/2));
				}
			};
			tB=document.getElementById(rel);
			cl=tA[i].getAttribute('class');
			if(tA[i].p7state){
				if(tA[i].p7state=='closed'){
					m=true;
				}
			}
			else if(cl){
				if(cl.indexOf('down')>-1||cl.indexOf('open')||cl.indexOf('play')>-1){
					if(tB.irmMode!='play'){
						tB.irmToggleResume=false;
						tB.irmMode='play';
						P7_IRMsetPlay(tB.irmControls[4]);
						P7_IRMsetPlay(tB.irmControls[12]);
						if(tB.irmShowTimer){
							clearTimeout(tB.irmShowTimer);
						}
						tB.irmShowTimer=setTimeout("P7_IRMcontrol('"+tB.id+"','play')",(tB.p7opt[5]));
					}
				}
				else{
					m=true;
				}
			}
			else{
				m=true;
			}
			if(m){
				if(tB.irmMode=='play'){
					tB.irmToggleResume=true;
					P7_IRMctrl(tB.id,'pause');
				}
			}
		}
	}
}
