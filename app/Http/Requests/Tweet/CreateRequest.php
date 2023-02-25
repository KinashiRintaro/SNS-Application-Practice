<?php

namespace App\Http\Requests\Tweet;

use Illuminate\Foundation\Http\FormRequest;

// 画面からリクエストされたデータをバリデーションするためのクラス
class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * ユーザーがこの要求を行う権限があるかどうかを判断する
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'tweet' => 'required|max:140',
            'images' => 'array|max:4',
            // array.*：配列の中身に対するバリデーション
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    /**
     * Requestクラスのuser関数でログイン中のユーザーが取得できる
     *
     * @return int
     */
    public function userId(): int
    {
        return $this->user()->id;
    }

    /**
     * Requestからツイートデータを取得する
     *
     * @return string
     */
    public function tweet(): string
    {
        // Request.input() : リクエストからデータを取得する 
        return $this->input('tweet');
    }

    /**
     * リクエストで送られてきたファイルからimagesというキー名のものを取り出す
     *
     * @return array
     */
    public function images(): array
    {
        return $this->file('images', []);
    }
}
