<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\Page;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgetPasswordMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\ExternalUser;

class ForgotPasswordController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showForgetPasswordForm()
    {
        $page = Page::where('slug', '/login')->firstOrFail();
        return view('front.forgetPassword', compact('page'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'username' => 'required|max:20|min:5',
        ]);

        // მოძებნე მომხმარებელი ორივე ცხრილში
        $customer = Customer::where('username', $request->username)->first();
        $external = ExternalUser::where('username', $request->username)->first();

        if (!$customer && !$external) {
            return back()->with('error', 'მომხმარებელი ვერ მოიძებნა');
        }

        // აირჩიე რომელის ტოკენს ვქმნით და რომელ ცხრილში ვწერთ
        $token = Str::random(64);

        if ($customer) {
            DB::table('customers_reset_passwords')->updateOrInsert(
                ['username' => $customer->username],
                ['token' => $token, 'created_at' => now()]
            );

            try {
                Mail::to($customer->email)->send(new ForgetPasswordMail($token, 'customer'));
            } catch (Throwable $e) {
                report($e);
                return back()->with('error', 'დაფიქსირდა შეცდომა, გთხოვთ სცადოთ ახლიდან');
            }
        } else {
            DB::table('external_users_reset_passwords')->updateOrInsert(
                ['username' => $external->username],
                ['token' => $token, 'created_at' => now()]
            );

            try {
                Mail::to($external->email)->send(new ForgetPasswordMail($token, 'external'));
            } catch (Throwable $e) {
                report($e);
                return back()->with('error', 'დაფიქსირდა შეცდომა, გთხოვთ სცადოთ ახლიდან');
            }
        }

        return back()->with('success', 'პაროლის აღსადგენი ლინკი გამოგზავნილია ელექტრონულ ფოსტაზე.');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm($token)
    {
        $page = Page::where('slug', '/login')->firstOrFail();

        return view('front.forgetPasswordLink', ['token' => $token, 'page' => $page]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
//    public function submitResetPasswordForm(Request $request)
//    {
//        $request->validate([
//            'username' => 'required|exists:customers,username',
//            'password' => 'required|string|min:6|confirmed',
//            'password_confirmation' => 'required'
//        ]);
//
//        $updatePassword = DB::table('customers_reset_passwords')
//            ->where([
//                'username' => $request->username,
//                'token' => $request->token
//            ])
//            ->first();
//
//        if (!$updatePassword) {
//            return back()->withInput()->with('error', 'პაროლის აღდგენის ლინკს არავალიდურია, გთხოვთ ახლიდან სცადოთ პაროლის აღდგენა');
//        }
//        //check if token expired
//        if (tokenExpired($updatePassword->created_at, 120)) {
//            $updatePassword->delete();
//
//            return back()->with('error', 'პაროლის აღდგენის ლინკს არავალიდურია, გთხოვთ ახლიდან სცადოთ პაროლის აღდგენა');
//        }
//
//
//        $customer = Customer::where('username', $request->username)
//            ->update(['password' => Hash::make($request->password)]);
//
//        DB::table('customers_reset_passwords')->where(['username' => $request->username])->delete();
//
//        return redirect(route('front.login'))->with('success', 'პაროლი წარმატებით შეიცვალა, გთხოვთ გაიაროთ ავტორიზაცია');
//    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'type' => 'required|in:customer,external',
            'token' => 'required'
        ]);

        $table = $request->type === 'external'
            ? 'external_users_reset_passwords'
            : 'customers_reset_passwords';

        $userModel = $request->type === 'external'
            ? ExternalUser::class
            : Customer::class;

        $updatePassword = DB::table($table)
            ->where([
                'username' => $request->username,
                'token' => $request->token,
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'პაროლის აღდგენის ლინკი არავალიდურია, გთხოვთ სცადოთ თავიდან.');
        }

        // Expiration check — 120 წუთი
        if (tokenExpired($updatePassword->created_at, 120)) {
            DB::table($table)->where('username', $request->username)->delete();

            return back()->with('error', 'პაროლის აღდგენის ლინკი ვადაგასულია, სცადეთ თავიდან.');
        }

        $userModel::where('username', $request->username)
            ->update(['password' => Hash::make($request->password)]);

        DB::table($table)->where(['username' => $request->username])->delete();

        return redirect(route('front.login'))->with('success', 'პაროლი წარმატებით შეიცვალა.');
    }



    //register
//    public function Register(Request $request)
//    {
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|unique:external_users',
//            'username' => 'required|string|unique:external_users',
//            'password' => 'required|string|min:6|confirmed',
//        ]);
//
//        $user = ExternalUser::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'username' => $request->username,
//            'password' => bcrypt($request->password),
//        ]);
//
//        Auth::guard('external')->login($user);
//
//        return redirect()->route('external.dashboard');
//    }

}
