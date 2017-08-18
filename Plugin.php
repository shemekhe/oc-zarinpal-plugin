<?php namespace at\Zarinpal;

use RainLab\User\Models\User;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;

class Plugin extends PluginBase
{

    public $require = ['RainLab.User'];

    public function registerComponents()
    {
        return [
            'at\zarinpal\Components\Payment' => 'payment',
            'at\zarinpal\Components\VerifyPayment' => 'verifyPayment'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'at.zarinpal::lang.setting.name',
                'description' => 'at.zarinpal::lang.setting.description',
                'category'    => SettingsManager::CATEGORY_SHOP,
                'icon'        => 'icon-money',
                'class'       => 'At\Zarinpal\Models\Settings',
                'keywords'    => 'zarinpal زرین پل زرین پال zarin payment',
            ]
        ];
    }

    public function boot(){
        User::extend(function ($model){
            $model->hasMany['transactions'] = ['at\Zarinpal\Models\Transaction', 'key' => 'user_id'];
        });
    }
}
