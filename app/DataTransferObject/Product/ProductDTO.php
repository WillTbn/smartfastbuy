<?php

namespace App\DataTransferObject\Product;

use App\DataTransferObject\AbstractDTO;
use App\DataTransferObject\InterfaceDTO;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class ProductDTO extends AbstractDTO implements InterfaceDTO
{
    public readonly int $account_id;
    public readonly ?int $id;
    public readonly ?int $condominia_id;
    public function __construct(
        public readonly string $name,
        public readonly string $barcode,
        public readonly string $quantity,
        public readonly float $value,
        // public readonly string $value,
        public readonly int $category_id,
        public readonly ?string $type = null,
        public readonly ?string $description = null,
        ?int $id = null,
        ?int $condominia_id = null,
    )
    {
        $this->account_id = auth()->user()->id;
        $this->id = $id;
        $this->condominia_id = $condominia_id;

        $this->validate();

    }
    public function rules():array
    {
        return [
            'name' => 'required|string|min:10|max:60',
            'barcode' => ['required',
                Rule::unique('products')->ignore($this->id)
            ],
            'quantity' => 'required',
            'value' => 'required',
            'category_id'=> 'required|numeric',
            'type' => '',
            'description' => '',
            'account_id'=>'',
            'condominia_id'=>'required',
        ];
    }
    public function messages():array
    {
        return [
            'required' => 'O :attribute é obrigatório!',
            'date' => "o :attribute tem que ser uma data válida.",
            'name.min' => 'É necessário no mínimo :min caracteres no nome!',
            'string' => 'Campo :attribute só aceitar texto.',
            'password_confirm.same' => 'Senhas não conferem, campo confirma senha tem que igual ao campo senha.',
            'code.min' => 'O código de verificação tem no minimo :min caracters',
            'max' => 'Limite máximo de caracteres ultrapassada no campo :attribute.',
            'min'=> 'Minimo de caracteres não atigindo, no campo :attribute.',
            'barcode.unique' => 'Código de barra já existente em nosso banco, atualize o existente.'
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
