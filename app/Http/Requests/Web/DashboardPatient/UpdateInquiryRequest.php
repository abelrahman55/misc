<?php
namespace App\Http\Requests\Web\DashboardPatient;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInquiryRequest extends FormRequest
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
        return [
            'date'                => 'nullable|string',
            'treatment_type'      => 'nullable|string',
            'assigned_coordintor' => 'nullable|string',
            'name'                => 'nullable|string|max:255',
            'contact_details'     => 'nullable|string|max:255',
            'country_id'          => 'nullable|integer|exists:countries,id',
            'specialty_id'        => 'nullable|integer|exists:specialties,id',
            'proximity'           => 'nullable|string|max:255',
            'reputation'          => 'nullable|string|max:255',
            'budget'              => 'nullable|numeric',
            'symptoms'            => 'nullable|string',
            'status'              => 'nullable|in:pending,confirmed,in_progress,awaiting_reply,completed',
            'files'               => 'nullable|array',
            'files.*'             => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048', // Adjust file types and size as needed
        ];
    }
}
