<?php

namespace App\Http\Requests;

use App\Http\Serializers\MessageSerializer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class AdvertRequest extends FormRequest
{

    public function __construct(
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null
    ) {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->request = $request;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'title' => 'required|string|max:200',
            'description' => 'required|string|max:1000',
            'photo1' => 'required|url',
            'photo2' => 'nullable|url',
            'photo3' => 'nullable|url',
            'price' => 'required|numeric'
        ];
    }


     //@param \Illuminate\Validation\Validator $validator


    /*public function withValidator($validator)
    {
        if (!$validator->passes()) {
            return response()->json(
                $this->serializer->advertAddAnswer(null, $validator->errors()),
                Response::HTTP_OK
            );
        }
    }*/
}
