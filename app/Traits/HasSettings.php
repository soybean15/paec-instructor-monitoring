<?php

namespace App\Traits;
use App\Models\Setting; 

trait HasSettings
{


    public function updateSetting($key, $newValue=null){

        $settings = Setting::find(1);
        $data = $settings->data;
    
        if (!array_key_exists($key, $data)) {
            throw new \InvalidArgumentException("Invalid setting key: $key");
        }
    
        $data[$key] = $newValue;
        $settings->data = $data;
        $settings->save();

        return json_encode([$key => $newValue]);
    
    }


    public function getSetting($key, $default = null)
    {
        // Assuming you have a Setting model
        $settings = Setting::find(1); // Assuming you want to retrieve settings from the first row
    
        if ($settings && isset($settings->data[$key])) {
            // Check if the key exists in the settings data
            return $settings->data[$key];
        }
        
    
        // If the key is not found in the settings data, return the default value
        return $default;
    }

}
