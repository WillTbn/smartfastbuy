<?php

namespace App\Jobs\AdmSystem\Responsible;

use App\DataTransferObject\Responsible\ResponsibleDTO;
use App\Services\Adm\AccountServices;
use App\Services\Adm\UserServices;
use App\Services\CondominiaServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserAndAccountCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // protected $data;
    /**
     * Create a new job instance.
     */
    // private CondominiaServices $condominiaService;
    public function __construct(
        protected ResponsibleDTO $dto,
        protected UserServices $userServices,
        protected AccountServices $accountServices,
        protected CondominiaServices $condominiaServices,
    )
    {
        // $this->condominiaService = $condominiaServices;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $this->userServices->createResponsable($this->dto);
        $this->condominiaServices->updateResponsable($this->dto);

    }
}
