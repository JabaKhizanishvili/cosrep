<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guide;
use App\Models\Route;
use App\Models\Trainer;
use App\Models\Customer;
use App\Models\Training;

class DashboardController extends Controller
{
    public function index()
    {
        $number_of_trainings = Training::count();
        $number_of_customers = Customer::count();
        $number_of_trainers = Trainer::count();


        return view('admin.dashboard.index', [
            'number_of_trainings' => $number_of_trainings,
            'number_of_customers' => $number_of_customers,
            'number_of_trainers' => $number_of_trainers,
        ]);
    }
}
