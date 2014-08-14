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
          $("#search_inputs").html(data);   

        }
    });
    
    $.ajax({
        type: "POST",
        url: "search_outputs.php",
        data: {arguments: arguments0},
        success: function(data) {
          $("#search_outputs").html(data);   

        }
    });
	
    $('.animation_image').show(); 
    $('.animation_image_2').show();  
	
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
        $('#resulting_tweets').show();
        $.ajax({
            type: "POST",
            url: "show_tweets.php",
            data: {arguments: arguments1},
            success: function(data) {   
                $(".tweet_table_body").html(data);   
                $('.animation_image_2').hide(); 
                        
                        
//                //Get number of results and display in output tab
//                var count = $('#results_table tr').length - 1;
//                var results = "<strong>Row counts</strong>: "+count;
//
//                //Get number of tweets and display in output tab
//                var count_tweets = $('#tweet_table_body tr').length;
//                var results_tweet = "<br><strong>Total tweet counts</strong>: "+count_tweets;
//
//                $("#search_outputs").html(results+results_tweet); 

            }
        });
    }
    

    return false;

}  


