/* 
 * Load results of sql search
 */


function load_results(){

    //Delete whatever was previously inputted
    //$input = document.getElementById("searchButton").value;
   
     arguments0 = $("#inputForm input[name='searchBox']").val();

   $('.animation_image').show(); 
  $.ajax({
     type: "POST",
     url: "fetch_page.php",
     data: {arguments: arguments0},
     success: function(data) {
         //output. Result table
      // $("#answer").html('<ul><li>'+data+'</li></ul>');    
            //Show loading image
       $(".dataBody").html(data);   
       //$('.dataBody').load("fetch_page.php #answer");
       //$('.dataBody').load ('fetch_page.php #answer', 'update=true').scrollTop(lastScrollPos);
       $('.animation_image').hide(); 
    }
  });
  return false;

//    //Show loading image
//    $('.animation_image').show(); 
//
//
//    //post page number and load returned data into result element
//    $.post('fetch_page.php', function(data) {
//
//       // $('.dataBody').load("fetch_page.php");
//         $('.dataBody').load ('fetch_page.php', 'update=true').scrollTop(lastScrollPos);
//		
//        //Hide loading image
//        $('.animation_image').hide();
//    });

}  


