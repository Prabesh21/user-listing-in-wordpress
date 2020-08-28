jQuery(document).ready(function($) {
    $("#my_role, #my_order, #order_by").change(function() {

        $.ajax({
            type: 'POST',
            url: my_scripts.my_ajax_url,
            // dataType: "json",
            data: {
                action: "register_user_front_end",
                my_role: $('#my_role option:selected').val(),
                my_order: $('#my_order option:selected').val(),
                order_by: $('#order_by option:selected').val(),
            },
            success: function(response) {

                response = JSON.parse(response);
                $("#tbody tr:gt(0)").remove();
                $(response).each(
                    function() {
                        $('#tbody').append(
                            '<tr><td>' + this.user_login +
                            '</td><td>' +
                            this.display_name +
                            '</td><td>' +
                            this.meta_value +
                            '</td></tr>')
                    });
                $('table.paginated').each(function() {
                    var $table = $(this);
                    var itemsPerPage = 10;
                    var currentPage = 0;
                    var pages = Math.ceil($table.find("tr:not(:has(th))").length / itemsPerPage);
                    $table.bind('repaginate', function() {
                        if (pages > 1) {
                            var pager;
                            if ($table.next().hasClass("pager"))
                                pager = $table.next().empty();
                            else
                                pager = $('<div class="pager" style="padding-top: 20px; direction:ltr; " align="center"></div>');

                            $('<span class="pg-goto"></span>').text(' « First ').bind('click', function() {
                                currentPage = 0;
                                $table.trigger('repaginate');
                            }).appendTo(pager);

                            $('<span class="pg-goto"> « Prev </span>').bind('click', function() {
                                if (currentPage > 0)
                                    currentPage--;
                                $table.trigger('repaginate');
                            }).appendTo(pager);

                            var startPager = currentPage > 2 ? currentPage - 2 : 0;
                            var endPager = startPager > 0 ? currentPage + 3 : 5;
                            if (endPager > pages) {
                                endPager = pages;
                                startPager = pages - 5;
                                if (startPager < 0)
                                    startPager = 0;
                            }

                            for (var page = startPager; page < endPager; page++) {
                                $('<span id="pg' + page + '" class="' + (page == currentPage ? 'pg-selected' : 'pg-normal') + '"></span>').text(page + 1).bind('click', {
                                    newPage: page
                                }, function(event) {
                                    currentPage = event.data['newPage'];
                                    $table.trigger('repaginate');
                                }).appendTo(pager);
                            }

                            $('<span class="pg-goto"> Next » </span>').bind('click', function() {
                                if (currentPage < pages - 1)
                                    currentPage++;
                                $table.trigger('repaginate');
                            }).appendTo(pager);
                            $('<span class="pg-goto"> Last » </span>').bind('click', function() {
                                currentPage = pages - 1;
                                $table.trigger('repaginate');
                            }).appendTo(pager);

                            if (!$table.next().hasClass("pager"))
                                pager.insertAfter($table);
                            //pager.insertBefore($table);

                        } // end $table.bind('repaginate', function () { ...

                        $table.find(
                            'tbody tr:not(:has(th))').hide().slice(currentPage * itemsPerPage, (currentPage + 1) * itemsPerPage).show();
                    });

                    $table.trigger('repaginate');

                });


            }
        });
    });
});