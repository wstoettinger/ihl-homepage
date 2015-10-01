!function(e,t){var a=t(e,e.document);e.lazySizes=a,"object"==typeof module&&module.exports?module.exports=a:"function"==typeof define&&define.amd&&define(a)}(window,function(e,t){"use strict";if(t.getElementsByClassName){var a,i=t.documentElement,n=e.HTMLPictureElement&&"sizes"in t.createElement("img"),r="addEventListener",s=e[r],o=e.setTimeout,l=e.requestAnimationFrame||o,c=e.setImmediate||o,u=/^picture$/i,d=["load","error","lazyincluded","_lazyloaded"],f={},m=Array.prototype.forEach,g=function(e,t){return f[t]||(f[t]=new RegExp("(\\s|^)"+t+"(\\s|$)")),f[t].test(e.className)&&f[t]},z=function(e,t){g(e,t)||(e.className=e.className.trim()+" "+t)},v=function(e,t){var a;(a=g(e,t))&&(e.className=e.className.replace(a," "))},y=function(e,t,a){var i=a?r:"removeEventListener";a&&y(e,t),d.forEach(function(a){e[i](a,t)})},p=function(e,a,i,n,r){var s=t.createEvent("CustomEvent");return s.initCustomEvent(a,!n,!r,i||{}),e.dispatchEvent(s),s},h=function(t,i){var r;!n&&(r=e.picturefill||e.respimage||a.pf)?r({reevaluate:!0,elements:[t]}):i&&i.src&&(t.src=i.src)},A=function(e,t){return(getComputedStyle(e,null)||{})[t]},C=function(e,t,i){for(i=i||e.offsetWidth;i<a.minSize&&t&&!e._lazysizesWidth;)i=t.offsetWidth,t=t.parentNode;return i},b=function(t){var a,i=0,n=e.Date,r=function(){a=!1,i=n.now(),t()},s=function(){c(r)},u=function(){l(s)};return function(){if(!a){var e=125-(n.now()-i);a=!0,6>e&&(e=6),o(u,e)}}},E=function(){var n,c,d,f,C,E,M,w,_,x,B,W,S,L,R,D,T=/^img$/i,k=/^iframe$/i,O="onscroll"in e&&!/glebot/.test(navigator.userAgent),P=0,$=0,F=0,I=0,H=function(e){F--,e&&e.target&&y(e.target,H),(!e||0>F||!e.target)&&(F=0)},j=function(e,t){var a,i=e,n="hidden"!=A(e,"visibility");for(_-=t,W+=t,x-=t,B+=t;n&&(i=i.offsetParent);)n=(A(i,"opacity")||1)>0,n&&"visible"!=A(i,"overflow")&&(a=i.getBoundingClientRect(),n=B>a.left&&x<a.right&&W>a.top-1&&_<a.bottom+1);return n},q=function(){var e,t,i,r,s,o,l,u,f;if((C=a.loadMode)&&8>F&&(e=n.length)){for(t=0,I++,D>$&&1>F&&I>3&&C>2?($=D,I=0):$=C>1&&I>2&&6>F?R:P;e>t;t++)if(n[t]&&!n[t]._lazyRace)if(O)if((u=n[t].getAttribute("data-expand"))&&(o=1*u)||(o=$),f!==o&&(M=innerWidth+o,w=innerHeight+o,l=-1*o,f=o),i=n[t].getBoundingClientRect(),(W=i.bottom)>=l&&(_=i.top)<=w&&(B=i.right)>=l&&(x=i.left)<=M&&(W||B||x||_)&&(d&&3>F&&!u&&(3>C||4>I)||j(n[t],o))){if(V(n[t]),s=!0,F>9)break;F>6&&($=P)}else!s&&d&&!r&&4>F&&4>I&&C>2&&(c[0]||a.preloadAfterLoad)&&(c[0]||!u&&(W||B||x||_||"auto"!=n[t].getAttribute(a.sizesAttr)))&&(r=c[0]||n[t]);else V(n[t]);r&&!s&&V(r)}},G=b(q),J=function(e){z(e.target,a.loadedClass),v(e.target,a.loadingClass),y(e.target,J)},K=function(e,t){try{e.contentWindow.location.replace(t)}catch(a){e.setAttribute("src",t)}},Q=function(e){var t,i,n=e.getAttribute(a.srcsetAttr);(t=a.customMedia[e.getAttribute("data-media")||e.getAttribute("media")])&&e.setAttribute("media",t),n&&e.setAttribute("srcset",n),t&&(i=e.parentNode,i.insertBefore(e.cloneNode(),e),i.removeChild(e))},U=function(){var e,t=[],a=function(){for(;t.length;)t.shift()();e=!1};return function(i){t.push(i),e||(e=!0,l(a))}}(),V=function(e){var t,i,n,r,s,l,c,A=T.test(e.nodeName),C=A&&(e.getAttribute(a.sizesAttr)||e.getAttribute("sizes")),b="auto"==C;(!b&&d||!A||!e.src&&!e.srcset||e.complete||g(e,a.errorClass))&&(b&&(c=e.offsetWidth),e._lazyRace=!0,F++,U(function(){e._lazyRace&&delete e._lazyRace,v(e,a.lazyClass),(s=p(e,"lazybeforeunveil")).defaultPrevented||(C&&(b?(z(e,a.autosizesClass),N.updateElem(e,!0,c)):e.setAttribute("sizes",C)),i=e.getAttribute(a.srcsetAttr),t=e.getAttribute(a.srcAttr),A&&(n=e.parentNode,r=n&&u.test(n.nodeName||"")),l=s.detail.firesLoad||"src"in e&&(i||t||r),s={target:e},l&&(y(e,H,!0),clearTimeout(f),f=o(H,2500),z(e,a.loadingClass),y(e,J,!0)),r&&m.call(n.getElementsByTagName("source"),Q),i?e.setAttribute("srcset",i):t&&!r&&(k.test(e.nodeName)?K(e,t):e.setAttribute("src",t)),(i||r)&&h(e,{src:t})),(!l||e.complete)&&(l?H(s):F--,J(s))}))},X=function(){if(!d){if(Date.now()-E<999)return void o(X,999);var e,t=function(){a.loadMode=3,R=S,G()};d=!0,a.loadMode=3,F||G(),s("scroll",function(){3==a.loadMode&&(R=L,a.loadMode=2),clearTimeout(e),e=o(t,99)},!0)}};return{_:function(){E=Date.now(),n=t.getElementsByClassName(a.lazyClass),c=t.getElementsByClassName(a.lazyClass+" "+a.preloadClass),R=a.expand,S=R,L=R*((a.expFactor+1)/2),D=R*a.expFactor,s("scroll",G,!0),s("resize",G,!0),e.MutationObserver?new MutationObserver(G).observe(i,{childList:!0,subtree:!0,attributes:!0}):(i[r]("DOMNodeInserted",G,!0),i[r]("DOMAttrModified",G,!0),setInterval(G,999)),s("hashchange",G,!0),["focus","mouseover","click","load","transitionend","animationend","webkitAnimationEnd"].forEach(function(e){t[r](e,G,!0)}),/d$|^c/.test(t.readyState)?X():(s("load",X),t[r]("DOMContentLoaded",G),o(X,2e4)),G(n.length>0)},checkElems:G,unveil:V}}(),N=function(){var e,i=function(e,t,a){var i,n,r,s,o=e.parentNode;if(o&&(a=C(e,o,a),s=p(e,"lazybeforesizes",{width:a,dataAttr:!!t}),!s.defaultPrevented&&(a=s.detail.width,a&&a!==e._lazysizesWidth))){if(e._lazysizesWidth=a,a+="px",e.setAttribute("sizes",a),u.test(o.nodeName||""))for(i=o.getElementsByTagName("source"),n=0,r=i.length;r>n;n++)i[n].setAttribute("sizes",a);s.detail.dataAttr||h(e,s.detail)}},n=function(){var t,a=e.length;if(a)for(t=0;a>t;t++)i(e[t])},r=b(n);return{_:function(){e=t.getElementsByClassName(a.autosizesClass),s("resize",r)},checkElems:r,updateElem:i}}(),M=function(){M.i||(M.i=!0,N._(),E._())};return function(){var t,i={lazyClass:"lazyload",loadedClass:"lazyloaded",loadingClass:"lazyloading",preloadClass:"lazypreload",errorClass:"lazyerror",autosizesClass:"lazyautosizes",srcAttr:"data-src",srcsetAttr:"data-srcset",sizesAttr:"data-sizes",minSize:40,customMedia:{},init:!0,expFactor:2,expand:359,loadMode:2};a=e.lazySizesConfig||e.lazysizesConfig||{};for(t in i)t in a||(a[t]=i[t]);e.lazySizesConfig=a,o(function(){a.init&&M()})}(),{cfg:a,autoSizer:N,loader:E,init:M,uP:h,aC:z,rC:v,hC:g,fire:p,gW:C}}});