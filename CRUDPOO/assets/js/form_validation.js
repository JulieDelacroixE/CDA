$(document).ready(function() {
    
    var titleOk = true;
    var yearOk = true;
    var labelOk = true;
    var genreOk = true;
    var priceOk = true;
    
    $("#title-input").keyup(function () {
        let titleInputValue = $(this).val();
        let filtreTitle = new RegExp("^[ a-zA-Z '-]{1,30}$");
    
        if (filtreTitle.test(titleInputValue) == false) {
            $("#titleErr").text("Entrez un titre valide.");
            titleOk = false;
            
        }
        else {
            $("#titleErr").text("");
            titleOk = true;
        }
    });
    
    
    $("#year-input").keyup(function () {
        let yearInputValue = $(this).val();
    
        let filtreYear = new RegExp("^[0-9]{4}$");
    
        if (filtreYear.test(yearInputValue) == false) {
            $("#yearError").text("Entrez une année valide.");
            yearOk = false;
        }
        else {
            $("#yearError").text("");
            yearOk = true;
        }
    });
    
    $("#label-input").keyup(function () {
        let labelInputValue = $(this).val();
    
        let filtreLabel = new RegExp("^.{1,200}$");
    
        if (filtreLabel.test(labelInputValue) == false) {
            $("#labelError").text("Entrez une description valide.");
            labelOk = false;
        }
        else {
            $("#labelError").text("");
            labelOk = true;
        }
    });
    
    $("#genre-input").keyup(function () {
        let genreInputValue = $(this).val();
    
        let filtreGenre = new RegExp("^[ a-zA-Z '-]{1,20}$");
    
        if (filtreGenre.test(genreInputValue) == false) {
            $("#genreError").text("Entrez un genre valide.");
            genreOk = false;
        }
        else {
            $("#genreError").text("");
            genreOk = true;
        }
    });
    
    $("#price-input").keyup(function () {
        let priceInputValue = $(this).val();
    
        let filtrePrice = new RegExp("^[0-9]{1,6}.*[0-9]{0,3}$");
    
        if (filtrePrice.test(priceInputValue) == false) {
            $("#priceError").text("Entrez un prix valide.");
            priceOk = false;
        }
        else {
            $("#priceError").text("");
            priceOk = true;
        }
    });
    
    $("#addForm").submit(function(e) {
        if (titleOk == false || yearOk == false || labelOk == false || genreOk == false || priceOk == false) {
            e.preventDefault();
        }
    })
      }); 