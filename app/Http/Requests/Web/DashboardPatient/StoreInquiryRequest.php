<?php
namespace App\Http\Requests\Web\DashboardPatient;

use Illuminate\Foundation\Http\FormRequest;

class StoreInquiryRequest extends FormRequest
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
            'date'                => 'required|string',
            'treatment_type'      => 'required|string',
            'assigned_coordintor' => 'nullable|string',
            'name'                => 'required|string|max:255',
            'contact_details'     => 'required|string|max:255',
            'country_id'          => 'required|integer|exists:countries,id',
            'specialty_id'        => 'required|integer|exists:specialties,id',
            'proximity'           => 'nullable|string|max:255',
            'reputation'          => 'nullable|string|max:255',
            'budget'              => 'nullable|numeric',
            'symptoms'            => 'nullable|string',
            'status'              => 'nullable|in:pending,confirmed,in_progress,awaiting_reply,completed',
            'files'               => 'required|array',
            'files.*'             => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048', // Adjust file types and size as needed
        ];
    }
}
