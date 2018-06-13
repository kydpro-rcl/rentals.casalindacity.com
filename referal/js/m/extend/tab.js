/* --- Script and noscript ---- */
function ResetShortcuts() {

}
function initTabs() {
	document.body.className = "javascript";
	document.getElementById('content1').style.visibility = 'visible';
	}


/* --- Preload and image swapping --- */	

function MM_preloadImages() { //v3.0
	var d = document;
	if (d.images) {
		if (!d.MM_p) d.MM_p=new Array();
		var i,j = d.MM_p.length, a = MM_preloadImages.arguments;
		for (i = 0; i < a.length; i ++) {
			if (a[i].indexOf("#") != 0) {
				d.MM_p[j] = new Image;
				d.MM_p[j ++].src = a[i];
			}
		}
	}
}

function MM_swapImgRestore() { //v3.0
	var i, x, a = document.MM_sr;
	for (i = 0; a && i < a.length && (x = a[i]) && x.oSrc; i ++) {
		x.src = x.oSrc;
	}
}

function MM_findObj(n, d) { //v4.01
	var p, i, x;
	if (!d) d=document;
	if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
		d = parent.frames[n.substring(p + 1)].document;
		n = n.substring(0,p);
	}
	if (!(x = d[n]) && d.all) x = d.all[n];
	for (i = 0; !x && i < d.forms.length; i ++) x = d.forms[i][n];
	for (i = 0; !x && d.layers && i < d.layers.length; i ++) x = MM_findObj(n,d.layers[i].document);
	if (!x && d.getElementById) x = d.getElementById(n);
	return x;
}

function MM_swapImage() { //v3.0
	var i, j = 0, x, a = MM_swapImage.arguments;
	document.MM_sr = new Array;
	for (i = 0; i < (a.length - 2); i += 3) {
		if ((x = MM_findObj(a[i])) != null) {
			document.MM_sr[j ++] = x;
			if (!x.oSrc) x.oSrc = x.src;
			x.src = a[i + 2];
		}
	}
}


/* --- Thumbs --- */

var gNavContents = new Array;
var gNavTables = [];

function showNavTab(num) {		
	if (document.body.onload || window.onload) {		
		for(i=1;i<4;i++) document.getElementById('content'+i).style.visibility = (num == i ? "visible" : "hidden");
	}	
}
function showNavTabh(num) {		
	if (document.body.onload || window.onload) {	
		for(i=1;i<4;i++){
		document.getElementById('tm'+i).style.backgroundColor = "#58A41C";
		document.getElementById('tm'+i).style.color = "white";
		document.getElementById('tm'+num).style.backgroundColor = "#f4ec6f";
		document.getElementById('tm'+num).style.color = "black";
		/*document.getElementById('tm'+i).style.backgroundColor = "#58A41C";
		document.getElementById('tm'+i).style.color = "white";
		document.getElementById('tm'+num).style.backgroundColor = "white";
		document.getElementById('tm'+num).style.color = "black";*/
		}
	}	
}
function cont(num) {		
	if (document.body.onload || window.onload) {		
		return num;
	}	
}

/* --- Resize tab width for Internet Explorer --- */

function reloadPage(init) {
	if (init == true) with (navigator) {
		if ((appName == "Netscape") && ((parseInt(appVersion) == 4) || (parseInt(appVersion) == 5))) {
			document.pgW = innerWidth;
			document.pgH = innerHeight;
			onresize = reloadPage;
		}
		if (appName == "Microsoft Internet Explorer" || appName == "Opera" || appName == "Konqueror") {
			onresize = reloadPage;
		}
	} else if (navigator.appName == "Netscape") {
		if (innerWidth != document.pgW || innerHeight != document.pgH) {
			location.reload();
		}
	} else if (navigator.appName == "Microsoft Internet Explorer" || navigator.appName == "Opera" || navigator.appName == "Konqueror") {
		location.reload();
	}
}

reloadPage(true);