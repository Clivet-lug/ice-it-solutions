<?php

namespace App\Http\Requests;

use App\Constants\PortfolioConstants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PortfolioRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Since we're already using admin middleware
    }

    public function rules()
    {
        $rules = [
            'title' => 'required|max:255',
            'type' => ['required', Rule::in(array_keys(PortfolioConstants::PROJECT_TYPES))],
            'sub_type' => 'nullable|string|max:255',
            'description' => 'required',
            'client_name' => 'nullable|max:255',
            'is_featured' => 'boolean',
            'completion_date' => 'nullable|date',
            'complexity_level' => ['nullable', Rule::in(array_keys(PortfolioConstants::COMPLEXITY_LEVELS))],
            'confidentiality_level' => ['nullable', Rule::in(array_keys(PortfolioConstants::CONFIDENTIALITY_LEVELS))],
            'challenges' => 'nullable|string',
            'solutions' => 'nullable|string',
            'features' => 'nullable|array',
            'technologies_used' => 'nullable|array',
            'project_status' => ['nullable', Rule::in(array_keys(PortfolioConstants::PROJECT_STATUS))],
        ];

        // Type-specific validation rules
        if ($this->input('type') === 'website' || $this->input('type') === 'webapp') {
            $rules += [
                'live_url' => 'nullable|url',
                'github_url' => 'nullable|url',
                'before_image' => 'nullable|image|max:5120', // 5MB
                'after_image' => 'required|image|max:5120',
            ];
        }

        if ($this->input('type') === 'webapp') {
            $rules += [
                'access_type' => ['required', Rule::in(array_keys(PortfolioConstants::ACCESS_TYPES))],
                'user_roles' => 'nullable|array',
                'user_base' => 'nullable|integer|min:0',
                'modules' => 'nullable|array',
            ];
        }

        if ($this->input('type') === 'document' || $this->input('type') === 'presentation') {
            $rules += [
                'sample_file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:10240', // 10MB
                'formatting_style' => 'nullable|string|max:255',
                'number_of_pages' => 'nullable|integer|min:1',
                'document_type' => 'required|string|max:255',
            ];
        }

        // Testimonial validation
        if ($this->filled('client_testimonial')) {
            $rules += [
                'client_testimonial' => 'string',
                'client_position' => 'required|string|max:255',
                'testimonial_date' => 'required|date',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'type.in' => 'Please select a valid project type.',
            'sub_type.in' => 'Please select a valid project sub-type.',
            'complexity_level.in' => 'Please select a valid complexity level.',
            'confidentiality_level.in' => 'Please select a valid confidentiality level.',
            'project_status.in' => 'Please select a valid project status.',
            'access_type.in' => 'Please select a valid access type.',
            'sample_file.mimes' => 'The sample file must be a PDF, DOC, DOCX, PPT, or PPTX file.',
            'after_image.required' => 'The after image is required for website projects.',
        ];
    }
}