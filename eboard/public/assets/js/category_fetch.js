var catMap = {

	"lectures" : "lectures",
	"items for sale" : "itemsale",
	"for rent" : "rentals",
	"events" : "events",
	"newest" : "newest",
	"jobs" : "jobs",
	"other" : "others"

}

var catDesc = {

	"lectures" : "Private lectures offers and requests",
	"items for sale" : "Sell and buy miscellaneous items",
	"for rent" : "House for rent in and around Bolzano",
	"events" : "Events, shows and conferences",
	"newest" : "Latest published ads",
	"jobs" : "Jobs offers and job application",
	"other" : "Miscellaneous"

}


/*
Add listeners for category navigation bar, to get the proper ads when clicking on them.
*/
function addClickListeners(){


	$(".bottomLI").click(function(){
		let catName = $(this).find("a").text().trim().toLowerCase();
		$("<input>").attr({
    		type: "hidden",
    		name: "catName",
    		value: catMap[catName]
		}).appendTo("#catForm");
		$("<input>").attr({
    		type: "hidden",
    		name: "catDesc",
    		value: catDesc[catName]
		}).appendTo("#catForm");

		$("#catForm").submit();

	})



}


