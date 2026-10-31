<?php

use App\Models\BusinessSetting;

use Illuminate\Support\Facades\DB;



if (!function_exists('getWebConfig')) {
    function getWebConfig($name): string|object|array|null
    {
        $config = null;
        $check = ['currency_model', 'currency_symbol_position', 'system_default_currency', 'language', 'company_name', 'decimal_point_settings', 'product_brand', 'digital_product', 'company_email'];

        if (in_array($name, $check) == true && session()->has($name)) {
            $config = session($name);
        } else {
            $data = BusinessSetting::where(['type' => $name])->first();
            if (isset($data)) {
                $config = json_decode($data['value'], true);
                if (is_null($config)) {
                    $config = $data['value'];
                }
            }

            if (in_array($name, $check) == true) {
                session()->put($name, $config);
            }
        }

        return $config;
    }
}


if(!function_exists('getAddonSetting')) {
    function getAddonSetting($settingType, $key_name): string|object|array|null
    {
        $config = null;
        $data = DB::table('addon_settings')->where("settings_type", $settingType)->where("key_name", $key_name)->where("is_active", 1)->first();
        if(isset($data)) {
            if($data->mode == 'live') {
                $config = json_decode($data->live_values, true);
            }else{
                $config = json_decode($data->test_values, true);
            }
        }
        return $config;
    }
}
