<?php namespace ShayanKhaksar\Zarinpal\Models;

use Model;

/**
 * Model
 */
class Transaction extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'at_zarinpal_transtacions';
    protected $primaryKey = 'transaction_id';

    public $belongsTo = [
        'user' => ['RainLab\User\Models\User', 'key' => 'user_id']
    ];

    public static function find_by_authority($authority)
    {
        return Transaction::where('authority', $authority)->first();
    }
}