<?php

namespace App\Services;

use App\Fields\AddressField;
use App\Fields\BasicDataField;
use App\Fields\EducationField;
use App\Fields\EmploymentField;
use App\Fields\LanguageField;
use App\Fields\Collections\FieldCollection;

class ProcessRequestService
{   
    public function processRequest(array $request): FieldCollection
    {
        $fieldCollection = new FieldCollection;

        $fieldCollection->addField(new BasicDataField(
            $request['basicData']['name'],
            $request['basicData']['surname'],
            $request['basicData']['phone'],
            $request['basicData']['email']
        ));

        $fieldCollection->addField(new AddressField(
            $request['address']['country'],
            $request['address']['city'],
            $request['address']['street'],
            $request['address']['houseNumber'],
            $request['address']['postIndex']
        ));

        foreach ($request['educations'] as $education) {
            $fieldCollection->addField(new EducationField(
                $education['institution'],
                $education['faculty'],
                $education['level'],
                $education['statuss'],
                $education['time']
            ));
        }

        foreach ($request['employments'] as $employment) {
            $fieldCollection->addField(new EmploymentField(
                $employment['institution'],
                $employment['position'],
                $employment['time'],
                $employment['description'],
                $employment['achievements']
            ));
        }

        foreach ($request['languages'] as $language) {
            $fieldCollection->addField(new LanguageField(
                $language['language'],
                $language['level']
            ));
        }

        return $fieldCollection;
    }
}
