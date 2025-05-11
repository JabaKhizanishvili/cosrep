<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ExternalUser;
use App\Models\Trainer;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Models\TrainingOrder;

class OrderController extends Controller
{
    //
//    public function index(Request $request)
//    {
//        $objects = Training::with(['trainer', 'category']);
//
//        if ($request->sort == 'customers') {
//            $objects->orderBy('customers_count', 'desc');
//        }
//        if ($request->sort == 'customers-') {
//            $objects->orderBy('customers_count', 'asc');
//        }
//
//        if ($request->sort == 'created_at') {
//            $objects->orderBy('created_at', 'desc');
//        }
//        if ($request->sort == 'created_at-') {
//            $objects->orderBy('created_at', 'asc');
//        }
//
//        if (!empty($request->trainer_id)) {
//            $objects->where('trainer_id', $request->trainer_id);
//        };
//
//        if (!empty($request->category_id)) {
//            $objects->where('category_id', $request->category_id);
//        };
//
//        if (!empty($request->keyword)) {
//            $objects->where('id', 'like', '%' . $request->keyword . '%')
//                ->orWhere('name', 'like', '%' . $request->keyword . '%');
//        };
//
//        $objects = $objects->orderBy('id', 'desc')->paginate(10);
//
//        $categories = Category::orderBy('name', 'asc')->get();
//        $trainers = Trainer::orderBy('id', 'desc')->get();
//
//        return view('admin.orders.index', compact('objects', 'categories', 'trainers'));
//    }


    public function index()
    {
        $query = TrainingOrder::with(['customer', 'training']);

        // Search functionality
        if (request()->has('keyword') && !empty(request('keyword'))) {
            $keyword = request('keyword');
            $query->where(function($q) use ($keyword) {
                $q->where('id_number', 'like', "%$keyword%")
                    ->orWhere('phone', 'like', "%$keyword%")
                    ->orWhereHas('customer', function($q) use ($keyword) {
                        $q->where('name', 'like', "%$keyword%")
                            ->orWhere('email', 'like', "%$keyword%")
                            ->orWhere('username', 'like', "%$keyword%");
                    });
            });
        }

        // Filter by status
        if (request()->has('status') && !empty(request('status'))) {
            $query->where('status', request('status'));
        }

        // Filter by type
        if (request()->has('type') && !empty(request('type'))) {
            $query->where('type', request('type'));
        }

        // Filter by training
        if (request()->has('training_id') && !empty(request('training_id'))) {
            $query->where('training_id', request('training_id'));
        }

        // Sorting
        $sort = request('sort', 'latest');
        switch ($sort) {
            case 'latest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'status_asc':
                $query->orderBy('status');
                break;
            case 'status_desc':
                $query->orderByDesc('status');
                break;
        }

        $orders = $query->paginate(20)->appends(request()->query());

        $trainings = Training::all();
        $statuses = TrainingOrder::getStatusOptions();
        $types = TrainingOrder::getTypeOptions();

        return view('admin.orders.index', compact('orders', 'trainings', 'statuses', 'types'));
    }

    public function edit(TrainingOrder $order)
    {
        $statuses = TrainingOrder::getStatusOptions();
        return view('admin.training_orders.edit', compact('order', 'statuses'));
    }

    public function update(Request $request, TrainingOrder $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,completed,rejected',
            'test' => 'nullable|numeric',
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order updated successfully');
    }

    public function destroy(TrainingOrder $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully');
    }

    public function massDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:training_orders,id',
        ]);

        TrainingOrder::whereIn('id', $request->ids)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Selected orders have been deleted successfully',
        ]);
    }
}
