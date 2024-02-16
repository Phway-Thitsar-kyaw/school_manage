<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\ClassStudent;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){

    }

    //teacher List
    public function teacherList(){

        //teacher list
        //their student
        //teacher info

        $teacher = ClassStudent::select('users.*',\DB::raw('COUNT(class_students.teacher_id) as student_count'))
                 ->join('users','users.id','class_students.teacher_id')
                 ->groupBy('class_students.teacher_id')
                 ->get();

        return view('admin.teacher.List')->with(['teacher' =>$teacher]);
    }

    //look teacher details
    public function lookTeacherDetails($teacher_id){

        $teacher = User::where('id',$teacher_id)
                 ->get();

        return view('admin.teacher.detail')->with(['teacher' => $teacher ]);
    }

    //download Teacher CSV
    public function downloadTeacherCSV(){

        $teacher = ClassStudent::select('users.*',\DB::raw('COUNT(class_students.teacher_id) as student_count'))
        ->join('users','users.id','class_students.teacher_id')
        ->groupBy('class_students.teacher_id')
        ->get();

        $csvExporter = new \Laracsv\Export();

        $csvExporter->build($teacher, [

            'id'=> 'No',
            'name' => 'Teacher Name',
            'email' => 'email',
            'gender' => 'Gender',
            'phone_number_one' => 'Phone Number',
            'student_count' => 'Student Count'

        ]);

        $csvReader = $csvExporter->getReader();

        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'teacher_List.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');

    }

    //student List
    public function studentList(){

        $student = User::where('role','student')
                  ->orderBy('created_at','desc')
                  ->get();
        return view('admin.student.List')->with(['student' => $student]);
    }

    //download student CSV
    public function downloadStudentCSV(){

        $student = User::where('role','student')
        ->orderBy('created_at','desc')
        ->get();

        $csvExporter = new \Laracsv\Export();

        $csvExporter->build($student, [

            'id'=> 'No',
            'name' => 'Name',
            'email' => 'email',
            'gender' => 'Gender',
            'phone_number_one' => 'Phone Number'

        ]);

        $csvReader = $csvExporter->getReader();

        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'student_List.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');

    }

    // send notification
    public function sendNotification(){
        return view('admin.notification.sendNotification');
    }

    //send Noti
    public function sendNoti(Request $request){

        $user_id = auth()->user()->id;
        $sender_name = auth()->user()->name;

        $data = [
            'user_id' => $user_id,
            'sender' => $sender_name,
            'message' => $request->message,
            'send_date' => Carbon::now()
        ];

        Notification::create($data);

        return back()->with(['success' => 'Notification is sent!']);

    }

    //create admin account
    public function createAdminAccount(Request $request){
        $validator = $this->checkCreateAdminValidation($request);

        if($validator->fails()){

            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $data = [
            'name' => $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'phone_number_one' => $request->phone_number_one,
            'phone_number_two' => $request->phone_number_two,
            'region' => $request->region,
            'town' => $request->town,
            'address' => $request->address,
            'status' => 0,
            'role' => 'admin'
        ];

        User::create($data);

        return back()->with(['createSuccess' => 'Admin Created Successful!']);

    }

    //add admin
    public function addAdmin(){
        return view('admin.addAdmin.Admin');
    }

    private function checkCreateAdminValidation($request){
        $validator = Validator::make($request->all(),[

            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'gender'=>'required',
            'date_of_birth'=>'required',
            'phone_number_one'=>'required',
            'phone_number_two'=>'required',
            'region'=>'required',
            'town'=>'required',
            'address'=>'required',
        ]);
        return $validator;
    }

// admin account list
public function adminAccountList(){

    $admin = User::where('role','admin')
           ->orderBy('created_at','desc')
           ->get();

    return view('admin.addAdmin.list')->with(['admin' => $admin]);
}

//delete admin account

public function deleteAdminAccount($admin_id){

    User::where('id',$admin_id)->delete();

    return back()->with('deleteSuccess','Delete Success');
}

}
