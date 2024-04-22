<?php

namespace App\Observers;

use App\Events\Signature\SetSignatureContract;
use App\Models\ContractCondominia;

class ContractCondominiaObserver
{
    /**
     * Handle the ContractCondominia "created" event.
     */
    public function created(ContractCondominia $contractCondominia): void
    {
        logger('Entrei no observer '.__CLASS__);
        if($contractCondominia->isDirty('ceo_id')){
            logger($contractCondominia);
            event(new SetSignatureContract($contractCondominia));
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
