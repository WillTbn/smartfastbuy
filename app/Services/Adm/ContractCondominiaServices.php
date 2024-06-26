<?php

namespace App\Services\Adm;

use App\DataTransferObject\Contract\ContractCondominiaDTO;
use App\DataTransferObject\Responsible\ResponsibleDTO;
use App\Models\Account;
use App\Models\ContractCondominia;
use App\Models\Signature;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Helpers\FileHelper;
use Illuminate\Support\Facades\Log;

class ContractCondominiaServices {
    use FileHelper;
    private ContractCondominia $contractModel;
    private User $userModel;
    private Account $accountModel;
    private Signature $signatureModel;
    public function __construct(
        User $userModel,
        Account $accountModel,
        ContractCondominia $contractModel,
        Signature $signatureModel

    )
    {
        $this->contractModel = $contractModel;
        $this->userModel = $userModel;
        $this->accountModel = $accountModel;
        $this->signatureModel = $signatureModel;
    }

    public function createdContract(ResponsibleDTO $resp,ContractCondominiaDTO $contract )
    {
        Log::info('entrei no '.__CLASS__);
        try{
            DB::beginTransaction();
            $user = $this->userModel->create([
                'name'=> $resp->name,
                'email' => $resp->email,
                'role_id' => $resp->role_id,
                'password' => $resp->password
            ]);
            $responsible = $this->accountModel->create([
                'person' =>$resp->person,
                'genre' =>$resp->genre,
                'birthday' =>$resp->birthday,
                'notifications' =>$resp->notifications,
                'phone' =>$resp->phone,
                'telephone'=>$resp->telephone,
                'condominia_id'=>$resp->condominia_id,
                'user_id' => $user->id
            ]);

            $this->contractModel->create([
                'document' => $this->setFileStore($contract->document,$contract->condominia_id, 'contract' ),
                'condominia_id' => $contract->condominia_id,
                'initial_date' => $contract->getInitialDate()->format('Y-m-d'),
                'final_date' => $contract->getFinalDate()->format('Y-m-d'),
                'ceo_id' => $contract->ceo_id,
                'responsible_id' => $responsible->user_id,
            ]);
            logger('Deu tudo certo no '.__CLASS__);
            DB::commit();
        }catch (Exception $e){
            Log::error('Deu erro no '.__CLASS__);
            Log::error('exception '.$e);
            return redirect()->back()->with('error', 'Problema na inserção no banco de dados!');
            DB::rollBack();
        }
    }

}
