/* 
 * Load results of sql search
 */
function load_results(){

    //Delete whatever was previously inputted
    document.getElementById("searchButton").value = "";

    //Show loading image
    $('.animation_image').show(); 

    //post page number and load returned data into result element
    $.post('fetch_page.php', function(data) {

        $('.dataBody').load("fetch_page.php");

        //Hide loading image
        $('.animation_image').hide(); //hide loading image once data is received

    });
}  
