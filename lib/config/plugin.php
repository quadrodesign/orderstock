<?php
return array (
  'name' => 'Изменение склада',
  'description' => 'Изменяем склад при редактировании, удалении и восстановлении заказа',
  'icon' => 'img/orderstock.gif',
  'shop_settings' => true,
  'handlers' => 
  array (
    'backend_order_edit' => 'backend_order_edit',
    'backend_order' => 'backendOrder',
  ),
);
