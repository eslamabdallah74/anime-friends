<?php

namespace App\Http\Requests;

use App\Models\Pivot\AnimeUser;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AnimeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'      => 'required|min:2|max:30',
            'url'       => 'nullable|min:2|max:200',
            'status'    => ['required', Rule::in(array_keys(AnimeUser::$status))],
        ];
    }
}
