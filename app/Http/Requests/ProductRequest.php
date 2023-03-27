<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ProductType;
use Illuminate\Validation\Rules\Enum;

class ProductRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return $this->updateRules();
        }

        return $this->createRules();
    }

    private function createRules(): array
    {
        $rules = [
            'name' => 'required|string|max:255|unique:products',
        ];

        return array_merge($rules, $this->sharedRules());
    }

    private function updateRules(): array
    {
        $product = $this->route()->parameter('product');

        $rules = [
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
        ];

        return array_merge($rules, $this->sharedRules());
    }

    private function sharedRules(): array
    {
        return [
            'price' => 'required|decimal:0,2',
            'type' => [new Enum(ProductType::class)]
        ];
    }
}
