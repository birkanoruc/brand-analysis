<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnalysisStoreRequest extends FormRequest
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
        $analysisId = $this->analysi ? $this->analysi->id : null;

        $rules = [
            'name' => 'required|string|unique:analysis,name,' . $analysisId,
            'brand_id' => 'required|exists:brands,id',
            'analysisDate' => 'required|date',
            'analysis_metas' => 'required|array',
        ];

        if ($this->has('analysis_metas')) {
            foreach ($this->analysis_metas as $categoryId => $uploadId) {
                // Eğer bir seçim yapılmışsa, exists kuralı uygulansın
                if (!empty($uploadId)) {
                    $rules["analysis_metas.$categoryId"] = 'required|exists:uploads,id';
                }
            }
        }

        return $rules;
    }
}
