<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminManageArticleRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return \Auth::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'image' => 'nullable|image',
			'title' => 'required|max:255',
			'content' => 'required|max:65535',
			'excerpt' => 'required|max:65535',
			'published' => 'boolean',
			'tags' => 'required|max:255'
		];
	}
}
