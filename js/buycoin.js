// JS for Item Input area
	$(function () {
	
	    $("#packagearea .buycoin_radio input[type='radio']").change(function(){
	        if($(this).is(":checked")){
	            $('.buycoin_radio .inner').removeClass("c_on");
	            $(this).parent().addClass("c_on");
	        }else{
	            $(this).parent().removeClass("c_on");
	        }
	    });

	    $("#paymentarea #currentcc input[type='radio']").change(function(){
	        if($(this).is(":checked")){
	            $('#currentcc .inner').removeClass("c_on");
	            $(this).parent().addClass("c_on");
	            $('.foot-btnarea .buycoinbtn').addClass("active");
	        }else{
	            $(this).parent().removeClass("c_on");
	        }
	    });

		$('#addcardbtn').click(function() {
	        $('#newccinput').addClass('active');
	        $(this).addClass("hidden");
	        $('#currentcc').addClass('hidden');
	    });

		$('#cccancelbtn').click(function() {
	        $('#newccinput').removeClass('active');
	        $('#addcardbtn').removeClass('hidden');
	        $('#currentcc').removeClass('hidden');
	    });


	    $("#newccinput .inputadd input[type='radio']").change(function(){
	        if($(this).is(":checked")){
	            $('#newccinput .cbxbd').removeClass("c_on");
	            $(this).parent().addClass("c_on");
	        }else{
	            $(this).parent().removeClass("c_on");
	        }
	    });


		$('#packagearea .buycoin_radio label').click(function() {
            $('#paymentarea').addClass("active");
			$('body,html').animate({
				scrollTop: 700
			}, 500);
		});
		//$('#paymentarea .paymethod_radio label').click(function() {
		$('input[name=card_radio]').click(function(e) {
            $('#coinconfirmarea').addClass("active");
            $('button#buy-complete').addClass("active");
            $('#cvc_input').show();
			$('body,html').animate({
				scrollTop: 1400
			}, 500);
			confirmationArea(e);
		});

	});
