var p1, p2, p3, p4, p5;
var startColor = '#e13b03';
var endColor = '#6FD57F';
$(document).ready(function() {
    $(".carousel").owlCarousel({
        pagination: true,
        navigation: true,
        singleItem: true,
        navigationText: [
            "",
            ""
        ]
    });
    /*$(".carousel2").owlCarousel({
        pagination: false,
        navigation: true,
        singleItem: true,
        navigationText: [
            "",
            ""
        ]
    });*/
    $('nav li a').each(function() {
        $(this).click(function(event) {
            event.preventDefault();
            var itemId = $(this).attr('href');
            $(this).addClass('active');
            $('html,body').stop().animate({
                scrollTop: $(itemId).offset().top
            }, 1000);
            event.preventDefault();
        });
    });
    $(".anim").fadeOut();
    var date = new Date();
    var str = date.getFullYear() + "/" + (date.getMonth() + 1) + "/" + (date.getDate() + 1) + " " + "00:00:00";
    $('.count').county({
        endDateTime: new Date(str),
        reflection: false,
        animation: 'fade',
        theme: 'black'
    });
    $('a.call').click(function() {
        $('.form-wrapper').fadeIn("slow");
        return false;
    });
    $(document).click(function(event) {
        if ($(event.target).closest("form").length) return;
        $('.form-wrapper').fadeOut(200);
        $('.message-wrapper').fadeOut(200);
        $(".modal-wrapper").fadeOut(200);
    });
    $("a.modal-button").click(function() {
        $('.modal-wrapper').fadeIn("slow");
        return false;
    });
    $("a.close").click(function() {
        $(".modal-wrapper").fadeOut(200);
        $(".form-wrapper").fadeOut(200);
        return false;
    });
    $('form').submit(function(e) {
        $.post($(this).attr('action'), $(this).serialize(), function(response) {
            $("form input[type='text']").val("");
            $(".form-wrapper").fadeOut();
            $(".modal-wrapper").fadeOut();
            console.log(response);
            $(".message-wrapper").fadeIn()
            $(".message-container").html("<h2>" + response + "</h2>");
        });
        e.preventDefault();
    });
    p1 = new ProgressBar.Circle("#p1", {
        duration: 1300,
        color: startColor,
        trailColor: "#fff",
        strokeWidth: 10
    });
    p2 = new ProgressBar.Circle("#p2", {
        duration: 500,
        color: startColor,
        trailColor: "#fff",
        strokeWidth: 10
    });
    p3 = new ProgressBar.Circle("#p3", {
        duration: 6000,
        color: startColor,
        trailColor: "#fff",
        strokeWidth: 10
    });
    p4 = new ProgressBar.Circle("#p4", {
        duration: 1500,
        color: startColor,
        trailColor: "#fff",
        strokeWidth: 10
    });
    p5 = new ProgressBar.Circle("#p5", {
        duration: 700,
        color: startColor,
        trailColor: "#fff",
        strokeWidth: 10
    });
    $(window).scroll(function() {
        var scrolled;
        var windowOffset = $(window).scrollTop() + 250;
        if (windowOffset > 300) {
            $("nav").addClass("fixed");
        } else if (windowOffset < 300) {
            $("nav").removeClass("fixed");
        }
        var section3Offset = $("#section3").offset().top;
        if (section3Offset < windowOffset) {
            p1.animate(1);
            p2.animate(1);
            p3.animate(1);
            p4.animate(1);
            p5.animate(1);
        }
    });
});
$(window).scroll(function() {
    var scrolled = false;
    var windowOffset = $(window).scrollTop() + 250;
    //var section2Offset = $("#section2").offset().top;
    var section3Offset = $("#section3").offset().top;
    //var section4Offset = $("#section4").offset().top;
    //var section5Offset = $("#section5").offset().top;
    var section7Offset = $("#section7").offset().top;
    //var section9Offset = $("#section9").offset().top;	
    //var section11Offset = $("#section11").offset().top;	
    //var section12Offset = $("#section12").offset().top;	

    $("#section3 .row .w-20 .number").each(function(index) {
        if (section3Offset < windowOffset && !$(this).hasClass("scrolled")) {
            printProcent($(this), $(this).attr('number'));
            $(this).addClass('scrolled');
        }
    });
    $("#section7 .row .w-33").each(function(index) {
        if (section7Offset < windowOffset) {
            if (index < 3)
                $(this).delay(index * 400).fadeIn().addClass("animated fadeInLeft");
            else
                $(this).delay(index * 400).fadeIn().addClass("animated fadeInRight");
        }
    });
});

function printProcent(number, max) {
    var i = 0;
    var step = max / 100;
    var progress = 0;
    var timerId = setInterval(function() {
        //if (step <= max) numer.find(".progress").value(progress);
        progress += step;
        number.text(i);
        if (i == max) clearInterval(timerId);
        i++;
    }, 10);
}