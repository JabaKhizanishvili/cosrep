<?php
namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\ExternalUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Customer;

class ExternalAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();

    }

//    public function handleProviderCallback()
//    {
//        try {
//            $socialUser = Socialite::driver('google')->user();
//
//            // მოძებნა ან შექმნა მომხმარებლის
//            $externalUser = ExternalUser::firstOrCreate(
//                ['email' => $socialUser->getEmail()],
//                [
//                    'name' => $socialUser->getName(),
//                    'email' => $socialUser->getEmail(),
//                    'username' => Str::slug($socialUser->getNickname() ?? $socialUser->getName()) . rand(100, 999),
//                    'password' => bcrypt(Str::random(16)),
//                ]
//            );
//
//            // პირდაპირი ლოგინი (არა attempt)
//            Auth::guard('external')->login($externalUser);
//
//            return redirect()->route('front.dashboard');
//
//        } catch (\Exception $e) {
//            Log::error('Socialite authentication failed: ' . $e->getMessage());
//            return redirect()->route('login')->withErrors([
//                'socialite' => 'სოციალური ავთენტიფიკაცია ვერ მოხერხდა. გთხოვთ სცადოთ თავიდან.'
//            ]);
//        }
//    }
//
//    public function callback()
//    {
//        try {
//            // Get the user information from Google
//            $user = Socialite::driver('google')->user();
//        } catch (Throwable $e) {
//            return redirect('/')->with('error', 'Google authentication failed.');
//        }
//
//        // Check if the user already exists in the database
//        $existingUser = ExternalUser::where('email', $user->email)->first();
//
//        if ($existingUser) {
//            Auth::guard('external')->login($existingUser);
//        } else {
//            $newUser = ExternalUser::updateOrCreate([
//                'email' => $user->email
//            ], [
//                'name' => $user->name,
//                'password' => bcrypt(Str::random(16)),
//            ]);
//
//            Auth::guard('external')->login($newUser); // ← აქაც შეცდომა გქონდა: $existingUser-ს ლოგინავდი, არა ახალს
//        }
//
//
//        // Redirect the user to the dashboard or any other secure page
//        return redirect()->route('front.dashboard');
//    }

    public function handleProviderCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();

            // ჯერ ვამოწმებთ customers ცხრილში
            $customer = Customer::where('email', $socialUser->getEmail())->first();

            if ($customer) {
                Auth::guard('customer')->login($customer);
            } else {
                // თუ customers-ში არ არის, მაშინ external_users-ში ვამოწმებთ/ვქმნით
                $externalUser = ExternalUser::firstOrCreate(
                    ['email' => $socialUser->getEmail()],
                    [
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->getEmail(),
                        'username' => Str::slug($socialUser->getNickname() ?? $socialUser->getName()) . rand(100, 999),
                        'password' => bcrypt(Str::random(16)),
                    ]
                );

                Auth::guard('external')->login($externalUser);
            }

            return redirect()->route('front.dashboard');

        } catch (\Exception $e) {
            Log::error('Google authentication failed: ' . $e->getMessage());
            return redirect()->route('login')->withErrors([
                'socialite' => 'Google ავთენტიფიკაცია ვერ მოხერხდა. გთხოვთ სცადოთ თავიდან.'
            ]);
        }
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();

            // ჯერ customers ცხრილში ვეძებთ
            $customer = Customer::where('email', $user->email)->first();

            if ($customer) {
                Auth::guard('customer')->login($customer);
            } else {
                // თუ არ არის customers-ში, მაშინ external_users-ში
//                $externalUser = ExternalUser::updateOrCreate(
//                    ['email' => $user->email],
//                    [
//                        'name' => $user->name,
//                        'password' => bcrypt(Str::random(16)),
//                    ]
//                );
                $externalUser = ExternalUser::firstOrCreate(
                    ['email' => $user->email],
                    [
                        'name' => $user->name,
                        'password' => bcrypt(Str::random(16)),
                    ]
                );

                Auth::guard('external')->login($externalUser);
            }

            return redirect()->route('front.dashboard');

        } catch (Throwable $e) {
            return redirect('/')->with('error', 'Google authentication failed.');
        }
    }


}
