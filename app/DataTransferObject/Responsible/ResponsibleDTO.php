<?php
namespace App\DataTransferObject\Responsible;

use App\DataTransferObject\AbstractDTO;
use App\DataTransferObject\InterfaceDTO;
use App\Enums\NotificationsEnum;
use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class ResponsibleDTO extends AbstractDTO implements InterfaceDTO
{
    public $role_id;
    public function __construct(
        public readonly ?string $name=null,
        public readonly ?string $email=null,
        public readonly ?string $password=null,
        public readonly ?string $password_confirmation=null,
        public readonly ?int $condominia_id=null,
        public readonly ?string $person=null,
        public readonly ?string $genre=null,
        public readonly ?string $birthday=null,
        public readonly ?string $notifications=null,
        // ?int $role_id =  RoleEnum::Responsible=null,
        public readonly ?string $phone=null,
        public readonly ?string $telephone=null,
    )
    {
        $this->role_id = RoleEnum::Responsible;
        $this->validate();
    }

    public function rules():array
    {
        return [
            'name' => 'required|min:5',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults() ],
            'genre' => 'required|max:1',
            'birthday' => 'required|date',
            'notifications' => ['required', Rule::in(NotificationsEnum::forSelectName())],
            'condominia_id' => 'exists:condominias,id',
            // verificar existencia na tabela roles
            'role_id' => 'required',
            'person' => [
                'required','min:11','max:14',
                // Rule::unique('accounts')->ignore($this->user_id, 'user_id')
                Rule::unique('accounts')
            ],
            'telephone' => 'min:10|max:12',
            'phone'=>'',
        ];
    }
    public function messages():array
    {
        return [
            'required.name' => "Obrigatório campo name",
            'required.email' => "Obrigatório campo e-mail",
            'unique' => ':attribute ja registrado em no nosso sistema.',
            'unique.person' => 'CPF já registrado em no nosso sistema.',
            'min' => ':attribute tem que ter no minimo :min.',
            'date' => "o :attribute tem que ser uma data válida.",
            'name.min' => 'É necessário no mínimo :min caracteres no nome!',
            'string' => 'Campo :attribute só aceitar texto.',
            'password_confirm.same' => 'Senhas não conferem, campo confirma senha tem que igual ao campo senha.',
            'code.min' => 'O código de verificação tem no minimo :min caracters',
            'max' => 'Limite máximo de caracteres ultrapassada no campo :attribute.',
            'min'=> 'Minimo de caracteres não atigindo, no campo :attribute.',
            'barcode.unique' => 'Código de barra já existente em nosso banco, atualize o existente.'
            // 'unique' => 'o :attribute já existente.'
        ];
    }
    public function validator():Validator
    {
        return validator($this->toArray(), $this->rules(), $this->messages());
    }

    public function validate():array
    {
        return $this->validator()->validate();
    }
}
