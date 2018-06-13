

/***********************************************

* AnyLink Drop Down Menu- © Dynamic Drive (www.dynamicdrive.com)

* This notice MUST stay intact for legal use

* Visit http://www.dynamicdrive.com/ for full source code

***********************************************/



//More

var menu1=new Array()

menu1[0]='<a href="http://www.casalindacity.com/golf.php">Amfi Golf</a>'

menu1[1]='<a href="http://www.casalindacity.com/flights.php">Flights info</a>'

menu1[2]='<a href="http://www.casalindacity.com/weather.php">Weather and Time</a>'

menu1[3]='<a href="http://www.casalindacity.com/map.php">Maps</a>'

menu1[4]='<a href="http://www.casalindacity.com/partners.php">Partners</a>'

menu1[5]='<a href="http://www.casalindacity.com/email.php">Email</a>'

menu1[6]='<a href="http://www.casalindacity.com/news/administrator/">Edit News (Admin)</a>'


//About us
var menu2=new Array()

menu2[0]='<a href="about.php#mision">Mision</a>'

menu2[1]='<a href="about.php#vision">Vision</a>'

menu2[2]='<a href="about.php#team">Team</a>'


//Villas
var menu3=new Array()

menu3[0]='<a href="http://www.casalindacity.com/typevillas.php">Type of Villas</a>'

menu3[1]='<a href="http://www.casalindacity.com/villas.php">To buy</a>'

menu3[2]='<a href="http://www.casalindacity.com/booking.php">Booking</a>'

menu3[3]='<a href="http://www.casalindacity.com/payment_plan.php">Payment Plan</a>'

//menu3[4]='<a href="floorplan.php">Floor Plans</a>'


//News
var menu4=new Array()

menu4[0]='<a href="news/administrator/">Admin</a>'

//menu4[1]='<a href="news/administrator/">Admin</a>'

//menu4[2]='<a href="golf.php">Golf</a>'

//menu4[3]='<a href="flights.php">Flights info</a>'




var menuwidth='165px' //default menu width

//var menubgcolor='white'  //menu bgcolor
var menubgcolor='#00a8dd' //menu bgcolor

var disappeardelay=250  //menu disappear speed onMouseout (in miliseconds)

var hidemenu_onclick="yes" //hide menu when user clicks within menu?



/////No further editting needed



var ie4=document.all

var ns6=document.getElementById&&!document.all



if (ie4||ns6)

document.write('<div id="dropmenudiv" style="visibility:hidden;width:'+menuwidth+';background-color:'+menubgcolor+'" onMouseover="clearhidemenu()" onMouseout="dynamichide(event)"></div>')



function getposOffset(what, offsettype){

var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;

var parentEl=what.offsetParent;

while (parentEl!=null){

totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;

parentEl=parentEl.offsetParent;

}

return totaloffset;

}





function showhide(obj, e, visible, hidden, menuwidth){

if (ie4||ns6)

dropmenuobj.style.left=dropmenuobj.style.top=-500

if (menuwidth!=""){

dropmenuobj.widthobj=dropmenuobj.style

dropmenuobj.widthobj.width=menuwidth

}

if (e.type=="click" && obj.visibility==hidden || e.type=="mouseover")

obj.visibility=visible

else if (e.type=="click")

obj.visibility=hidden

}



function iecompattest(){

return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body

}



function clearbrowseredge(obj, whichedge){

var edgeoffset=0

if (whichedge=="rightedge"){

var windowedge=ie4 && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-15 : window.pageXOffset+window.innerWidth-15

dropmenuobj.contentmeasure=dropmenuobj.offsetWidth

if (windowedge-dropmenuobj.x < dropmenuobj.contentmeasure)

edgeoffset=dropmenuobj.contentmeasure-obj.offsetWidth

}

else{

var topedge=ie4 && !window.opera? iecompattest().scrollTop : window.pageYOffset

var windowedge=ie4 && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18

dropmenuobj.contentmeasure=dropmenuobj.offsetHeight

if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure){ //move up?

edgeoffset=dropmenuobj.contentmeasure+obj.offsetHeight

if ((dropmenuobj.y-topedge)<dropmenuobj.contentmeasure) //up no good either?

edgeoffset=dropmenuobj.y+obj.offsetHeight-topedge

}

}

return edgeoffset

}



function populatemenu(what){

if (ie4||ns6)

dropmenuobj.innerHTML=what.join("")

}





function dropdownmenu(obj, e, menucontents, menuwidth){

if (window.event) event.cancelBubble=true

else if (e.stopPropagation) e.stopPropagation()

clearhidemenu()

dropmenuobj=document.getElementById? document.getElementById("dropmenudiv") : dropmenudiv

populatemenu(menucontents)



if (ie4||ns6){

showhide(dropmenuobj.style, e, "visible", "hidden", menuwidth)

dropmenuobj.x=getposOffset(obj, "left")

dropmenuobj.y=getposOffset(obj, "top")

dropmenuobj.style.left=(dropmenuobj.x-clearbrowseredge(obj, "rightedge")-0)+"px"

dropmenuobj.style.top=(dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+obj.offsetHeight+5)+"px"

}



return clickreturnvalue()

}



function clickreturnvalue(){

if (ie4||ns6) return false

else return true

}



function contains_ns6(a, b) {

while (b.parentNode)

if ((b = b.parentNode) == a)

return true;

return false;

}



function dynamichide(e){

if (ie4&&!dropmenuobj.contains(e.toElement))

delayhidemenu()

else if (ns6&&e.currentTarget!= e.relatedTarget&& !contains_ns6(e.currentTarget, e.relatedTarget))

delayhidemenu()

}



function hidemenu(e){

if (typeof dropmenuobj!="undefined"){

if (ie4||ns6)

dropmenuobj.style.visibility="hidden"

}

}



function delayhidemenu(){

if (ie4||ns6)

delayhide=setTimeout("hidemenu()",disappeardelay)

}



function clearhidemenu(){

if (typeof delayhide!="undefined")

clearTimeout(delayhide)

}



if (hidemenu_onclick=="yes")

document.onclick=hidemenu