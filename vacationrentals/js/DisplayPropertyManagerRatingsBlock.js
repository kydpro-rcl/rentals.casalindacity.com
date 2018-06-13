/*
* This script requires CDN_BASE_URL, RESERVATIONS_BASE_URL, and RESERVATIONS_PROXY_URL to be set in head.inc in a global JS block
*/
document.write('<li' + 'nk rel="stylesheet" type="text/css" href="' + CDN_BASE_URL + '/3/CSS/InfoBlockRatings.css?v=20130125" title="master" />');
document.write('<div id="propertymanager-rating-panel"></div>');

$.ajax({
    type: "GET",
    url: RESERVATIONS_BASE_URL + "/LiveScore/Data/GetPropertyManagerRatingsBlock",
    dataType: 'jsonp',
    data: {
        AuthToken: '2d239c00-65c2-4cb2-95a6-4999074e8683',
        adminCustDataID: ADMIN_CUST_DATA_ID,
        dynSiteID: DYN_SITE_ID
    },
    success: function(jsonp) {
        if (jsonp.success) {
            $('#propertymanager-rating-panel').html(jsonp.data);
        } else {
            alert('Request failed the error was "' + jsonp.message + "'");
        }
    }
});