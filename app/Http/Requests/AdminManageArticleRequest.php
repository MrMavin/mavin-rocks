<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Concerns\ValidatesAttributes;

class AdminManageArticleRequest extends FormRequest
{
	use ValidatesAttributes;

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
	 * @return array
	 */
	public function messages()
	{
		return [
			'tags.required_if' => 'Tags are required if you want to publish your article.'
		];
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'category_id' => 'nullable|exists:blog_categories,id',
			'image' => 'nullable|image',
			'title' => 'required|max:255',
			'content' => 'required|max:65535',
			'excerpt' => 'required|max:65535',
			'published' => 'boolean',
			'tags' => 'required_if:published,1|max:255'
		];
	}
}
