/*!
 * Replace no-js on HTML with js
 */
document.documentElement.className = document.documentElement.className.replace(/(\s|^)no-js(\s|$)/, '$1' + 'js' + '$2');

/*!
 * Get parameter value from URL or URL string
 * Used by Search and Video Placeholder
 * Updated 2015-12-07
 */
function getURLParameter(param, href){
  var href = (href && href.length > 0 && href.indexOf('?') != -1) ? href.split('?')[1] : window.location.search.substring(1),
      pairs = href.split('&')
  ;
  for(var i = 0; i < pairs.length; i++){
    var pair = pairs[i].split('=');
    if(pair[0] == param){
      return pair[1];
    }
  }
}

// IE safe forEach method
var forEach = function (array, callback, scope){
  for (var i = 0; i < array.length; i++){
    callback.call(scope, i, array[i]);
  }
};

/*!
 * General Helpers
 */
document.addEventListener('DOMContentLoaded', function(){

  // Table overflow
  document.querySelectorAll('table').forEach(function(item) {
    table = item;
    var table_wrapper = document.createElement('div');
    table_wrapper.setAttribute('class', 'tablewrap');
    table.parentNode.insertBefore(table_wrapper, table);
    table_wrapper.appendChild(table);
  });

  // Link Tracking
  document.querySelectorAll('a').forEach(function(item) {
    var link = item;
    // External Link Tracking
    if(link.href.indexOf(location.hostname) == -1){
      link.addEventListener('click', function(e){
        try{ ga( 'send', 'event', 'UserAction', 'External Link', e.target.href ); } catch(err){}
      }, false);
    }

    // PDF Download tracking
    if(link.href.indexOf('.pdf') != -1){
      link.addEventListener('click', function(e){
        try{ ga( 'send', 'event', 'UserAction', 'PDF Download', e.target.href ); } catch(err){}
      }, false);
    }

  });

}, false);

/*!
 * Mobile Nav
 * @author Erik Runyon
 * Updated 2017-10-23
 */
(function(){
  var wrapper = document.querySelector('#wrapper'),
      drawer = document.getElementById('nav-mobile'),
      button = document.querySelectorAll('.nav-skip, .btn-nav-mobile'),
      toggleDrawer = function(){
        wrapper.classList.contains('active') ? wrapper.classList.remove('active') : wrapper.classList.add('active');
        drawer.classList.contains('active') ? drawer.classList.remove('active') : drawer.classList.add('active');
        button.forEach(function(item){
          item.classList.contains('toggled') ? item.classList.remove('toggled') : item.classList.add('toggled');
        });
      }
  ;

  // Add Mobile Nav
  var nav = document.querySelector('#nav').outerHTML;
  var mobile_nav_html = nav.replace(/id="nav"/i, 'id="nav-mobile-inner"')
                       .replace(/aria-label="Primary navigation"/i, 'aria-label="Mobile Navigation"');
  drawer.innerHTML = mobile_nav_html;

  // Add Listeners
  document.querySelector('#content').addEventListener('click', function(){ if(wrapper.classList.contains('active')) toggleDrawer(); }, false);
  window.addEventListener('resize', function(){ if(wrapper.classList.contains('active')) toggleDrawer(); }, false);
  button.forEach(function(item){
    item.addEventListener('click', function(e){ e.preventDefault(); toggleDrawer(); }, false)
  });
})();

/*!
 * Fixed Navs
 * @author Erik Runyon
 * Updated 2019-01-16 SMM
 */
(function(){
  var scrollCurr = 0,
      hasNavTop = (!!document.querySelector('#nav-top'));
      nav_mobile = document.querySelector('.nav-mobile-util'),
      nav_mobile_height = nav_mobile.offsetHeight,
      nav_mobile_offset = nav_mobile.offsetTop
  ;

  if (hasNavTop) {
    var nav_primary = document.querySelector('.nav-header'),
        nav_fixed = document.getElementById('navbar'),
        nav_primary_bot = nav_primary.offsetHeight + nav_primary.offsetTop,
        top_nav_html = document.querySelector('#nav-top').innerHTML
    ;
    nav_fixed.innerHTML = top_nav_html;
  }


  window.addEventListener('scroll', function(){
    scrollCurr = window.pageYOffset;

    // Mobile Sticky Nav
    if (window.innerWidth <= 960){
      if (scrollCurr > nav_mobile_offset){
        document.body.style.marginTop = nav_mobile_height + 'px';
        nav_mobile.classList.add('fixed');
      } else {
        nav_mobile.classList.remove('fixed');
        document.body.style.marginTop = 0;
      }
    } else if (hasNavTop) {
      // Fullsize Sticky Nav
      if (scrollCurr > nav_primary_bot){
        nav_fixed.classList.add('visible');
      } else {
        nav_fixed.classList.remove('visible');
      }
    }
  });
})();

/*!
 * Primary Nav Search
 * @author Erik Runyon
 * Updated 2018-09-28
 */
document.addEventListener('click', function(e){
  // https://gomakethings.com/checking-event-target-selectors-with-event-bubbling-in-vanilla-javascript/
  if(e.target.closest('.search-toggle')){
    e.preventDefault();

    // Close the mobile nav if open
    if(document.getElementById('nav-mobile').classList.contains('active')){
      document.querySelectorAll('.nav-menu')[0].click();
    }

    var activeEl = document.activeElement,
        b = document.querySelectorAll('.nav-top, .nav-mobile-util'),
        isMobile = function(){ return !!activeEl.closest('.nav-mobile-util'); }
    ;

    forEach(b, function (index, element){
      if(element.classList.contains('active')){
        element.classList.add('is-closing-search');
        window.setTimeout(function(){
          element.classList.remove('active');
          element.classList.remove('is-closing-search');
        }, 500);
      } else {
        element.classList.add('is-opening-search');
        window.setTimeout(function(){
          element.classList.add('active');
          element.classList.remove('is-opening-search');
          if(isMobile()){ var searchContainer = activeEl.closest('.nav-mobile-util'); }
          if(activeEl.closest('.nav-top')){ var searchContainer = activeEl.closest('.nav-top'); }
          if(searchContainer){
            var searchInput = searchContainer.querySelector('.search-input');
            window.setTimeout(function(){ searchInput.focus(); }, 500);
          }
        }, 500);
      }
    });
  }
}, false);

/*!
 * Activate Primary Nav Search when skip link is used
 * @author Erik Runyon
 * Updated 2018-10-30
 */
window.addEventListener("hashchange", function(){
  if(window.location.hash.substring(1) == 'search-nav-top'){
    document.getElementById('nav-top').classList.add('active');
    window.setTimeout(function(){
      document.getElementById('search-input-nav-top').focus();
    }, 500);
  }
}, false);

/*!
 * Search
 * @author Erik Runyon
 * Updated 2017-10-23
 */
if(document.querySelectorAll('.search-results').length > 0){
  var p = document.createElement('p'),
      search_results = document.querySelectorAll('.search-results')[0]
  ;

  p.setAttribute('class', 'search-sort');
  p.innerHTML = 'Sort by: <select class="search-sort-select" id="sort-select"><option value="">Relevance</option><option value="date">Date</option></select>';

  search_results.parentNode.insertBefore(p, search_results);

  var sort_select = document.querySelector('#sort-select');
  sort_select.addEventListener('change', function(e){
    window.location.href = window.location.origin + window.location.pathname + '?q=' + getURLParameter('q') + '&as_sitesearch=' + getURLParameter('as_sitesearch') + '&sort=' + sort_select.value;
  }, false);

  if(getURLParameter('sort') == 'date'){
    sort_select.value = 'date';
  }
}

/* Google Fonts */
WebFontConfig = {
  google: { families: [ 'Libre+Franklin:400,bold', 'Sumana:400' ] }
};
(function(){
  var wf = document.createElement('script');
  wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
  wf.type = 'text/javascript';
  wf.async = 'true';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(wf, s);
})();

/*!
 * Social Sharing
 */
document.addEventListener('DOMContentLoaded', function(){
  if(document.querySelectorAll('article').length === 1){
    var containers = document.querySelectorAll('.social-share'),
        url = encodeURIComponent(document.location.href),
        title = encodeURIComponent(document.querySelector('article h1').innerText),
        img = document.querySelector('article img') ? encodeURIComponent(document.querySelector('article img').src) : '',
        content = '<ul class="no-bullets"> ',
        services = [
          {
            service: 'Facebook',
            url: 'https://www.facebook.com/dialog/share?app_id=135465433914446&display=popup&href='+ url +'&title='+ title,
            html: '<svg class="icon" data-icon="facebook"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-facebook"></use></svg>'
          },
          {
            service: 'Twitter',
            url: 'https://twitter.com/intent/tweet?text='+ title +'&url='+ url,
            html: '<svg class="icon" data-icon="twitter"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-twitter"></use></svg>'
          },
          {
            service: 'Email',
            url: 'mailto:?subject='+ title +'&body='+ url,
            html: '<svg class="icon" data-icon="envelope-o"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-envelope-o"></use></svg>'
          }
        ];

    for(i=0; i<services.length; i++){
      content += '<li><a title="'+ services[i].service +'" class="share-'+ services[i].service.toLowerCase() +'" href="'+ services[i].url +'">'+ services[i].html +'</a></li>';
    }
    content += '</ul>';
    [].forEach.call(containers, function(container) {
      container.innerHTML = content;
      container.addEventListener('click', function(e){
        if(e.target && e.target.tagName.toLowerCase() === 'a'){
          var service = e.target.protocol.indexOf('mailto') !== -1 ? 'email' : e.target.host;
          try{ ga('send', 'event', 'Social Share', service, title); } catch(err){}
          if(service !== 'email'){
            e.preventDefault();
            window.open(e.target.href, "_blank", "toolbar=no,menubar=no,location=yes,resizable=yes,scrollbars=yes,status=yes,width=600,height=400,modal=yes,alwaysRaised=yes");
          }
        }
      }, false);
    });
  } // /if
});
