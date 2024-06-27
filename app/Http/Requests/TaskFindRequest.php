<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ValidatesAndPreparesRequestData;
use Illuminate\Contracts\Validation\ValidationRule;

class TaskFindRequest extends FormRequest
{
    use ValidatesAndPreparesRequestData;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Gets the fields for which data will be prepared for validation.
     *
     * @return array
     */
    protected function prepareForValidationFields(): array
    {
        return ['id'];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:tasks,id'
        ];
    }

    /**
     * Define custom validation messages for the specified rules.
     *
     * @return array An array that maps rules to custom messages.
     */
    public function messages(): array
    {
        return [
            'id.exists' => __('validation.not_exists_db', ['attribute' => __('tasks.tasks')]),
        ];
    }
}
