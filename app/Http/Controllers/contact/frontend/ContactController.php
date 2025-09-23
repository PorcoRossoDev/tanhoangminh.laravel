<?php

namespace App\Http\Controllers\contact\frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use App\Components\System;
use App\Rules\PhoneNumber;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    protected $system;
    public function __construct()
    {
        $this->system = new System();
    }
    public function index( Request $request )
    {
        //echo $request->query->count();die;
        //page: Contact

        $contacts = [1, 2, 3];

        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'contact'])->with('fields')->select('meta_title', 'meta_description', 'image', 'title', 'description', 'id')->first();
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('contact.frontend.index', compact('fcSystem', 'seo', 'page', 'contacts'));
    }
    public function store(Request $request)
    {
        // dùng Validator để tự trả JSON lỗi
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email'    => 'required|email',
            'phone'    => 'required|string|max:20',
            'phongban' => 'required|string|max:255',
            'ykien'    => 'required|string|max:255',
            //'message'  => 'required|string',
            'file'     => 'nullable|file|max:2048', // 2MB
        ],[
            'fullname.required' => 'Trường Họ và tên là trường bắt buộc.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'phongban.required' => 'Phòng ban là trường bắt buộc.',
            'ykien.required' => 'Ý kiến là trường bắt buộc.',
            'file.max' => 'Dung lượng file không được vượt quá 2MB.',
        ]);
        if ($validator->passes()) {
            $filePath = null;
            if ($request->hasFile('file')) {
                $file     = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Tạo thư mục nếu chưa có
                $destinationPath = base_path('upload/files/contact');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // Di chuyển file
                $file->move($destinationPath, $fileName);

                // Lưu đường dẫn vào DB
                $filePath = 'upload/files/contact/' . $fileName;
            }
            $contact = Contact::insertGetId([
                'fullname' => $request->fullname,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'phongban' => $request->phongban,
                'ykien'    => $request->ykien,
                'message'  => $request->message,
                'type'  => 'contact',
                'created_at' => Carbon::now(),
                'file'=> $filePath,
            ]);
            if ($contact > 0) {
                return response()->json(['status' => '200']);
            } else {
                return response()->json(['status' => '500']);
            }
        }
        
        return response()->json(['error' => $validator->errors()->all(), 'status' => '500']);
    }
    
    public function agency(Request $request)
    {
        if (config('app.locale') == 'vi') {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'address' => 'required',
                'phone' => ['required', new PhoneNumber],
            ], [
                'fullname.required' => 'Trường Họ và tên là trường bắt buộc.',
                'email.required' => 'Email là trường bắt buộc.',
                'email.email' => 'Email không đúng định dạng.',
                'address.required' => 'Địa chỉ là trường bắt buộc.',
                'phone.required' => 'Số điện thoại là trường bắt buộc.',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required',
            ]);
        }
        if ($validator->passes()) {
            $id = Contact::insertGetId([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'type' => 'agency',
                'created_at' => Carbon::now()
            ]);
            if ($id > 0) {
                return response()->json(['status' => '200']);
            } else {
                return response()->json(['status' => '500']);
            }
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }
    
    public function expertBook(Request $request)
    {
        if (config('app.locale') == 'vi') {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'phone' => ['required', new PhoneNumber],
                'birthday' => 'required',
                'email' => 'required|email',
                'gender' => 'required',
                'cityid' => 'required',
                'district' => 'required',
                'address' => 'required',
                'expert' => 'required',
                'location' => 'required',
                'date' => 'required',
                'message' => 'required',
            ], [
                'fullname.required' => 'Trường Họ và tên là trường bắt buộc.',
                'phone.required' => 'Số điện thoại là trường bắt buộc.',
                'birthday.required' => 'Ngày sinh là trường bắt buộc.',
                'email.required' => 'Email là trường bắt buộc.',
                'email.email' => 'Email không đúng định dạng.',
                'gender.required' => 'Giới tính là trường bắt buộc.',
                'cityid.required' => 'Tỉnh/Thành phố là trường bắt buộc.',
                'district.required' => 'Quận/Huyện phố là trường bắt buộc.',
                'address.required' => 'Địa chỉ là trường bắt buộc.',
                'expert.required' => 'Chuyên khoa là trường bắt buộc.',
                'location.required' => 'Địa chỉ khám là trường bắt buộc.',
                'date.required' => 'Ngày khám là trường bắt buộc.',
                'message.required' => 'Nội dung là trường bắt buộc.',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required',
            ]);
        }
        if ($validator->passes()) {
            $birthday = explode(' / ', $request->birthday);
            $date = explode(' / ', $request->date);
            $_data = [
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'birthday' => join('-', array_reverse($birthday, true)),
                'email' => $request->email,
                'gender' => $request->gender,
                'city' => $request->city_hidden,
                'district' => $request->district_hidden,
                'address' => $request->address,
                'expert_id' => $request->expert_id,
                'expert' => $request->expert,
                'expert_name' => $request->expert_name,
                'expert_json' => $request->expert_json,
                'location' => $request->location,
                'date' => join('-', array_reverse($date, true)),
                'time_booinkg' => $request->time_booinkg,
                'message' => $request->message,
                'type' => 'expert',
                'created_at' => Carbon::now()
            ];
            $id = Contact::insertGetId($_data);
            if ($id > 0) {
                return response()->json(['status' => '200']);
            } else {
                return response()->json(['status' => '500']);
            }
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }
    
    public function scheduleAnAppointment(Request $request)
    {
        if (config('app.locale') == 'vi') {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'phone' => ['required', new PhoneNumber],
                'birthday' => 'required',
                'email' => 'required|email',
                'gender' => 'required',
                'cityid' => 'required',
                'district' => 'required',
                'address' => 'required',
                'date' => 'required',
                'time_booinkg' => 'required',
                'message' => 'required',
            ], [
                'fullname.required' => 'Trường Họ và tên là trường bắt buộc.',
                'phone.required' => 'Số điện thoại là trường bắt buộc.',
                'birthday.required' => 'Ngày sinh là trường bắt buộc.',
                'email.required' => 'Email là trường bắt buộc.',
                'email.email' => 'Email không đúng định dạng.',
                'gender.required' => 'Giới tính là trường bắt buộc.',
                'cityid.required' => 'Tỉnh/Thành phố là trường bắt buộc.',
                'district.required' => 'Quận/Huyện phố là trường bắt buộc.',
                'address.required' => 'Địa chỉ là trường bắt buộc.',
                'date.required' => 'Ngày khám là trường bắt buộc.',
                'time_booinkg.required' => 'Ngày khám là trường bắt buộc.',
                'message.required' => 'Nội dung là trường bắt buộc.',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required',
            ]);
        }
        if ($validator->passes()) {
            $birthday = explode(' / ', $request->birthday);
            $date = explode(' / ', $request->date);
            $_data = [
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'birthday' => join('-', array_reverse($birthday, true)),
                'email' => $request->email,
                'gender' => $request->gender,
                'city' => $request->city_hidden,
                'district' => $request->district_hidden,
                'address' => $request->address,
                'expert_id' => $request->expert_id,
                'expert' => $request->expert,
                'expert_name' => $request->expert_name,
                'expert_json' => $request->expert_json,
                'location' => $request->location,
                'date' => join('-', array_reverse($date, true)),
                'time_booinkg' => $request->time_booinkg,
                'message' => $request->message,
                'type' => 'schedule_an_appointment',
                'created_at' => Carbon::now()
            ];
            $id = Contact::insertGetId($_data);
            if ($id > 0) {
                return response()->json(['status' => '200']);
            } else {
                return response()->json(['status' => '500']);
            }
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }
    
    public function scheduleSamplingStore(Request $request)
    {
        if (config('app.locale') == 'vi') {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'birthday' => 'required',
                'phone' => ['required', new PhoneNumber],
                'email' => 'required|email',
                'gender' => 'required',
                'type_of_test' => 'required',
                'sampling_date' => 'required',
                'sampling_time' => 'required',
                'cityid' => 'required',
                'district' => 'required',
                'address' => 'required',
                'message' => 'required',
            ], [
                'fullname.required' => 'Trường Họ và tên là trường bắt buộc.',
                'birthday.required' => 'Ngày sinh là trường bắt buộc.',
                'phone.required' => 'Số điện thoại là trường bắt buộc.',
                'email.required' => 'Email là trường bắt buộc.',
                'email.email' => 'Email không đúng định dạng.',
                'gender.required' => 'Giới tính là trường bắt buộc.',
                'type_of_test.required' => 'Loại xét nghiệm là trường bắt buộc.',
                'cityid.required' => 'Tỉnh/Thành phố là trường bắt buộc.',
                'district.required' => 'Quận/Huyện phố là trường bắt buộc.',
                'address.required' => 'Địa chỉ là trường bắt buộc.',
                'message.required' => 'Nội dung là trường bắt buộc.',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required',
            ]);
        }
        if ($validator->passes()) {
            $birthday = explode(' / ', $request->birthday);
            $sampling_date = explode(' / ', $request->sampling_date);
            $_data = [
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'birthday' => join('-', array_reverse($birthday, true)),
                'email' => $request->email,
                'gender' => $request->gender,
                'city' => $request->city_hidden,
                'district' => $request->district_hidden,
                'address' => $request->address,
                'sampling_date' => join('-', array_reverse($sampling_date, true)),
                'sampling_time' => $request->sampling_time,
                'type_of_test' => $request->type_of_test,
                'message' => $request->message,
                'type' => 'schedule_sampling',
                'created_at' => Carbon::now()
            ];
            $id = Contact::insertGetId($_data);
            if ($id > 0) {
                return response()->json(['status' => '200']);
            } else {
                return response()->json(['status' => '500']);
            }
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function popup(Request $request)
    {
        if (config('app.locale') == 'vi') {
            $validator = Validator::make($request->all(), [
                'company' => 'required',
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => ['required', new PhoneNumber],
                // 'message' => 'required',
            ], [
                'company.required' => 'Trường Công ty là trường bắt buộc.',
                'fullname.required' => 'Trường Họ và tên là trường bắt buộc.',
                'email.required' => 'Email là trường bắt buộc.',
                'email.email' => 'Email không đúng định dạng.',
                 'phone.required' => 'Số điện thoại là trường bắt buộc.',
                // 'phone.regex'        => 'Số điện thoại không hợp lệ.',
                // 'phone.numeric' => 'Số điện thoại không đúng định dạng.',
                // 'message.required' => 'Nội dung là trường bắt buộc.',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required',
            ]);
        }
        if ($validator->passes()) {
            $id = Contact::insertGetId([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'company' => $request->company,
                'phone' => $request->phone,
                // 'address' => $request->address,
                //'message' => $request->message,
                'type' => 'popup',
                'created_at' => Carbon::now()
            ]);
            if ($id > 0) {
                return response()->json(['status' => '200']);
            } else {
                return response()->json(['status' => '500']);
            }
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function subcribers(Request $request)
    {
        if (config('app.locale') == 'vi') {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => ['required', 'numeric', 'regex:/^(03|02|05|07|08|09|01[2|6|8|9])+([0-9]{8})$/'],
                'company' => 'required',
            ], [
                'fullname.required' => 'Trường Họ và tên là trường bắt buộc.',
                'email.required' => 'Email là trường bắt buộc.',
                'email.email' => 'Email không đúng định dạng.',
                'phone.required' => 'Số điện thoại không được để trống.',
                'phone.regex'        => 'Số điện thoại không hợp lệ.',
                'phone.numeric' => 'Số điện thoại không đúng định dạng.',
                'company.required' => 'Công ty là trường bắt buộc.',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'company' => 'required',
            ]);
        }
        if ($validator->passes()) {
            $id = Contact::insertGetId([
                'fullname' => $request->fullname,
                'address' => $request->company,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
                'type' => 'email',
                'created_at' => Carbon::now()
            ]);
            if ($id > 0) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 500]);
            }
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function agency_old(Request $request)
    {
        $fcSystem = $this->system->fcSystem();
        if (config('app.locale') == 'vi') {
            $validatorTitle = [
                'firstName.required' => $fcSystem['agency_7'] . ' là trường bắt buộc. ',
                'lastName.required' => $fcSystem['agency_8'] . ' là trường bắt buộc. ',
                'email.required' => 'Email là trường bắt buộc.',
                'email.email' => 'Email không đúng định dạng.',
                'company.required' => $fcSystem['agency_11'] . ' là trường bắt buộc.',
                'terms.required' => $fcSystem['agency_12'] . ' là trường bắt buộc.',
                'address1.required' => $fcSystem['agency_16'] . ' là trường bắt buộc.',
                'city.required' => $fcSystem['agency_18'] . ' là trường bắt buộc.',
                'code.required' => $fcSystem['agency_19'] . ' là trường bắt buộc.',
                'country.required' => $fcSystem['agency_20'] . ' là trường bắt buộc.',
                'accept.required' => $fcSystem['agency_22'] . ' là trường bắt buộc.',
            ];
        } else {
            $validatorTitle = [
                'firstName.required' => $fcSystem['agency_7'] . ' is a required field. ',
                'lastName.required' => $fcSystem['agency_8'] . ' is a required field. ',
                'email.required' => 'Email is a required field.',
                'email.email' => 'Email malformed.',
                'company.required' => $fcSystem['agency_11'] . ' is a required field.',
                'terms.required' => $fcSystem['agency_12'] . ' is a required field.',
                'address1.required' => $fcSystem['agency_16'] . ' is a required field.',
                'city.required' => $fcSystem['agency_18'] . ' is a required field.',
                'code.required' => $fcSystem['agency_19'] . ' is a required field.',
                'country.required' => $fcSystem['agency_20'] . ' is a required field.',
                'accept.required' => $fcSystem['agency_22'] . ' is a required field.',
            ];
        }
        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'company' => 'required',
            'terms' => 'required',
            'address1' => 'required',
            'city' => 'required',
            'code' => 'required',
            'country' => 'required',
            'accept' => 'required',
            // 'phone' => ['required', 'numeric', 'regex:/^(03|02|05|07|08|09|01[2|6|8|9])+([0-9]{8})$/'],
            // 'file' => 'required|mimes:pdf|max:2048',
        ], $validatorTitle);


        $message = '';
        $message .=  '<div>';
        $message .=  '<p><b>' . $fcSystem['agency_7'] . ':</b> ' . $request->firstName . '</p>';
        $message .=  '<p><b>' . $fcSystem['agency_8'] . ':</b> ' . $request->lastName . '</p>';
        $message .=  '<p><b>Email:</b> ' . $request->email . '</p>';
        $message .=  '<p><b>' . $fcSystem['agency_9'] . ':</b> ' . $request->account . '</p>';
        $message .=  '<p><b>' . $fcSystem['agency_10'] . ':</b> ' . $request->associated . '</p>';
        $message .=  '<p><b>' . $fcSystem['agency_11'] . ':</b> ' . $request->company . '</p>';
        $message .=  '<p><b>' . $fcSystem['agency_12'] . ':</b> ' . $request->terms . '</p>';
        $message .=  '<p><b>' . $fcSystem['agency_13'] . ':</b> ' . $request->apply . '</p>';
        $message .=  '<p><b>Website:</b> ' . $request->website  . '</p>';
        $message .=  '<p><b>' . $fcSystem['agency_15'] . ':</b> ' . $request->business . '</p>';
        $message .=  '<p><b>' . $fcSystem['agency_16'] . ':</b> ' . $request->address1 . '</p>';
        $message .=  '<p><b>' . $fcSystem['agency_17'] . ':</b> ' . $request->address2 . '</p>';
        $message .=  '<p><b>' . $fcSystem['agency_18'] . ':</b> ' . $request->city . '</p>';
        $message .=  '<p><b>' . $fcSystem['agency_19'] . ':</b> ' . $request->code . '</p>';
        $message .=  '<p><b>' . $fcSystem['agency_20'] . ':</b> ' . $request->country . '</p>';
        $message .=  '</div>';
        if ($validator->passes()) {
            $filePath = '';
            if (!empty($request->file)) {
                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            }
            $id = Contact::insertGetId([
                'fullname' => $request->firstName . $request->lastName,
                // 'phone' => $request->phone,
                'message' => $message,
                // 'address' => $request->title,
                'file' => !empty($filePath) ? 'storage/app/public/' . $filePath : '',
                'type' => 'register',
                'created_at' => Carbon::now()
            ]);
            if ($id > 0) {
                //gửi email
                $html = '<table width="100%" cellpadding="0" cellspacing="0" border="0" dir="ltr" align="center" style="background-color:#fff;font-size:16px">
                            <tbody>
                                <tr>
                                    <td align="left" valign="top" style="margin:0;padding:0">
                                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="720" bgcolor="#ffffff">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div style="border:2px solid #2f5acf;padding:8px 16px;border-radius:16px;margin-top:16px">
                                                            <p style="margin:10px 0 20px;font-weight:bold;font-size:20px">
                                                                Đăng kí đại lý
                                                                <span style="font-weight:normal">(' . Carbon::now() . ')</span>
                                                            </p>
                                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td valign="top">
                                                                            <p style="margin:10px 0;font-weight:bold">
                                                                                <b>Thông tin đăng kí</b>
                                                                            </p>' . $message . '
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>';
                $details = [
                    'subject' => "Đăng kí đại lý",
                    'message' => $html,
                ];
                configEmail();
                Mail::to('nguyenquyen571995@gmail.com')->send(new \App\Mail\SendMail($details));
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 500]);
            }
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }
}
