$(document).ready(function() {
    var options = {
        url: function(phrase) {
            return "/street/search?q=" + phrase;
        },

        getValue: "name",

        list: {

            onSelectItemEvent: function() {
                var value = $("#search_street").getSelectedItemData().id;

                $("#street_id").val(value).trigger("change");
            }
        }
    };

    $("#search_street").easyAutocomplete(options);
});