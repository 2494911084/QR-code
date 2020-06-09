<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;
use App\SubjectQr;

class SubjectQrsController extends Controller
{
    public function show(SubjectQr $subjectQr)
    {
        $subjects_id = $subjectQr->content;
        $subjects_id = json_decode($subjects_id);
        // return $subjectQr->content;
        $fsubject_array = [];
        foreach ($subjects_id as $key => $value) {
             $subject = Subject::find($value);
             if ($subject) {
                $fsubject_array[] = $subject;
             }
        }
        // $files_id_array = \Str::toArray($files_id);
        return $fsubject_array;
    }
}
