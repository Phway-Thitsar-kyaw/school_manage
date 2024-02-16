<?php

namespace App\Http\Controllers\Teacher;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Classes;
use App\Models\ClassStudent;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\CourseRequest;
use App\Mail\TeacherResponseMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TeacherController extends Controller
{
    public function courseInfo(){
        return view('teacher.course.courseInfo');
    }

     // Create courses

     public function createCourse(Request $request){

        $data = $this->getCourseData($request,"create");

        Course::create($data);
        return back()->with(['courseSuccess' => 'Course create success!']);

    }

    public function courseList(){

        $id = auth()->user()->id;

        $courseData = Course::where ('user_id', $id)->orderBy('created_at','desc')->get();

        return view('teacher.course.courseList')->with( ['course'=> $courseData ]);
    }


    public function deleteCourse($course_id){

        Course::where('course_id',$course_id)->delete();

        return back()->with(['deleteSuccess' => 'Course Deleted!'] );

    }

    // update course Page
    public function updatePage( $course_id ){

        $courseData = Course::where('course_id', $course_id)->get();

        return view('teacher.course.updateCourse')->with( [ 'courseData' => $courseData ]);

    }

    //update Course
    public function courseUpdate( $course_id , Request $request ){

        $courseData = $this->getCourseData($request, "update");

        Course::where('course_id', $course_id)->update($courseData);

        $courseData = Course::get();

        return back()->with( [ 'updateSuccess' => 'Course update Success!' ] );
    }


    public function classInfo(){

        $id = auth()->user()->id;

        $course = Course::where('user_id',$id)->get();

        return view('teacher.class.classInfo')->with([ 'course'=> $course ]);
    }

    //Create Class

    public function createClass(Request $request){

        $classData = $this->getClassData($request);

        Classes::create($classData);
        return back()->with(['createClassSuccess' =>'Class Created!']);
    }

    public function classList(){

        $id = auth()->user()->id;

        $classData = Classes::select('classes.*','courses.*')

                    ->join('courses','courses.course_id','classes.course_id')
                    ->where('classes.user_id',$id)
                    ->orderBy('classes.created_at','desc')
                    ->get();

        return view('teacher.class.classList')->with(['classData'=>$classData]);
    }

    public function deleteClass($class_id){

        Classes::where('class_id', $class_id)->delete();

        return back()->with(['deleteSuccess' => 'Class Deleted!']);
    }

    //update class Page
    public function updateClassPage($class_id){

        $data = Classes::where('class_id', $class_id)->get();

        return view('teacher.class.updateClass')->with(['class'=>$data]);

    }

    //update Class
    public function updateClass( $class_id, Request $request){

        $classData = $this->getClassData($request);

        Classes::where('class_id', $class_id )->update($classData);

        return back()->with(['updateSuccess' => "Class Updated!"]);
    }


    public function classStudentInfo(){

        $id = auth()->user()->id;
        $classStudent = ClassStudent::select('users.name','classes.class_name','class_students.*','courses.course_title')
                        ->orderBy('class_students.created_at','desc')
                        ->join('users','users.id','class_students.student_id')
                        ->join('classes','classes.class_id','class_students.class_id')
                        ->join('courses','classes.course_id','courses.course_id')
                        ->where('teacher_id',$id)
                        ->get();

        return view('teacher.classStudent.classStudentInfo')->with(['classStudent'=>$classStudent ]);
    }

    //change status

    public function changeStatus($class_student_id,$status){

        // 2 accept
        // 3 full student
        // 4 reject

        $data = [
            'status' => $status
        ];

        $email = ClassStudent::join('users', 'users.id','class_students.student_id')
                ->where('class_students.class_student_id',$class_student_id)
                ->select('users.email')
                ->get();

        // dd($email[0]['email']);

        $mail = [];

        if($status != 5 ){

            if($status == 2)
        {
            $mail['message'] = ' Teacher accept this class ';
        }elseif($status == 3){
            $mail['message'] = ' Student full for this class';
        }else{
            $mail['message'] = ' Teacher reject for this class';
        }

        }

        $mail['email'] = $email[0]['email'];

        // Mail::to($email[0]['email'])->send(new TeacherResponseMail($mail));

        ClassStudent::where('class_student_id',$class_student_id)->update($data);

        return back()->with(['changeStatusSuccess' => 'Change Status Success!']);
    }

    public function profileInfo(){

        $id = auth()->user()->id;
        $teacherInfo = User::where('id',$id)->get();

        return view('teacher.profile.profileInfo')->with(['teacherInfo'=>$teacherInfo]);
    }

    // update Profile
    public function updateProfile($user_id, Request $request){

        $userData = $this->getUserProfileData($request);

        User::where('id',$user_id)->update($userData);

        return back()->with(['updateSuccess'=>'Updated Success']);

    }

    //change password

    public function changePasswordForm(){

        return view('teacher.profile.changePassword');
    }

    // change password
    public function changePassword( Request $request ){

        $user_password = auth()->user()->password;

        if (Hash::check($request->old_password, $user_password)) {

            if(strlen($request->new_password) >= 8 && strlen($request->confirm_password >= 8)){

                if($request->new_password == $request->confirm_password){

                    $data = [

                       'password' =>  Hash::make($request->confirm_password)

                    ];

                    $id = auth()->user()->id;

                    User::where('id',$id)->update($data);

                    return back()->with('success','Change Password Success');
                }
                else{

                    return back()->with('notSameBoth','New Password and Confirm Password not match.Try Again!');
                }

            }else{
                return back()->with('errorLength','New Password and Confirm Password Greather than 8');
            }
        }
        else{

            return back()->with('not Match','Old Password do not match!. Try Again');
        }

    }

    public function courseRequestList(){

        $news = CourseRequest::join('users','course_requests.student_id','users.id')
                ->orderBy('course_requests.created_at','desc')
                ->select('course_requests.*','users.name')
                ->paginate(7);

        return view('teacher.news.newsInfo')->with(['news' => $news]);
    }

    public function notificationInfo(){

        $notification = Notification::orderBy('created_at','desc')
                      ->paginate('10');

        return view('teacher.notification.notificationInfo')->with(['notification' => $notification]);
    }

     // get course data from client
     private function getCourseData($request, $status ){

        if( $status == "create" ){

                $response = [
                    'user_id' => auth()->user()->id,
                    'course_title' => $request->course_title,
                    'course_explanation' => $request->course_explanation,
                    'course_details' => $request->course_details,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

            }else if($status == "update" ){

                $response = [
                    'course_title' => $request->course_title,
                    'course_explanation' => $request->course_explanation,
                    'course_details' => $request->course_details,
                    'updated_at' => Carbon::now()
                ];
        }

            return $response;

    }

     //get Class Data

     private function getClassData($request){

        $data = [];

        if(isset($request->course_id)){
            $data['course_id'] = $request->course_id;
        }
        if(isset($request->class_name)){
            $data['class_name'] = $request->class_name;
        }
        if(isset($request->fee)){
            $data['fee'] = $request->fee;
        }
        if(isset($request->start_time)){
            $data['start_time'] = $request->start_time;
        }
        if(isset($request->end_time)){
            $data['end_time'] = $request->end_time;
        }
        if(isset($request->start_date)){
            $data['start_date'] = $request->start_date;
        }
        if(isset($request->end_date)){
            $data['end_date'] = $request->end_date;
        }
        if(isset($request->class_type)){
            $data['class_type'] = $request->class_type;
        }
        if(isset($request->monday)){
            $data['monday'] = 1;
        }else{
            $data['monday'] = 0;
        }
        if(isset($request->tueday)){
            $data['tueday'] = 1;
        }else{
            $data['tueday'] = 0;
        }
        if(isset($request->wednesday)){
            $data['wednesday'] = 1;
        }else{
            $data['wednesday'] = 0;
        }
        if(isset($request->thursday)){
            $data['thursday'] =1;
        }else{
            $data['thursday'] = 0;
        }
        if(isset($request->friday)){
            $data['friday'] = 1;
        }else{
            $data['friday'] = 0;
        }
        if(isset($request->saturday)){
            $data['saturday'] = 1;
        }else{
            $data['saturday'] = 0;
        }
        if(isset($request->sunday)){
            $data['sunday'] = 1;
        }else{
            $data['sunday'] = 0;
        }

        $data['user_id'] = auth()->user()->id;

        return $data;
    }


    // get user profile data
    private function getUserProfileData($request){

        $data = [

            'name'=>$request->name,
            'email'=>$request->email,
            'date_of_birth'=>$request->date_of_birth,
            'gender'=>$request->gender,
            'phone_number_one'=>$request->phone_number_one,
            'phone_number_two'=>$request->phone_number_two,
            'region'=>$request->region,
            'town'=>$request->town,
            'address'=>$request->address,

        ];

        return $data;

    }

}

