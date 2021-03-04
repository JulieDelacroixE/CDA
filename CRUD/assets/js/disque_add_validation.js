$(document).ready(function() {

$("#title-input").keyup(function () {
    let titleInputValue = $(this).val();

    let filtreTitle = new RegExp("^[ a-zA-Z '-]{1,30}$");

    if (filtreTitle.test(titleInputValue) == false) {
        $("#titleErr").text("Entrez un titre valide.");
    }
    else {
        $("#titleErr").text("");
    }
});


$("#year-input").keyup(function () {
    let yearInputValue = $(this).val();

    let filtreYear = new RegExp("^[0-9]{4}$");

    if (filtreYear.test(yearInputValue) == false) {
        $("#yearError").text("Entrez une année valide.");
    }
    else {
        $("#yearError").text("");
    }
});

$("#label-input").keyup(function () {
    let labelInputValue = $(this).val();

    let filtreLabel = new RegExp("^.{1,200}$");

    if (filtreLabel.test(labelInputValue) == false) {
        $("#labelError").text("Entrez une description valide.");
    }
    else {
        $("#labelError").text("");
    }
});

$("#genre-input").keyup(function () {
    let genreInputValue = $(this).val();

    let filtreGenre = new RegExp("^[ a-zA-Z '-]{1,20}$");

    if (filtreGenre.test(genreInputValue) == false) {
        $("#genreError").text("Entrez un genre valide.");
    }
    else {
        $("#genreError").text("");
    }
});

$("#price-input").keyup(function () {
    let priceInputValue = $(this).val();

    let filtrePrice = new RegExp("^[0-9]{1,6}.*[0-9]{0,3}$");

    if (filtrePrice.test(priceInputValue) == false) {
        $("#priceError").text("Entrez un prix valide.");
    }
    else {
        $("#priceError").text("");
    }
});


  }); 