
app.controller('createroomcontroller',function ($scope,$http){
    $("[data-toggle='tooltip']").tooltip();//开启tooltip
    $("#ex6").slider();
    $("#ex6").on("slide", function(slideEvt) {
        $("#ex6SliderVal").text(slideEvt.value);
    });

    
})