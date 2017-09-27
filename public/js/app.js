$(function(){
	$("#myModal").on("show.bs.modal", function(e) {
	    var link = $(e.relatedTarget);
	    $(this).find(".modal-content").load(link.attr("href"));
	});
	$("#myModal").on("shown.bs.modal", function(e) {
	    $("select[name='sport_id'], select[name='team_id'], select[name='country_id']").select2({
            theme: "bootstrap"
        });
	});
	
});
//# sourceMappingURL=app.js.map
