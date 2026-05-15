<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Vehiculo;
use App\Models\Vendedor;
use App\Models\Cliente;
use App\Models\Financiamiento;
use App\Models\Pago;

class DashboardController extends Controller
{
    public function index()
    {
        // ================= KPIs =================
        $ventasMes = Venta::whereMonth('created_at', now()->month)->count();

        $ingresosMes = Venta::whereMonth('created_at', now()->month)
            ->sum('precio_final');

        $vehiculosDisponibles = Vehiculo::where('estado', 'disponible')->count();

        $saldoPendiente = Financiamiento::sum('monto_financiado')
            - Pago::sum('monto');

        // ================= ALERTAS =================
        $vehiculosStockViejo = Vehiculo::where('estado', 'disponible')
            ->where('created_at', '<', now()->subDays(60))
            ->count();

        $financiamientosPendientes = Financiamiento::where('estado', 'pendiente')->count();

        // ================= TOP / ACTIVIDAD =================
        $topVendedores = Vendedor::withCount('ventas')
            ->orderByDesc('ventas_count')
            ->take(5)
            ->get();

        $ultimasVentas = Venta::latest()->take(5)->get();
        $ultimosVehiculos = Vehiculo::latest()->take(5)->get();

        return view('dashboard', compact(
            'ventasMes',
            'ingresosMes',
            'vehiculosDisponibles',
            'saldoPendiente',
            'vehiculosStockViejo',
            'financiamientosPendientes',
            'topVendedores',
            'ultimasVentas',
            'ultimosVehiculos'
        ));
    }
}