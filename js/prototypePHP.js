/*
* Define the animations used in the prototypePage.php, including the dropdown toggle menu, checkbox selections and tab menu transitions
* By Shiyi Zhang and Wei-Ling Chin
* 
*/

// A global variable to keep track the dropdown filter menu
var filterTitleClickedCount = 0;

// Toggle the dropdown filter menu
function filterTitleClick() {
	blockShow = document.getElementById('checkboxes');
	
	// If click the filter for the first time, show the dropdown selection menu
	if (filterTitleClickedCount == 0){
			
		$('.checkboxes').show('slow');
			
		$('#toggle-icon').fadeOut('slow');
		$('#toggle-icon-up').fadeIn('slow');
			
		// Change the arrow from pointing down to pointing up
		document.getElementById('toggle-icon-up').style.visibility="visible";
		document.getElementById('toggle-icon').style.visibility="hidden";
		
		// Update the count
		filterTitleClickedCount++;
			
		// Set the bookmark so that the entire page will move the the map section
		document.getElementById('searchBookmark').href="#mapExpand";	
	}
	// Else, hide the dropdown selection menu
	else {
			
		$('.checkboxes').hide('slow');
			
		$('#toggle-icon-up').fadeOut('slow');
		$('#toggle-icon').fadeIn('slow');
			
		//Change the arrow from pointing up to pointing down
		document.getElementById('toggle-icon').style.visibility="visible";
		document.getElementById('toggle-icon-up').style.visibility="hidden";
			
		// Update the count
		filterTitleClickedCount--;
		
		// Set the bookmark so that the entire page will move the the map section
		document.getElementById('searchBookmark').href="#map";
	}
}

// For the selectAll option for SNS checkbox
function toggleSNS(source) {
	
	// If the selectAll checkox is ticked, all the checkboxes under the SNS type will be selected
	checkboxes = document.getElementsByName('sns');
	for(var i=0, n=checkboxes.length;i<n;i++) {
		checkboxes[i].checked = source.checked;
	}
}

// For the selectAll option for the type checkbox
function toggleType(source) {
    
	// Define variables for each checkbox
    geotagged = document.getElementById('inlineCheckbox_geotagged');
    geoword = document.getElementById('inlineCheckbox_geoword');
    profile = document.getElementById('inlineCheckbox_profile');
    networking = document.getElementById('inlineCheckbox_networking');
    facebook = document.getElementById('inlineCheckbox_facebook');
    twitter = document.getElementById('inlineCheckbox_twitter');   

    typeAll = document.getElementById('rowSelectAllc');      
    snsAll = document.getElementById('rowSelectAllc2');
    
	// If the selectAll checkox is ticked, all the checkboxes under the Type category will be selected
	checkboxes = document.getElementsByName('result');
	for(var i=0, n=checkboxes.length;i<n;i++) {
		checkboxes[i].checked = source.checked;
	}

	// Disabled checkboxes will not be ticked
	if (geotagged.disabled == true) {
		geotagged.checked = false;
	}
	if (geoword.disabled == true) {
		geoword.checked = false;
	}
    
	//If selectAll checkboxes are chosen, all checkboxes should be selected
    if (snsAll.checked == true){
        geotagged.disabled = false;
        geotagged.checked = true;
        geoword.disabled = false;
        geoword.checked = true;
    }
        
    if (source.checked == false){
        geotagged.checked = false;
        geoword.checked = false;
    }
}

// Checkbox selection for the Facebook option
function facebookClicked(source) {

	// Define variables for each checkbox
    geotagged = document.getElementById('inlineCheckbox_geotagged');
    geoword = document.getElementById('inlineCheckbox_geoword');
    profile = document.getElementById('inlineCheckbox_profile');
    networking = document.getElementById('inlineCheckbox_networking');
    facebook = document.getElementById('inlineCheckbox_facebook');
    twitter = document.getElementById('inlineCheckbox_twitter');   

    typeAll = document.getElementById('rowSelectAllc');      
    snsAll = document.getElementById('rowSelectAllc2');
    
	// Disable the geo-tagged and geo-word checkboxes when Facebook option is selected
	if (source.checked == true) {
		geotagged.disabled = true;
		geoword.disabled = true;
	}
	else {
		geotagged.disabled = false;
		geoword.disabled = false;
	}
        
	// If both Twitter and Facebook options are selected, update the selectAll checkbox for the SNS type
    if (twitter.checked == true && source.checked == true){
        snsAll.checked = true;
    }else{
        if (source.checked == false) {
			typeAll.checked = false;
        }
        snsAll.checked = false;
    }
     
	// If all the geolocation method options are selected, update the selectAlll checkbox for the Type category
	if (geoword.checked == true && geotagged.checked == true && profile.checked == true && networking.checked == true){
		typeAll.checked = true;
    }    
}

// Checkbox selection for the Twitter option
function twitterClicked(source) {
    
	// Define variables for each checkbox
    geotagged = document.getElementById('inlineCheckbox_geotagged');
    geoword = document.getElementById('inlineCheckbox_geoword');
    profile = document.getElementById('inlineCheckbox_profile');
    networking = document.getElementById('inlineCheckbox_networking');
    facebook = document.getElementById('inlineCheckbox_facebook');
    twitter = document.getElementById('inlineCheckbox_twitter');   

    typeAll = document.getElementById('rowSelectAllc');      
    snsAll = document.getElementById('rowSelectAllc2');
	
	// If both Twitter and Facebook options are selected, update the selectAll checkbox for the SNS type
    if (facebook.checked == true && source.checked == true){
        snsAll.checked = true;
    }else{
        snsAll.checked = false;
    }
	
	// If the Facebook option is selected, disable the geo-tagged and the geo-word checkboxes
    if (facebook.checked == true) {
        geotagged.checked = false;
        geotagged.disabled = true;
        geoword.checked = false;
        geoword.disabled = true;
    }
}

// Checkbox selection for the geo-tagged option
function geotagClicked(source) {
    
	// Define variables for each checkbox
    geotagged = document.getElementById('inlineCheckbox_geotagged');
    geoword = document.getElementById('inlineCheckbox_geoword');
    profile = document.getElementById('inlineCheckbox_profile');
    networking = document.getElementById('inlineCheckbox_networking');
    facebook = document.getElementById('inlineCheckbox_facebook');
    twitter = document.getElementById('inlineCheckbox_twitter');   

    typeAll = document.getElementById('rowSelectAllc');      
    snsAll = document.getElementById('rowSelectAllc2');
        
	// Update the selectAll checkbox for the Type category when all geolocation method options are selected
    if (profile.checked == true && source.checked == true && geoword.checked == true && networking.checked == true){
        typeAll.checked = true;
    }else{
		typeAll.checked = false;
	}
}

// Checkbox selection for the user profile option
function profileClicked(source) {
    
	// Define variables for each checkbox
    geotagged = document.getElementById('inlineCheckbox_geotagged');
    geoword = document.getElementById('inlineCheckbox_geoword');
    profile = document.getElementById('inlineCheckbox_profile');
    networking = document.getElementById('inlineCheckbox_networking');
    facebook = document.getElementById('inlineCheckbox_facebook');
    twitter = document.getElementById('inlineCheckbox_twitter');   

    typeAll = document.getElementById('rowSelectAllc');      
    snsAll = document.getElementById('rowSelectAllc2');
      
	// Update the selectAll checkbox for the Type category when all geolocation method options are selected
    if (geotagged.checked == true && source.checked == true && geoword.checked == true && networking.checked == true){
        typeAll.checked = true;
    }else{
        typeAll.checked = false;
    }
}

// Checkbox selection for the geo-word option
function geowordClicked(source) {
    
	// Define variables for each checkbox
    geotagged = document.getElementById('inlineCheckbox_geotagged');
    geoword = document.getElementById('inlineCheckbox_geoword');
    profile = document.getElementById('inlineCheckbox_profile');
    networking = document.getElementById('inlineCheckbox_networking');
    facebook = document.getElementById('inlineCheckbox_facebook');
    twitter = document.getElementById('inlineCheckbox_twitter');   

    typeAll = document.getElementById('rowSelectAllc');      
    snsAll = document.getElementById('rowSelectAllc2');
     
	// Update the selectAll checkbox for the Type category when all geolocation method options are selected
    if (profile.checked == true && source.checked == true && geotagged.checked == true && networking.checked == true){
        typeAll.checked = true;
    }else{
        typeAll.checked = false;
    }
}

// Checkbox selection for the social network option
function networkingClicked(source) {
        
	// Define variables for each checkbox
    geotagged = document.getElementById('inlineCheckbox_geotagged');
    geoword = document.getElementById('inlineCheckbox_geoword');
    profile = document.getElementById('inlineCheckbox_profile');
    networking = document.getElementById('inlineCheckbox_networking');
    facebook = document.getElementById('inlineCheckbox_facebook');
    twitter = document.getElementById('inlineCheckbox_twitter');   

    typeAll = document.getElementById('rowSelectAllc');      
    snsAll = document.getElementById('rowSelectAllc2');
	
	// Update the selectAll checkbox for the Type category when all geolocation method options are selected
    if (profile.checked == true && source.checked == true && geotagged.checked == true && geoword.checked == true){
        typeAll.checked = true;
    }else{
        typeAll.checked = false;
    }
}
	
// The tab transitions
function tabs(selectedtab) { 
   
	// Show the tab contents when clicking different tab names
	var s_tab_content = "tab_content_" + selectedtab;   
	var contents = document.getElementsByTagName("div");
	for(var x=0; x<contents.length; x++) {
		name = contents[x].getAttribute("name");
		if (name == 'tab_content') {
			// Show the corresponding contents, and hide other tab contents
			if (contents[x].id == s_tab_content) {
				contents[x].style.display = "block";                        
			} else {
				contents[x].style.display = "none";
			}
		}
	}   
	// Show the active tab when clicking different tab names
	var s_tab = "tab_" + selectedtab;       
	var tabs = document.getElementsByTagName("li");
	for(var x=0; x<tabs.length; x++) {
		name = tabs[x].getAttribute("name");
		if (name == 'tab') {
			// Display the active tab by adding a line underneath the tab name
			if (tabs[x].id == s_tab) {
				tabs[x].className = "active";                       
			} else {
			tabs[x].className = "";
			}
		}
	}
	
	// Set the last tab as the boundary
	var tab = document.getElementById("tab_4").className;
	if (tab != "active"){
		document.getElementById("tab_4").className="last";
	}
}

// Set the bookmark so that the page can move to the map section
$(document).ready(function(){
	document.getElementById('searchBookmark').href="#map";
});