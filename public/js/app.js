$(function(){
	$("#myModal").on("show.bs.modal", function(e) {
	    var link = $(e.relatedTarget);
	    $(this).find(".modal-content").load(link.attr("href"));
	});
	$("#myModal").on("shown.bs.modal", function(e) {
	    $("select[name='country_id'], select[name='sport_id'], select[name='team_id'], select[name='tournament_id'], select[name='member_one'], select[name='member_two']").select2({
            theme: "bootstrap"
        });
	});
	
});
//# sourceMappingURL=app.js.map
