var catMap = {

	"lectures" : "lectures",
	"items for sale" : "itemsale",
	"for rent" : "rentals",
	"events" : "events",
	"newest" : "newest",
	"jobs" : "jobs",
	"other" : "others"

}

/*
Add listeners for category navigation bar, to get the proper ads when clicking on them.
*/
function addClickListeners(){


	$(".bottomLI").click(function(){
		let catName = $(this).find("a").text().trim().toLowerCase();
		$("<input>").attr({
    		type: "hidden",
    		name: "category",
    		value: catMap[catName]
		}).appendTo("#catForm");

		$("#catForm").submit();

	})



}


