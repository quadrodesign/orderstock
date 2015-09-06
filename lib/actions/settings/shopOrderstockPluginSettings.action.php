<?php

class shopOrderstockPluginSettingsAction extends waViewAction
{
    
    public function execute()
    {
        $model_settings = new waAppSettingsModel();
        $settings = $model_settings->get($key = array('shop', 'orderstock'));
        
        $workflow = new shopWorkflow();
        $state_names = array();
        foreach ($workflow->getAvailableStates() as $state_id => $state) {
            $state_names[$state_id] = $state['name'];
        }
        
        $this->view->assign('state_names', $state_names);
        $this->view->assign('settings', $settings);
    }       
}
