/* 
    Document   : smart-user-picker
    Created on : Mar 15, 2014, 11:57:52 AM
    Author     : Lea
    Description:
        Select2 autocomplete that searches for users.  
		Relies on /admin/main/fetch_users to do the search
*/
(function($){
    $.fn.smart_user_picker = function() {
        var selector = this;
        selector.select2({
            minimumInputLength: 1,
            ajax: {
                url: "/admin/main/fetch_users",
                dataType: 'json',
                quietMillis: 100,
                data: function (term, page) { // page is the one-based page number tracked by Select2
                    return {
                        q: term, //search term
                        limit: 10, // page size
                        page: page, // page number
                    };
                },
                results: function (data, page) {
                    var more = (page * 10) < data.total;
                    return {results: data.users, more: more};
                }
            },
            initSelection: function(element, callback) {
                // the input tag has a value attribute preloaded that points to a preselected movie's id
                // this function resolves that id attribute to an object that select2 can render
                // using its formatResult renderer - that way the movie name is shown preselected
                var id=$(element).val();
                if (id !== "") {
                    $.ajax("/admin/main/fetch_users", {
                        data: {
                            id: id
                        },
                        dataType: "json"
                    }).done(function(data) { callback(data); });
                }
            },
            formatResult: formatUserResult, // omitted for brevity, see the source of this page
            formatSelection: formatUserSelection,  // omitted for brevity, see the source of this page
        }).one('select2-focus', select2Focus).on("select2-blur", function () {
			$(this).one('select2-focus', select2Focus)
		});
    }

    function formatUserResult(user) {
        return user.first_name+' '+user.last_name;
    }

    function formatUserSelection(user) {
        return user.first_name+' '+user.last_name;
    }
	
	function select2Focus() {
		var select2 = $(this).data('select2');
		setTimeout(function() {
			if (!select2.opened()) {
				select2.open();
			}
		}, 0);
	}
})(jQuery);