<?php

namespace App\Http\Requests;

use App\Actions\SanitizeRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserHandleWithdrawRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "gateway_id" => "required",
            "gateway_fields" => "required",
        ];
    }

    protected function prepareForValidation()
    {
        $fields = [];
        foreach($this->gateway_field ?? [] as $key => $value){
            $fields[$key] = SanitizeRequest::sanitizeString($value);
        }

        return $this->merge([
            "gateway_id" => $this->gateway_name,
            "gateway_fields" => serialize($fields),
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }
}
