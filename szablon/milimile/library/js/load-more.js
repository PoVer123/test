jQuery(function($){

	$('.post-listing').append( '<div class="load-more"><div class="ball"></div><div class="ball"></div><div class="ball"></div><div class="ball"></div><div class="ball"></div><div class="ball"></div><div class="ball"></div></div>' );
	var button = $('.post-listing .load-more');
	var page = 2;
	var loading = false;
	var obj = document.getElementsByClassName('post-listing')[0];
	var name = obj.id;
	if( name == ''){
		name = 'main';
	};
	var tax = obj.dataset.tax ? obj.dataset.tax : "none";
	var term = obj.dataset.term ? obj.dataset.term :"none";
	var scrollHandling = {
	    allow: true,
	    reallow: function() {
	        scrollHandling.allow = true;
	    },
	    delay: 400 //(milliseconds) adjust to the highest acceptable value
	};

	$(window).scroll(function(){
		if( ! loading && scrollHandling.allow ) {
			scrollHandling.allow = false;
			setTimeout(scrollHandling.reallow, scrollHandling.delay);
			var offset = $(button).offset().top - $(window).scrollTop();
			if( 2000 > offset ) {
				loading = true;
				button.fadeIn();
				var data = {
					action: 'be_ajax_load_more',
					page: page,
					name: name,
					taxname: tax,
					termname: term,
					query: beloadmore.query,
				};
				$.post(beloadmore.url, data, function(res) {
					if( res.success) {
						$('.post-listing').append( res.data );
						$('.post-listing').append( button );
						page = page + 1;
						loading = false;
						button.fadeOut();
					} 
					else {
						console.log(res);
					}
				}).fail(function(xhr, textStatus, e) {
					 console.log(xhr.responseText);
				})


			}

		}
	});
});
