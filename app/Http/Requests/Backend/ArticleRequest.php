<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->id ?? null;
        switch ($this->method()) {
            case 'POST':
                return [
                    'title'               => 'required|max:255',
                    'body'                => 'required',
                    'slug'                => 'required|max:255|unique:articles',
                    'article_category_id' => 'required',
                    'image'               => 'image|mimes:jpeg,png,jpg|max:10000',
                    'author_name'         => 'max:255',
                    'meta_title'          => 'max:255',
                    'alt_image'           => 'max:255',
                    'tag_ids'             => 'required',
                ];
                break;
            case 'PUT':
                return [
                    'title'               => 'required|max:255',
                    'slug'                => 'required|max:255|unique:articles,slug'.($id ? ','.$id : ''),
                    'body'                => 'required',
                    'article_category_id' => 'required',
                    'image'               => 'image|mimes:jpeg,png,jpg|max:10000',
                    'author_name'         => 'max:255',
                    'meta_title'          => 'max:255',
                    'alt_image'           => 'max:255',
                    'tag_ids'             => 'required',
                ];
                break;
            default:
                return [];
                break;
        }

    }
}
