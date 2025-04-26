<?php

namespace App\Repository;

interface TeacherRepositoryInterface
{

    // get all Teachers
    public function getAllTeachers();

    // Get specialization
    public function Getspecialization();

    // Get Gender
    public function GetGender();

    // Store Teachers
    public function StoreTeachers($request);

    // edit Teachers
    public function editTeachers($id);

    // Update Teachers
    public function UpdateTeachers($request);

    // Delete Teachers
    public function DeleteTeachers($request);

}
