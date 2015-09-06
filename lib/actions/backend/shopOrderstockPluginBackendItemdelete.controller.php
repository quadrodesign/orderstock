<?php

class shopOrderstockPluginBackendItemdeleteController extends waJsonController {
    
    public function execute()
    {        
        $data = waRequest::post();
        $orderItemsModel = new shopOrderItemsModel();
        $where = 'order_id='.$data['order_id'];
        $where .= $data['sku_id'] ? ' AND product_id='.$data['product_id'].' AND sku_id='.$data['sku_id'] : 'AND product_id='.$data['product_id'] ;
        
        $result = $orderItemsModel->select('stock_id')->where($where)->fetchField();
        if($result) {
            $id = $orderItemsModel->select('id')->where($where)->fetchField();
            if($data['stock_id'] != $result) {
                $orderItemsModel->updateById($id, array('stock_id' => $data['stock_id']));
            }
        }
    }
}