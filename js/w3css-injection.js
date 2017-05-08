jQuery(document).ready(function ($) {

	// Recent entries
	//$( ".widget_recent_entries li" ).addClass( "w3-text-red" );

	// Tag cloud widget
	$( ".widget_tag_cloud .tagcloud" ).addClass( "w3-container w3-padding-16 w3-white" );
	$( ".widget_tag_cloud a" ).addClass( "w3-tag w3-light-grey w3-hover-black" );
	$( ".widget_tag_cloud a" ).css({"margin-top":"2px", "margin-bottom":"2px"}); // css({"propertyname":"value","propertyname":"value"});

	// Unordered list widgets
	// $( ".widget_archive ul, .widget_recent_entries ul, .widget_recent_comments ul, .widget_pages ul, .widget_meta ul, .widget_categories ul, .widget_rss ul" ).addClass("w3-ul w3-hoverable");
	//$( ".widget_archive li, .widget_recent_entries li, .widget_pages li, .widget_meta li, .widget_categories li" ).addClass("w3-padding-8");
	//$( ".widget_archive a, .widget_recent_entries a, .widget_recent_comments a, .widget_pages a, .widget_meta a, .widget_meta a abbr, .widget_categories a, .widget_rss a" ).css({"text-decoration":"none"});
	// Select dropdown (alternative view)
	$( ".widget_archive label, .widget_categories label" ).css({"display":"none"});
	$( ".widget_archive select, .widget_categories select" ).addClass("w3-white w3-select").css({"border":"none", "outline":"none"});
	$( ".widget_archive select" ).wrapAll('<div class="w3-cell-row" style="padding-left:16px;padding-right:16px;">'); // wrap inside parent div
	$( ".widget_categories select" ).wrapAll('<div class="w3-cell-row" style="padding-left:16px;padding-right:16px;">'); // wrap inside parent div

	// calendar widget
	$( ".widget_calendar caption" ).addClass("w3-large w3-padding w3-light-grey");
	$( ".widget_calendar" ).addClass("w3-padding");
	$( ".widget_calendar table" ).addClass("w3-table w3-striped w3-hoverable");
	$( ".widget_calendar tbody td a" ).addClass("w3-tag w3-hover-light-grey");
	$( ".widget_calendar tfoot a" ).addClass("w3-tag w3-light-grey w3-hover-black");

	// text widget
	$(".widget_text .textwidget").addClass("w3-container w3-padding-16");

	// rss widget
	$(".widget_rss li a").addClass("w3-tag w3-light-grey w3-left-align");
	//$(".widget_rss .rsswidget img").css({"position":"relative", "top":"50%", "transform":"translateY(-35%)"});
	//$(".widget_rss li").css({"padding-right":"15px"});

	// Search widget
	$(".widget_search form").addClass("w3-container w3-padding-16");
	$('.widget_search input[type="search"]').addClass("w3-light-grey");
	//$('.widget_search input[type="submit"]').css({"display":"none"});

	// Fix for old styles showing before the W3CSS classes are injected
	$( "#secondary" ).css({"visibility":"visible"});

	// other styles

	// some links
	$( ".tags-links a, .cat-links a" ).addClass("w3-tag w3-light-grey w3-hover-black");
	$( ".tags-links a, .cat-links a" ).css({"text-decoration":"none"});

	// images
	$(".popular_posts_widget img").removeClass("wp-post-image");
	$( ".post img" ).addClass("w3-image"); // wrap post inside parent div
	$( "img" ).css({"visibility":"visible"});

	// single post navigation
	$(".nav-links button").css({"white-space":"normal", "text-decoration":"none"});
	$(".nav-links a").css({"text-decoration":"none"});
	$(".post-navigation h2").addClass("w3-container");
	$(".post-navigation .nav-links").addClass("w3-row-padding");
	$(".nav-previous, .nav-next").addClass("w3-half"); // wrap post inside parent div

	// comments
	//$(".comments-title").addClass("w3-container");
	$("#comments").addClass("w3-card-4 w3-margin w3-white");
	$("#comments .comment-metadata a").addClass("w3-tag w3-light-grey w3-hover-black w3-margin-top").css({"text-decoration":"none"});
	$("#comments .reply a").addClass("w3-tag w3-light-grey w3-hover-black w3-margin-bottom").css({"text-decoration":"none"});
	$("#comments h2").addClass("w3-container w3-padding w3-light-grey");
	$("#respond h3").addClass("w3-panel w3-light-grey w3-padding");
	$("#respond form").addClass("w3-container");
	//$("textarea").addClass("w3-textarea");
	$('#respond form input[type="submit"], #respond textarea, #respond form #url, #respond form #email, #respond form #author').addClass("w3-input w3-border");
	$(".comment-author a").addClass("w3-tag w3-light-grey w3-hover-black");

});
