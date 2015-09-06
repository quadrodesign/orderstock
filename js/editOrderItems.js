function editOrderItems(order_id, stocks) {
    $('#order-items .s-order-item-delete').on('click', function(){
        var product_id = $(this).closest('tr').data('product-id');
        if($(this).closest('tr').find('.s-orders-skus').length) {
            var sku_id = $(this).closest('tr').find('.s-orders-skus input[type=radio]:checked').val();
        }
        
        var serializeData = '&product_id=' + product_id;
        serializeData += typeof sku_id != 'undefined' ? '&sku_id=' + sku_id : ''; 
        
        //Формируем select
        var id_selected = $(this).closest('tr').find('.s-orders-stock').val();
        var select = '<select name="stock_id">';
        var selected = '';
        $.each(stocks, function(index, value) {
            selected = value.id == id_selected ? 'selected="selected"' : '';
            select += '<option value="'+value.id+'" '+selected+'>'+value.name+'</option>';
        });
        select += '</select>'; 
        
        //Открываем диалоговое окно
        $('<div><form><div class="dialog-content">Выберите склад: '+select+'</div><div class="dialog-buttons"><input type="submit" class="button green" value="Выбрать" /> или <a class="cancel" href="#">отмена</a></div></form></div>').waDialog({
            'onSubmit': function (d) {
                
                $.post('?plugin=orderstock&module=backend&action=itemdelete', $(this).serialize() + '&order_id=' + order_id + serializeData, function () {
                    d.trigger('close'); // закрыть диалог
                }, 'json');
                return false;
            },
            width: '300px',
            height: '100px',
            });
        
    });
}