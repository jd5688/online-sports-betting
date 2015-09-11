// Like Message

successarea3 = $('#success-area3');
succesanimate3 = $('#success-area3 #success_animate');
successarea2 = $('#success-area2');
succesanimate2 = $('#success-area2 #success_animate');
successarea = $('#success-area');
succesanimate = $('#success_animate');
		$(document).ready(function() {
			$('a.like').click(function(e) {
				var sucess_area = '';
				var game_id = $(e.currentTarget).attr("id");
				var uid = $('input[name=cur-user-id]').val();
				var redir = '';
				if (!uid) {
					redir = window.location.origin + window.location.pathname + window.location.search + '#login';
					window.location.replace(redir);
					return;
				}
				var t = $('input[name=cur-time]').val();
		        var url = $('input[name=cur-url]').val();
		        var key = $('input[name=cur-pubkey]').val();
		        var hash = $('input[name=cur-hash]').val();
		        var like_el = $('input[name=cur-likes-' + game_id + ']')
		        var likes = like_el.val();

		        url = url + "/ajax/like.php";
		        var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
		        uri += '&gid=' + game_id + '&uid=' + uid;
		        $.ajax({
		            type: 'POST',
		            url: url,
		            beforeSend: function(x) {
		                if(x && x.overrideMimeType) {
		                    x.overrideMimeType("application/json;charset=UTF-8");
		                }
		            },
		            data: uri,
		            success: function(data){
		                if (data.error === '0' && data.status === 'success') {
		                	$('a#' + game_id + '.like').html((parseInt(likes) + 1) + ' Like');
		                	$('a#' + game_id + '.like').toggleClass('added');
		                	like_el.val(parseInt(likes) + 1);
					        successarea2.addClass('active');
					        succesanimate2.addClass('bounceInDown');
								setTimeout(function(){
									succesanimate2.removeClass('bounceInDown').addClass('bounceOutUp');
								},2000);			
					        succesanimate2.removeClass('bounceOutUp');
								setTimeout(function(){
									successarea2.removeClass('active');
								},3000);
		                }

		                if (data.error === '0' && data.status === 'deleted') {
		                	$('a#' + game_id + '.like').html((parseInt(likes) - 1) + ' Like');
		                	$('a#' + game_id + '.like').toggleClass('added');
		                	like_el.val(parseInt(likes) - 1);
		                }
		            }
		            
		        });
		    });

			$('a.bookmark').click(function(e) {
				var sucess_area = '';
				var game_id = $(e.currentTarget).attr("id");
				var uid = $('input[name=cur-user-id]').val();
				var redir = '';
				if (!uid) {
					redir = window.location.origin + window.location.pathname + window.location.search + '#login';
					window.location.replace(redir);
					return;
				}
				var t = $('input[name=cur-time]').val();
		        var url = $('input[name=cur-url]').val();
		        var key = $('input[name=cur-pubkey]').val();
		        var hash = $('input[name=cur-hash]').val();
		        var bm_el = $('input[name=cur-bookmarks-' + game_id + ']')
		        var bookmarks = bm_el.val();

		        url = url + "/ajax/bookmark.php";
		        var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
		        uri += '&gid=' + game_id + '&uid=' + uid;
		        $.ajax({
		            type: 'POST',
		            url: url,
		            beforeSend: function(x) {
		                if(x && x.overrideMimeType) {
		                    x.overrideMimeType("application/json;charset=UTF-8");
		                }
		            },
		            data: uri,
		            success: function(data){
		                if (data.error === '0' && data.status === 'success') {
		                	$('a#' + game_id + '.bookmark').toggleClass('added');
		                	bm_el.val(parseInt(bookmarks) + 1);
					        successarea.addClass('active');
					        succesanimate.addClass('bounceInDown');
								setTimeout(function(){
									succesanimate.removeClass('bounceInDown').addClass('bounceOutUp');
								},2000);			
					        succesanimate.removeClass('bounceOutUp');
								setTimeout(function(){
									successarea.removeClass('active');
								},3000);
		                }

		                if (data.error === '0' && data.status === 'deleted') {
		                	$('a#' + game_id + '.bookmark').toggleClass('added');
		                	bm_el.val(parseInt(bookmarks) - 1);
		                }
		            }
		            
		        });
		    });
		});



// JS for page top scroll
$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
            $('#pagetop').fadeIn(200);
        } else {
            $('#pagetop').fadeOut(200);
        }
    });
    $('#pagetop').click(function(event) {
        event.preventDefault();
         
        $('html, body').animate({scrollTop: 0}, 300);
    })
});


// Header Dropdown MENU *** Need a Fix ***

    $(document).ready(function() {
	    over_flg = '';
		$('#usrmenu .dropdown-toggle').click(function() { 
			if ($(this).attr('class') == 'selected') {
			  // メニュー非表示
			  $(this).removeClass('selected').next('ul').removeClass('open');
			} else {
			  // 表示しているメニューを閉じる
			  $('#usrmenu .dropdown-toggle').removeClass('selected');
			  $('#usrmenu ul').removeClass('open');
			
			  // メニュー表示
			  $(this).addClass('selected').next('ul').addClass('open');
			}    
			});
			
			// マウスカーソルがメニュー上/メニュー外
			$('#usrmenu .dropdown-toggle,#usrmenu ul').hover(function(){
			over_flg = true;
			}, function(){
			over_flg = false;
			});  
			
			// メニュー領域外をクリックしたらメニューを閉じる
			$('body').click(function() {
			if (over_flg == false) {
			  $('#usrmenu .dropdown-toggle').removeClass('selected');
			  $('#usrmenu ul').removeClass('open');
			}
		});


    });


