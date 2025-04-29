<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class StudentController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $students = Student::all();
            return response()->json($students, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error retrieving students', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'date_of_birth' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); // 422 Unprocessable Entity
        }
        $data = $request->all();

        try {
            $student = Student::create($data);
            return response()->json($student, 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error creating student', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * 
     * @param  string $id 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        try {
            $student = Student::findOrFail($id);
            return response()->json($student, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Student not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error retrieving student', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  string $id 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:students,email,' . $id,
            'date_of_birth' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); // 422 Unprocessable Entity
        }

        try {
            $student = Student::findOrFail($id);
            $student->update($validator->validated());
            return response()->json($student, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Student not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error updating student', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * 
     * @param  string $id 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();
            return response()->json(null, 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Student not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error deleting student', 'error' => $e->getMessage()], 500);
        }
    }
}
