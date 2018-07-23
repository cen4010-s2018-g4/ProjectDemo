$(document).ready(function() {
    $("#reg").click(function(){
        $("#login").hide();
        $("#register").show();
    });
    
    $("#log").click(function(){
        $("#login").show();
        $("#register").hide();
    });
})