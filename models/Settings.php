<?php
/**
 * Created by PhpStorm.
 * User: Shkha
 * Date: 3/12/2017
 * Time: 9:53 PM
 */

namespace at\Zarinpal\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'at_zarinpal_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';
}