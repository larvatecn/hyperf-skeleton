<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

/**
 * 保存设置请求
 * @author Tongle Xu <xutongle@gmail.com>
 */
class StoreSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'key' => ['required', 'string'],
            'value' => ['required', 'string'],
            'type' => ['required', 'string', 'in:string,bool,boolean,int,integer,float']
        ];
    }
}
