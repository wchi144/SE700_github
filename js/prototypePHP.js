var filterTitleClickedCount = 0;
	
function filterTitleClick() {
	blockShow = document.getElementById('checkboxes');
		
	if (filterTitleClickedCount == 0){
			
		$('.checkboxes').show('slow');
			
		$('#toggle-icon').fadeOut('slow');
		$('#toggle-icon-up').fadeIn('slow');
			
		document.getElementById('toggle-icon-up').style.visibility="visible";
		document.getElementById('toggle-icon').style.visibility="hidden";
		filterTitleClickedCount++;
			
		document.getElementById('searchBookmark').href="#mapExpand";	
	}
	else {
			
		$('.checkboxes').hide('slow');
			
		$('#toggle-icon-up').fadeOut('slow');
		$('#toggle-icon').fadeIn('slow');
			
		document.getElementById('toggle-icon').style.visibility="visible";
		document.getElementById('toggle-icon-up').style.visibility="hidden";
			
		filterTitleClickedCount--;
			
		document.getElementById('searchBookmark').href="#map";
	}
}
	
function toggleSNS(source) {
	checkboxes = document.getElementsByName('sns');
	for(var i=0, n=checkboxes.length;i<n;i++) {
		checkboxes[i].checked = source.checked;
	}
}
	
function toggleType(source) {
    
        geotagged = document.getElementById('inlineCheckbox_geotagged');
        geoword = document.getElementById('inlineCheckbox_geoword');
        profile = document.getElementById('inlineCheckbox_profile');
        networking = document.getElementById('inlineCheckbox_networking');
        facebook = document.getElementById('inlineCheckbox_facebook');
        twitter = document.getElementById('inlineCheckbox_twitter');   

        typeAll = document.getElementById('rowSelectAllc');      
        snsAll = document.getElementById('rowSelectAllc2');
        
	checkboxes = document.getElementsByName('result');
	for(var i=0, n=checkboxes.length;i<n;i++) {
		checkboxes[i].checked = source.checked;
	}

	if (geotagged.disabled == true) {
		geotagged.checked = false;
	}
	if (geoword.disabled == true) {
		geoword.checked = false;
	}
        
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
	
function facebookClicked(source) {
        geotagged = document.getElementById('inlineCheckbox_geotagged');
        geoword = document.getElementById('inlineCheckbox_geoword');
        profile = document.getElementById('inlineCheckbox_profile');
        networking = document.getElementById('inlineCheckbox_networking');
        facebook = document.getElementById('inlineCheckbox_facebook');
        twitter = document.getElementById('inlineCheckbox_twitter');   

        typeAll = document.getElementById('rowSelectAllc');      
        snsAll = document.getElementById('rowSelectAllc2');
        
	if (source.checked == true) {
		geotagged.disabled = true;
		geoword.disabled = true;
	}
	else {
		geotagged.disabled = false;
		geoword.disabled = false;
	}
        
        if (twitter.checked == true && source.checked == true){
            snsAll.checked = true;
        }else{
            if (source.checked == false) {
                typeAll.checked = false;
            }
            snsAll.checked = false;
        }
        
        if (geoword.checked == true && geotagged.checked == true && profile.checked == true && networking.checked == true){
            typeAll.checked = true;
        }
        
}

function twitterClicked(source) {
    
        geotagged = document.getElementById('inlineCheckbox_geotagged');
        geoword = document.getElementById('inlineCheckbox_geoword');
        profile = document.getElementById('inlineCheckbox_profile');
        networking = document.getElementById('inlineCheckbox_networking');
        facebook = document.getElementById('inlineCheckbox_facebook');
        twitter = document.getElementById('inlineCheckbox_twitter');   

        typeAll = document.getElementById('rowSelectAllc');      
        snsAll = document.getElementById('rowSelectAllc2');
	
        if (facebook.checked == true && source.checked == true){
            snsAll.checked = true;
        }else{
            snsAll.checked = false;
        }
        if (facebook.checked == true) {
            geotagged.checked = false;
            geotagged.disabled = true;
            geoword.checked = false;
            geoword.disabled = true;
        }
}

function geotagClicked(source) {
    
        geotagged = document.getElementById('inlineCheckbox_geotagged');
        geoword = document.getElementById('inlineCheckbox_geoword');
        profile = document.getElementById('inlineCheckbox_profile');
        networking = document.getElementById('inlineCheckbox_networking');
        facebook = document.getElementById('inlineCheckbox_facebook');
        twitter = document.getElementById('inlineCheckbox_twitter');   

        typeAll = document.getElementById('rowSelectAllc');      
        snsAll = document.getElementById('rowSelectAllc2');
        
        if (profile.checked == true && source.checked == true && geoword.checked == true && networking.checked == true){
            typeAll.checked = true;
        }else{
            typeAll.checked = false;
        }
}

function profileClicked(source) {
    
        geotagged = document.getElementById('inlineCheckbox_geotagged');
        geoword = document.getElementById('inlineCheckbox_geoword');
        profile = document.getElementById('inlineCheckbox_profile');
        networking = document.getElementById('inlineCheckbox_networking');
        facebook = document.getElementById('inlineCheckbox_facebook');
        twitter = document.getElementById('inlineCheckbox_twitter');   

        typeAll = document.getElementById('rowSelectAllc');      
        snsAll = document.getElementById('rowSelectAllc2');
        
        if (geotagged.checked == true && source.checked == true && geoword.checked == true && networking.checked == true){
            typeAll.checked = true;
        }else{
            typeAll.checked = false;
        }
}

function geowordClicked(source) {
    
        geotagged = document.getElementById('inlineCheckbox_geotagged');
        geoword = document.getElementById('inlineCheckbox_geoword');
        profile = document.getElementById('inlineCheckbox_profile');
        networking = document.getElementById('inlineCheckbox_networking');
        facebook = document.getElementById('inlineCheckbox_facebook');
        twitter = document.getElementById('inlineCheckbox_twitter');   

        typeAll = document.getElementById('rowSelectAllc');      
        snsAll = document.getElementById('rowSelectAllc2');
        
        if (profile.checked == true && source.checked == true && geotagged.checked == true && networking.checked == true){
            typeAll.checked = true;
        }else{
            typeAll.checked = false;
        }
}

function networkingClicked(source) {
        
        geotagged = document.getElementById('inlineCheckbox_geotagged');
        geoword = document.getElementById('inlineCheckbox_geoword');
        profile = document.getElementById('inlineCheckbox_profile');
        networking = document.getElementById('inlineCheckbox_networking');
        facebook = document.getElementById('inlineCheckbox_facebook');
        twitter = document.getElementById('inlineCheckbox_twitter');   

        typeAll = document.getElementById('rowSelectAllc');      
        snsAll = document.getElementById('rowSelectAllc2');
	
        if (profile.checked == true && source.checked == true && geotagged.checked == true && geoword.checked == true){
            typeAll.checked = true;
        }else{
            typeAll.checked = false;
        }
}
	
function tabs(selectedtab) {    
	// contents
	var s_tab_content = "tab_content_" + selectedtab;   
	var contents = document.getElementsByTagName("div");
	for(var x=0; x<contents.length; x++) {
		name = contents[x].getAttribute("name");
		if (name == 'tab_content') {
			if (contents[x].id == s_tab_content) {
				contents[x].style.display = "block";                        
			} else {
				contents[x].style.display = "none";
			}
		}
	}   
	// tabs
	var s_tab = "tab_" + selectedtab;       
	var tabs = document.getElementsByTagName("li");
	for(var x=0; x<tabs.length; x++) {
		name = tabs[x].getAttribute("name");
		if (name == 'tab') {
			if (tabs[x].id == s_tab) {
				tabs[x].className = "active";                       
			} else {
			tabs[x].className = "";
			}
		}
	}
	var tab = document.getElementById("tab_4").className;
	if (tab != "active"){
		document.getElementById("tab_4").className="last";
	}
}
	
$(document).ready(function(){
	document.getElementById('searchBookmark').href="#map";
});