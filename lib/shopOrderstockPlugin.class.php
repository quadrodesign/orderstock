<?php

class shopOrderstockPlugin extends shopPlugin
{
    public function backend_order_edit($param){
        if($this->getSettings('status')) {
            $state_ids = explode(',', $this->getSettings('state_ids'));
            if(in_array($param['state_id'], $state_ids)) {
                $stock_model = new shopStockModel();
                $stocks = $stock_model->getAll();
                return '<script type="text/javascript" src="'. wa()->getAppStaticUrl('shop') .'plugins/orderstock/js/editOrderItems.js?'.date('His').'"></script>
                        <script type="text/javascript">
                            $(function() { new editOrderItems('.$param['id'].','.json_encode($stocks).');});
                        </script>';
            }
        }
      return false;
    }
    
    public function backendOrder($param){
        if($this->getSettings('status')) {
            $stock_model = new shopStockModel();
            $stocks = $stock_model->getAll();
            if($stocks) {
                return array('action_button' => '<script type="text/javascript" src="'. wa()->getAppStaticUrl('shop') .'plugins/orderstock/js/editOrder.js?'.date('His').'"></script>
                              <script type="text/javascript">
                                $(function() { new editOrder('.$param['id'].','.json_encode($stocks).');});
                              </script>');
            }
        }
      return false;
    }
}
