<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('product') ?: null;
        return [
            'name'          => 'required|string|max:255',
            'sku'           =>  ['required', 'max:255', Rule::unique('products')->ignore($id)],
            'img_thumbnail' => 'nullable|image|max:2048',
            'price_regular' => ['required', 'numeric', 'min:0', 'regex:/^\d{1,8}(\.\d{1,2})?$/'],
            'price_sale'    => ['nullable', 'numeric', 'min:0', 'lte:price_regular', 'regex:/^\d{1,8}(\.\d{1,2})?$/'],
            'description'   => 'nullable|string',
            'content'       => 'nullable|string',
            'material'      => 'nullable|string',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'is_active'    => 'nullable|boolean',
            'is_hot_deal'  => 'nullable|boolean',
            'is_good_deal' => 'nullable|boolean',
            'is_new'       => 'nullable|boolean',
            'product_color' => 'required',
            'product_size'  => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'          => 'Tên sản phẩm không được để trống.',
            'sku.required'           => 'SKU là bắt buộc.',
            'price_regular.required' => 'Giá thường là bắt buộc.',
            'price_sale.lte'         => 'Giá khuyến mãi phải nhỏ hơn hoặc bằng giá thường.',
            'category_id.required'   => 'Vui lòng chọn danh mục.',
            'product_color.required' => 'Hãy chọn màu sản phẩm.',
            'product_size.required'  => 'Hãy chọn kích thước sản phẩm.',
        ];
    }
}
