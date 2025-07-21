<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Analytics\AnalyticsClient;
use Illuminate\Support\Facades\Validator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('safe_string', function ($attribute, $value, $parameters, $validator) {
        // Reject if contains script tags or suspicious patterns
            return !preg_match('/(<script|<\/script|SELECT\s|INSERT\s|UPDATE\s|DELETE\s|DROP\s|--|#|\/\*|\*\/)/i', $value);
        }, 'Input contains unsafe characters or potential XSS/SQLi.');
    }
}
