<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceOrder;
use App\Models\Equipment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. KPI Cards Data
        $totalServiceOrders = ServiceOrder::count();
        $pendingServiceOrders = ServiceOrder::where('status', 'pending')->count();
        $totalEquipments = Equipment::count();
        $overdueMaintenances = Equipment::where('last_maintenance_date', '<=', Carbon::now()->subMonths(6))->count(); // Exemplo: Atrasado se não houver manutenção há mais de 6 meses

        // 2. Chart Data: Service Orders by Status
        $serviceOrderStatus = ServiceOrder::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')->all();

        // 3. Chart Data: New Service Orders (Last 30 Days)
        $newServiceOrders = ServiceOrder::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $newServiceOrdersData = [];
        $newServiceOrdersLabels = [];
        foreach ($newServiceOrders as $order) {
            $newServiceOrdersLabels[] = Carbon::parse($order->date)->format('d/m');
            $newServiceOrdersData[] = $order->count;
        }

        return view('dashboard', [
            'totalServiceOrders' => $totalServiceOrders,
            'pendingServiceOrders' => $pendingServiceOrders,
            'totalEquipments' => $totalEquipments,
            'overdueMaintenances' => $overdueMaintenances,
            'serviceOrderStatusData' => json_encode(array_values($serviceOrderStatus)),
            'serviceOrderStatusLabels' => json_encode(array_keys($serviceOrderStatus)),
            'newServiceOrdersData' => json_encode($newServiceOrdersData),
            'newServiceOrdersLabels' => json_encode($newServiceOrdersLabels),
        ]);
    }
}
