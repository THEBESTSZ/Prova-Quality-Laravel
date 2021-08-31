<?php

namespace App\Http\Requests;
use Carbon\Carbon;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome'=>'required|min:3',
            'nascimento'=>'required|date_format:Y/m/d|after:'.Carbon::now()->subYears(120),
            'foto' => 'file|max:200|mimes:jpeg,jpg,png,gif',
            'email' => 'required|email:rfc,dns'
        ];
    }

    public function messages(){
        return [
            'required'=>' O Campo :attribute não pode estar vazio',
            'min'=>' O Campo :attribute tem que ter mais de :min caracteres ',
            'date_format'=>' O Campo :attribute deve estar no padrão internacional Ano-Mês-Dia ',
            'nascimento.after' => ' A idade não pode exceder 120 anos',
            'foto.max' => ' O tamanho máximo da foto não pode exceder 200 kb',
            'email' => ' O email informado é inválido',
            'foto.mimes' => ' Somente as seguintes extensões são permitidas: jpeg,jpg,png,gif'
        ];

    }
}
