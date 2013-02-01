var refreshing = false;
var startinglimit;
var refreshed;

function searchStrings(more){
	obj = new Object();
	obj.searchfor	= $j('#searchstring').val();
	obj.searchtype	= $j('input:radio[name=searchtype]:checked').val();	

	// Prevent searching if the cache is refreshed at the moment
	if (refreshing){
		return;
	}

	// Only update the used searchstring and searchtype if the search button
	// was used to start the search (that will be the case if 'more' is null)
	if (more > 0){
		// If 'more' is greater than 0 we have already displayed some results for
		// the current searchstring, so display the spinner at the more link
		$j('#more-results').addClass('overrider-spinner');
		obj.more = more;
		
	} else {
		// Otherwise it is a new searchstring and we have to remove all previous results first
		$j('#more-results').attr('style', 'display:none;');
		var children = $j('#results-container div.language-results');
		children.remove();
		$j('#results-container').addClass('overrider-spinner').show();
		
	}

    $j.ajax({
      type: "POST",
      url: "index.php?option=com_joverrider&task=searchstring",
      data: {search_data: JSON.stringify(obj)},
      dataType: "json",
    /*  async: false, */
      success: function(r)
      {
			if (r.message){
				alert(r.message);
			}
			
			if(r.data.results.length > 0){
				insertResults(r.data.results);
			} else {
				// If there aren't any results display an appropriate message
				$j('#results').html('No strings found!');
			}
			
			if(r.data.more > 0) {
				// If there are more results than the sent ones
				// display the more link
				startinglimit = r.data.more;
				$j('#more-results').show();
			} else {
				$j('#more-results').attr('style', 'display:none;');
			}
			
			$j('#results-container').removeClass('overrider-spinner');
			$j('#more-results').removeClass('overrider-spinner');
      },
      error: function()
      {
        alert("I cannot search the string");
      }
    });	
}

function refreshStrings(){
	refreshing = true;
	$j('#refresh-status').show();    
	$j.ajax({
      type: "POST",
      url: "index.php?option=com_joverrider&task=refreshstrings",
      data: {},
      dataType: "json",
    /*  async: false, */
      success: function(r)
      {
		$j('#refresh-status').hide();
		
		if (r.message){
			$j('#refresh-result').html(r.message).show();
			setInterval(function(){$j('#refresh-result').hide('slow')},2000);
		}

		refreshing = false;
      },
      error: function()
      {
        alert("I cannot refresh the strings list in the DB");
		$j('#refresh-status').hide();
		refreshing = false;
      }
    });	
}
var counter = 0;
var results_div;

function insertResults(results){
	// For creating an individual ID for each result we use a counter
	counter = counter + 1;

	var newresults = '<div id="language-results' + counter +'" class="language-results" style="display:none;"></div>';
	$j('#results').append(newresults);
	
	// Create some elements for each result and insert it into the container
	Array.each(results, function (item, index) {
			var resdata = '<div title="'+ item.file +'" class="result row' + index%2 +'" onclick="selectString(' + counter + index + ');"><table class="admintable joverrider"><tr>'
	+'	<td id="override_key' + counter + index + '" class="result-key">'+ item.constant +'</td>'
	+'	<td id="override_lang' + counter + index + '" class="result-lang">'+ item.lang +'</td>'
	+'</tr>'
	+'<tr>'
	+'	<td id="override_string' + counter + index + '" class="result-string">'+ item.string +'</td>'
	+'	<td id="override_client' + counter + index + '" class="result-client">'+ item.client +'</td>'
	+'</tr></table>';
		
		$j('#language-results' + counter).append(resdata);
	}, this);

	// Finally insert the container afore the more link and reveal it
	$j('#language-results' + counter).show();
};

function selectString(id){
	$j('#constant').val($j('#override_key' + id).html());
	$j('#text').val($j('#override_string' + id).html());
	
	cli = 1;
	if($j('#override_client' + id).html() == 'site'){
		cli = 0;
	}
	$j('#lang_client').val(cli);
	$j('#lang_code').val($j('#override_lang' + id).html());
	
	str = $j('#override_key' + id).html();
	n = str.split('_');
	$j('#lang_group').val(n[0] + '_' + n[1]);
	
	$j('#text').each(resizetxtarea);
	$j('html, body').animate({scrollTop:0}, 'slow');
};