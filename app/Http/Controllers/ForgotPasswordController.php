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

        //get customer based on username
        $customer = Customer::where('username', $request->username)->first();
        if (!$customer) {
            return back()->with('error', 'მომხმარებელი ვერ მოიძებნა');
        }
        $token = Str::random(64);

        DB::table('customers_reset_passwords')->updateOrInsert(
            [
                'username' => $request->username,
            ],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        try {

            Mail::to($customer->email)->send(new ForgetPasswordMail($token));
        } catch (Throwable $e) {

            return back()->with('error', 'დაფიქსირდა შეცდომა, გთხოვთ სცადოთ ახლიდან');
            report($e);
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
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:customers,username',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('customers_reset_passwords')
            ->where([
                'username' => $request->username,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'პაროლის აღდგენის ლინკს არავალიდურია, გთხოვთ ახლიდან სცადოთ პაროლის აღდგენა');
        }
        //check if token expired
        if (tokenExpired($updatePassword->created_at, 120)) {
            $updatePassword->delete();

            return back()->with('error', 'პაროლის აღდგენის ლინკს არავალიდურია, გთხოვთ ახლიდან სცადოთ პაროლის აღდგენა');
        }


        $customer = Customer::where('username', $request->username)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('customers_reset_passwords')->where(['username' => $request->username])->delete();

        return redirect('/login')->with('success', 'პაროლი წარმატებით შეიცვალა, გთხოვთ გაიაროთ ავტორიზაცია');
    }
}
