// Deleting Quotation JS
$('#quotDel').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget); // Button that triggered the model
    var quot = button.data('id'); // Extract info from data-* attributes
    var modal = $(this);
    modal.find('.modal-body #deleteId').val(quot);
});
$(function () {
    $('[data-toggle="popover"]').popover()
})