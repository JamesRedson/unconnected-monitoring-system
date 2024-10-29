<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
			'first_name' => [
				'required',
				'string',
				'max:255'
			],
			'last_name' => [
				'required',
				'string',
				'max:255'
			],
			'sex' => [
				'required',
				'string',
				'max:255',
				'in:Male,Female'
			],
			'birth_date' => [
				'required',
				'date',
				'before:today'
			],
		];
	}

	/**
	 * Get custom messages for validator errors.
	 */
	public function messages()
	{
		return [
			'first_name.required' => 'First name is required',
			'last_name.required' => 'Last name is required',
			'sex.required' => 'Sex is required',
			'sex.in' => 'Sex must be one of: male, female',
			'birth_date.required' => 'Birth date is required',
			'birth_date.date' => 'Birth date must be a valid date',
			'birth_date.before' => 'Birth date must be before today',
		];
	}
}
