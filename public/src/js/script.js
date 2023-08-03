$(document).ready(function () {
    $('#sidebarCollapse').on('click', function() {
        $('#km-sidebar, #km-content').toggleClass('active');
        $('#km-icon').toggleClass('fa-bars fa-xmark');
    });
});

$(function() {
    var itemsPerPage = 5;
    var currentPage = 1;
    var totalItems = $('table tbody tr').length;
    var totalPages = Math.ceil(totalItems / itemsPerPage);
    $('#total-data').html(totalItems);

    var generatePaginationLinks = function() {
        var paginationLinks = '';
        for (var i = 1; i <= totalPages; i++) {
            var linkClass = (i === currentPage) ? 'bg-primary' : '';
            paginationLinks += '<li class="list-unstyled"><button type="button" class="' + linkClass + ' text-white btn btn-km-primary me-1" data-page="' + i + '">' + i + '</button></li>';
        }
        $('.pagination ul').html(paginationLinks);
    };

    var updateTables = function() {
        var startIndex = (currentPage - 1) * itemsPerPage;
        var endIndex = startIndex + itemsPerPage;
        var searchInput = $('#search-input').val().toLowerCase();
        
        $('table tbody tr').hide().filter(function() {
            var text = $(this).text().toLowerCase();
            return text.indexOf(searchInput) > -1;
        }).slice(startIndex, endIndex).show();
    };

    $('.pagination').on('click', 'button', function(event) {
        event.preventDefault();
        currentPage = $(this).data('page');
        $('.pagination button').removeClass('bg-primary');
        $('.pagination button[data-page="' + currentPage + '"]').addClass('bg-primary');
        updateTables();
    });


    $('#km-form-select').on('change', function() {
        itemsPerPage = parseInt($(this).val());
        totalPages = Math.ceil(totalItems / itemsPerPage);
        generatePaginationLinks();
        updateTables();
    });

    $('#search-input').on('keyup', function() {
        updateTables();
    });
      
    updateTables();
    generatePaginationLinks();
    $('.pagination button').eq(0).addClass('bg-primary');
});