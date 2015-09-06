<?php
$plugin_id = array('shop', 'orderstock');
$app_settings_model = new waAppSettingsModel();
$app_settings_model->set($plugin_id, 'status', 0);
$app_settings_model->set($plugin_id, 'state_ids', 'processing,paid,shipped,completed');