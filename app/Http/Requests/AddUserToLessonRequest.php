<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;


class AddUserToLessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        //dd($this->validationData()['userId']);
        return [
            'lessonId' => ['required','unique:lesson_user,lesson_id,'.$this->validationData()['lessonId'].',id,user_id,'.$this->validationData()['userId'],'exists:lessons,id'],
            'userId' => ['required','exists:users,id']
        ];
    }

    public function messages(): array
    {
        return [
            'lessonId.required'=>'You have to choose lesson',
            'lessonId.unique'=>'This user already signed in into this lesson',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json(['errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

}
