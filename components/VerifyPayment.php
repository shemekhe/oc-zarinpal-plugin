<?php

namespace at\ZarinPal\Components;

use at\Zarinpal\Models\Settings;
use at\Zarinpal\Models\Transaction;
use Cms\Classes\ComponentBase;
use Input;

/**
 * Created by PhpStorm.
 * User: Shkha
 * Date: 3/13/2017
 * Time: 11:38 PM
 */
class VerifyPayment extends ComponentBase
{

    /**
     * Returns information about this component, including name and description.
     */
    public function componentDetails()
    {
        return [
            'name' => 'at.zarinpal::lang.component.verify_payment.name',
            'description' => 'at.zarinpal::lang.component.verify_payment.description'
        ];
    }

    public function onRun()
    {
        $merchant_id = Settings::get('merchant_id');
        $Authority = Input::get('Authority');

        //Defining Page Variables
        $this->page['is_payment_success'] = 0;
        $this->page['payment_status'] = '0';
        $this->page['payment_refID'] = '0';
        $this->page['payment_message'] = 'none';
        $this->page['Authority'] = Input::get('Authority');;

        $transaction = Transaction::find_by_authority($Authority);
        if ($transaction != null) {
            $data = array('MerchantID' => $merchant_id, 'Authority' => $Authority, 'Amount' => $transaction->amount);
            $jsonData = json_encode($data);
            $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
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
            curl_close($ch);
            $result = json_decode($result, true);
            if ($err) {
                $this->page['payment_message'] = "cURL Error #:" . $err;
            } else {
                if ($result['Status'] == 100) {
                    $transaction->status = $result['Status'];
                    $transaction->is_successful = true;
                    $transaction->ref_id = $result['RefID'];
                    $this->page['payment_status'] = $result['Status'];
                    $this->page['payment_refID'] = $result['RefID'];
                    $this->page['is_payment_success'] = true;
                    $transaction->save();
                    //echo 'Transaction success. RefID:' . $result['RefID'];
                    $this->page['payment_message'] = 'Transaction success. RefID:' . $result['RefID'];
                } else {
                    $transaction->status = $result['Status'];
                    $this->page['payment_status'] = $result['Status'];
                    //$transaction->is_successful = false;
                    $transaction->save();
                    $this->page['payment_message'] = 'Transaction failed. Status:' . $result['Status'];
                }
            }
        } else {
            $this->page['payment_message'] = "Transaction Not Found";
        }
    }
}