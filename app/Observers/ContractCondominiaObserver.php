<?php

namespace App\Observers;

use App\Enums\ContractStates;
use App\Events\Signature\SetSignatureContract;
use App\Models\ContractCondominia;
use App\Services\CondominiaServices;
use Illuminate\Support\Facades\Log;

class ContractCondominiaObserver
{
    private CondominiaServices $condominiaServices;
    public function __construct(
        CondominiaServices $condominiaServices
    )
    {
        $this->condominiaServices = $condominiaServices;
    }
    /**
     * Handle the ContractCondominia "created" event.
     */
    public function created(ContractCondominia $contractCondominia): void
    {
        logger('Entrei no observer '.__CLASS__);
        if($contractCondominia->isDirty('ceo_id')){
            logger($contractCondominia);
            event(new SetSignatureContract($contractCondominia));
        }else{
            $cond = $this->condominiaServices->getFirst($contractCondominia->condominia_id);
            Log::debug('Esse contrato não foi assinado pelo ceo_id'.json_encode( $cond));
            $this->condominiaServices->updatedStatus( $cond, ContractStates::Initial);
        }
    }

    /**
     * Handle the ContractCondominia "updated" event.
     */
    public function updated(ContractCondominia $contractCondominia): void
    {
        //
    }

    /**
     * Handle the ContractCondominia "deleted" event.
     */
    public function deleted(ContractCondominia $contractCondominia): void
    {
        //
    }

    /**
     * Handle the ContractCondominia "restored" event.
     */
    public function restored(ContractCondominia $contractCondominia): void
    {
        //
    }

    /**
     * Handle the ContractCondominia "force deleted" event.
     */
    public function forceDeleted(ContractCondominia $contractCondominia): void
    {
        //
    }
}
