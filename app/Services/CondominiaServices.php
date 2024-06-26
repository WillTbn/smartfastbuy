<?php

namespace App\Services;

use App\DataTransferObject\Condominia\CondominiaDTO;
use App\DataTransferObject\Responsible\ResponsibleDTO;
use App\Enums\ContractStates;
use App\Models\Account;
use App\Models\AddressCondominia;
use App\Models\Condominia;
use App\Models\ContractCondominia;
use App\Models\Role;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CondominiaServices
{
    private Condominia $condominiaModel;
    public function __construct(
        Condominia $condominiaModel
    ) {
        $this->condominiaModel = $condominiaModel;
    }
    public function getAllCond()
    {
        // $respon = Role::where('name', 'Responsavel')->value('id');
        // return DB::table('condominias')
        //     // ->join('accounts', 'condominias.id', '=', 'accounts.condominia_id')
        //     ->join('users', 'accounts.user_id', '=', 'users.id')

        //     ->select(
        //         'condominias.id',
        //         'condominias.name',
        //         'condominias.contract_condominia_id as cond_id',
        //         'condominias.address_condominias_id as addr_id',
        //         'users.email as responsable_email'
        //     )
        //     ->groupBy(
        //         'condominias.id',
        //         'condominias.name',
        //         'users.email',
        //         'condominias.contract_condominia_id',
        //         'condominias.address_condominias_id',
        //         'users.email')
        // ->get();
        return Condominia::with(['addressCondominia', 'contractCondominia', 'responsable'])->get();
    }

    public function getlinkToUser()
    {
        $auth = auth()->user();
        // dd($auth->account)
        return DB::table('condominias')->where('id', $auth->account->condominia->id)->get();
    }

    public function createCondominia(CondominiaDTO $dtoCondominia)
    {

        try{
            DB::beginTransaction();
            $cond = Condominia::create([
                'name' => $dtoCondominia->name
            ]);

            AddressCondominia::create([
                'condominia_id' => $cond->id,
                'road' => $dtoCondominia->road,
                'state' => $dtoCondominia->state,
                'district' => $dtoCondominia->district,
                'zip_code' => $dtoCondominia->zip_code,
                'city' => $dtoCondominia->city,
                'number' => $dtoCondominia->number

            ]);

            DB::commit();

        }catch(Exception $e){
            // dd($e);
            DB::rollBack();
            return redirect()->back()->with('error', 'Problema na criação do condominio!');
        }

    }
    public function updateResponsable(ResponsibleDTO $responsible)
    {
        $cond = Condominia::find($responsible->condominia_id);
        // dd($responsible); first
        $respon = Account::where('person', $responsible->person)->first();
        $cond->update(['responsible_id'=> $respon->user_id]);
        // dd($cond);
    }
    public function getOne(Condominia $condominia)
    {
        return $condominia->where('id', $condominia->id)->with(['contractCondominia', 'addressCondominia'])->first();
    }
    public function getFirst($condominia_id)
    {
        return $this->condominiaModel->find($condominia_id);
    }
    public function updatedStatus(Condominia $cond, ContractStates $status)
    {
        try{
            DB::beginTransaction();
            Log::info('Status é '.json_encode($status));
            $cond->update([
                'contract_status' => $status
            ]);
            Log::info('Status atualizado para '.json_encode($status));
            DB::commit();
        }catch(Exception $e)
        {
            DB::rollBack();
            Log::error('No update de '.__CLASS__);
            // return redirect()->back()->with('error', 'Problema na criação do condominio!');
        }
    }
}
