$(document).bind("mobileinit", function(){
  
  $.extend(  $.mobile , {
    loadingMessage: "Laster inn...", 
    pageLoadErrorMessage: "Kunne ikke vise side"
  });
  
  $('#show-more-results').live('tap', function() {
    show_more_results($(this).attr('id'));
  });
  
});


function show_more_results(searchid) {

  // Display progress indicator
  $.mobile.showPageLoadingMsg()

  // FIXME Make one call to getUrlVars or $.mobile.path.parseUrl
  var q           = $.getUrlVar('q');
  var library     = $.getUrlVar('library');
  var sort_by     = $.getUrlVar('sort_by');
  var sort_order  = $.getUrlVar('sort_order');
  var format      = $.getUrlVar('format');
  
  // Set default for nextpage
  if ($('#' + searchid).jqmData('nextpage') == undefined) {
    $('#' + searchid).jqmData('nextpage', 1);
  }
  
  // Get the value of nextpage
  var nextpage = $('#' + searchid).jqmData('nextpage');
  
  // Construct url
  // TODO Use jQuery.param? 
  var url = '/glitre/api/index.php?q=' + q + '&library=' + library + '&sort_by=' + sort_by + '&sort_order=' + sort_order + '&format=' + format + '&page=' + nextpage;
  
  /*
  // Fetch the actual data
  $('#searchtmp').load(url + ' .searchresult', function(response, status, xhr) {
    if (status == "error") {
      alert("Error! " + xhr.status + " " + xhr.statusText);
    } else if (status == "success") {
      // alert('Data loaded!')
      // Move items from temporary location
      $('#searchtmp li').appendTo('#searchresults');
      $('#searchresults').listview("refresh");
      // alert('moved');
      // Increment the nextpage counter
      $('#' + searchid).jqmData('nextpage', nextpage+1);
    }
  });
  */
  
  // Fetch the actual data
  $('#searchtmp').load(url + ' .searchresult', function(response, status, xhr) {
    if (status == "error") {
      alert("Error! " + xhr.status + " " + xhr.statusText);
    } else if (status == "success") {
      // alert('Data loaded!');
      // Move items from temporary location
      $('#searchtmp li').appendTo('#searchresults');
      $('#searchresults').listview("refresh");
      // TODO Update "from x to y of z"
      // Increment the nextpage counter
      $('#' + searchid).jqmData('nextpage', nextpage+1);
    }
  });
  
  // Hide progress indicator
  $.mobile.hidePageLoadingMsg()

}

// Thanks to: http://jquery-howto.blogspot.com/2009/09/get-url-parameters-values-with-jquery.html
$.extend({
  getUrlVars: function(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
      hash = hashes[i].split('=');
      // The following two lines remove anything after a #
      var subhash = hash[1].split('#');
      hash[1] = subhash[0];
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars;
  },
  getUrlVar: function(name){
    return $.getUrlVars()[name];
  }
});
