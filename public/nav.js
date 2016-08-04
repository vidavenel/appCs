$(document).ready(function () {
    var fullpath = window.location;

    $('.sidebar-menu').find('.active').each(function () {
        $(this).removeClass('active');
    });

    var currentLink=$('a[href="'+ fullpath + '"]');
    console.log(currentLink);
    currentLink.closest('li').addClass('active');
    currentLink.closest('.treeview').addClass('active');

});