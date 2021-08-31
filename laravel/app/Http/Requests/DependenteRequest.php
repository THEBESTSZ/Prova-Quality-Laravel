<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class DependenteRequest extends FormRequest
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
        ];
    }
    public function messages(){
        return [
            'required'=>' O Campo :attribute não pode estar vazio',
            'min'=>' O Campo :attribute tem que ter mais de :min caracteres ',
            'date_format'=>' O Campo :attribute deve estar no padrão internacional Ano-Mês-Dia ',
            'Nascimento.after' => 'A idade não pode exceder 120 anos'
        ];

    }
}
