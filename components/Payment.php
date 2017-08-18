<?php
/**
 * Created by PhpStorm.
 * User: Shkha
 * Date: 3/14/2017
 * Time: 2:22 AM
 */

namespace ShayanKhaksar\ZarinPal\Components;

use ShayanKhaksar\Zarinpal\Models\Settings;
use ShayanKhaksar\Zarinpal\Models\Transaction;
use Cms\Classes\ComponentBase;
use RainLab\User\Models\User;
use Redirect;

class Payment extends ComponentBase
{

    /**
     * Returns information about this component, including name and description.
     */
    public function componentDetails()
    {
        return [
            'name' => 'ShayanKhaksar.zarinpal::lang.component.payment.name',
            'description' => 'ShayanKhaksar.zarinpal::lang.component.payment.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'callback_url' => [
                'title' => 'ShayanKhaksar.zarinpal::lang.component.payment.properties.callback_url.name',
                'description' => 'ShayanKhaksar.zarinpal::lang.component.payment.properties.callback_url.description',
                'default' => Settings::get('callback_url'),
                'type' => 'string',
                'required' => true,
                'validationMessage' => 'ShayanKhaksar.zarinpal::lang.component.payment.properties.callback_url.validation_message'
            ]
        ];
    }

    public function sendRequest($amount, $description, User $user)
    {
        $merchant_id = Settings::get('merchant_id');
        $callback_url = $this->property('callback_url', Settings::get('callback_url'));
        if ($description == null || $description == '')
            $description = 'ندارد';


        $transaction = new Transaction();
        $transaction->description = $description;
        $transaction->amount = $amount;
        if ($user != null)
            $transaction->user = $user;

        $this->page['Status'] = '';
        $this->page['Authority'] = '';

        if ($amount < 100)
            $amount = 100;

        $data = array('MerchantID' => $merchant_id,
            'Amount' => $amount,
            'CallbackURL' => $callback_url,
            'Description' => $description);
        $jsonData = json_encode($data);
        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);

        $result = json_decode($result, true);
        curl_close($ch);

        if ($err) {
            echo "c URL Error #:" . $err;
        } else {
            if ($result['Status'] == 100) {
                $transaction->status = $result['Status'];
                $transaction->authority = $result['Authority'];
                $transaction->save();
                $this->page['Status'] = $result['Status'];
                $this->page['Authority'] = $result['Authority'];
                //header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['Authority']);
                return Redirect::to('https://www.zarinpal.com/pg/StartPay/' . $result['Authority']);
            } else {
                echo 'ERR: ' . $result['Status'];
                $transaction->status = $result['Status'];
                $transaction->save();
                $this->page['Status'] = $result['Status'];
                $this->page['Authority'] = $result['Authority'];

            }
        }
    }
}