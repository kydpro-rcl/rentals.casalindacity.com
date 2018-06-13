!function (t, e, a, i) {
	var s = function (t, e, a) {
		this.dynsiteId = t,
		this.adminCustDataId = e,
		this.pageDataId = a,
		this.unavailableTypes = [1, 4, 5, 6, 7, 8, 9, 10],
		this.unavailableDateObjs = [],
		this.queriedYears = []
	};
	s.prototype.getCalendarData = function (t, e, i) {
		var s = this;
		s.xhr && 4 != s.xhr.readystate && (s.xhr.abort(), s.xhr = null),
		this.queriedYears.push(new Date(t).getFullYear()),
		s.xhr = a.ajax({
				type: "get",
				url: LIVEREZ.DynsiteFunctions.getServerName() + "/inc/api/webservices.aspx?method=propertycalendardata",
				data: {
					AdminCustDataID: s.adminCustDataId,
					DynSiteID: s.dynsiteId,
					PageDataID: s.pageDataId,
					ad: t,
					dd: e
				},
				dataType: "json",
				success: function (t) {
					t.forEach(function (t) {
						(s.unavailableTypes.indexOf(parseInt(t.calendarDayTypes)) > -1 || 2 === parseInt(t.calendarDayTypes) && 1 === parseInt(t.earlyCheckIn) || 3 === parseInt(t.calendarDayTypes) && 1 === parseInt(t.lateCheckOut)) && s.unavailableDateObjs.push(new Date(t.startDate.split("T")[0].replace(/-/g, "/")))
					}),
					s.unavailableDateObjs = s.unavailableDateObjs.filter(function (t, e, a) {
							return a.indexOf(t) >= e
						}),
					i()
				},
				error: function (t, e, i) {
					a(".datepicker-overlay").remove(),
					console.log(t),
					console.log(e),
					console.log(i)
				}
			})
	},
	s.prototype.findDateConflicts = function (t, e) {
		for (var a = !1, t = new Date(LIVEREZ.DynsiteFunctions.fixEuroDatesForAPI(t, dateFormatType)), e = new Date(LIVEREZ.DynsiteFunctions.fixEuroDatesForAPI(e, dateFormatType)), i = 0; i < this.unavailableDateObjs.length; i++) {
			var s = this.unavailableDateObjs[i];
			s >= t && e >= s && (a = !0)
		}
		return a
	},
	t.CalendarAvailability = s
}
(this.LIVEREZ = this.LIVEREZ || {}, this, lrjQ), function (t, e, a, i) {
	var s = {};
	s.PopUp = function (t, a, i, s, r, n) {
		e.open(t, a, "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=" + i + ",height=" + s + ",left=" + r + ",top=" + n)
	},
	s.socialSharePage = function (t, a, i) {
		var s,
		r = encodeURIComponent(e.location.href).toString();
		switch (a = encodeURIComponent(a), i = encodeURIComponent(i), t) {
		case "facebook":
			s = "https://www.facebook.com/sharer.php?u=" + r;
			break;
		case "twitter":
			s = "https://twitter.com/intent/tweet?source=tweetbutton&text=" + i + "&url=" + r;
			break;
		case "pinterest":
			s = "https://www.pinterest.com/pin/create/button/?url=" + r + "&media=" + a + "&description=" + i;
			break;
		case "googlePlus":
			s = "https://plus.google.com/share?url=" + r
		}
		this.PopUp(s, e, 400, 350)
	},
	s.isEmailAddr = function (t) {
		var e = !1,
		a = new String(t),
		i = a.indexOf("@");
		if (i > 0) {
			var s = a.indexOf(".", i);
			s > i + 1 && a.length > s + 1 && (e = !0)
		}
		return e
	},
	s.validRequired = function (t, e) {
		var a = !0;
		return "" == t.value && (alert('Please enter a value for the "' + e + '" field.'), t.focus(), a = !1),
		a
	},
	s.allDigits = function (t) {
		return this.inValidCharSet(t, "0123456789")
	},
	s.inValidCharSet = function (t, e) {
		for (var a = !0, i = 0; i < t.length; i++)
			if (e.indexOf(t.substr(i, 1)) < 0) {
				a = !1;
				break
			}
		return a
	},
	s.validEmail = function (t, e, a) {
		var i = !0;
		return a && !this.validRequired(t, e) && (i = !1),
		i && (t.value.length < 3 || !this.isEmailAddr(t.value)) && (alert("Please enter a complete email address in the form: yourname@yourdomain.com"), t.focus(), i = !1),
		i
	},
	s.validNum = function (t, e, a) {
		var i = !0;
		return a && !this.validRequired(t, e) && (i = !1),
		i && (this.allDigits(t.value) || (alert('Please enter a number for the "' + e + '" field.'), t.focus(), i = !1)),
		i
	},
	s.validInt = function (t, e, a) {
		var i = !0;
		if (a && !this.validRequired(t, e) && (i = !1), i) {
			var s = parseInt(t.value, 10);
			isNaN(s) && (alert('Please enter a number for the "' + e + '" field.'), t.focus(), i = !1)
		}
		return i
	},
	s.validDate = function (t, e, a) {
		var i = !0;
		if (a && !this.validRequired(t, e) && (i = !1), i) {
			var s = t.value.split("/");
			if (i = 3 == s.length) { {
					var r = parseInt(s[0], 10),
					n = parseInt(s[1], 10);
					parseInt(s[2], 10)
				}
				i = allDigits(s[0]) && r > 0 && 13 > r && allDigits(s[1]) && n > 0 && 32 > n && allDigits(s[2]) && (2 == s[2].length || 4 == s[2].length)
			}
			i || (alert('Please enter a date in the format MM/DD/YYYY for the "' + e + '" field.'), t.focus())
		}
		return i
	},
	s.getServerName = function () {
		return e.location.origin ? e.location.origin : e.location.protocol + "//" + e.location.hostname + (e.location.port ? ":" + e.location.port : "")
	},
	s.goPropertyByElem = function (t) {
		var a = t.options[t.selectedIndex].value;
		"" != a && (e.parent.location.href = a)
	},
	s.goPropertyByID = function (t) {
		t && (e.parent.location.href = "vacation-rental-home.asp?PageDataID=" + t)
	},
	s.sendtofriend = function (t) {
		e.parent.location.href = "vacation-rental-home-stf.asp?PageDataID=" + t
	},
	s.propertycontact = function (t, a, i) {
		e.parent.location.href = "vacation-rental-home-contact.asp?PageDataID=" + t + "&ad=" + a + "&dd=" + i
	},
	s.viewproperty = function (t, e) {
		var a = document.viewproperty;
		a.action = "/vacation-rental-home.asp?PageDataID=" + t,
		a.PageDataID.value = t,
		a.WebReferencePageDataID.value = t,
		a.InventoryUnitDataID.value = e,
		a.submit()
	},
	s.debounce = function (t, e, a) {
		var i;
		return function () {
			var s = this,
			r = arguments,
			n = function () {
				i = null,
				a || t.apply(s, r)
			},
			o = a && !i;
			clearTimeout(i),
			i = setTimeout(n, e),
			o && t.apply(s, r)
		}
	},
	s.DateShort = function (t, e) {
		var a = new Date(t);
		return e = e || "/",
		a = a.getMonth() + 1 + e + a.getDate() + e + a.getFullYear()
	},
	s.handleNavisCookies = function (t, e) {
		"" !== t && "" !== e && (LIVEREZ.Storage.set(DYN_SITE_ID + "navis800Num", e), LIVEREZ.Storage.set(DYN_SITE_ID + "NavisHiddenKeywordVal", t), this.fix800NumberForNavis()),
		LIVEREZ.Storage.get(DYN_SITE_ID + "navis800Num") && this.fix800NumberForNavis()
	},
	s.fix800NumberForNavis = function () {
		var t = LIVEREZ.Storage.get(DYN_SITE_ID + "navis800Num"),
		e = LIVEREZ.Storage.get(DYN_SITE_ID + "NavisHiddenKeywordVal");
		a(".phone-link").attr("href", "tel: " + t),
		a(".800PhoneHolder").text(t);
		var i = a("#NavisHiddenKeyword");
		e && i && i.val(e);
		var s = a("#NavisCode");
		s && t && s.val(t)
	},
	s.handleCRMPlusCookies = function (t) {
		LIVEREZ.Storage.get(DYN_SITE_ID + "LeadID") ? this.insertLeadCookie() : "" !== t && (LIVEREZ.Storage.set(DYN_SITE_ID + "LeadID", t), this.insertLeadCookie())
	},
	s.insertLeadCookie = function () {
		var t = LIVEREZ.Storage.get(DYN_SITE_ID + "LeadID"),
		e = a(".hiddenLeadID");
		t && e && e.val(t)
	},
	s.fixEuroDatesForAPI = function (t, e) {
		if (1 === e) {
			var a = t.split("/");
			return a[1] + "/" + a[0] + "/" + a[2]
		}
		return t
	},
	s.dateObjectToString = function (t) {
		return t.getMonth() + 1 + "/" + t.getDate() + "/" + t.getFullYear()
	},
	s.truncate = function (t, e, a) {
		var i = t.substring(0, e);
		return t.length > e && a && (i += "..."),
		i
	},
	s.daydiff = function (t, e) {
		return (e - t) / 864e5
	},
	s.checkValidStartEndDates = function (t, e) {
		var a = (new Date).setHours(0, 0, 0, 0);
		t = new Date(t).setHours(0, 0, 0, 0),
		e = new Date(e).setHours(0, 0, 0, 0);
		var i = this.daydiff(t, e),
		s = maxWebRentalDays || 365;
		return t === e ? "Arrival and Departure dates cannot be the same." : a > t ? "Arrival date must be in the future." : a > e ? "Departure date must be in the future." : t >= e ? "Departure date must come after arrival date." : i > s ? "Travel Dates cannot span more than " + s + " days. Please contact us for additional booking options." : void 0
	},
	s.isMobileDevice = function () {
		var t = !1;
		return function (e) {
			(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(e) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(e.substr(0, 4))) && (t = !0)
		}
		(navigator.userAgent || navigator.vendor || e.opera),
		t
	},
	s.checkForEmailElementToHide = function () {
		var t = document.getElementById("email-div");
		t && (t.style.display = "none")
	},
	t.DynsiteFunctions = s
}
(this.LIVEREZ = this.LIVEREZ || {}, this, lrjQ), $(window).load(function () {
	LIVEREZ.DynsiteFunctions.checkForEmailElementToHide()
}), function (t, e, a) {
	t.events = {
		searchCreateMapImage: "search-map-image",
		searchClearFilters: "search-clear-filters",
		searchMapOpen: "search-map-open",
		searchMapClose: "search-map-close",
		searchStart: "search-start",
		searchComplete: "search-complete",
		instantQuoteFinished: "instant-quote-finished",
		calDataFinished: "cal-data-finished",
		searchSuggestionsStart: "search-suggesttions-start",
		searchSuggestionsComplete: "search-suggesttions-complete",
		calendarSearchStart: "calendar-search-start",
		calendarSearchComplete: "calendar-search-complete"
	}
}
(this.LIVEREZ = this.LIVEREZ || {}, this, lrjQ), Array.prototype.filter || (Array.prototype.filter = function (t) {
	"use strict";
	if (void 0 === this || null === this)
		throw new TypeError;
	var e = Object(this),
	a = e.length >>> 0;
	if ("function" != typeof t)
		throw new TypeError;
	for (var i = [], s = arguments.length >= 2 ? arguments[1] : void 0, r = 0; a > r; r++)
		if (r in e) {
			var n = e[r];
			t.call(s, n, r, e) && i.push(n)
		}
	return i
}), Array.prototype.forEach || (Array.prototype.forEach = function (t, e) {
	var a,
	i;
	if (null == this)
		throw new TypeError(" this is null or not defined");
	var s = Object(this),
	r = s.length >>> 0;
	if ("function" != typeof t)
		throw new TypeError(t + " is not a function");
	for (arguments.length > 1 && (a = e), i = 0; r > i; ) {
		var n;
		i in s && (n = s[i], t.call(a, n, i, s)),
		i++
	}
}), Array.prototype.indexOf || (Array.prototype.indexOf = function (t, e) {
	if (void 0 === this || null === this)
		throw new TypeError('"this" is null or not defined');
	var a = this.length >>> 0;
	for (e = +e || 0, Math.abs(e) === 1 / 0 && (e = 0), 0 > e && (e += a, 0 > e && (e = 0)); a > e; e++)
		if (this[e] === t)
			return e;
	return -1
}), Function.prototype.bind || (Function.prototype.bind = function (t) {
	if ("function" != typeof this)
		throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");
	var e = Array.prototype.slice.call(arguments, 1),
	a = this,
	i = function () {},
	s = function () {
		return a.apply(this instanceof i && t ? this : t, e.concat(Array.prototype.slice.call(arguments)))
	};
	return i.prototype = this.prototype,
	s.prototype = new i,
	s
}), function (t, e, a, i) {
	"use strict";
	var s = {};
	s.localStoreSupport = function () {
		try {
			return localStorage.setItem("localstoragesupporttest", 1),
			localStorage.removeItem("localstoragesupporttest"),
			"localStorage" in e && e.localStorage
		} catch (t) {
			return !1
		}
	},
	s.set = function (t, e, a) {
		if (e = JSON.stringify(e), a) {
			var i = new Date;
			i.setTime(i.getTime() + 24 * a * 60 * 60 * 1e3);
			var s = "; expires=" + i.toGMTString()
		} else
			var s = "";
		this.localStoreSupport() ? localStorage.setItem(t, e) : document.cookie = t + "=" + e + s + "; path=/"
	},
	s.get = function (t) {
		if (!this.localStoreSupport()) {
			for (var e = t + "=", a = document.cookie.split(";"), i = 0; i < a.length; i++) {
				for (var s = a[i]; " " == s.charAt(0); )
					s = s.substring(1, s.length);
				if (0 == s.indexOf(e))
					return JSON.parse(s.substring(e.length, s.length))
			}
			return null
		}
		return this.exists(t) ? JSON.parse(localStorage.getItem(t)) : void 0
	},
	s.remove = function (t) {
		this.localStoreSupport() ? this.exists(t) && localStorage.removeItem(t) : this.set(t, "", -1)
	},
	s.exists = function (t) {
		return null !== localStorage.getItem(t)
	},
	t.Storage = s
}
(this.LIVEREZ = this.LIVEREZ || {}, this, lrjQ), function (t, e, a, i) {
	var s = {},
	r = {},
	n = -1;
	s.publish = function (t, e) {
		if (!r[t])
			return !1;
		for (var a = r[t], i = a ? a.length : 0; i--; )
			a[i].func(t, e);
		return this
	},
	s.subscribe = function (t, e) {
		r[t] || (r[t] = []);
		var a = (++n).toString();
		return r[t].push({
			token: a,
			func: e
		}),
		a
	},
	s.unsubscribe = function (t) {
		for (var e in r)
			if (r[e])
				for (var a = 0, i = r[e].length; i > a; a++)
					if (r[e][a].token === t)
						return r[e].splice(a, 1), t;
		return this
	},
	t.Publisher = s
}
(this.LIVEREZ = this.LIVEREZ || {}, this, lrjQ), function (t, e) {
	"use strict";
	var a,
	i = {
		timeoutLength: 500,
		dataSource: function (e, a) {
			var i = {
				q: encodeURIComponent(a)
			};
			t.ajax({
				type: "GET",
				url: "data/properties.json",
				data: i,
				dataType: "json",
				success: function (t) {
					e(null, t)
				},
				error: function (t, a, i) {
					e({
						data: t,
						status: a,
						error: i
					})
				}
			})
		},
		onNewData: function (t) {
			console.log(t)
		}
	},
	s = function (e) {
		return this.each(function () {
			var a = t(this),
			s = "object" == typeof e && e;
			s = t.extend(i, s),
			new r(a, s)
		})
	},
	r = function (t, e) {
		this.element = t,
		this.options = e,
		this.init(this.element, this.options)
	};
	r.prototype.init = function (e, i) {
		var s = this,
		r = t("<div/>").css({
				position: "relative",
				width: this.element.width() + 2
			}).addClass("lr-typeahead-wrapper"),
		n = t("<div/>");
		n.css({
			position: "absolute",
			top: this.element.outerHeight(),
			left: "0",
			width: "100%",
			display: "none",
			border: "1px solid #ccc",
			"border-top": "none",
			background: "white",
			color: "#444",
			"max-height": "150px",
			"overflow-y": "scroll"
		}).html("Loading Data...").addClass("lr-typeahead"),
		this.element.wrap(r),
		this.element.after(n),
		e.on("keydown", function () {
			s.open("keydown", n, s.element)
		}),
		e.on("keyup", function () {
			s.element.val() ? (a && clearTimeout(a), a = setTimeout(function () {
						s.getData("keyup", function (t, e) {
							t ? n.html("No Results") : s.insertTypeAheadData(n, e)
						})
					}, s.options.timeoutLength)) : s.close("keyup", n)
		})
	},
	r.prototype.open = function (e, a, i) {
		var s = a.get(0);
		a.html("Loading Data..."),
		"none" === s.style.display && (t("body").on("click", function (e) {
				a.is(e.target) || 0 !== a.has(e.target).length || (s.style.display = "none", i.val("")),
				t("body").off("click")
			}), s.style.display = "block")
	},
	r.prototype.close = function (t, e) {
		var a = e.get(0);
		return "block" === a.style.display && (a.style.display = "none"),
		this
	},
	r.prototype.insertTypeAheadData = function (t, e) {
		var a = this;
		return t.empty(),
		t.append(a.options.onNewData(e)),
		this
	},
	r.prototype.getData = function (t, e) {
		var a = this;
		return a.options.dataSource(e, a.element.val()),
		this
	};
	t.fn.lrtypeahead;
	t.fn.lrtypeahead = s,
	t.fn.lrtypeahead.Constructor = r
}
(lrjQ), function (t, e, a) {
	a(document).ready(function () {
		var t = new Date,
		e = new Date(t.getFullYear(), t.getMonth(), t.getDate(), 0, 0, 0, 0);
		a(".datepicker-range").datepicker({
			beforeShowDay: function (t) {
				return t.valueOf() < e.valueOf() ? "disabled" : ""
			},
			format: dateFormat,
			autoclose: !0,
			orientation: "auto"
		}).on("changeDate", function (t) {
			if ("txtStartDate" == t.target.id) {
				var e = new Date(t.date);
				e.setDate(e.getDate() + defaultSearchDepartureDays),
				a("#txtEndDate").datepicker("setDate", e),
				a("#txtEndDate").focus()
			}
			"txtStartDate" == t.target.id
		}).data("datepicker"),
		a(".lr-calendar-search-desktop-datepicker").datepicker({
			beforeShowDay: function (t) {
				return t.valueOf() < e.valueOf() ? "disabled" : ""
			},
			format: dateFormat,
			autoclose: !0,
			orientation: "auto"
		}),
		LIVEREZ.Publisher.subscribe("mobiscroll-loaded", function (t) {
			a(".lr-calendar-search-mobile-datepicker").mobiscroll().calendar({
				theme: "bootstrap",
				display: "modal",
				controls: ["calendar"],
				minDate: e,
				dateFormat: dateFormat
			}),
			a(".lr-calendar-search-mobile-datepicker").change(function () {
				a(".lr-calendar-search-desktop-datepicker").val(this.value)
			})
		}),
		LIVEREZ.Publisher.subscribe("mobiscroll-loaded", function (t) {
			a("#txtStartDate-mobile").mobiscroll().calendar({
				theme: "bootstrap",
				display: "modal",
				controls: ["calendar"],
				minDate: e,
				dateFormat: dateFormat
			}),
			a("#txtEndDate-mobile").mobiscroll().calendar({
				theme: "bootstrap",
				display: "modal",
				controls: ["calendar"],
				minDate: e,
				dateFormat: dateFormat
			}),
			a("#txtStartDate-mobile").change(function () {
				a("#txtStartDate").val(this.value);
				var t = new Date(a("#txtStartDate-mobile").val()),
				e = new Date(a("#txtEndDate-mobile").val()),
				i = e - t,
				s = i / 1e3 / 60 / 60 / 24,
				r = new Date(t);
				r.setDate(t.getDate() + defaultSearchDepartureDays);
				var n = r.getMonth() + 1 + "/" + r.getDate() + "/" + r.getFullYear();
				(t > e || s >= 30) && (a("#txtEndDate-mobile").val(n), a("#txtEndDate-mobile").mobiscroll("setDate", r), a("#txtEndDate-mobile").mobiscroll("option", "minDate", t), a("#txtEndDate").val(n))
			}),
			a("#txtEndDate-mobile").change(function () {
				a("#txtEndDate").val(this.value)
			})
		})
	})
}
(this.LIVEREZ = this.LIVEREZ || {}, this, lrjQ), LIVEREZ.DynsiteFunctions.isMobileDevice() && $.getScript("https://cdn.liverez.com/3/common/js/mobiscroll.custom-2.10.1.min.js", function () {
	$("head").append($('<link rel="stylesheet" type="text/css" />').attr("href", "/css/vendor/mobiscroll.custom-2.10.1.min.css")),
	LIVEREZ.Publisher.publish("mobiscroll-loaded", "ready")
}), function (t, e, a, i) {
	function s(t) {
		var e = t.split(".");
		return "00" === e[1] && (t = e[0]),
		t
	}
	var r = {};
	r.getQuote = function (e) {
		var i = this,
		s = LIVEREZ.DynsiteFunctions.checkValidStartEndDates(e.StartDate, e.EndDate);
		return s ? (i.hideLoading(), i.setError(s), i.showDates(), void i.showButton("contact")) : (i.xhr && i.killAjax(), void(this.xhr = a.ajax({
						type: "get",
						url: LIVEREZ.DynsiteFunctions.getServerName() + "/inc/api/webservices.aspx?method=instantquote",
						data: {
							AdminCustDataID: ADMIN_CUST_DATA_ID,
							DynSiteID: DYN_SITE_ID,
							PageDataID: e.PageDataID,
							ad: e.StartDate,
							dd: e.EndDate,
							adults: e.Adults,
							children: e.Children,
							checkAvailable: !0
						},
						dataType: "json",
						success: function (e) {
							t.Publisher.publish(t.events.instantQuoteFinished, e)
						},
						error: function (t, e, a) {
							console.log(a),
							i.hideLoading(),
							i.setError("There was an issue with the quote. Please try new travel dates or try again later."),
							i.showDates(),
							i.showButton("contact")
						}
					})))
	},
	LIVEREZ.Publisher.subscribe(LIVEREZ.events.instantQuoteFinished, function (t, e) {
		a(".has-specials").addClass("hidden"),
		a(".quote-fee-row").addClass("hidden"),
		a(".discounted-rent").removeClass("on-sale"),
		e.error || 1 !== e.isAvailable ? (LIVEREZ.InstantQuote.showButton("contact"), LIVEREZ.InstantQuote.setError(e.message.split(".").join(". <br>")), LIVEREZ.InstantQuote.showDates()) : (a(".property-instant-quote-nightly-rate-before-specials").text(s(e.averageDailyRateBeforeSpecials)), a(".property-instant-quote-nightly-rate").text(s(e.averageDailyRate)), a(".property-instant-quote-num-nights").text(e.quantityDays), a(".property-instant-quote-fees").text(s(e.fees)), "0.00" !== e.fees && a(".quote-fee-row").removeClass("hidden"), a(".property-instant-quote-tax").text(s(e.taxTotal)), a(".property-instant-quote-rent").text(s(e.rent)), a(".property-instant-quote-rent-before-specials").text(s(e.rentBeforeSpecials)), a(".property-instant-quote-start-date").text(LIVEREZ.DynsiteFunctions.fixEuroDatesForAPI(a("#property-instant-quote-start-date").val(), dateFormatType)), a(".property-instant-quote-end-date").text(LIVEREZ.DynsiteFunctions.fixEuroDatesForAPI(a("#property-instant-quote-end-date").val(), dateFormatType)), a(".property-instant-quote-total-price").text(s(e.total)), a(".property-instant-quote-deposit-due").text(s(e.deposit)), e.hasSpecials && (a(".has-specials").removeClass("hidden").addClass("strikeout"), a(".discounted-rent").addClass("on-sale")), LIVEREZ.InstantQuote.showPricing(), LIVEREZ.InstantQuote.showButton(OnlineBookings ? "book" : "contact"), a(".property-instant-quote-change-dates").removeClass("hidden")),
		LIVEREZ.InstantQuote.showHeading(e.isAvailable),
		LIVEREZ.InstantQuote.hideLoading()
	}),
	r.killAjax = function (t) {
		4 != this.xhr.readystate && (this.xhr.abort(), this.xhr = null)
	},
	r.setError = function (t) {
		a(".property-instant-quote-message").html(t).removeClass("hidden")
	},
	r.removeError = function (t) {
		a(".property-instant-quote-message").empty().addClass("hidden")
	},
	r.showButton = function (t) {
		a(".property-instant-quote-action-button").addClass("hidden"),
		"" !== t && a(".property-instant-quote-button-" + t).removeClass("hidden")
	},
	r.submitForm = function (t) {
		a("#property-quote-form-" + t).submit()
	},
	r.showLoading = function () {
		a(".property-instant-quote-loading").removeClass("hidden")
	},
	r.hideLoading = function () {
		a(".property-instant-quote-loading").addClass("hidden")
	},
	r.showDates = function () {
		a(".property-instant-quote-dates").removeClass("hidden")
	},
	r.hideDates = function () {
		a(".property-instant-quote-dates").addClass("hidden")
	},
	r.showPricing = function () {
		a(".property-instant-quote-available").removeClass("hidden")
	},
	r.hidePricing = function () {
		a(".property-instant-quote-available").addClass("hidden"),
		a(".property-instant-quote-available").addClass("hidden")
	},
	r.changeDates = function () {
		a(".property-instant-quote-change-dates").addClass("hidden"),
		this.killAjax(),
		this.showHeading(0),
		this.removeError(),
		this.hideLoading(),
		this.hidePricing(),
		this.showDates(),
		this.showButton("")
	},
	r.showHeading = function (t) {
		a(".property-instant-quote-heading").addClass("hidden"),
		1 === t ? a(".property-instant-quote-heading-available").removeClass("hidden") : a(".property-instant-quote-heading-default").removeClass("hidden")
	},
	t.InstantQuote = r
}
(this.LIVEREZ = this.LIVEREZ || {}, this, lrjQ), function (t, e, a, i) {
	var s = {};
	s.cacheObj = {},
	s.cacheObj.mapData = {
		markerObjs: [],
		markersArr: [],
		isOpen: !1
	},
	s.setSearch = function (t) {
		return this.cacheObj.SearchObj = t,
		this
	},
	s.searchOrder = function (t) {
		return this.cacheObj.SearchObj.Sort = t,
		this
	},
	s.searchRun = function () {
		LIVEREZ.Publisher.publish(LIVEREZ.events.searchStart);
		var t = this;
		t.xhr && (t.xhr.abort(), t.xhr = null);
		var e = {
			Beds: t.cacheObj.SearchObj.Bedrooms,
			sleeps: t.cacheObj.SearchObj.Guests,
			arrivaldate: t.cacheObj.SearchObj.ArrivalDate,
			departuredate: t.cacheObj.SearchObj.DepartureDate,
			categoryid: t.cacheObj.SearchObj.CategoryID,
			LocationID: t.cacheObj.SearchObj.LocationID,
			comparesearch: t.cacheObj.SearchObj.CompareSearch,
			style: t.cacheObj.SearchObj.Style,
			communityid: t.cacheObj.SearchObj.CommunityID,
			admincustdataid: t.cacheObj.SearchObj.AdminCustDataID,
			dynsiteid: t.cacheObj.SearchObj.DynsiteID,
			searchtype: t.cacheObj.SearchObj.SearchType,
			advs: t.cacheObj.SearchObj.AdvancedSearch,
			pagedataid: t.cacheObj.SearchObj.pagedataid
		};
		t.cacheObj.SearchObj.Sort > 0 && (e.O = this.cacheObj.SearchObj.Sort),
		t.xhr = a.ajax({
				type: "get",
				url: LIVEREZ.DynsiteFunctions.getServerName() + "/inc/api/webservices.aspx?method=searchresults",
				data: e,
				dataType: "json",
				success: function (t, a, i) {
					t.comparesearch = e.comparesearch,
					LIVEREZ.Publisher.publish(LIVEREZ.events.searchComplete, t)
				},
				error: function (t, e, a) {
					"abort" === !e && LIVEREZ.Publisher.publish(LIVEREZ.events.searchComplete, {
						error: a
					})
				}
			})
	},
	s.getCalendarSuggestions = function (e) {
		var i = [];
		e.hasOwnProperty("properties") && Array.isArray(e.properties) && e.properties.length && (i = e.properties.map(function (t) {
					return t.pageDataID
				})),
		LIVEREZ.Publisher.publish(LIVEREZ.events.searchSuggestionsStart);
		var s = this;
		s.csxhr && (s.csxhr.abort(), s.csxhr = null);
		var r = new Date(s.cacheObj.SearchObj.ArrivalDate),
		n = new Date(s.cacheObj.SearchObj.DepartureDate),
		o = (n - r) / 864e5;
		s.daysBack = 5,
		s.daysForward = o > 15 ? o + 5 : 15;
		var l = t.DynsiteFunctions.dateObjectToString(new Date(new Date(r).setDate(r.getDate() - s.daysBack))),
		h = t.DynsiteFunctions.dateObjectToString(new Date(new Date(r).setDate(r.getDate() + s.daysForward))),
		c = Math.floor(.8 * o);
		2 > c && (c = 2);
		var d = {
			bedrooms: s.cacheObj.SearchObj.Bedrooms,
			guests: s.cacheObj.SearchObj.Guests,
			startDate: l,
			endDate: h,
			locationDataID: s.cacheObj.SearchObj.LocationID,
			admincustdataid: s.cacheObj.SearchObj.AdminCustDataID,
			dynsiteid: s.cacheObj.SearchObj.DynsiteID,
			consecutiveDays: c,
			maxProperties: 10
		};
		s.csxhr = a.ajax({
				type: "get",
				url: LIVEREZ.DynsiteFunctions.getServerName() + "/inc/api/webservices.aspx?method=calendarsuggestions",
				data: d,
				dataType: "json",
				success: function (t, a, s) {
					var r = [];
					t.length && (r = t.filter(function (t) {
								return -1 === i.indexOf(t.PageDataID)
							})),
					LIVEREZ.Publisher.publish(LIVEREZ.events.searchSuggestionsComplete, {
						preferences: e,
						data: r
					})
				},
				error: function (t, e, a) {
					"abort" === !e ? LIVEREZ.Publisher.publish(LIVEREZ.events.searchSuggestionsComplete, {
						error: a
					}) : LIVEREZ.Publisher.publish(LIVEREZ.events.searchSuggestionsComplete, {
						error: "error fetching results"
					})
				}
			})
	},
	s.CompareProperties = function () {
		var t = this;
		t.CheckCompare() && (document.Search_xml.PageDataID.value = t.CompareCheckboxArr.join(","), document.Search_xml.submit())
	},
	s.CheckCompare = function () {
		var t = this;
		return t.CompareCheckboxArr = [],
		a("input:checkbox[name=PageDataID]:checked").each(function () {
			t.CompareCheckboxArr.push(a(this).val())
		}),
		0 == this.CompareCheckboxArr.length ? (alert("No Properties were selected. Please select up to 3 properties if available."), !1) : 1 == this.CompareCheckboxArr.length ? (alert("Sorry you cannot compare homes if there is only one property"), !1) : this.CompareCheckboxArr.length > 3 ? (alert("You have selected more then 3 properties. Please remove one"), !1) : !0
	},
	s.setView = function (t) {
		return LIVEREZ.Storage.set("SearchResultsView", t),
		this
	},
	s.getView = function (t) {
		return LIVEREZ.Storage.get("SearchResultsView")
	},
	s.saveResultsData = function (t) {
		return this.cacheObj.results = t,
		this
	},
	s.renderResultsbyView = function (t) {
		if (this.cacheObj.results) {
			var e = this.cacheObj.results,
			i = this,
			r = "",
			n = a("<div></div>");
			if (i.cacheObj.mapData.markerObjs.length = 0, e.properties && e.properties.length) {
				var o = "";
				"grid" === i.getView() && (o += '<div class="row property-list-wrapper grid-view"><ul class="row-same-height row-full-height list-unstyled">'),
				e.properties.forEach(function (t, a) {
					"grid" === i.getView() ? (a > 0 && a % 3 === 0 && (o += '</ul></div><div class="row property-list-wrapper grid-view"><ul class="row-same-height row-full-height list-unstyled">'), o += i.SearchResultsTemplateGrid(e, t)) : o += i.SearchResultsTemplateList(e, t),
					t.latitude && t.longitude && HasGoogleMaps && i.cacheObj.mapData.markerObjs.push(t)
				}),
				"grid" === i.getView() && (o += "</ul></div>"),
				n.append(o),
				i.cacheObj.mapData.markerObjs.length > 0 && HasGoogleMaps && LIVEREZ.Publisher.publish(LIVEREZ.events.searchCreateMapImage, {
					lat: i.cacheObj.mapData.markerObjs[0].latitude,
					lng: i.cacheObj.mapData.markerObjs[0].longitude
				})
			} else
				r += e.returnMessageText ? "We couldn’t find any results that matched your criteria.<br>" + e.returnMessageText : "We couldn’t find any results that matched your criteria.<br>Try adjusting your dates or removing some search filters to show more properties.";
			e.weekToWeek && e.weekToWeek.hasProperties ? (r += '<div class="week-to-week-message-container">', e.properties && e.properties.length && (r += "<h4>Additional Properties Available</h4>"), r += "<div>" + e.weekToWeek.messageText + "</div>", r += '<div class="row">', e.weekToWeek.prevSuggestions.length && (r += '<div class="col-sm-6">', r += "<strong>Try Previous Week</strong>", e.weekToWeek.prevSuggestions.forEach(function (t) {
						t.fixedStartDate = LIVEREZ.DynsiteFunctions.fixEuroDatesForAPI(t.startDate, dateFormatType),
						t.fixedEndDate = LIVEREZ.DynsiteFunctions.fixEuroDatesForAPI(t.endDate, dateFormatType),
						r += "<div><a href=\"javascript: LIVEREZ.SearchResults.changeDates('" + t.fixedStartDate + "', '" + t.fixedEndDate + "'); _SetSearch();\">" + LIVEREZ.DynsiteFunctions.truncate(t.startingDay, 3) + " " + t.fixedStartDate + " - " + LIVEREZ.DynsiteFunctions.truncate(t.startingDay, 3) + " " + t.fixedEndDate + "</a></div>"
					}), r += "</div>"), e.weekToWeek.nextSuggestions.length && (r += '<div class="col-sm-6">', r += "<strong>Try Next Week</strong>", e.weekToWeek.nextSuggestions.forEach(function (t) {
						t.fixedStartDate = LIVEREZ.DynsiteFunctions.fixEuroDatesForAPI(t.startDate, dateFormatType),
						t.fixedEndDate = LIVEREZ.DynsiteFunctions.fixEuroDatesForAPI(t.endDate, dateFormatType),
						r += "<div><a href=\"javascript: LIVEREZ.SearchResults.changeDates('" + t.fixedStartDate + "', '" + t.fixedEndDate + "'); _SetSearch();\">" + LIVEREZ.DynsiteFunctions.truncate(t.startingDay, 3) + " " + t.fixedStartDate + " - " + LIVEREZ.DynsiteFunctions.truncate(t.startingDay, 3) + " " + t.fixedEndDate + "</a></div>"
					}), r += "</div>"), r += "</div>", r += "</div>") : e.minimumNightsStay && e.minimumNightsStay.hasProperties && (e.properties && e.properties.length && (r += "<h4>Additional Properties Available</h4>"), r += "<br>" + e.minimumNightsStay.messageText),
			"" !== r && n.append('<div class="search-results-error-message">' + r + "</div>"),
			t(n)
		} else
			s.searchRun()
	},
	s.createMap = function () {
		var t = this.cacheObj.mapData.markerObjs;
		a(".search-results-map-view-header-span").text("Viewing Map for " + t.length + " Vacation Rentals");
		var e = {
			zoom: 10,
			center: new google.maps.LatLng(t[0].latitude, t[0].longitude),
			styles: [{
					featureType: "poi.business",
					elementType: "labels",
					stylers: [{
							visibility: "off"
						}
					]
				}
			]
		},
		i = new google.maps.Map(document.getElementById("map_canvas"), e);
		this.infowindow = new google.maps.InfoWindow,
		this.createMapMarkers(i, t)
	},
	s.deleteAllMapMarkers = function () {
		for (var t = 0; t < this.cacheObj.mapData.markersArr.length; t++)
			this.cacheObj.mapData.markersArr[t].setMap(null);
		this.cacheObj.mapData.markersArr.length = 0
	},
	s.createMapMarkers = function (t, e) {
		var a = this,
		i = new google.maps.LatLngBounds;
		a.deleteAllMapMarkers(),
		e.forEach(function (e) {
			var s = LIVEREZ.SearchResults.SearchResultsTemplateMapInfoWindow(e),
			r = new google.maps.LatLng(e.latitude, e.longitude),
			e = new google.maps.Marker({
					position: r,
					map: t,
					title: e.pid
				});
			a.cacheObj.mapData.markersArr.push(e),
			google.maps.event.addListener(e, "click", function () {
				a.infowindow.setContent(s),
				a.infowindow.open(t, this)
			}),
			i.extend(r)
		}),
		t.fitBounds(i)
	},
	s.openMap = function () {
		LIVEREZ.Publisher.publish(LIVEREZ.events.searchMapOpen),
		this.cacheObj.mapData.isOpen = !0,
		this.createMap()
	},
	s.closeMap = function () {
		LIVEREZ.Publisher.publish(LIVEREZ.events.searchMapClose),
		this.cacheObj.mapData.isOpen = !1
	},
	s.saveFilters = function (t) {
		var e = [];
		t.each(function (t, a) {
			var i = {
				name: this.name,
				type: this.type,
				value: this.value
			};
			"checkbox" === this.type && (i.checked = this.checked),
			e.push(i)
		}),
		LIVEREZ.Storage.set("searchFilters", e)
	},
	s.clearFilters = function () {
		LIVEREZ.Publisher.publish(LIVEREZ.events.searchClearFilters),
		LIVEREZ.Storage.remove("searchFilters")
	},
	s.getFilters = function () {
		return LIVEREZ.Storage.get("searchFilters") || []
	},
	s.setFilters = function (t) {
		var e = this.getFilters();
		e && e.length && e.forEach(function (t) {
			"select-one" === t.type && a('select[name="' + t.name + '"]').val(t.value),
			"checkbox" === t.type && t.checked === !0 && a('input:checkbox[name="' + t.name + '"][value="' + t.value + '"]').attr("checked", "checked")
		}),
		t()
	},
	s.changeDates = function (t, e) {
		return a("#txtStartDate").val(t),
		a("#txtStartDate-mobile").val(t),
		a("#AD").val(t),
		a("#txtEndDate").val(e),
		a("#txtEndDate-mobile").val(e),
		a("#DD").val(e),
		this
	},
	t.SearchResults = s
}
(this.LIVEREZ = this.LIVEREZ || {}, this, lrjQ), function (t, e, a) {
	function i(t) {
		var e = parseFloat(t).toFixed(2);
		return e.replace(".00", "")
	}
	LIVEREZ.SearchResults.SearchResultsTemplateList = function (t, e) {
		var a = '<div class="row property-list-wrapper row-view">';
		return a += '<div class="row-same-height row-full-height">',
		a += '<div class="col-md-3 property-list-img-wrapper col-md-height col-lg-height col-full-height col-top">',
		a += '<div class="property-list-price-wrapper visible-sm visible-xs">',
		t.showRatesOnResults && (a += '<div class="property-list-price-container">', a += '<h2 class="property-list-price"><strong>' + t.currencySymbol + i(e.averageNightlyRate) + "</strong></h2>", a += '<div class="property-list-per-night"><small>Per night <strong>' + t.currency + "</strong></small></div>", a += "</div>"),
		a += "</div>",
		a += '<a href="' + e.link + '">',
		a += '<img class="img-responsive property-list-img" src="' + e.image + '">',
		a += "</a>",
		a += '<div class="property-list-items-wrapper visible-sm visible-xs">',
		e.headline && (a += '<h4 class="property-list-title"><a href="' + e.link + '">' + e.headline + "</a></h4>"),
		a += "</div>",
		a += "</div>",
		a += '<div class="col-md-7 property-list-items-wrapper col-md-height col-lg-height col-full-height col-top">',
		e.headline && (a += '<h4 class="property-list-title hidden-sm hidden-xs"><a href="' + e.link + '">' + e.headline + "</a></h4>"),
		e.location && (a += '<div class="property-list-item property-list-item item-location">', a += '<i class="fa fa-map-marker"></i> ' + e.location, a += "</div>"),
		a += '<div class="row">',
		a += '<div class="col-xs-6 col-lg-4">',
		a += '<ul class="property-list-item-wrapper">',
		1 == t.showSleepsOnSearchResults && (a += '<li class="property-list-item item-guests"><strong>' + e.maxGuests + "</strong> Guests</li>"),
		1 == t.showBedsOnSearchResults && (a += 0 === e.bedrooms ? '<li class="property-list-item item-bedroom"><strong>Studio</strong> Bedrooms</li>' : '<li class="property-list-item item-bedroom"><strong>' + e.bedrooms + "</strong> Bedrooms</li>"),
		1 == t.showBathsOnSearchResults && (a += '<li class="property-list-item item-bathrooms"><strong>' + e.bathrooms + "</strong> Bathrooms</li>"),
		a += "</ul>",
		a += "</div>",
		a += '<div class="col-xs-6 col-lg-8">',
		a += '<ul class="property-list-item-wrapper">',
		e.pid && (a += '<li class="property-list-item property-list-code">', a += '<span class="pid-text">Code:</span> <strong>' + LIVEREZ.DynsiteFunctions.truncate(e.pid, 15, !0) + "</strong>", a += "</li>"),
		1 == t.showMinNightsOnSearchResults && (a += '<li class="property-list-item item-min-nights">Minimum Stay: <strong>' + e.minNightsReq + " nights</strong></li>"),
		1 == t.showPetsOnSearchResults && "Yes" === e.allowsPets && (a += '<li class="property-list-item item-pets"><i class="fa fa-paw"></i> Pets Allowed</li>'),
		a += "</ul>",
		a += "</div>",
		a += "</div>",
		a += "</div>",
		a += '<div class="col-md-2 property-list-details-wrapper hidden-sm hidden-xs col-md-height col-lg-height col-full-height col-top">',
		a += '<div class="row">',
		t.showRatesOnResults && (a += '<div class="col-sm-4 col-md-12 property-list-price-wrapper text-right">', a += '<h2 class="property-list-price"><strong>' + t.currencySymbol + i(e.averageNightlyRate) + "</strong></h2>", a += '<div class="property-list-per-night"><small>Per night <strong>' + t.currency + "</strong></small></div>", a += "</div>"),
		a += '<div class="col-sm-4 col-md-12 property-list-btn-wrapper">',
		a += '<a class="btn btn-link btn-block btn-view-rental" href="' + e.link + '">View Rental</a>',
		a += "</div>",
		1 === t.comparesearch && (a += '<div class="col-sm-4 col-md-12 property-list-checkbox-wrapper">', a += '<div class="property-list-compare text-right" data-pagedataid="' + e.pageDataID + '">', a += '<input class="checkbox-' + e.pageDataID + '" ID="checkbox-' + e.pageDataID + '" type="checkbox" name="PageDataID" value="' + e.pageDataID + '">', a += ' <label for="checkbox-' + e.pageDataID + '" class="property-list-compare-text"><strong>Compare</strong></label>', a += "</div>", a += "</div>"),
		a += "</div>",
		a += "</div>",
		a += "</div>",
		a += "</div>"
	},
	LIVEREZ.SearchResults.SearchResultsTemplateGrid = function (t, e) {
		var a = '<li class="col-md-4 col-top">';
		return a += '<div class="property-list-content-wrapper">',
		a += '<div class="property-list-img-wrapper">',
		a += '<div class="property-list-price-wrapper visible-sm visible-xs">',
		t.showRatesOnResults && (a += '<div class="property-list-price-container">', a += '<h2 class="property-list-price"><strong>' + t.currencySymbol + i(e.averageNightlyRate) + "</strong></h2>", a += '<div class="property-list-per-night"><small>Per night <strong>' + t.currency + "</strong></small></div>", a += "</div>"),
		a += "</div>",
		a += '<a href="' + e.link + '"><img class="img-responsive property-list-img" src="' + e.image + '"></a>',
		a += '<div class="property-list-items-wrapper visible-sm visible-xs">',
		e.headline && (a += '<h4 class="property-list-title"><a href="' + e.link + '">' + e.headline + "</a></h4>"),
		a += "</div>",
		a += "</div>",
		a += '<div class="property-list-text-wrapper">',
		e.headline && (a += '<h4 class="property-list-title hidden-sm hidden-xs">', a += '<a href="' + e.link + '">' + e.headline + "</a>", a += "</h4>"),
		e.location && (a += '<div class="property-list-item item-location"><i class="fa fa-map-marker"></i> ' + e.location + "</div>"),
		a += '<div class="row property-list-details-wrapper">',
		a += '<div class="col-xs-6 col-md-5 ">',
		a += '<ul class="property-list-item-wrapper">',
		1 == t.showSleepsOnSearchResults && (a += '<li class="property-list-item item-guests"><strong>' + e.maxGuests + "</strong> Guests</li>"),
		1 == t.showBedsOnSearchResults && (a += 0 === e.bedrooms ? '<li class="property-list-item item-bedroom"><strong>Studio</strong> Bedrooms</li>' : '<li class="property-list-item item-bedroom"><strong>' + e.bedrooms + "</strong> Bedrooms</li>"),
		1 == t.showBathsOnSearchResults && (a += '<li class="property-list-item item-bathrooms"><strong>' + e.bathrooms + "</strong> Bathrooms</li>"),
		a += "</ul>",
		a += "</div>",
		a += '<div class="col-xs-6 col-md-7">',
		t.showRatesOnResults && (a += '<div class="col-sm-4 col-md-12 property-list-price-wrapper text-right">', a += '<h2 class="property-list-price"><strong>' + t.currencySymbol + i(e.averageNightlyRate) + "</strong></h2>", a += '<div class="property-list-per-night"><small>Per night <strong>' + t.currency + "</strong></small></div>", a += "</div>"),
		a += "</div>",
		a += "</div>",
		a += '<div class="row">',
		a += '<div class="col-sm-12">',
		a += '<ul class="property-list-item-wrapper">',
		e.pid && (a += '<li class="property-list-item property-list-code"><span class="pid-text">Code:</span> <strong>' + LIVEREZ.DynsiteFunctions.truncate(e.pid, 15, !0) + "</strong></li>"),
		1 == t.showMinNightsOnSearchResults && (a += '<li class="property-list-item item-min-nights">Minimum Stay: <strong>' + e.minNightsReq + " nights</strong></li>"),
		a += '<li class="property-list-item item-pets">',
		1 == t.showPetsOnSearchResults && "Yes" === e.allowsPets && (a += '<i class="fa fa-paw"></i> Pets Allowed'),
		a += "</li>",
		a += "</ul>",
		a += "</div>",
		a += "</div>",
		a += "</div>",
		a += '<div class="property-list-footer">',
		a += '<div class="row hidden-sm hidden-xs">',
		1 === t.comparesearch && (a += '<div class="col-sm-4 col-md-6 property-list-checkbox-wrapper">', a += '<div class="property-list-compare" data-pagedataid="' + e.pageDataID + '">', a += '<input class="checkbox-' + e.pageDataID + '" id="checkbox-' + e.pageDataID + '" type="checkbox" name="PageDataID" value="' + e.pageDataID + '">', a += ' <label for="checkbox-' + e.pageDataID + '" class="property-list-compare-text"><strong> Compare</strong></label>', a += "</div>", a += "</div>"),
		a += '<div class="col-sm-4 col-md-6 property-list-btn-wrapper">',
		a += '<a class="btn btn-link btn-block btn-view-rental" href="' + e.link + '">View Rental</a>',
		a += "</div>",
		a += "</div>",
		a += "</div>",
		a += "</div>",
		a += "</li>"
	},
	LIVEREZ.SearchResults.CalendarSuggestion = function (e, a, i, s) {
		function r(t) {
			return {
				date: n(new Date(t.actDate)),
				checkIn: t.CheckInCustDataID > 0,
				checkOut: t.CheckOutCustDataID > 0,
				occupied: 0 === t.CheckInCustDataID && 0 === t.CheckOutCustDataID || t.CheckInCustDataID > 0 && 0 !== t.earlyCheckIn || t.CheckOutCustDataID > 0 && 0 !== t.lateCheckOut
			}
		}
		function n(t) {
			return new Date(t.getTime() + 6e4 * t.getTimezoneOffset())
		}
		var o = a.CalendarSuggestions.map(r),
		l = new Date(e.searchForm.startDate),
		h = new Date(l).setDate(l.getDate() - i),
		c = new Date(l).setDate(l.getDate() + s),
		d = new t.StripCalendar(h, c, o),
		p = "";
		d.generateHtml(function (t) {
			p = t
		});
		var u = '<div class="row property-list-wrapper lr-serach-calendar-suggestion row-view">';
		return u += '<div class="row-same-height row-full-height">',
		u += '<div class="col-md-3 property-list-img-wrapper col-md-height col-lg-height col-full-height col-top">',
		u += '<div class="property-list-price-wrapper visible-sm visible-xs">',
		u += "</div>",
		u += '<a href="/vacation-rental-home.asp?PageDataID=' + a.PageDataID + '">',
		u += '<img class="img-responsive property-list-img" src="https://cdn.liverez.com/5/' + a.AdminCustDataID + "/1/" + a.PageDataID + '/250/1.jpg ">',
		u += "</a>",
		u += '<div class="property-list-items-wrapper visible-sm visible-xs">',
		a.Heading && (u += '<h4 class="property-list-title"><a href="/vacation-rental-home.asp?PageDataID=' + a.PageDataID + '">' + a.Heading + "</a></h4>"),
		u += "</div>",
		u += "</div>",
		u += '<div class="col-md-7 property-list-items-wrapper col-md-height col-lg-height col-full-height col-top">',
		a.Heading && (u += '<h4 class="property-list-title hidden-sm hidden-xs"><a href="/vacation-rental-home.asp?PageDataID=' + a.PageDataID + '">' + a.Heading + "</a></h4>"),
		a.Location && (u += '<div class="property-list-item property-list-item item-location">', u += '<i class="fa fa-map-marker"></i> ' + a.Location, u += "</div>"),
		u += '<div class="row">',
		u += '<div class="col-xs-6 col-lg-4">',
		u += '<ul class="property-list-item-wrapper">',
		1 == e.showSleepsOnSearchResults && (u += '<li class="property-list-item item-guests"><strong>' + a.Sleeps + "</strong> Guests</li>"),
		1 == e.showBedsOnSearchResults && (u += 0 === a.Bedrooms ? '<li class="property-list-item item-bedroom"><strong>Studio</strong> Bedroom</li>' : '<li class="property-list-item item-bedroom"><strong>' + a.Bedrooms + "</strong> Bedrooms</li>"),
		1 == e.showBathsOnSearchResults && (u += '<li class="property-list-item item-bathrooms"><strong>' + a.Bathrooms + "</strong> Bathrooms</li>"),
		u += "</ul>",
		u += "</div>",
		u += '<div class="col-xs-6 col-lg-8">',
		u += '<ul class="property-list-item-wrapper">',
		a.PID && (u += '<li class="property-list-item property-list-code">', u += '<span class="pid-text">Code:</span> <strong>' + LIVEREZ.DynsiteFunctions.truncate(a.PID, 15, !0) + "</strong>", u += "</li>"),
		1 == e.showMinNightsOnSearchResults && (u += '<li class="property-list-item item-min-nights">Minimum Stay: <strong>' + a.MinimumNightsStay + " nights</strong></li>"),
		1 == e.showPetsOnSearchResults && "Yes" === a.AllowsPets && (u += '<li class="property-list-item item-pets"><i class="fa fa-paw"></i> Pets Allowed</li>'),
		u += "</ul>",
		u += "</div>",
		u += "</div>",
		u += '<div class="row">',
		u += '<div class="col-xs-12">',
		u += '<div class="table-responsive">',
		u += p,
		u += "</div>",
		u += "</div>",
		u += "</div>",
		u += "</div>",
		u += '<div class="col-md-2 property-list-details-wrapper hidden-sm hidden-xs col-md-height col-lg-height col-full-height col-top">',
		u += '<div class="row">',
		u += '<div class="col-sm-4 col-md-12 property-list-btn-wrapper">',
		u += '<a class="btn btn-link btn-block btn-view-rental" href="/vacation-rental-home.asp?PageDataID=' + a.PageDataID + '">View Rental</a>',
		u += "</div>",
		u += "</div>",
		u += "</div>",
		u += "</div>",
		u += "</div>"
	},
	LIVEREZ.SearchResults.SearchResultsTemplateMapInfoWindow = function (t) {
		var e = '<div class="search-result-map-info-window">';
		return e += '<a href="' + t.link + '"><img src="' + t.image + '" class="search-result-map-info-window-thumb"></a>',
		e += '<div class="search-result-map-info-window-float">',
		e += '<div class="search-result-map-info-window-headline"><a href="' + t.link + '">' + t.headline + "</a></div>",
		e += '<div class="search-result-map-info-window-price"><strong>' + i(t.averageNightlyRate) + " avg/night</strong></div>",
		e += '<div class="search-result-map-info-window-details">Bedrooms: <strong>' + t.bedrooms + "</strong> Bathrooms: <strong>" + t.bathrooms + "</strong> Sleeps: <strong>" + t.maxGuests + "</strong></div>",
		"" !== t.location && (e += '<div class="search-result-map-info-window-location">Location: <strong>' + t.location + "</strong></div>"),
		e += '<div class="search-result-map-info-window-link"><a href="' + t.link + '"> View Property Details</a></div>',
		e += "</div>",
		e += "</div>"
	}
}
(this.LIVEREZ = this.LIVEREZ || {}, this, lrjQ), function (t, e) {
	function a() {
		return new Date(Date.UTC.apply(Date, arguments))
	}
	function i() {
		var t = new Date;
		return a(t.getFullYear(), t.getMonth(), t.getDate())
	}
	function s(t, e) {
		return t.getUTCFullYear() === e.getUTCFullYear() && t.getUTCMonth() === e.getUTCMonth() && t.getUTCDate() === e.getUTCDate()
	}
	function r(t) {
		return function () {
			return this[t].apply(this, arguments)
		}
	}
	function n(t) {
		return t && !isNaN(t.getTime())
	}
	function o(e, a) {
		function i(t, e) {
			return e.toLowerCase()
		}
		var s,
		r = t(e).data(),
		n = {},
		o = new RegExp("^" + a.toLowerCase() + "([A-Z])");
		a = new RegExp("^" + a.toLowerCase());
		for (var l in r)
			a.test(l) && (s = l.replace(o, i), n[s] = r[l]);
		return n
	}
	function l(e) {
		var a = {};
		if (f[e] || (e = e.split("-")[0], f[e])) {
			var i = f[e];
			return t.each(m, function (t, e) {
				e in i && (a[e] = i[e])
			}),
			a
		}
	}
	var h = function () {
		var e = {
			get: function (t) {
				return this.slice(t)[0]
			},
			contains: function (t) {
				for (var e = t && t.valueOf(), a = 0, i = this.length; i > a; a++)
					if (this[a].valueOf() === e)
						return a;
				return -1
			},
			remove: function (t) {
				this.splice(t, 1)
			},
			replace: function (e) {
				e && (t.isArray(e) || (e = [e]), this.clear(), this.push.apply(this, e))
			},
			clear: function () {
				this.length = 0
			},
			copy: function () {
				var t = new h;
				return t.replace(this),
				t
			}
		};
		return function () {
			var a = [];
			return a.push.apply(a, arguments),
			t.extend(a, e),
			a
		}
	}
	(),
	c = function (e, a) {
		t(e).data("datepicker", this),
		this._process_options(a),
		this.dates = new h,
		this.viewDate = this.o.defaultViewDate,
		this.focusDate = null,
		this.element = t(e),
		this.isInline = !1,
		this.isInput = this.element.is("input"),
		this.component = this.element.hasClass("date") ? this.element.find(".add-on, .input-group-addon, .btn") : !1,
		this.hasInput = this.component && this.element.find("input").length,
		this.component && 0 === this.component.length && (this.component = !1),
		this.picker = t(v.template),
		this._buildEvents(),
		this._attachEvents(),
		this.isInline ? this.picker.addClass("datepicker-inline").appendTo(this.element) : this.picker.addClass("datepicker-dropdown dropdown-menu"),
		this.o.rtl && this.picker.addClass("datepicker-rtl"),
		this.viewMode = this.o.startView,
		this.o.calendarWeeks && this.picker.find("thead .datepicker-title, tfoot .today, tfoot .clear").attr("colspan", function (t, e) {
			return parseInt(e) + 1
		}),
		this._allow_update = !1,
		this.setStartDate(this._o.startDate),
		this.setEndDate(this._o.endDate),
		this.setDaysOfWeekDisabled(this.o.daysOfWeekDisabled),
		this.setDaysOfWeekHighlighted(this.o.daysOfWeekHighlighted),
		this.setDatesDisabled(this.o.datesDisabled),
		this.fillDow(),
		this.fillMonths(),
		this._allow_update = !0,
		this.update(),
		this.showMode(),
		this.isInline && this.show()
	};
	c.prototype = {
		constructor: c,
		_process_options: function (e) {
			this._o = t.extend({}, this._o, e);
			var s = this.o = t.extend({}, this._o),
			r = s.language;
			switch (f[r] || (r = r.split("-")[0], f[r] || (r = g.language)), s.language = r, s.startView) {
			case 2:
			case "decade":
				s.startView = 2;
				break;
			case 1:
			case "year":
				s.startView = 1;
				break;
			default:
				s.startView = 0
			}
			switch (s.minViewMode) {
			case 1:
			case "months":
				s.minViewMode = 1;
				break;
			case 2:
			case "years":
				s.minViewMode = 2;
				break;
			default:
				s.minViewMode = 0
			}
			switch (s.maxViewMode) {
			case 0:
			case "days":
				s.maxViewMode = 0;
				break;
			case 1:
			case "months":
				s.maxViewMode = 1;
				break;
			default:
				s.maxViewMode = 2
			}
			s.startView = Math.min(s.startView, s.maxViewMode),
			s.startView = Math.max(s.startView, s.minViewMode),
			s.multidate !== !0 && (s.multidate = Number(s.multidate) || !1, s.multidate !== !1 && (s.multidate = Math.max(0, s.multidate))),
			s.multidateSeparator = String(s.multidateSeparator),
			s.weekStart %= 7,
			s.weekEnd = (s.weekStart + 6) % 7;
			var n = v.parseFormat(s.format);
			if (s.startDate !==  - (1 / 0) && (s.startDate = s.startDate ? s.startDate instanceof Date ? this._local_to_utc(this._zero_time(s.startDate)) : v.parseDate(s.startDate, n, s.language) :  - (1 / 0)), s.endDate !== 1 / 0 && (s.endDate = s.endDate ? s.endDate instanceof Date ? this._local_to_utc(this._zero_time(s.endDate)) : v.parseDate(s.endDate, n, s.language) : 1 / 0), s.daysOfWeekDisabled = s.daysOfWeekDisabled || [], t.isArray(s.daysOfWeekDisabled) || (s.daysOfWeekDisabled = s.daysOfWeekDisabled.split(/[,\s]*/)), s.daysOfWeekDisabled = t.map(s.daysOfWeekDisabled, function (t) {
						return parseInt(t, 10)
					}), s.daysOfWeekHighlighted = s.daysOfWeekHighlighted || [], t.isArray(s.daysOfWeekHighlighted) || (s.daysOfWeekHighlighted = s.daysOfWeekHighlighted.split(/[,\s]*/)), s.daysOfWeekHighlighted = t.map(s.daysOfWeekHighlighted, function (t) {
						return parseInt(t, 10)
					}), s.datesDisabled = s.datesDisabled || [], !t.isArray(s.datesDisabled)) {
				var o = [];
				o.push(v.parseDate(s.datesDisabled, n, s.language)),
				s.datesDisabled = o
			}
			s.datesDisabled = t.map(s.datesDisabled, function (t) {
					return v.parseDate(t, n, s.language)
				});
			var l = String(s.orientation).toLowerCase().split(/\s+/g),
			h = s.orientation.toLowerCase();
			if (l = t.grep(l, function (t) {
						return /^auto|left|right|top|bottom$/.test(t)
					}), s.orientation = {
					x: "auto",
					y: "auto"
				}, h && "auto" !== h)
				if (1 === l.length)
					switch (l[0]) {
					case "top":
					case "bottom":
						s.orientation.y = l[0];
						break;
					case "left":
					case "right":
						s.orientation.x = l[0]
					}
				else
					h = t.grep(l, function (t) {
							return /^left|right$/.test(t)
						}), s.orientation.x = h[0] || "auto", h = t.grep(l, function (t) {
							return /^top|bottom$/.test(t)
						}), s.orientation.y = h[0] || "auto";
			else ;
			if (s.defaultViewDate) {
				var c = s.defaultViewDate.year || (new Date).getFullYear(),
				d = s.defaultViewDate.month || 0,
				p = s.defaultViewDate.day || 1;
				s.defaultViewDate = a(c, d, p)
			} else
				s.defaultViewDate = i()
		},
		_events: [],
		_secondaryEvents: [],
		_applyEvents: function (t) {
			for (var a, i, s, r = 0; r < t.length; r++)
				a = t[r][0], 2 === t[r].length ? (i = e, s = t[r][1]) : 3 === t[r].length && (i = t[r][1], s = t[r][2]), a.on(s, i)
		},
		_unapplyEvents: function (t) {
			for (var a, i, s, r = 0; r < t.length; r++)
				a = t[r][0], 2 === t[r].length ? (s = e, i = t[r][1]) : 3 === t[r].length && (s = t[r][1], i = t[r][2]), a.off(i, s)
		},
		_buildEvents: function () {
			var e = {
				keyup: t.proxy(function (e) {
					-1 === t.inArray(e.keyCode, [27, 37, 39, 38, 40, 32, 13, 9]) && this.update()
				}, this),
				keydown: t.proxy(this.keydown, this),
				paste: t.proxy(this.paste, this)
			};
			this.o.showOnFocus === !0 && (e.focus = t.proxy(this.show, this)),
			this.isInput ? this._events = [[this.element, e]] : this.component && this.hasInput ? this._events = [[this.element.find("input"), e], [this.component, {
						click: t.proxy(this.show, this)
					}
				]] : this.element.is("div") ? this.isInline = !0 : this._events = [[this.element, {
							click: t.proxy(this.show, this)
						}
					]],
			this._events.push([this.element, "*", {
						blur: t.proxy(function (t) {
							this._focused_from = t.target
						}, this)
					}
				], [this.element, {
						blur: t.proxy(function (t) {
							this._focused_from = t.target
						}, this)
					}
				]),
			this.o.immediateUpdates && this._events.push([this.element, {
						"changeYear changeMonth": t.proxy(function (t) {
							this.update(t.date)
						}, this)
					}
				]),
			this._secondaryEvents = [[this.picker, {
						click: t.proxy(this.click, this)
					}
				], [t(window), {
						resize: t.proxy(this.place, this)
					}
				], [t(document), {
						mousedown: t.proxy(function (t) {
							this.element.is(t.target) || this.element.find(t.target).length || this.picker.is(t.target) || this.picker.find(t.target).length || this.picker.hasClass("datepicker-inline") || this.hide()
						}, this)
					}
				]]
		},
		_attachEvents: function () {
			this._detachEvents(),
			this._applyEvents(this._events)
		},
		_detachEvents: function () {
			this._unapplyEvents(this._events)
		},
		_attachSecondaryEvents: function () {
			this._detachSecondaryEvents(),
			this._applyEvents(this._secondaryEvents)
		},
		_detachSecondaryEvents: function () {
			this._unapplyEvents(this._secondaryEvents)
		},
		_trigger: function (e, a) {
			var i = a || this.dates.get(-1),
			s = this._utc_to_local(i);
			this.element.trigger({
				type: e,
				date: s,
				dates: t.map(this.dates, this._utc_to_local),
				format: t.proxy(function (t, e) {
					0 === arguments.length ? (t = this.dates.length - 1, e = this.o.format) : "string" == typeof t && (e = t, t = this.dates.length - 1),
					e = e || this.o.format;
					var a = this.dates.get(t);
					return v.formatDate(a, e, this.o.language)
				}, this)
			})
		},
		show: function () {
			var e = this.component ? this.element.find("input") : this.element;
			if (!e.attr("readonly") || this.o.enableOnReadonly !== !1)
				return this.isInline || this.picker.appendTo(this.o.container), this.place(), this.picker.show(), this._attachSecondaryEvents(), this._trigger("show"), (window.navigator.msMaxTouchPoints || "ontouchstart" in document) && this.o.disableTouchKeyboard && t(this.element).blur(), this
		},
		hide: function () {
			return this.isInline ? this : this.picker.is(":visible") ? (this.focusDate = null, this.picker.hide().detach(), this._detachSecondaryEvents(), this.viewMode = this.o.startView, this.showMode(), this.o.forceParse && (this.isInput && this.element.val() || this.hasInput && this.element.find("input").val()) && this.setValue(), this._trigger("hide"), this) : this
		},
		remove: function () {
			return this.hide(),
			this._detachEvents(),
			this._detachSecondaryEvents(),
			this.picker.remove(),
			delete this.element.data().datepicker,
			this.isInput || delete this.element.data().date,
			this
		},
		paste: function (e) {
			var a;
			if (e.originalEvent.clipboardData && e.originalEvent.clipboardData.types && -1 !== t.inArray("text/plain", e.originalEvent.clipboardData.types))
				a = e.originalEvent.clipboardData.getData("text/plain");
			else {
				if (!window.clipboardData)
					return;
				a = window.clipboardData.getData("Text")
			}
			this.setDate(a),
			this.update(),
			e.preventDefault()
		},
		_utc_to_local: function (t) {
			return t && new Date(t.getTime() + 6e4 * t.getTimezoneOffset())
		},
		_local_to_utc: function (t) {
			return t && new Date(t.getTime() - 6e4 * t.getTimezoneOffset())
		},
		_zero_time: function (t) {
			return t && new Date(t.getFullYear(), t.getMonth(), t.getDate())
		},
		_zero_utc_time: function (t) {
			return t && new Date(Date.UTC(t.getUTCFullYear(), t.getUTCMonth(), t.getUTCDate()))
		},
		getDates: function () {
			return t.map(this.dates, this._utc_to_local)
		},
		getUTCDates: function () {
			return t.map(this.dates, function (t) {
				return new Date(t)
			})
		},
		getDate: function () {
			return this._utc_to_local(this.getUTCDate())
		},
		getUTCDate: function () {
			var t = this.dates.get(-1);
			return "undefined" != typeof t ? new Date(t) : null
		},
		clearDates: function () {
			var t;
			this.isInput ? t = this.element : this.component && (t = this.element.find("input")),
			t && t.val(""),
			this.update(),
			this._trigger("changeDate"),
			this.o.autoclose && this.hide()
		},
		setDates: function () {
			var e = t.isArray(arguments[0]) ? arguments[0] : arguments;
			return this.update.apply(this, e),
			this._trigger("changeDate"),
			this.setValue(),
			this
		},
		setUTCDates: function () {
			var e = t.isArray(arguments[0]) ? arguments[0] : arguments;
			return this.update.apply(this, t.map(e, this._utc_to_local)),
			this._trigger("changeDate"),
			this.setValue(),
			this
		},
		setDate: r("setDates"),
		setUTCDate: r("setUTCDates"),
		setValue: function () {
			var t = this.getFormattedDate();
			return this.isInput ? this.element.val(t) : this.component && this.element.find("input").val(t),
			this
		},
		getFormattedDate: function (a) {
			a === e && (a = this.o.format);
			var i = this.o.language;
			return t.map(this.dates, function (t) {
				return v.formatDate(t, a, i)
			}).join(this.o.multidateSeparator)
		},
		setStartDate: function (t) {
			return this._process_options({
				startDate: t
			}),
			this.update(),
			this.updateNavArrows(),
			this
		},
		setEndDate: function (t) {
			return this._process_options({
				endDate: t
			}),
			this.update(),
			this.updateNavArrows(),
			this
		},
		setDaysOfWeekDisabled: function (t) {
			return this._process_options({
				daysOfWeekDisabled: t
			}),
			this.update(),
			this.updateNavArrows(),
			this
		},
		setDaysOfWeekHighlighted: function (t) {
			return this._process_options({
				daysOfWeekHighlighted: t
			}),
			this.update(),
			this
		},
		setDatesDisabled: function (t) {
			this._process_options({
				datesDisabled: t
			}),
			this.update(),
			this.updateNavArrows()
		},
		place: function () {
			if (this.isInline)
				return this;
			var e = this.picker.outerWidth(),
			a = this.picker.outerHeight(),
			i = 10,
			s = t(this.o.container),
			r = s.width(),
			n = "body" === this.o.container ? t(document).scrollTop() : s.scrollTop(),
			o = s.offset(),
			l = [];
			this.element.parents().each(function () {
				var e = t(this).css("z-index");
				"auto" !== e && 0 !== e && l.push(parseInt(e))
			});
			var h = Math.max.apply(Math, l) + this.o.zIndexOffset,
			c = this.component ? this.component.parent().offset() : this.element.offset(),
			d = this.component ? this.component.outerHeight(!0) : this.element.outerHeight(!1),
			p = this.component ? this.component.outerWidth(!0) : this.element.outerWidth(!1),
			u = c.left - o.left,
			g = c.top - o.top;
			"body" !== this.o.container && (g += n),
			this.picker.removeClass("datepicker-orient-top datepicker-orient-bottom datepicker-orient-right datepicker-orient-left"),
			"auto" !== this.o.orientation.x ? (this.picker.addClass("datepicker-orient-" + this.o.orientation.x), "right" === this.o.orientation.x && (u -= e - p)) : c.left < 0 ? (this.picker.addClass("datepicker-orient-left"), u -= c.left - i) : u + e > r ? (this.picker.addClass("datepicker-orient-right"), u += p - e) : this.picker.addClass("datepicker-orient-left");
			var m,
			f = this.o.orientation.y;
			if ("auto" === f && (m = -n + g - a, f = 0 > m ? "bottom" : "top"), this.picker.addClass("datepicker-orient-" + f), "top" === f ? g -= a + parseInt(this.picker.css("padding-top")) : g += d, this.o.rtl) {
				var v = r - (u + p);
				this.picker.css({
					top: g,
					right: v,
					zIndex: h
				})
			} else
				this.picker.css({
					top: g,
					left: u,
					zIndex: h
				});
			return this
		},
		_allow_update: !0,
		update: function () {
			if (!this._allow_update)
				return this;
			var e = this.dates.copy(),
			a = [],
			i = !1;
			return arguments.length ? (t.each(arguments, t.proxy(function (t, e) {
						e instanceof Date && (e = this._local_to_utc(e)),
						a.push(e)
					}, this)), i = !0) : (a = this.isInput ? this.element.val() : this.element.data("date") || this.element.find("input").val(), a = a && this.o.multidate ? a.split(this.o.multidateSeparator) : [a], delete this.element.data().date),
			a = t.map(a, t.proxy(function (t) {
						return v.parseDate(t, this.o.format, this.o.language)
					}, this)),
			a = t.grep(a, t.proxy(function (t) {
						return !this.dateWithinRange(t) || !t
					}, this), !0),
			this.dates.replace(a),
			this.viewDate = this.dates.length ? new Date(this.dates.get(-1)) : this.viewDate < this.o.startDate ? new Date(this.o.startDate) : this.viewDate > this.o.endDate ? new Date(this.o.endDate) : this.o.defaultViewDate,
			i ? this.setValue() : a.length && String(e) !== String(this.dates) && this._trigger("changeDate"),
			!this.dates.length && e.length && this._trigger("clearDate"),
			this.fill(),
			this.element.change(),
			this
		},
		fillDow: function () {
			var t = this.o.weekStart,
			e = "<tr>";
			for (this.o.calendarWeeks && (this.picker.find(".datepicker-days .datepicker-switch").attr("colspan", function (t, e) {
						return parseInt(e) + 1
					}), e += '<th class="cw">&#160;</th>'); t < this.o.weekStart + 7; )
				e += '<th class="dow">' + f[this.o.language].daysMin[t++ % 7] + "</th>";
			e += "</tr>",
			this.picker.find(".datepicker-days thead").append(e)
		},
		fillMonths: function () {
			for (var t = "", e = 0; 12 > e; )
				t += '<span class="month">' + f[this.o.language].monthsShort[e++] + "</span>";
			this.picker.find(".datepicker-months td").html(t)
		},
		setRange: function (e) {
			e && e.length ? this.range = t.map(e, function (t) {
					return t.valueOf()
				}) : delete this.range,
			this.fill()
		},
		getClassNames: function (e) {
			var a = [],
			i = this.viewDate.getUTCFullYear(),
			s = this.viewDate.getUTCMonth(),
			r = new Date;
			return e.getUTCFullYear() < i || e.getUTCFullYear() === i && e.getUTCMonth() < s ? a.push("old") : (e.getUTCFullYear() > i || e.getUTCFullYear() === i && e.getUTCMonth() > s) && a.push("new"),
			this.focusDate && e.valueOf() === this.focusDate.valueOf() && a.push("focused"),
			this.o.todayHighlight && e.getUTCFullYear() === r.getFullYear() && e.getUTCMonth() === r.getMonth() && e.getUTCDate() === r.getDate() && a.push("today"),
			-1 !== this.dates.contains(e) && a.push("active"),
			(!this.dateWithinRange(e) || this.dateIsDisabled(e)) && a.push("disabled"),
			-1 !== t.inArray(e.getUTCDay(), this.o.daysOfWeekHighlighted) && a.push("highlighted"),
			this.range && (e > this.range[0] && e < this.range[this.range.length - 1] && a.push("range"), -1 !== t.inArray(e.valueOf(), this.range) && a.push("selected"), e.valueOf() === this.range[0] && a.push("range-start"), e.valueOf() === this.range[this.range.length - 1] && a.push("range-end")),
			a
		},
		fill: function () {
			var i,
			s = new Date(this.viewDate),
			r = s.getUTCFullYear(),
			n = s.getUTCMonth(),
			o = this.o.startDate !==  - (1 / 0) ? this.o.startDate.getUTCFullYear() :  - (1 / 0),
			l = this.o.startDate !==  - (1 / 0) ? this.o.startDate.getUTCMonth() :  - (1 / 0),
			h = this.o.endDate !== 1 / 0 ? this.o.endDate.getUTCFullYear() : 1 / 0,
			c = this.o.endDate !== 1 / 0 ? this.o.endDate.getUTCMonth() : 1 / 0,
			d = f[this.o.language].today || f.en.today || "",
			p = f[this.o.language].clear || f.en.clear || "",
			u = f[this.o.language].titleFormat || f.en.titleFormat;
			if (!isNaN(r) && !isNaN(n)) {
				this.picker.find(".datepicker-days thead .datepicker-switch").text(v.formatDate(new a(r, n), u, this.o.language)),
				this.picker.find("tfoot .today").text(d).toggle(this.o.todayBtn !== !1),
				this.picker.find("tfoot .clear").text(p).toggle(this.o.clearBtn !== !1),
				this.picker.find("thead .datepicker-title").text(this.o.title).toggle("" !== this.o.title),
				this.updateNavArrows(),
				this.fillMonths();
				var g = a(r, n - 1, 28),
				m = v.getDaysInMonth(g.getUTCFullYear(), g.getUTCMonth());
				g.setUTCDate(m),
				g.setUTCDate(m - (g.getUTCDay() - this.o.weekStart + 7) % 7);
				var D = new Date(g);
				g.getUTCFullYear() < 100 && D.setUTCFullYear(g.getUTCFullYear()),
				D.setUTCDate(D.getUTCDate() + 42),
				D = D.valueOf();
				for (var y, b = []; g.valueOf() < D; ) {
					if (g.getUTCDay() === this.o.weekStart && (b.push("<tr>"), this.o.calendarWeeks)) {
						var w = new Date(+g + (this.o.weekStart - g.getUTCDay() - 7) % 7 * 864e5),
						k = new Date(Number(w) + (11 - w.getUTCDay()) % 7 * 864e5),
						E = new Date(Number(E = a(k.getUTCFullYear(), 0, 1)) + (11 - E.getUTCDay()) % 7 * 864e5),
						I = (k - E) / 864e5 / 7 + 1;
						b.push('<td class="cw">' + I + "</td>")
					}
					if (y = this.getClassNames(g), y.push("day"), this.o.beforeShowDay !== t.noop) {
						var C = this.o.beforeShowDay(this._utc_to_local(g));
						C === e ? C = {}
						 : "boolean" == typeof C ? C = {
							enabled: C
						}
						 : "string" == typeof C && (C = {
								classes: C
							}),
						C.enabled === !1 && y.push("disabled"),
						C.classes && (y = y.concat(C.classes.split(/\s+/))),
						C.tooltip && (i = C.tooltip)
					}
					y = t.unique(y),
					b.push('<td class="' + y.join(" ") + '"' + (i ? ' title="' + i + '"' : "") + ">" + g.getUTCDate() + "</td>"),
					i = null,
					g.getUTCDay() === this.o.weekEnd && b.push("</tr>"),
					g.setUTCDate(g.getUTCDate() + 1)
				}
				this.picker.find(".datepicker-days tbody").empty().append(b.join(""));
				var S = f[this.o.language].monthsTitle || f.en.monthsTitle || "Months",
				x = this.picker.find(".datepicker-months").find(".datepicker-switch").text(this.o.maxViewMode < 2 ? S : r).end().find("span").removeClass("active");
				if (t.each(this.dates, function (t, e) {
						e.getUTCFullYear() === r && x.eq(e.getUTCMonth()).addClass("active")
					}), (o > r || r > h) && x.addClass("disabled"), r === o && x.slice(0, l).addClass("disabled"), r === h && x.slice(c + 1).addClass("disabled"), this.o.beforeShowMonth !== t.noop) {
					var T = this;
					t.each(x, function (e, a) {
						if (!t(a).hasClass("disabled")) {
							var i = new Date(r, e, 1),
							s = T.o.beforeShowMonth(i);
							s === !1 && t(a).addClass("disabled")
						}
					})
				}
				b = "",
				r = 10 * parseInt(r / 10, 10);
				var O = this.picker.find(".datepicker-years").find(".datepicker-switch").text(r + "-" + (r + 9)).end().find("td");
				r -= 1;
				for (var M, R = t.map(this.dates, function (t) {
							return t.getUTCFullYear()
						}), _ = -1; 11 > _; _++) {
					if (M = ["year"], i = null, -1 === _ ? M.push("old") : 10 === _ && M.push("new"), -1 !== t.inArray(r, R) && M.push("active"), (o > r || r > h) && M.push("disabled"), this.o.beforeShowYear !== t.noop) {
						var V = this.o.beforeShowYear(new Date(r, 0, 1));
						V === e ? V = {}
						 : "boolean" == typeof V ? V = {
							enabled: V
						}
						 : "string" == typeof V && (V = {
								classes: V
							}),
						V.enabled === !1 && M.push("disabled"),
						V.classes && (M = M.concat(V.classes.split(/\s+/))),
						V.tooltip && (i = V.tooltip)
					}
					b += '<span class="' + M.join(" ") + '"' + (i ? ' title="' + i + '"' : "") + ">" + r + "</span>",
					r += 1
				}
				O.html(b)
			}
		},
		updateNavArrows: function () {
			if (this._allow_update) {
				var t = new Date(this.viewDate),
				e = t.getUTCFullYear(),
				a = t.getUTCMonth();
				switch (this.viewMode) {
				case 0:
					this.picker.find(".prev").css(this.o.startDate !==  - (1 / 0) && e <= this.o.startDate.getUTCFullYear() && a <= this.o.startDate.getUTCMonth() ? {
						visibility: "hidden"
					}
						 : {
						visibility: "visible"
					}),
					this.picker.find(".next").css(this.o.endDate !== 1 / 0 && e >= this.o.endDate.getUTCFullYear() && a >= this.o.endDate.getUTCMonth() ? {
						visibility: "hidden"
					}
						 : {
						visibility: "visible"
					});
					break;
				case 1:
				case 2:
					this.picker.find(".prev").css(this.o.startDate !==  - (1 / 0) && e <= this.o.startDate.getUTCFullYear() || this.o.maxViewMode < 2 ? {
						visibility: "hidden"
					}
						 : {
						visibility: "visible"
					}),
					this.picker.find(".next").css(this.o.endDate !== 1 / 0 && e >= this.o.endDate.getUTCFullYear() || this.o.maxViewMode < 2 ? {
						visibility: "hidden"
					}
						 : {
						visibility: "visible"
					})
				}
			}
		},
		click: function (e) {
			e.preventDefault(),
			e.stopPropagation();
			var s,
			r,
			n,
			o = t(e.target).closest("span, td, th");
			if (1 === o.length)
				switch (o[0].nodeName.toLowerCase()) {
				case "th":
					switch (o[0].className) {
					case "datepicker-switch":
						this.showMode(1);
						break;
					case "prev":
					case "next":
						var l = v.modes[this.viewMode].navStep * ("prev" === o[0].className ? -1 : 1);
						switch (this.viewMode) {
						case 0:
							this.viewDate = this.moveMonth(this.viewDate, l),
							this._trigger("changeMonth", this.viewDate);
							break;
						case 1:
						case 2:
							this.viewDate = this.moveYear(this.viewDate, l),
							1 === this.viewMode && this._trigger("changeYear", this.viewDate)
						}
						this.fill();
						break;
					case "today":
						this.showMode(-2);
						var h = "linked" === this.o.todayBtn ? null : "view";
						this._setDate(i(), h);
						break;
					case "clear":
						this.clearDates()
					}
					break;
				case "span":
					o.hasClass("disabled") || (this.viewDate.setUTCDate(1), o.hasClass("month") ? (n = 1, r = o.parent().find("span").index(o), s = this.viewDate.getUTCFullYear(), this.viewDate.setUTCMonth(r), this._trigger("changeMonth", this.viewDate), 1 === this.o.minViewMode ? (this._setDate(a(s, r, n)), this.showMode()) : this.showMode(-1)) : (n = 1, r = 0, s = parseInt(o.text(), 10) || 0, this.viewDate.setUTCFullYear(s), this._trigger("changeYear", this.viewDate), 2 === this.o.minViewMode && this._setDate(a(s, r, n)), this.showMode(-1)), this.fill());
					break;
				case "td":
					o.hasClass("day") && !o.hasClass("disabled") && (n = parseInt(o.text(), 10) || 1, s = this.viewDate.getUTCFullYear(), r = this.viewDate.getUTCMonth(), o.hasClass("old") ? 0 === r ? (r = 11, s -= 1) : r -= 1 : o.hasClass("new") && (11 === r ? (r = 0, s += 1) : r += 1), this._setDate(a(s, r, n)))
				}
			this.picker.is(":visible") && this._focused_from && t(this._focused_from).focus(),
			delete this._focused_from
		},
		_toggle_multidate: function (t) {
			var e = this.dates.contains(t);
			if (t || this.dates.clear(), -1 !== e ? (this.o.multidate === !0 || this.o.multidate > 1 || this.o.toggleActive) && this.dates.remove(e) : this.o.multidate === !1 ? (this.dates.clear(), this.dates.push(t)) : this.dates.push(t), "number" == typeof this.o.multidate)
				for (; this.dates.length > this.o.multidate; )
					this.dates.remove(0)
		},
		_setDate: function (t, e) {
			e && "date" !== e || this._toggle_multidate(t && new Date(t)),
			e && "view" !== e || (this.viewDate = t && new Date(t)),
			this.fill(),
			this.setValue(),
			e && "view" === e || this._trigger("changeDate");
			var a;
			this.isInput ? a = this.element : this.component && (a = this.element.find("input")),
			a && a.change(),
			!this.o.autoclose || e && "date" !== e || this.hide()
		},
		moveDay: function (t, e) {
			var a = new Date(t);
			return a.setUTCDate(t.getUTCDate() + e),
			a
		},
		moveWeek: function (t, e) {
			return this.moveDay(t, 7 * e)
		},
		moveMonth: function (t, e) {
			if (!n(t))
				return this.o.defaultViewDate;
			if (!e)
				return t;
			var a,
			i,
			s = new Date(t.valueOf()),
			r = s.getUTCDate(),
			o = s.getUTCMonth(),
			l = Math.abs(e);
			if (e = e > 0 ? 1 : -1, 1 === l)
				i = -1 === e ? function () {
					return s.getUTCMonth() === o
				}
			 : function () {
				return s.getUTCMonth() !== a
			},
			a = o + e,
			s.setUTCMonth(a),
			(0 > a || a > 11) && (a = (a + 12) % 12);
			else {
				for (var h = 0; l > h; h++)
					s = this.moveMonth(s, e);
				a = s.getUTCMonth(),
				s.setUTCDate(r),
				i = function () {
					return a !== s.getUTCMonth()
				}
			}
			for (; i(); )
				s.setUTCDate(--r), s.setUTCMonth(a);
			return s
		},
		moveYear: function (t, e) {
			return this.moveMonth(t, 12 * e)
		},
		moveAvailableDate: function (t, e, a) {
			do {
				if (t = this[a](t, e), !this.dateWithinRange(t))
					return !1;
				a = "moveDay"
			} while (this.dateIsDisabled(t));
			return t
		},
		weekOfDateIsDisabled: function (e) {
			return -1 !== t.inArray(e.getUTCDay(), this.o.daysOfWeekDisabled)
		},
		dateIsDisabled: function (e) {
			return this.weekOfDateIsDisabled(e) || t.grep(this.o.datesDisabled, function (t) {
				return s(e, t)
			}).length > 0
		},
		dateWithinRange: function (t) {
			return t >= this.o.startDate && t <= this.o.endDate
		},
		keydown: function (t) {
			if (!this.picker.is(":visible"))
				return void((40 === t.keyCode || 27 === t.keyCode) && (this.show(), t.stopPropagation()));
			var e,
			a,
			i = !1,
			s = this.focusDate || this.viewDate;
			switch (t.keyCode) {
			case 27:
				this.focusDate ? (this.focusDate = null, this.viewDate = this.dates.get(-1) || this.viewDate, this.fill()) : this.hide(),
				t.preventDefault(),
				t.stopPropagation();
				break;
			case 37:
			case 38:
			case 39:
			case 40:
				if (!this.o.keyboardNavigation || 7 === this.o.daysOfWeekDisabled.length)
					break;
				e = 37 === t.keyCode || 38 === t.keyCode ? -1 : 1,
				t.ctrlKey ? (a = this.moveAvailableDate(s, e, "moveYear"), a && this._trigger("changeYear", this.viewDate)) : t.shiftKey ? (a = this.moveAvailableDate(s, e, "moveMonth"), a && this._trigger("changeMonth", this.viewDate)) : 37 === t.keyCode || 39 === t.keyCode ? a = this.moveAvailableDate(s, e, "moveDay") : this.weekOfDateIsDisabled(s) || (a = this.moveAvailableDate(s, e, "moveWeek")),
				a && (this.focusDate = this.viewDate = a, this.setValue(), this.fill(), t.preventDefault());
				break;
			case 13:
				if (!this.o.forceParse)
					break;
				s = this.focusDate || this.dates.get(-1) || this.viewDate,
				this.o.keyboardNavigation && (this._toggle_multidate(s), i = !0),
				this.focusDate = null,
				this.viewDate = this.dates.get(-1) || this.viewDate,
				this.setValue(),
				this.fill(),
				this.picker.is(":visible") && (t.preventDefault(), t.stopPropagation(), this.o.autoclose && this.hide());
				break;
			case 9:
				this.focusDate = null,
				this.viewDate = this.dates.get(-1) || this.viewDate,
				this.fill(),
				this.hide()
			}
			if (i) {
				this._trigger(this.dates.length ? "changeDate" : "clearDate");
				var r;
				this.isInput ? r = this.element : this.component && (r = this.element.find("input")),
				r && r.change()
			}
		},
		showMode: function (t) {
			t && (this.viewMode = Math.max(this.o.minViewMode, Math.min(this.o.maxViewMode, this.viewMode + t))),
			this.picker.children("div").hide().filter(".datepicker-" + v.modes[this.viewMode].clsName).show(),
			this.updateNavArrows()
		}
	};
	var d = function (e, a) {
		t(e).data("datepicker", this),
		this.element = t(e),
		this.inputs = t.map(a.inputs, function (t) {
				return t.jquery ? t[0] : t
			}),
		delete a.inputs,
		u.call(t(this.inputs), a).on("changeDate", t.proxy(this.dateUpdated, this)),
		this.pickers = t.map(this.inputs, function (e) {
				return t(e).data("datepicker")
			}),
		this.updateDates()
	};
	d.prototype = {
		updateDates: function () {
			this.dates = t.map(this.pickers, function (t) {
					return t.getUTCDate()
				}),
			this.updateRanges()
		},
		updateRanges: function () {
			var e = t.map(this.dates, function (t) {
					return t.valueOf()
				});
			t.each(this.pickers, function (t, a) {
				a.setRange(e)
			})
		},
		dateUpdated: function (e) {
			if (!this.updating) {
				this.updating = !0;
				var a = t(e.target).data("datepicker");
				if ("undefined" != typeof a) {
					var i = a.getUTCDate(),
					s = t.inArray(e.target, this.inputs),
					r = s - 1,
					n = s + 1,
					o = this.inputs.length;
					if (-1 !== s) {
						if (t.each(this.pickers, function (t, e) {
								e.getUTCDate() || e.setUTCDate(i)
							}), i < this.dates[r])
							for (; r >= 0 && i < this.dates[r]; )
								this.pickers[r--].setUTCDate(i);
						else if (i > this.dates[n])
							for (; o > n && i > this.dates[n]; )
								this.pickers[n++].setUTCDate(i);
						this.updateDates(),
						delete this.updating
					}
				}
			}
		},
		remove: function () {
			t.map(this.pickers, function (t) {
				t.remove()
			}),
			delete this.element.data().datepicker
		}
	};
	var p = t.fn.datepicker,
	u = function (a) {
		var i = Array.apply(null, arguments);
		i.shift();
		var s;
		if (this.each(function () {
				var e = t(this),
				r = e.data("datepicker"),
				n = "object" == typeof a && a;
				if (!r) {
					var h = o(this, "date"),
					p = t.extend({}, g, h, n),
					u = l(p.language),
					m = t.extend({}, g, u, h, n);
					e.hasClass("input-daterange") || m.inputs ? (t.extend(m, {
							inputs: m.inputs || e.find("input").toArray()
						}), r = new d(this, m)) : r = new c(this, m),
					e.data("datepicker", r)
				}
				"string" == typeof a && "function" == typeof r[a] && (s = r[a].apply(r, i))
			}), s === e || s instanceof c || s instanceof d)
			return this;
		if (this.length > 1)
			throw new Error("Using only allowed for the collection of a single element (" + a + " function)");
		return s
	};
	t.fn.datepicker = u;
	var g = t.fn.datepicker.defaults = {
		autoclose: !1,
		beforeShowDay: t.noop,
		beforeShowMonth: t.noop,
		beforeShowYear: t.noop,
		calendarWeeks: !1,
		clearBtn: !1,
		toggleActive: !1,
		daysOfWeekDisabled: [],
		daysOfWeekHighlighted: [],
		datesDisabled: [],
		endDate: 1 / 0,
		forceParse: !0,
		format: "mm/dd/yyyy",
		keyboardNavigation: !0,
		language: "en",
		minViewMode: 0,
		maxViewMode: 2,
		multidate: !1,
		multidateSeparator: ",",
		orientation: "auto",
		rtl: !1,
		startDate:  - (1 / 0),
		startView: 0,
		todayBtn: !1,
		todayHighlight: !1,
		weekStart: 0,
		disableTouchKeyboard: !1,
		enableOnReadonly: !0,
		showOnFocus: !0,
		zIndexOffset: 10,
		container: "body",
		immediateUpdates: !1,
		title: ""
	},
	m = t.fn.datepicker.locale_opts = ["format", "rtl", "weekStart"];
	t.fn.datepicker.Constructor = c;
	var f = t.fn.datepicker.dates = {
		en: {
			days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
			daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
			daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
			months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
			monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			today: "Today",
			clear: "Clear",
			titleFormat: "MM yyyy"
		}
	},
	v = {
		modes: [{
				clsName: "days",
				navFnc: "Month",
				navStep: 1
			}, {
				clsName: "months",
				navFnc: "FullYear",
				navStep: 1
			}, {
				clsName: "years",
				navFnc: "FullYear",
				navStep: 10
			}
		],
		isLeapYear: function (t) {
			return t % 4 === 0 && t % 100 !== 0 || t % 400 === 0
		},
		getDaysInMonth: function (t, e) {
			return [31, v.isLeapYear(t) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][e]
		},
		validParts: /dd?|DD?|mm?|MM?|yy(?:yy)?/g,
		nonpunctuation: /[^ -\/:-@\[\u3400-\u9fff-`{-~\t\n\r]+/g,
		parseFormat: function (t) {
			if ("function" == typeof t.toValue && "function" == typeof t.toDisplay)
				return t;
			var e = t.replace(this.validParts, "\x00").split("\x00"),
			a = t.match(this.validParts);
			if (!e || !e.length || !a || 0 === a.length)
				throw new Error("Invalid date format.");
			return {
				separators: e,
				parts: a
			}
		},
		parseDate: function (s, r, n) {
			function o() {
				var t = this.slice(0, g[d].length),
				e = g[d].slice(0, t.length);
				return t.toLowerCase() === e.toLowerCase()
			}
			if (!s)
				return e;
			if (s instanceof Date)
				return s;
			if ("string" == typeof r && (r = v.parseFormat(r)), r.toValue)
				return r.toValue(s, r, n);
			var l,
			h,
			d,
			p,
			u = /([\-+]\d+)([dmwy])/,
			g = s.match(/([\-+]\d+)([dmwy])/g),
			m = {
				d: "moveDay",
				m: "moveMonth",
				w: "moveWeek",
				y: "moveYear"
			};
			if (/^[\-+]\d+[dmwy]([\s,]+[\-+]\d+[dmwy])*$/.test(s)) {
				for (s = new Date, d = 0; d < g.length; d++)
					l = u.exec(g[d]), h = parseInt(l[1]), p = m[l[2]], s = c.prototype[p](s, h);
				return a(s.getUTCFullYear(), s.getUTCMonth(), s.getUTCDate())
			}
			g = s && s.match(this.nonpunctuation) || [],
			s = new Date;
			var D,
			y,
			b = {},
			w = ["yyyy", "yy", "M", "MM", "m", "mm", "d", "dd"],
			k = {
				yyyy: function (t, e) {
					return t.setUTCFullYear(e)
				},
				yy: function (t, e) {
					return t.setUTCFullYear(2e3 + e)
				},
				m: function (t, e) {
					if (isNaN(t))
						return t;
					for (e -= 1; 0 > e; )
						e += 12;
					for (e %= 12, t.setUTCMonth(e); t.getUTCMonth() !== e; )
						t.setUTCDate(t.getUTCDate() - 1);
					return t
				},
				d: function (t, e) {
					return t.setUTCDate(e)
				}
			};
			k.M = k.MM = k.mm = k.m,
			k.dd = k.d,
			s = i();
			var E = r.parts.slice();
			if (g.length !== E.length && (E = t(E).filter(function (e, a) {
							return -1 !== t.inArray(a, w)
						}).toArray()), g.length === E.length) {
				var I;
				for (d = 0, I = E.length; I > d; d++) {
					if (D = parseInt(g[d], 10), l = E[d], isNaN(D))
						switch (l) {
						case "MM":
							y = t(f[n].months).filter(o),
							D = t.inArray(y[0], f[n].months) + 1;
							break;
						case "M":
							y = t(f[n].monthsShort).filter(o),
							D = t.inArray(y[0], f[n].monthsShort) + 1
						}
					b[l] = D
				}
				var C,
				S;
				for (d = 0; d < w.length; d++)
					S = w[d], S in b && !isNaN(b[S]) && (C = new Date(s), k[S](C, b[S]), isNaN(C) || (s = C))
			}
			return s
		},
		formatDate: function (e, a, i) {
			if (!e)
				return "";
			if ("string" == typeof a && (a = v.parseFormat(a)), a.toDisplay)
				return a.toDisplay(e, a, i);
			var s = {
				d: e.getUTCDate(),
				D: f[i].daysShort[e.getUTCDay()],
				DD: f[i].days[e.getUTCDay()],
				m: e.getUTCMonth() + 1,
				M: f[i].monthsShort[e.getUTCMonth()],
				MM: f[i].months[e.getUTCMonth()],
				yy: e.getUTCFullYear().toString().substring(2),
				yyyy: e.getUTCFullYear()
			};
			s.dd = (s.d < 10 ? "0" : "") + s.d,
			s.mm = (s.m < 10 ? "0" : "") + s.m,
			e = [];
			for (var r = t.extend([], a.separators), n = 0, o = a.parts.length; o >= n; n++)
				r.length && e.push(r.shift()), e.push(s[a.parts[n]]);
			return e.join("")
		},
		headTemplate: '<thead><tr><th colspan="7" class="datepicker-title"></th></tr><tr><th class="prev">&#171;</th><th colspan="5" class="datepicker-switch"></th><th class="next">&#187;</th></tr></thead>',
		contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>',
		footTemplate: '<tfoot><tr><th colspan="7" class="today"></th></tr><tr><th colspan="7" class="clear"></th></tr></tfoot>'
	};
	v.template = '<div class="datepicker"><div class="datepicker-days"><table class=" table-condensed">' + v.headTemplate + "<tbody></tbody>" + v.footTemplate + '</table></div><div class="datepicker-months"><table class="table-condensed">' + v.headTemplate + v.contTemplate + v.footTemplate + '</table></div><div class="datepicker-years"><table class="table-condensed">' + v.headTemplate + v.contTemplate + v.footTemplate + "</table></div></div>",
	t.fn.datepicker.DPGlobal = v,
	t.fn.datepicker.noConflict = function () {
		return t.fn.datepicker = p,
		this
	},
	t.fn.datepicker.version = "1.5.1",
	t(document).on("focus.datepicker.data-api click.datepicker.data-api", '[data-provide="datepicker"]', function (e) {
		var a = t(this);
		a.data("datepicker") || (e.preventDefault(), u.call(a, "show"))
	}),
	t(function () {
		u.call(t('[data-provide="datepicker-inline"]'))
	})
}
(lrjQ), function (t, e, a, i) {
	function s(t) {
		return t.getFullYear() + "-" + (t.getMonth() + 1) + "-" + t.getDate()
	}
	function r(t, e) {
		return Math.abs((t.getTime() - e.getTime()) / 864e5)
	}
	function n(t, e) {
		for (var a = [], i = new Date(t), s = new Date(e); s >= i; )
			a.push(new Date(i)), i.setDate(i.getDate() + 1);
		return a
	}
	function o(t) {
		var e = {};
		return t.forEach(function (t) {
			var a = t.getMonth(),
			i = t.getFullYear(),
			s = i + "_" + a;
			e[s] = e.hasOwnProperty(s) ? e[s] + 1 : 1
		}),
		e
	}
	var l = function (t, e, a) {
		var i = this;
		this.startDate = new Date(t),
		this.endDate = new Date(e),
		this.numberOfDays = r(i.startDate, i.endDate),
		this.data = a,
		this.startingMonth = this.startDate.getMonth(),
		this.stoppingMonth = this.endDate.getMonth(),
		this.displayDates = n(i.startDate, i.endDate)
	},
	h = {
		days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
		daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
		daysSuperShort: ["S", "M", "T", "W", "T", "F", "S"],
		months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
		monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
	};
	return l.prototype.generateHtml = function (t) {
		var e = a("<div />").addClass("table-responsive"),
		i = a("<table />").addClass("lr-strip-calendar"),
		r = o(this.displayDates),
		n = a("<tr />").addClass("lr-strip-calendar--heading-row"),
		l = a("<tr />").addClass("lr-strip-calendar--weekday-row"),
		c = a("<tr />").addClass("lr-strip-calendar--date-row");
		for (var d in r) {
			var p = d.split("_")[1],
			u = a("<td />").text(h.monthsShort[p]).attr("colspan", r[d]);
			n.append(u)
		}
		this.displayDates.forEach(function (t) {
			var e = a("<td />").text(h.daysSuperShort[t.getDay()]);
			e.addClass("lr-strip-calendar--weekday"),
			l.append(e);
			var i = a("<td />").text(t.getDate());
			i.addClass("lr-strip-calendar--day " + s(t)),
			c.append(i)
		}),
		this.data.forEach(function (t) {
			var e = c.children("." + s(t.date));
			t.checkIn && e.addClass("checkin"),
			t.checkOut && e.addClass("checkout"),
			t.occupied && e.addClass("occupied")
		}),
		i.append(n),
		i.append(l),
		i.append(c),
		e.append(i),
		t(e.html())
	},
	t.StripCalendar = l
}
(this.LIVEREZ = this.LIVEREZ || {}, this, lrjQ);
