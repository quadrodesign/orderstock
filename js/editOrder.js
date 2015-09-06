function editOrder(order_id, sklads) {
    $('.workflow-actions .wf-action').each(function(){
        if($(this).data('action-id') == 'delete' || $(this).data('action-id') == 'restore') {
            $(this).removeClass('wf-action');
        }
    });
    
    $('.workflow-actions a').on('click', function(e){
        var button = $(this);
        var action_id = button.data('action-id');
        if((action_id == 'delete' || action_id == 'restore') && !button.hasClass('wf-action')) {
            //Формируем select
            var select = '<select name="stock_id">';
            $.each(sklads, function(index, value) {
                select += '<option value="'+value.id+'">'+value.name+'</option>';
            });
            select += '</select>';
            
            //Открываем диалоговое окно
            $('<div><form><div class="dialog-content">Выберите склад: '+select+'</div><div class="dialog-buttons"><input type="submit" class="button green" value="Выбрать" /> или <a class="cancel" href="#">Отмена</a></div></form></div>').waDialog({
                'onSubmit': function (d) {
                    $.post('?plugin=orderstock&module=backend&action=event', $(this).serialize() + '&order_id=' + order_id + '&action_id=' + action_id, function () {
                        d.trigger('close'); // закрыть диалог
                        button.addClass('wf-action');
                        clickWfAction();
                        button.click();
                    }, 'json');
                    return false;
                },
                width: '300px',
                height: '100px',
                });
            return false;    
        }
    });
}

function clickWfAction() {
    $('.wf-action[data-action-id=delete], .wf-action[data-action-id=restore]').click(function () {
        var self = $(this);
        if (!self.data('confirm') || confirm(self.data('confirm'))) {
            self.after('<i class="icon16 loading"></i>');
            $.post('?module=workflow&action=prepare', {
                action_id: self.attr('data-action-id'),
                id: $.order.id
            }, function (response) {
                var el;
                self.parent().find('.loading').remove();
                if (self.data('container')) {
                    el = $(self.data('container'));
                    el.prev('.workflow-actions').hide();
                } else {
                    self.closest('.workflow-actions').hide();
                    el = self.closest('.workflow-actions').next();
                }
                el.empty().html(response).show();
            });
        }
        return false;
    });
}