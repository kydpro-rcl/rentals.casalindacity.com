 //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//  function checkForm(formitem)
//  is used for form validation
//==============================================================================================
//
//  reference
//  =========
//
//  Include this file on top outside the form and add 
//  'onSubmit="return(checkForm(this));"' to the form tag.
//
//  There are 3 methods to show the validation message:
//  ---------------------------------------------------
//  1) You can define a tag (e.g. <span></span>) with the name of the element itself plus a "m" 
//  (e.g. id="firstnamem") in which the error will be printed. 
//  2) If you want to output multiple errors in only one field, then set the "valgroup"
//  attribute to the id of the output tag. 
//  3) If there is neither of both defined, the output will be alerted with javascript.
//
//  For 1) and 2) you can also define a css class with the element css class plus an "err" (e.g. textboxerr), 
//  that is used to highlight the field with the validation failure. The css class "errorfont" 
//  can be created to define the layout of the message itself.
//
//  Checks:
//  -------
//  Checks are specified by additional attributes to the element tags:
//  valtype => 					defines the validation type(s). Multiple checks are separated
//						 					by commas. Allowed values:
//						 					- mandatory (fails if the field is empty)
//						 					- number
//						 					- integer
//						 					- email
//						 					- custom (expects the attribute "valcustom" that is
//						   					eval()-compared with the value of the field)
//						 					- expression (expects the attribute "valexpr" that is interpreted with
//						   					eval())
//  valmsg => 				 	defines the error message for a failed validation. If not set a standard
//										 	message will be outputted.
//  valdependent		=> 	defines that the field will only be checked if ALL of the dependent
//										 	fields pass the condition/check that is set in <fieldname>=<valtype>
//  valdependentone => 	defines that the field will only be checked if ONE of the dependent
//										 	fields passes the condition/check that is set in <fieldname>=<valtype>
//
//  examples
//  ========
//
//  1) simple: check email address
//  ---------------------------------------
//  <input type="text" name="email" valtype="email">									<!-- message will be shown as a javascript message box (alert)-->
//  
//  2) advanced: conditional password check
//  ---------------------------------------
//  <input type="checkbox" name="protect_with_password" value="yes">	<!-- not directly validated -->
//  <input  type="text" 																							<!-- only validated if "protect_with_password" is checked -->
//				 	name="password1" 
//					class="textbox"
//					valtype="mandatory,custom"
//					valcustom="== document.getElementById('password2').value"
//					valmsg="empty password or passwords do not match" 
//					valdependentone="protect_with_password" 
//					protect_with_password="mandatory">
//  <input type="text" id="password2">																<!-- not validated -->
//  <span id="passwordm"></span>																			<!-- where "valmsg" will be printed -->
//

	var fields     = new Array();
	var cssclasses;
	var cform;
	var errorclass;
	var field;
	var dialogmsg;


// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ independend functions:

function ltrim(str) { 
  for (var k=0; k<str.length && str.charAt(k)<=" " ; k++);
  return str.substring(k,str.length);
  }
  
function rtrim(str) {
  for (var j=str.length-1; j>=0 && str.charAt(j)<=" " ; j--);
  return str.substring(0,j+1);
  }
  
function trim(str) {
  return ltrim(rtrim(str));
  }

function isElement(elid) {
	return(document.getElementById(elid));
	}

function hasFormChanged(formobj) {
	var i1, i2	 = false;
	for (i1 = 0; i1 < formobj.elements.length; i1++) {
		if (formobj.elements[i1].tagName == 'SELECT') {
			for (i2 = 0; i2 < formobj.elements[i1].options.length; i2++) {
				if (formobj.elements[i1].options[i2].defaultSelected != formobj.elements[i1].options[i2].selected) {
					return(true);
				  }
			  }	
			}
		else if ((formobj.elements[i1].type == 'radio') || (formobj.elements[i1].type == 'checkbox')) {
			if (formobj.elements[i1].defaultChecked != formobj.elements[i1].checked) {
				return(true);
				}		
			}
		else {
			if (formobj.elements[i1].defaultValue != formobj.elements[i1].value) {
				return(true);
				}			
			}
		}
	return(false);
	}
	
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


// ==================================================================== form validation:
  

function checkForm(formitem) {
	var i1 		= 0;
	dialogmsg = '';
	fields 		= new Array();
	cform  		= formitem;
	if (!cssclasses) {
		cssclasses = new Array();
		var firstrun = true;
	  }
	for (i1 = 0; i1 < cform.elements.length; i1++) {
		// store original css class names:
		if (firstrun) {
		  cssclasses[cform.elements[i1].name] = cform.elements[i1].className;
			}
		// check what is to validate:
		getValidationVars(cform.elements[i1]);	
		}
	// validation:
	return(doValidation());
	}

function getValidationVars(el) {
	var i1 = 0;
	if (areDependenciesValid(el)) {
		if (el.getAttribute('valtype')) {
			if (!fields[el.nodeName.toUpperCase()]) {
		    fields[el.nodeName.toUpperCase()] = new Array();
		    }
			var vtypes 			= el.getAttribute('valtype').split(',');
			for (i1 = 0; i1 < vtypes.length; i1++) {
				var check      = new Array();
				check['name']  = el.name;
				check['type']  = vtypes[i1];
				check					 = getNewErrorMsg(check, el);
				check					 = resetOldErrorMsg(check, el);
				if (el.getAttribute('valcustom')) { 
					check['valcustom'] = el.getAttribute('valcustom'); 
					}
			  fields[el.nodeName.toUpperCase()].push(check);
			  }
			}
	  }
	}

function resetOldErrorMsg(check, el) {
	if ((el.getAttribute('valgroup')) && (isElement(el.getAttribute('valgroup') + 'm'))) {
		document.getElementById(el.getAttribute('valgroup') + 'm').innerHTML = '';
		}
	else if (isElement(check['name'] + 'm')) {
		document.getElementById(check['name'] + 'm').innerHTML = '';
		}	
	switch (el.nodeName.toUpperCase()) {
	  case "INPUT":
			switch (el.getAttribute('type')) {
	  		case "checkbox":
	  			break;
	  		default:
				  el.className = cssclasses[el.name];
				  break;
	  		}
		case "SELECT":
		  break;
		default:
		  el.className = cssclasses[el.name];
		  break;
		}	 
	return(check);
	}

function getNewErrorMsg(check, el) {
	check['msg']	 = 'invalid value';
	if (el.getAttribute('valmsg')) {
		check['msg'] = el.getAttribute('valmsg');
		}
	if (el.getAttribute('valgroup')) {
		check['valgroup'] = el.getAttribute('valgroup');
	  }
	return(check);
	}

function doValidation() {
	var retval = true;
	var i1 = 0;
	for (var key in fields) {
		for (i1 = 0; i1 < fields[key].length; i1++) {			   
	    if (!checkElement(fields[key][i1], key)) {
	    	retval = false;
	    	}	    
	    }
	  }
	if (dialogmsg) {
		alert(dialogmsg);
	  }
	return(retval);
	}

// ==================================================================== field validation:

function checkElement(check, eltagname) {
	var ok 		 = false;	
	errorclass = false;
	field 		 = cform.elements[check['name']];
	if(!field.disabled){
		val 		 = getElementValue(eltagname, field.getAttribute('type')); 	
		ok			 = checkValue(check, val);
		if (!ok) {
			printErrorMsg(check);
			}
		return(ok);
	} else {
		return true;	
	}
}

function getElementValue(eltagname, eltype) {
	val = false;
	switch (eltagname) {
	  case "INPUT":
			switch (eltype) {
	  		case "checkbox":
			    val				 = field.checked;	
	  			break;
	  		case "text":
			    val				 = field.value;	
		  		errorclass = cssclasses[field.name] + 'err';
	  			break;
	  		case "file":
			    val				 = field.value;	
		  		errorclass = cssclasses[field.name] + 'err';
	  			break;
	  		}
	    break;
	  case "TEXTAREA":
	    val				 = field.value;	
		  errorclass = cssclasses[field.name] + 'err';
	    break;
		case "SELECT":
		  val = field.options[field.selectedIndex].value;
		  break;
		}	
  return(val);
  }

function printErrorMsg(check) {	
	var fieldmsg, comma, lbreak = '';
	if (errorclass) {
    field.className = errorclass;
		}
	if ((check['valgroup']) && (isElement(check['valgroup'] + 'm'))) {
	  fieldmsg  = document.getElementById(check['valgroup'] + 'm');
  	if (fieldmsg.innerHTML) {
  	  comma  = ', ';
  	  }
	  fieldmsg.innerHTML += '<font class=\"errorfont\">'+ comma + check['msg'] + '</font>';
	  }
	else if (isElement(check['name'] + 'm')) {
	  fieldmsg  = document.getElementById(check['name'] + 'm');
	  fieldmsg.innerHTML = '<font class=\"errorfont\">' + check['msg'] + '</font>';
		}		
	else {
  	if (dialogmsg) {
  	  lbreak = "\r\n";
  	  }
	  dialogmsg += lbreak + check['msg'];
	  }
	}

function checkValue(check, val) {	
	var ok 		 = false;	
	switch (trim(check['type'].toLowerCase())) {
	  case "mandatory":
	    ok = checkMandatory(val);
	    break;
	  case "number":
	    ok = checkNumber(val);
	    break;
	  case "integer":
	    ok = checkInteger(val);
	    break;
	  case "email":
	    ok = checkEmail(val);
	    break;
		case "custom":
			ok = checkCustom(val, check['valcustom']);
		  break;
		}	  	
	return(ok);
	}

// ==================================================================== Dependencies between fields:


function areDependenciesValid(el) {	
	if (el.getAttribute('valdependent')) { 
		if (!areDependenciesActive(el, el.getAttribute('valdependent').split(','))) {
			var check      = new Array();
			check['name']  = el.name;
			check					 = resetOldErrorMsg(check, el);
			return(false);
			}
		}
	if (el.getAttribute('valdependentone')) { 
		if (!isOneOfDependenciesActive(el, el.getAttribute('valdependentone').split(','))) {
			var check      = new Array();
			check['name']  = el.name;
			check					 = resetOldErrorMsg(check, el);
			return(false);
			}
		}
	return(true);
	}

// loops through dependencies, true if ALL are valid:
function areDependenciesActive(el, dependencies) {
	var i1,i2  			= 0;
	var depcheckarr = new Array;
	for (i1 = 0; i1 < dependencies.length; i1++) {
		if (el.getAttribute(dependencies[i1])) {
			var depchecks = el.getAttribute(dependencies[i1]).split(',');
			for (i2 = 0; i2 < depchecks.length; i2++) {
				depcheckarr['type'] = depchecks[i2];
				field 		 					= cform.elements[dependencies[i1]];
				if (!checkValue(depcheckarr, getElementValue(field.nodeName, field.getAttribute('type')))) {
					return(false);
					}
			  }
			}		
	  }	
	return(true);
	}

// loops through dependencies, true if at least ONE is valid:
function isOneOfDependenciesActive(el, dependencies) {
	var res 				= false;
	var i1,i2  			= 0;
	var depcheckarr = new Array;
	for (i1 = 0; i1 < dependencies.length; i1++) {
		if (el.getAttribute(dependencies[i1])) {
			var depchecks = el.getAttribute(dependencies[i1]).split(',');
			for (i2 = 0; i2 < depchecks.length; i2++) {
				depcheckarr['type'] = depchecks[i2];
				field 		 					= cform.elements[dependencies[i1]];
				if (checkValue(depcheckarr, getElementValue(field.nodeName, field.getAttribute('type')))) {
					return(true);
					}
			  }
			}		
	  }	
	return(false);
	}

// ==================================================================== check routines:
		
function checkMandatory(val) {
	return(val != '');
	}

function checkNumber(val) {
	return(!isNaN(val));
	}

function checkInteger(val) {
  var res;
  res = !isNaN(val);	
	if (res) {
		var mod = val % 1;
		res = (mod == 0);
		}	
	return(res);
	}
	
function checkEmail(val) {
	var at="@"
	var dot="."
	var lat=val.indexOf(at)
	var lstr=val.length
	var ldot=val.indexOf(dot)
	if (val.indexOf(at)==-1)																							 		{ return false; }
	if (val.indexOf(at)==-1 || val.indexOf(at)==0 || val.indexOf(at)==lstr)		{ return false; }
	if (val.indexOf(dot)==-1 || val.indexOf(dot)==0 || val.indexOf(dot)==lstr){ return false; }
	if (val.indexOf(at,(lat+1))!=-1)																					{ return false; }
	if (val.substring(lat-1,lat)==dot || val.substring(lat+1,lat+2)==dot)			{ return false; }
	if (val.indexOf(dot,(lat+2))==-1)																					{ return false; }	
	if (val.indexOf(" ")!=-1)																									{ return false; }
  return true;
  }				

function checkCustom(val, expression) {
	return(eval(val + expression));
	}			