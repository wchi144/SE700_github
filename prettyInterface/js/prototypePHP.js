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
	checkboxes = document.getElementsByName('result');
	for(var i=0, n=checkboxes.length;i<n;i++) {
		checkboxes[i].checked = source.checked;
	}
	
	geotagged = document.getElementById('inlineCheckbox_geotagged');
	geoword = document.getElementById('inlineCheckbox_geoword');

	if (geotagged.disabled == true) {
		geotagged.checked = false;
	}
	if (geoword.disabled == true) {
		geoword.checked = false;
	}
}
	
function facebookClicked(source) {
	geotagged = document.getElementById('inlineCheckbox_geotagged');
	geoword = document.getElementById('inlineCheckbox_geoword');
	if (source.checked == true) {
		geotagged.disabled = true;
		geoword.disabled = true;
	}
	else {
		geotagged.disabled = false;
		geoword.disabled = false;
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