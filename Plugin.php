<?php namespace shayankhaksar\Zarinpal;

use RainLab\User\Models\User;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;

class Plugin extends PluginBase
{

    public $require = ['RainLab.User'];

    public function registerComponents()
    {
        return [
            'shayankhaksar\zarinpal\Components\Payment' => 'payment',
            'shayankhaksar\zarinpal\Components\VerifyPayment' => 'verifyPayment'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'shayankhaksar.zarinpal::lang.setting.name',
                'description' => 'shayankhaksar.zarinpal::lang.setting.description',
                'category'    => SettingsManager::CATEGORY_SHOP,
                'icon'        => 'icon-money',
                'class'       => 'shayankhaksar\Zarinpal\Models\Settings',
                'keywords'    => 'zarinpal زرین پل زرین پال zarin payment',
            ]
        ];
    }

    public function boot(){
        User::extend(function ($model){
            $model->hasMany['transactions'] = ['shayankhaksar\Zarinpal\Models\Transaction', 'key' => 'user_id'];
        });
    }
}
