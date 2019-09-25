/*!
 * Load ND icons
 */
;(function(window,document){'use strict';if(!document.createElementNS||!document.createElementNS('http://www.w3.org/2000/svg','svg').createSVGRect){return true;}
var file='https://static.nd.edu/images/icons/base-v1.svg',version=2,isLocalStorage='localStorage'in window&&window['localStorage']!==null,request,data,insertIT=function(){document.body.insertAdjacentHTML('afterbegin',data);},insert=function(){if(document.body)insertIT();else document.addEventListener('DOMContentLoaded',insertIT);};if(isLocalStorage&&localStorage.getItem('inlineSVGrev')==version){data=localStorage.getItem('inlineSVGdata');if(data){insert();return true;}}
try{request=new XMLHttpRequest();request.open('GET',file,true);request.onload=function(){if(request.status>=200&&request.status<400){data=request.responseText;insert();if(isLocalStorage){localStorage.setItem('inlineSVGdata',data);localStorage.setItem('inlineSVGrev',version);}}}
request.send();}catch(e){}}(window,document));var icons=document.querySelectorAll('span.icon');for(i=0;i<icons.length;i++){var el=icons[i],className=el.getAttribute('class'),dataIcon=el.getAttribute('data-icon'),svg=document.createElementNS('http://www.w3.org/2000/svg','svg'),use=document.createElementNS('http://www.w3.org/2000/svg','use');use.setAttributeNS('http://www.w3.org/1999/xlink','xlink:href','#icon-'+dataIcon);svg.setAttribute('class',className);svg.setAttribute('data-icon',dataIcon);svg.appendChild(use);el.parentNode.replaceChild(svg,el);}