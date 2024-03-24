<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionReport extends Model
{
    protected $connection = 'finance5';

    protected $table = 'transactions_report_tbl';

    protected $primaryKey = 'id';

    protected $fillable = [
        'transactionName',
        'transactionType',
        'transactionAmount',
        'transactionDate',
        'transactionStatus',
        'reasonForCancellation',

    ];


    public $timestamps = true;

}
