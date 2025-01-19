<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\StudentCourseBatch;
use App\Models\Course;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Fetch all students
        $students = Student::paginate(10);

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Create the student record
            Student::create([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Return a success response
            return redirect()->route('students.index')->with('success', 'Student registered successfully!');
        } catch (QueryException $e) {
            // Handle any database exceptions
            return redirect()->route('students.create')->with('error', 'There was an error processing the request.');
        } catch (\Exception $e) {
            // Handle any other exceptions
            return redirect()->route('students.create')->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Display the specified student.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        // Find the student by ID
        $student = Student::findOrFail($id);

        return response()->view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        // Find the student by ID
        $student = Student::findOrFail($id);

        return response()->view('students.edit', compact('student'));
    }

    /**
     * Update the specified student in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Find the student by ID
        $student = Student::findOrFail($id);

        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Update the student record
            $student->update([
                'name' => $request->name,
                'email' => $request->email,
                
            ]);

            // Redirect to the student list with success message
            return redirect()->route('students.index')->with('success', 'Student updated successfully!');
        } catch (QueryException $e) {
            // Handle any database exceptions
            return redirect()->route('students.edit')->with('error', 'There was an error updating the student.');
        } catch (\Exception $e) {
            // Handle any other exceptions
            return redirect()->route('students.edit')->with('error', 'An unexpected error occurred.');
        }
    }


    /**
     * Remove the specified student from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    /*public function destroy($id)
    {
        // Find the student by ID
        $student = Student::findOrFail($id);

        // Delete the student record
        $student->delete();

        // Redirect to the student list with success message
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
*/
    public function destroy(Student $student)
    {
        try {
            $student->delete();
            return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('students.index')->with('error', 'An error occurred while deleting the student.');
        }
    }


    public function courses($id)
    {
        try {
            // Retrieve the student using the provided ID
            $student = Student::findOrFail($id);

            // Retrieve the student's course registrations (StudentCourseBatch) along with related CourseBatch and Course
            $registeredCourses = StudentCourseBatch::where('student_id', $id)
                ->with(['courseBatch', 'courseBatch.course'])  // Eager load courseBatch and its related course
                ->get();

            // If no courses are found, handle that case
            if ($registeredCourses->isEmpty()) {
                return redirect()->route('students.index')->with('error', 'No courses found for this student.');
            }

            // Return the view with the student and course data
            return response()->view('students.courses', compact('student', 'registeredCourses'));

        } catch (ModelNotFoundException $e) {
            // Handle the case where the student is not found
            return redirect()->route('students.index')->with('error', 'Student not found.');
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->route('students.index')->with('error', 'An error occurred while fetching courses.');
        }
    }

    public function RegisterForNewCourse($studentId)
    {
        $courses = Course::all();
        $student = Student::findOrFail($studentId);

        // Return the view with the courses and course batches
        return view('students.registerForNewCourse', compact('student','courses'));

    }

    public function normalSearch(Request $request)
    {
        $request->validate(['student_id' => 'required']);
        // Perform search by student_id
        $students = Student::where('id', $request->student_id)->paginate(10);
        return view('students.index', compact('students'));
    }

    public function advancedSearch(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email',
        ]);
        // Perform search by name and/or email
        $query = Student::query();
        if ($request->name) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->email) {
            $query->where('email', $request->email);
        }
        $students = $query->paginate(10);
        return view('students.index', compact('students'));
    }

}
