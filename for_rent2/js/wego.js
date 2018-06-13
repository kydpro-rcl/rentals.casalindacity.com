var link = "https://preview.superstore.travel/flights?brand_key=c623ddf20e3b031642fbda19254ff1182d3069c4"
var iframe = document.createElement('iframe');
iframe.frameBorder=0;
iframe.width="100%";
iframe.height="600px";
iframe.id="randomid";
iframe.setAttribute("src", link);
document.getElementById("modal-iframe").appendChild(iframe);