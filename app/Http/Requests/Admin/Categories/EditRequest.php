<?php

namespace App\Http\Requests\Admin\Categories;

use App\Enums\Permissions\Category as CategoryPermission;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can(CategoryPermission::EDIT->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('category')->id;

        return [
            'name' => ['required', 'string', 'min:2', 'max:50', Rule::unique(Category::class)->ignore($id)],
            'parent_id' => ['nullable', 'integer', 'exists:' . Category::class . ',id'],
        ];
    }
}
