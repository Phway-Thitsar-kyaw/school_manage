<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ClassStudent;
use App\Models\Course;
use App\Models\CourseRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //direct course page
    public function index()
    {

        //$course = Course::orderBy('created_at','desc')->get();

        $course = Course::select('courses.*', 'users.name')
            ->join('users', 'users.id', 'courses.user_id')
            ->orderBy('courses.created_at', 'desc')
            ->paginate(6);

        return view('student.course.list')->with(['course' => $course]);
    }

    //look course

    public function lookCourse($course_id)
    {

        $id = auth()->user()->id;

        $courseData = Course::select('courses.*', 'users.name', 'users.id')
            ->join('users', 'users.id', 'courses.user_id')
            ->where('courses.course_id', $course_id)
            ->get();

        $relatedClass = Course::select('classes.*')
            ->join('classes', 'courses.course_id', 'classes.course_id')
            ->where('courses.course_id', $course_id)
            ->get();
        if (empty($relatedClass->toArray())) {
            $relatedClass = null;
        }

        return view('student.course.lookCourse')->with(['courseData' => $courseData, 'relatedClass' => $relatedClass]);
    }

    //Enroll Class

    public function enrollClass($class_id, $teacher_id, Request $request)
    {

        $data = [
            'class_id' => $class_id,
            'student_id' => auth()->user()->id,
            'teacher_id' => $teacher_id,
            'status' => 1,
        ];

        ClassStudent::create($data);

        return back()->with(['classStudentAttendSuccess' => 'Enroll Success']);
    }

    //class list

    public function classList()
    {

        $class = Classes::orderBy('classes.created_at', 'desc')
            ->join('users', 'classes.user_id', 'users.id')
            ->select('classes.*', 'users.name', 'users.id')
            ->paginate(6);

        return view('student.class.classList')->with(['class' => $class]);
    }

    //look Class Information

    public function lookClassInformation($class_id)
    {

        $class = Classes::where('class_id', $class_id)
            ->get();

        $id = auth()->user()->id;

        $attend_status = Classes::leftJoin('class_students', 'class_students.class_id', 'classes.class_id')
            ->where('class_students.class_id', $class_id)
            ->where('class_students.student_id', $id)
            ->select('class_students.status')
            ->get();

        if (empty($attend_status->toArray())) {

            $status = null;

        } else {

            $status = $attend_status[0]['status'];
        }

        return view('student.class.lookClassInformation')->with(['class' => $class, 'status' => $status]);

    }

    //teacher list

    public function teacherList()
    {

        $teacher = User::orderBy('created_at', 'desc')
            ->where('role', 'teacher')
            ->paginate(6);

        return view('student.teacher.teacherList')->with(['teacher' => $teacher]);
    }

    //teacher related course
    public function lookTeacherCourse($teacher_id)
    {

        $teacherData = User::where('id', $teacher_id)
            ->get();

        $class = Classes::where('classes.user_id', $teacher_id)
            ->select('classes.*')
            ->get();

        return view('student.teacher.lookTeacherCourse')->with(['teacherData' => $teacherData, 'class' => $class]);
    }

    //Profile

    public function profileInfo()
    {

        $id = auth()->user()->id;

        $studentInfo = User::where('id', $id)->get();

        return view('student.profile.profileInfo')->with(['studentInfo' => $studentInfo]);
    }

    // update profile

    public function updateStudentProfile($user_id, Request $request)
    {
        $userData = $this->getUserProfileData($request);

        User::where('id', $user_id)->update($userData);

        return back()->with(['updateSuccess' => 'Updated Success']);
    }

    // get user profile data
    private function getUserProfileData($request)
    {

        $data = [

            'name' => $request->name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone_number_one' => $request->phone_number_one,
            'phone_number_two' => $request->phone_number_two,
            'region' => $request->region,
            'town' => $request->town,
            'address' => $request->address,

        ];

        return $data;

    }

    // change password

    public function changePasswordForm()
    {

        return view('student.profile.changePassword');

    }

    //change Password
    public function changePassword(Request $request)
    {
        $user_password = auth()->user()->password;

        if (Hash::check($request->old_password, $user_password)) {

            if (strlen($request->new_password) >= 8 && strlen($request->confirm_password >= 8)) {

                if ($request->new_password == $request->confirm_password) {

                    $data = [

                        'password' => Hash::make($request->confirm_password),

                    ];

                    $id = auth()->user()->id;

                    User::where('id', $id)->update($data);

                    return back()->with('success', 'Change Password Success');
                } else {

                    return back()->with('notSameBoth', 'New Password and Confirm Password not match.Try Again!');
                }

            } else {
                return back()->with('errorLength', 'New Password and Confirm Password Greather than 8');
            }
        } else {

            return back()->with('not Match', 'Old Password do not match!. Try Again');
        }

    }

    // course request
    public function courseRequest()
    {
        return view('student.courseRequest.courseRequest');
    }

    // request course

    public function requestCourse(Request $request)
    {

        $validator = $this->requestCourseValidation($request);

        if ($validator->fails()) {

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'student_id' => auth()->user()->id,
            'course_request_title' => $request->course_request_title,
            'course_request_details' => $request->course_request_details,
        ];

        CourseRequest::create($data);

        return back()->with(['createSuccess' => 'Course Request Success!']);
    }

    private function requestCourseValidation($request)
    {

        $validator = Validator::make($request->all(), [
            'course_request_title' => 'required',
            'course_request_details' => 'required',

        ]);

        return $validator;

    }
}
