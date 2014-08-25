/* 
 * Load results of sql search
 */
function load_results(){

    //Delete whatever was previously inputted
    //$input = document.getElementById("searchButton").value;
   
    //arguments0 = $("#inputForm input[name='searchBox']").val();

    
    arguments0 = {
    input: $("#inputForm input[name='searchBox']").val(),    
    geotagged: $('#inlineCheckbox_geotagged:checked').val(),
    profile: $('#inlineCheckbox_profile:checked').val(),
    geoword: $('#inlineCheckbox_geoword:checked').val(),
    networking: $('#inlineCheckbox_networking:checked').val(),
    facebook: $('#inlineCheckbox_facebook:checked').val(),
    twitter: $('#inlineCheckbox_twitter:checked').val()
  };
  
    arguments1 = {
        input: $("#inputForm input[name='searchBox']").val(),    
        geotagged: $('#inlineCheckbox_geotagged:checked').val(),
        profile: $('#inlineCheckbox_profile:checked').val(),
        geoword: $('#inlineCheckbox_geoword:checked').val(),
        networking: $('#inlineCheckbox_networking:checked').val()
    };
    
    $.ajax({
        type: "POST",
        url: "search_inputs.php",
        data: {arguments: arguments0},
        success: function(data) {
          $("#tab_content_3").html(data);   

        }
    });
    
    $.ajax({
        type: "POST",
        url: "search_outputs.php",
        data: {arguments: arguments0},
        success: function(data) {
          $("#tab_content_4").html(data);   

        }
    });
	
    $('.animation_image').show(); 
    
	
    $.ajax({
        type: "POST",
        url: "fetch_page.php",
        data: {arguments: arguments0},
        success: function(data) {
          $(".dataBody").html(data);   
          $('.animation_image').hide(); 
//       // $('.dataBody').load("fetch_page.php");
//         $('.dataBody').load ('fetch_page.php', 'update=true').scrollTop(lastScrollPos);


        }
    });

    if($('#inlineCheckbox_twitter:checked').val()==="twitter"){
        $('.animation_image_2').show();  
        $('#resulting_tweets').show();
        $.ajax({
            type: "POST",
            url: "show_tweets.php",
            data: {arguments: arguments1},
            success: function(data) {   
                $(".tweet_table_body").html(data);   
                $('.animation_image_2').hide(); 

            }
        });
    }
    

    return false;

}  


