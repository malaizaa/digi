(function( $ ) {
    $.fn.skills = function() {
        this.find( "input:checkbox" ).on('click', function() {
            if( $(this).val() == 5) {
                $('[data-handler="skillHandler"] input:checkbox').prop('checked', false);
                $(this).prop('checked', true);
            } else {
                $('input:checkbox').last().prop('checked', false)
            };
        });

        return this;
    };
}( jQuery ));

// Usage example:
$('[data-handler="skillHandler"]').skills();
