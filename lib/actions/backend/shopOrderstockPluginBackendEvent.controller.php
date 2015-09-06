<?php

class shopOrderstockPluginBackendEventController extends waJsonController {
    
    public function execute()
    {        
        $data = waRequest::post();
        
        if(is_numeric($data['stock_id'])) {
            $orderItemsModel = new shopOrderItemsModel();
            $orderItemsModel->updateByField('order_id', $data['order_id'], array('stock_id' => $data['stock_id']));
        }
    }
}