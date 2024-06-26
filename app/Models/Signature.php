<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Signature extends Model
{
    use HasFactory;
    protected $table = 'signatures';
    protected $fillable =[
        'signature_ceo',
        'signature_responsible',
        'contract_id',
        'contract_condominia_id'
    ];

    public function contractCondominia():HasOne
    {
        return $this->hasOne(ContractCondominia::class);
    }
}
