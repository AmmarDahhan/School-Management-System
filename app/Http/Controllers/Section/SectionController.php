<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSectionsRequest;
use App\Models\Teachers;

class SectionController extends Controller
{
    public function index()
    {

        $Grades = Grade::with(['Sections'])->get();

        $list_Grades = Grade::all();

        $teachers = Teachers::all();

        return view('pages.Sections.Sections', compact('Grades', 'list_Grades', 'teachers'));
    }

    public function store(StoreSectionsRequest $request)
    {

        try {

            $validated = $request->validated();
            $Sections = new Section();

            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->Grade_id = $request->Grade_id;
            $Sections->Class_id = $request->Class_id;
            $Sections->Status = 1;
            $Sections->save();
            $Sections->teachers()->attach($request->teacher_id);
            toastr()->success(trans('messages.success'));

            return redirect()->route('Sections.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(StoreSectionsRequest $request)
    {

        try {
            $validated = $request->validated();
            $Sections = Section::findOrFail($request->id);

            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->Grade_id = $request->Grade_id;
            $Sections->Class_id = $request->Class_id;

            if (isset($request->Status)) {
                $Sections->Status = 1;
            } else {
                $Sections->Status = 2;
            }

            // update pivot tABLE
            if (isset($request->teacher_id)) {
                $Sections->teachers()->sync($request->teacher_id);
            } else {
                $Sections->teachers()->sync(array());
            }

            $Sections->save();
            toastr()->success(trans('messages.Update'));

            return redirect()->route('Sections.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(request $request)
    {

        Section::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Sections.index');
    }

    public function getclasses($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");

        return $list_classes;
    }
}
