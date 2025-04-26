<?php


namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use App\Http\Requests\StoreGradesRequest;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{

    public function index()
    {
        $Grades = Grade::all();
        return view('pages.grades.grades_list', compact('Grades'));
    }

    public function store(StoreGradesRequest $request)
    {
        // if (Grade::where('Name->ar', $request->Name)->orWhere('Name->en', $request->Name_en)->exists()) {

        //     return redirect()->back()->withErrors(trans('grades-trans.exists'));
        // }

        try {
            $validated = $request->validated();
            $Grade = new Grade();
            /*
              $translations = [
                  'en' => $request->Name_en,
                  'ar' => $request->Name
              ];
              $Grade->setTranslations('Name', $translations);
              */
            $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
            $Grade->Notes = $request->Notes;
            $Grade->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(StoreGradesRequest $request)
    {
        try {

            $validated = $request->validated();
            $Grades = Grade::findOrFail($request->id);
            $Grades->update([
                $Grades->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
                $Grades->Notes = $request->Notes,
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $MyClass_id = Classroom::where('Grade_id', $request->id)->pluck('Grade_id');

        if ($MyClass_id->count() == 0) {

            $Grades = Grade::findOrFail($request->id)->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('Grades.index');
        } else {

            toastr()->error(trans('grades-trans.delete_Grade_Error'));
            return redirect()->route('Grades.index');
        }
    }
}
