<?php

namespace App\Services;

use App\DataTransferObject\Invitation\InvitationDTO;
use App\Models\Invitation;
use Illuminate\Support\Facades\DB;

class InvitationServices
{
    public function sendCreate(InvitationDTO $inv):Invitation
    {
        // return $inv;
        $invite =  new Invitation();
        $invite->email = $inv->email;
        $invite->name = $inv->name;
        $invite->data = $inv->data;
        $invite->user_id = $inv->user_id;
        $invite->token = $inv->token;
        $invite->created_at = now();
        $invite->saveOrFail();
        return $invite;
    }

    public function getData(int $id)
    {
        $response =
        DB::table('invitations')
            ->join('users', 'users.id', '=', 'invitations.user_id')
            ->join('accounts', 'users.id', '=','accounts.user_id')
            // ->join('apartments', 'id', '=', 'invitations.data.apartment_id')
            ->select(
                'invitations.id',
                'invitations.email',
                'invitations.name',
                'invitations.data',
                'invitations.updated_at as date_send',
                'users.email as create_email',
                'accounts.avatar as create_avatar'
            )
            ->where('invitations.id', '=', $id)
        ->first();


        return $response;
    }
    public function getDataAll()
    {
        $response = DB::table('users')
            ->join('invitations', 'users.id', '=', 'invitations.user_id')
            ->join('accounts', 'users.id', '=','accounts.user_id')
            ->whereNull('invitations.deleted_at')
            ->select(
                'invitations.id',
                'invitations.email',
                'invitations.name',
                'invitations.created_at',
                'users.email as create_email',
                DB::raw("CONCAT('".env('APP_URL_C')."/', accounts.avatar) as create_avatar"),
            )
        ->get();
        return $response;
    }

    public function getDataAllCondominia(int $condominia_id)
    {
        return
        DB::table('users')
            ->join('invitations', 'users.id', '=', 'invitations.user_id')
            ->join('accounts', 'users.id', '=','accounts.user_id')
            ->whereNull('invitations.deleted_at')
            ->where('invitations.condominia_id', '=', $condominia_id)
            ->select(
                'invitations.id',
                'invitations.email',
                'invitations.name',
                'invitations.created_at',
                'users.email as create_email',
                DB::raw("CONCAT('".env('APP_URL_C')."/', accounts.avatar) as create_avatar"),
            )
        ->get();

    }

    public function delete(int $id)
    {
        Invitation::destroy($id);
    }
    public function countInvitations()
    {
        $result = [
            'name' => 'convites',
            'count' =>DB::table('invitations')->count(),
            'icons' => 'fa-solid fa-city'
        ];
        return $result;
    }
}
