
$(document).ready(function() {

  // Afficher/cacher la navbar
    $(function() { 
        $('#sidebarCollapse').on('click', function() {
          $('#sidebar, #content').toggleClass('active');
        });
    });  
    // Affichage détails des disques
    $(".details-link").click(function() {
      let dButton = $(this).val();
          $("#details-box").load("disques_details.php?id="+dButton);
    }); 

    // Affichage détails des artistes
    $(".details-artist-link").click(function() {
      let daButton = $(this).val();
          $("#details-artist-box").load("artistes_details.php?id="+daButton);
    }); 

    // Aperçu de l'image uploadée
    function readimg(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#newimg').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]); 
      }
    }
    
    $("#photo").change(function() {
      readimg(this);
    });
}); 