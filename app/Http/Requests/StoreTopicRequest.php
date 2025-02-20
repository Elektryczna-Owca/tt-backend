<?php

namespace App\Http\Requests;

use App\Models\Topic;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'StoreTopicRequest',
    description: 'StoreTopicRequest'
)]
class StoreTopicRequest extends FormRequest
{
    #[OA\Property(property: 'name', type: 'string')]
    #[OA\Property(property: 'description', type: 'string')]

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            Topic::NAME => ['required', 'string', 'max:255'],
            Topic::DESCRIPTION => ['required', 'string', 'max:255'],
        ];
    }
}
