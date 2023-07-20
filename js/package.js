// Package JS
    $('#duration').on("click",function(e){
        if($("#duration").hasClass("active")){
            //shows yearly plans
            $("#duration").removeClass("active").addClass("inactive");
            // change contents for monthly

            // changing display price
            $("#basic").html("750");
            $("#smart").html("1000");
            $("#exclusive").html("1500");
            // changing plan validity
            $("#Basic").html("/ Month");
            $("#Smart").html("/ Month");
            $("#Exclusive").html("/ Month");

            // emptying offer badge for monthly plans
            $('#offer-1').empty();
            $('#offer-2').empty();
            $('#offer-3').empty();

            // changing price for Checkout
            $('.basicBtn').attr('data-price',750);
            $('.basicBtn').attr('data-id',1);
            $('.smartBtn').attr('data-price',1000);
            $('.smartBtn').attr('data-id',2);
            $('.exclusiveBtn').attr('data-price',1500);
            $('.exclusiveBtn').attr('data-id',3);
        }else if($("#duration").hasClass("inactive")){
            //shows monthly plans
            $("#duration").removeClass("inactive").addClass("active");
            // change contents for yearly

            // changing display price
            $("#basic").html('9000');
            $("#smart").html('12000');
            $("#exclusive").html('18000');
            //changing plan validity
            $("#Basic").html("/ Year");
            $("#Smart").html("/ Year");
            $("#Exclusive").html("/ Year");
            // offer badge
            // $('#offer-1').html('<label class="badge bg-primary text-light" style="font-size:1rem;">25% Offer</label>')
            // $('#offer-2').html('<label class="badge bg-light text-primary" style="font-size:1rem;">25% Offer</label>')
            // $('#offer-3').html('<label class="badge bg-primary text-light" style="font-size:1rem;">25% Offer</label>')

            // changing price for Checkout
            $('.basicBtn').attr('data-price',9000);
            $('.basicBtn').attr('data-id',4);
            $('.smartBtn').attr('data-price',12000);
            $('.smartBtn').attr('data-id',5);
            $('.exclusiveBtn').attr('data-price',18000);
            $('.exclusiveBtn').attr('data-id',6);
        }
    });