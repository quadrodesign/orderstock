<?php

class shopOrderstockPluginSettingsSaveController extends waJsonController {
    
    public function execute()
    {
        $plugin_id = array('shop', 'orderstock');
        try {
            $app_settings_model = new waAppSettingsModel();
            $settings = waRequest::post('settings');
            
            $state_ids = implode(',',$settings['states']);
            
            $app_settings_model->set($plugin_id, 'status', (int) $settings['status']);
            $app_settings_model->set($plugin_id, 'state_ids', $state_ids);
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }
}