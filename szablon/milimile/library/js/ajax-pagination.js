(function($) {

	
	function get_the_category(element){
		return element.context.id;
	};
	function get_the_country(){
		var elements = document.getElementById('filters');
		if(elements)
		var element = elements.getElementsByTagName('ul');
		if(element)
			return element[0].id;
		else return false;
	}
	$(document).ready(function(){

			if(get_the_country()){

			var country = get_the_country();
			
			$.ajax({
				url: ajaxpagination.ajaxurl,
				type: 'post',
				data: {
					action: 'ajax_pagination',
					page: ['wszystkie'],
					country: country
				},
				success: function( html ) {
						$('#post-results').append( html );
						core = new google.maps.LatLng(php_vars.latitude, php_vars.longtitude);
					
				}
			}).done(function(){
				$('[id]').each(function(){
					//markers
					 var lat = parseFloat(this.dataset.lat);
					 var lng = parseFloat(this.dataset.lng);
					 var item = document.getElementById(this.id);
						if(!isNaN(lat) && !isNaN(lng)){
							var latlen = new google.maps.LatLng(lat, lng);
							if(containsObject(latlen, markers) == false){
								markers.push(latlen);
								var labelcontent = '<div class="labelcontent"><div class="labelimage"><img src="'+item.getElementsByTagName('img')[0].src +'" alt="Label image"></div><div class="labeltext"><h5>'+item.getElementsByTagName('a')[0].title+'</h5>'+item.getElementsByClassName('exc')[0].innerHTML +'<a href="'+item.getElementsByTagName('a')[0].href+'">Zobacz więcej</a></div></div>';
								labels.set(latlen, labelcontent);
							}
						}

				});
				if($('#post-results').children().length == 1){
					$('#post-results').find('.load-more').hide();
					$('#post-results').append("Brak postów w wybranych kategoriach.");
					markers[0] = core;
				};
				var options = {center: markers[0], zoom: 4, styles: styling};

				initMap(options);
				setMarkers(map);
				console.log('done');
			});

		}
	});
	var map = document.getElementById('map');
	var core;
	var markers = [];
	var openTabs = [];
	var labels = new Map();
	var infowindow = null;


	function setMarkers(map){
			for (var i = 0; i < markers.length; i++) {
				var infowindow = new google.maps.InfoWindow({
          				content: labels.get(markers[i])
        		});
				var marker = new google.maps.Marker({
					    position: markers[i], 
					    map: map
					});
			marker.addListener('click', function() {
			  infowindow.setContent(labels.get(this.position));
	          infowindow.open(map, this);
	        });
		    marker.setMap(map);

			}
	};
	function initMap(options){
		map = new google.maps.Map(document.getElementById('map'), options);
		var infowindow = new google.maps.InfoWindow({
          				content: "loading..."
        		});
	};
	function containsObject(obj, list) {
	    var i;
	    for (i = 0; i < list.length; i++) {
	        if (list[i].lat() === obj.lat() ) {
	            return true;
	        }
	    }
	    return false;
	}
	
	$(document).on('click', 'button', function(e){
		$('#post-results').find('.post-views').remove();
		markers = [];
		if(openTabs.length==0){
			$('#post-results').append('Aby wyszukać, zaznacz interesujące Cię kategorie');
		}else{
			var country = get_the_country();

			//for(var index =0; index<openTabs.length; index++){
				var page = openTabs;
				$.ajax({
				url: ajaxpagination.ajaxurl,
				type: 'post',
				data: {
					action: 'ajax_pagination',
					page: page,
					country: country
				},
				success: function( html ) {
					
					console.log('start');
					$('#post-results').append( html );
					
					//check for duplicates of posts:
					var duplicated = {};

					$('[id]').each(function () {   
					    var ids = $('[id="' + this.id + '"]');

					    if ( ids.length <= 1 ) return  ;

					    if ( !duplicated[ this.id ] ){
					         duplicated[ this.id ] = [];   
					    }       

					    duplicated[ this.id ].push( this );
					});

					// remove duplicate last ID, for elems > 1 
					for ( var i in duplicated){

					    if ( duplicated.hasOwnProperty(i) ){  

					             $( duplicated[i].pop() ).remove();            
					    }
					}
					//endof check for duplicates.

				}
			}).done(function(){
				$('[id]').each(function(){
					//markers
					 var lat = parseFloat(this.dataset.lat);
					 var lng = parseFloat(this.dataset.lng);
					 var item = document.getElementById(this.id);
						if(!isNaN(lat) && !isNaN(lng)){
							var latlen = new google.maps.LatLng(lat, lng);
							if(containsObject(latlen, markers) == false){
								markers.push(latlen);
								var labelcontent = '<div class="labelcontent"><div class="labelimage"><img src="'+item.getElementsByTagName('img')[0].src +'" alt="Label image"></div><div class="labeltext"><h5>'+item.getElementsByTagName('a')[0].title+'</h5>'+item.getElementsByClassName('exc')[0].innerHTML +'<a href="'+item.getElementsByTagName('a')[0].href+'">Zobacz więcej</a></div></div>';
								labels.set(latlen, labelcontent);
							}
						}

				});
				if($('#post-results').children().length == 1){
					$('#post-results').find('.load-more').hide();
					$('#post-results').append("Brak postów w wybranych kategoriach.");
					markers[0] = core;
				};
				var options = {center: markers[0], zoom: 4, styles: styling};

				initMap(options);
				setMarkers(map);
				console.log('done');
			});


				//
			//}//endofloop

		}//endof elif
	});
//

	 
	//
	$(document).on( 'click', '.cat-icons a', function( event ) {
		event.preventDefault();
		if(!$(this).hasClass('opened')){
			//dodaje do listy otwartych tabsów:
			openTabs.push(this.id);
			//dodaje klase opened –> css
			$(this).addClass('opened');

		}
		else{
			//usuwam klasę opened -> css
			$(this).removeClass('opened');
			//usuwam z listy otwartych tabsów ten, który odklikuję
			removeA(openTabs, this.id);	
		}
	})
	function removeA(arr) {
    var what, a = arguments, L = a.length, ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax= arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
}
var styling = [
  
  {
    "featureType": "water",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#9fcecb"
      }
    ]
  }
  
];
})(jQuery);
