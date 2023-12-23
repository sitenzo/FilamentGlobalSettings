<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Support\Enums\FontFamily;
use Illuminate\Http\Request;
use Filament\Infolists;
use Filament\Forms;
use Symfony\Component\HttpFoundation\Response;use Filament\Tables;

class XFilamentPanelOptions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $LocalOptions = $this->getLocalOptions();

        /**
         * Configure default table and component options
         */
        Tables\Table::configureUsing(function (Tables\Table $table) use ($LocalOptions): void {
            Tables\Table::$defaultCurrency = $LocalOptions['defaultCurrency'];
            Tables\Table::$defaultDateDisplayFormat = $LocalOptions['defaultDateDisplayFormat'];
            Tables\Table::$defaultDateTimeDisplayFormat = $LocalOptions['defaultDateTimeDisplayFormat'];
            Tables\Table::$defaultTimeDisplayFormat = $LocalOptions['defaultTimeDisplayFormat'];

            $table
                ->striped()
                ->deferLoading()
                ->paginationPageOptions([25, 50, 100]);
        });


        /**
         * Configure default Infolist and components options
         */
        Infolists\Infolist::configureUsing(function (Infolists\Infolist $infolist) use ($LocalOptions): void {
            Infolists\Infolist::$defaultCurrency = $LocalOptions['defaultCurrency'];
            Infolists\Infolist::$defaultDateDisplayFormat = $LocalOptions['defaultDateDisplayFormat'];
            Infolists\Infolist::$defaultDateTimeDisplayFormat = $LocalOptions['defaultDateTimeDisplayFormat'];
            Infolists\Infolist::$defaultTimeDisplayFormat = $LocalOptions['defaultTimeDisplayFormat'];
        });

        Infolists\Components\TextEntry::configureUsing(function (Infolists\Components\TextEntry $entry): void {
            $entry
                ->fontFamily(FontFamily::Mono)
                ->default('-');
        });

        Infolists\Components\Section::configureUsing(function (Infolists\Components\Section $Section): void {
            $Section
                ->compact();
        });

        /**
         * Configure default Form and components options
         */
        Forms\Components\DateTimePicker::configureUsing(function (Forms\Components\DateTimePicker $DateTimePicker) use ($LocalOptions): void {
            Forms\Components\DateTimePicker::$defaultDateDisplayFormat = $LocalOptions['defaultDateDisplayFormat'];
            Forms\Components\DateTimePicker::$defaultDateTimeDisplayFormat = $LocalOptions['defaultDateDisplayFormat'];
            Forms\Components\DateTimePicker::$defaultDateTimeWithSecondsDisplayFormat = $LocalOptions['defaultDateTimeWithSecondsDisplayFormat'];
            Forms\Components\DateTimePicker::$defaultTimeDisplayFormat = $LocalOptions['defaultTimeDisplayFormat'];
            Forms\Components\DateTimePicker::$defaultTimeWithSecondsDisplayFormat = $LocalOptions['defaultTimeWithSecondsDisplayFormat'];
        });

        Forms\Components\Section::configureUsing(function (Forms\Components\Section $Section): void {
            $Section
                ->compact();
        });

        return $next($request);
    }

    private function getLocalOptions(): array
    {
        $currentLocale = app()->getLocale();

        $defaultOptions = [
            'defaultCurrency' => 'eur',
            'defaultDateTimeDisplayFormat' => 'M j, Y H:i',
            'defaultTimeDisplayFormat' => 'H:i',
            'defaultTimeWithSecondsDisplayFormat' => 'H:i:s',
            'defaultDateDisplayFormat' => 'M j, Y',
            'defaultDateTimeWithSecondsDisplayFormat' => 'M j, Y H:i:s',
        ];
        $nlLocaleOptions = [
            'defaultCurrency' => 'eur',
            'defaultDateTimeDisplayFormat' => 'j M Y H:i',
            'defaultTimeDisplayFormat' => 'H:i',
            'defaultTimeWithSecondsDisplayFormat' => 'H:i:s',
            'defaultDateDisplayFormat' => 'j M Y',
            'defaultDateTimeWithSecondsDisplayFormat' => 'j M Y H:i:s',
        ];

        return $currentLocale == 'nl' ? $nlLocaleOptions : $defaultOptions;
    }
}
