<?php

namespace App\Modules\Server\Request;


use App\Modules\Server\Enum\HddTypeEnum;
use App\Modules\Server\Enum\RamEnum;
use App\Modules\Server\Enum\StorageEnum;
use App\Modules\Server\Rule\LocationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServerFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'location' => ['sometimes', new LocationRule()],
            'hdd_type' => ['sometimes',  Rule::in(HddTypeEnum::getValues())],
            'ram' => ['sometimes','array'],
            'ram.*' => ['required_with:ram', Rule::in(RamEnum::getValues())],
            'storage' => ['sometimes','array'],
            'storage.0' => ['required_with:storage', Rule::in(StorageEnum::getValues())],
            'storage.1' => ['required_with:storage', Rule::in(StorageEnum::getValues())]
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $inputToUpperCase = ['hdd_type','ram','storage'];

        foreach ($inputToUpperCase as $inputKey){
            if($this->has($inputKey)){
                $input = $this->input($inputKey);
                if(is_string($input)){
                    $this->merge([$inputKey => strtoupper($input)]);
                }
                if(is_array($input)){
                    $inputArr = [];
                    foreach ($input as $value){
                        $inputArr[] = strtoupper($value);
                    }
                    $this->merge([$inputKey => $inputArr]);
                }
            }
        }
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation(): void
    {
        if ($storageValue = $this->input('storage')) {
            $mergeInput = [];
            foreach ($storageValue as $value) {
                $mergeInput[] = StorageEnum::getValueInGB($value);
            }
            asort($mergeInput);
            $this->merge(['storage' => $mergeInput]);
        }

        if ($ramValue = $this->input('ram')){
            $mergeInput = [];
            foreach ($ramValue as $value) {
                $mergeInput[] = RamEnum::getValueInGB($value);
            }
            $this->merge(['ram' => $mergeInput]);
        }

        if ($hddTypeValue = $this->input('hdd_type')) {
            if ($hddTypeValue === HddTypeEnum::SATA) {
                $hddTypeValue = HddTypeEnum::SATA2;
            }
            $this->merge(['hdd_type' => strtoupper($hddTypeValue)]);
        }
    }

}
