<?php namespace ShayanKhaksar\Zarinpal;

use RainLab\User\Models\User;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;

class Plugin extends PluginBase
{

    public $require = ['RainLab.User'];

    public function registerComponents()
    {
        return [
            'ShayanKhaksar\zarinpal\Components\Payment' => 'payment',
            'ShayanKhaksar\zarinpal\Components\VerifyPayment' => 'verifyPayment'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'ShayanKhaksar.zarinpal::lang.setting.name',
                'description' => 'ShayanKhaksar.zarinpal::lang.setting.description',
                'category'    => SettingsManager::CATEGORY_SHOP,
                'icon'        => 'icon-money',
                'class'       => 'ShayanKhaksar\Zarinpal\Models\Settings',
                'keywords'    => 'zarinpal زرین پل زرین پال zarin payment',
            ]
        ];
    }

    public function boot(){
        User::extend(function ($model){
            $model->hasMany['transactions'] = ['ShayanKhaksar\Zarinpal\Models\Transaction', 'key' => 'user_id'];
        });
    }
}
