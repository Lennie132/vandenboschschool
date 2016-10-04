// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

/* Respond.js: min/max-width media query polyfill. (c) Scott Jehl. MIT Lic. j.mp/respondjs  */
/* Deze functie zorgt ervoor dat responsive (voornamelijk Bootstrap) goed functioneert in IE8 en lager */
!function(e){"use strict";function t(){E(!0)}var a={};e.respond=a,a.update=function(){};var n=[],r=function(){var t=!1;try{t=new e.XMLHttpRequest}catch(a){t=new e.ActiveXObject("Microsoft.XMLHTTP")}return function(){return t}}(),s=function(e,t){var a=r();a&&(a.open("GET",e,!0),a.onreadystatechange=function(){4!==a.readyState||200!==a.status&&304!==a.status||t(a.responseText)},4!==a.readyState&&a.send(null))},i=function(e){return e.replace(a.regex.minmaxwh,"").match(a.regex.other)};if(a.ajax=s,a.queue=n,a.unsupportedmq=i,a.regex={media:/@media[^\{]+\{([^\{\}]*\{[^\}\{]*\})+/gi,keyframes:/@(?:\-(?:o|moz|webkit)\-)?keyframes[^\{]+\{(?:[^\{\}]*\{[^\}\{]*\})+[^\}]*\}/gi,comments:/\/\*[^*]*\*+([^/][^*]*\*+)*\//gi,urls:/(url\()['"]?([^\/\)'"][^:\)'"]+)['"]?(\))/g,findStyles:/@media *([^\{]+)\{([\S\s]+?)$/,only:/(only\s+)?([a-zA-Z]+)\s?/,minw:/\(\s*min\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/,maxw:/\(\s*max\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/,minmaxwh:/\(\s*m(in|ax)\-(height|width)\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/gi,other:/\([^\)]*\)/g},a.mediaQueriesSupported=e.matchMedia&&null!==e.matchMedia("only all")&&e.matchMedia("only all").matches,!a.mediaQueriesSupported){var o,l,m,h=e.document,d=h.documentElement,u=[],c=[],p=[],f={},g=30,x=h.getElementsByTagName("head")[0]||d,y=h.getElementsByTagName("base")[0],v=x.getElementsByTagName("link"),w=function(){var e,t=h.createElement("div"),a=h.body,n=d.style.fontSize,r=a&&a.style.fontSize,s=!1;return t.style.cssText="position:absolute;font-size:1em;width:1em",a||(a=s=h.createElement("body"),a.style.background="none"),d.style.fontSize="100%",a.style.fontSize="100%",a.appendChild(t),s&&d.insertBefore(a,d.firstChild),e=t.offsetWidth,s?d.removeChild(a):a.removeChild(t),d.style.fontSize=n,r&&(a.style.fontSize=r),e=m=parseFloat(e)},E=function(t){var a="clientWidth",n=d[a],r="CSS1Compat"===h.compatMode&&n||h.body[a]||n,s={},i=v[v.length-1],f=(new Date).getTime();if(t&&o&&g>f-o)return e.clearTimeout(l),void(l=e.setTimeout(E,g));o=f;for(var y in u)if(u.hasOwnProperty(y)){var S=u[y],T=S.minw,$=S.maxw,z=null===T,b=null===$,C="em";T&&(T=parseFloat(T)*(T.indexOf(C)>-1?m||w():1)),$&&($=parseFloat($)*($.indexOf(C)>-1?m||w():1)),S.hasquery&&(z&&b||!(z||r>=T)||!(b||$>=r))||(s[S.media]||(s[S.media]=[]),s[S.media].push(c[S.rules]))}for(var R in p)p.hasOwnProperty(R)&&p[R]&&p[R].parentNode===x&&x.removeChild(p[R]);p.length=0;for(var O in s)if(s.hasOwnProperty(O)){var M=h.createElement("style"),k=s[O].join("\n");M.type="text/css",M.media=O,x.insertBefore(M,i.nextSibling),M.styleSheet?M.styleSheet.cssText=k:M.appendChild(h.createTextNode(k)),p.push(M)}},S=function(e,t,n){var r=e.replace(a.regex.comments,"").replace(a.regex.keyframes,"").match(a.regex.media),s=r&&r.length||0;t=t.substring(0,t.lastIndexOf("/"));var o=function(e){return e.replace(a.regex.urls,"$1"+t+"$2$3")},l=!s&&n;t.length&&(t+="/"),l&&(s=1);for(var m=0;s>m;m++){var h,d,p,f;l?(h=n,c.push(o(e))):(h=r[m].match(a.regex.findStyles)&&RegExp.$1,c.push(RegExp.$2&&o(RegExp.$2))),p=h.split(","),f=p.length;for(var g=0;f>g;g++)d=p[g],i(d)||u.push({media:d.split("(")[0].match(a.regex.only)&&RegExp.$2||"all",rules:c.length-1,hasquery:d.indexOf("(")>-1,minw:d.match(a.regex.minw)&&parseFloat(RegExp.$1)+(RegExp.$2||""),maxw:d.match(a.regex.maxw)&&parseFloat(RegExp.$1)+(RegExp.$2||"")})}E()},T=function(){if(n.length){var t=n.shift();s(t.href,function(a){S(a,t.href,t.media),f[t.href]=!0,e.setTimeout(function(){T()},0)})}},$=function(){for(var t=0;t<v.length;t++){var a=v[t],r=a.href,s=a.media,i=a.rel&&"stylesheet"===a.rel.toLowerCase();r&&i&&!f[r]&&(a.styleSheet&&a.styleSheet.rawCssText?(S(a.styleSheet.rawCssText,r,s),f[r]=!0):(!/^([a-zA-Z:]*\/\/)/.test(r)&&!y||r.replace(RegExp.$1,"").split("/")[0]===e.location.host)&&("//"===r.substring(0,2)&&(r=e.location.protocol+r),n.push({href:r,media:s})))}T()};$(),a.update=$,a.getEmValue=w,e.addEventListener?e.addEventListener("resize",t,!1):e.attachEvent&&e.attachEvent("onresize",t)}}(this);

// Place any jQuery/helper plugins in here.



//HTML5 fallback
$(document).ready(function(){
	Modernizr.load([
		{
			test:Modernizr.input.placeholder,
			nope: '',
			complete: function(){
				
					$('[placeholder]').on('focus', function() {
					  var input = $(this);
					  if (input.val() == input.attr('placeholder')) {
						input.val('');
						input.removeClass('placeholder');
					  }
					}).blur(function() {
					
					  var input = $(this);
					  if (input.val() == '' || input.val() == input.attr('placeholder')) {
						input.addClass('placeholder');
						input.val(input.attr('placeholder'));
					  }
					}).blur();
					$('[placeholder]').parents('form').submit(function() {
					  $(this).find('[placeholder]').each(function() {
						var input = $(this);
						if (input.val() == input.attr('placeholder')) {
						  input.val('');
						}
					  })
					});
			}
		},
		{
			//-- date input fields
			/*test: Modernizr.inputtypes.date,
			nope: ['//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css'],
			complete: function () {
					var minDate=null;
					var maxDate=null;
					var dateFormat = 'dd-mm-yy';
					$('input[type=date]').each(function(){					
						//-- data naar NL notatie!
						if($(this).val()!==''){
							$(this).val($.datepicker.formatDate(dateFormat, new Date($(this).val())));
						}
						if($(this).attr('min')){
							minDate = $.datepicker.formatDate(dateFormat, new Date($(this).attr('min')));
						}	
						if($(this).attr('max')){						
							maxDate = $.datepicker.formatDate(dateFormat, new Date($(this).attr('max')));
						}
						
						$(this).datepicker({
							dateFormat: dateFormat,
							minDate: minDate,
							maxDate: maxDate,
						});
					});

				}
		*/}
	]);
});
