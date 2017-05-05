
$("#filter-field").on("keyup", function(){

  var userValue = $("#filter-field").val();

  // parcourt tous les a. pour chacun, la fct est appelée
  //avec l'élément du DOM en argument
  $("#terms-list a").each(function(i, el){
    var term = $(el).html(); // récupére le contenu du a
    var res = term.search(userValue); // cherche dans la chaine

    // si pas trouvée, on cache
    if (res === -1) {
      $(el).parent().hide();
    } else {
      $(el).parent().show();
    }
  });

});
