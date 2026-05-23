<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use App\Models\Colocation;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    // الحل هنا: حيدنا كلمة 'static'
    protected ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        // ... (باقي الكود ديالك كيبقى هو هو)
        $transactionsDuJour = Transaction::whereDate('created_at', Carbon::today())->count();
        $transactionsDuMois = Transaction::whereMonth('created_at', Carbon::now()->month)->count();
        
        $utilisateursActifs = Transaction::whereDate('created_at', Carbon::today())
            ->pluck('payer_id')
            ->unique()
            ->count();

        return [
            Stat::make('Transactions (Aujourd\'hui)', $transactionsDuJour)
                ->description('Nombre d\'opérations effectuées ce jour')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),

            Stat::make('Transactions (Ce mois)', $transactionsDuMois)
                ->description('Total des opérations du mois en cours')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Utilisateurs actifs', $utilisateursActifs)
                ->description('Membres ayant effectué une transaction aujourd\'hui')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('warning'),

            Stat::make('Total Colocations', Colocation::count())
                ->description('Nombre total d\'espaces créés')
                ->descriptionIcon('heroicon-m-home-modern')
                ->color('primary'),
        ];
    }
}