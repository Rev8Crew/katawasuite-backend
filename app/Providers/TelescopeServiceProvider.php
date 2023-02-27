<?php

namespace App\Providers;

use App\Models\Common\EntryContentDto;
use Illuminate\Support\Facades\Gate;
use Laravel\Telescope\EntryType;
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeApplicationServiceProvider;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class TelescopeServiceProvider extends TelescopeApplicationServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Telescope::night();

        $this->hideSensitiveRequestDetails();

        Telescope::filter(function (IncomingEntry $entry) {
            if ($this->app->environment('local')) {
                return true;
            }

            $entryDto = new EntryContentDto($entry);

            return true;
//            return $entry->isReportableException() ||
//                $entry->isFailedRequest() ||
//                $entry->isFailedJob() ||
//                $entry->isScheduledTask() ||
//                $entry->hasMonitoredTag() ||
//                $entry->isQuery() ||
//                $entry->isClientRequest() ||
//                $entry->isRequest() ||
//                $entryDto->isSlowRequest() ||
//                $entry->type === EntryType::LOG;
        });

        Telescope::tag(static function (IncomingEntry $entry) {
            $entryDto = new EntryContentDto($entry);

            return $entryDto->isErrorRequest(SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR)
                ? ['status:'.$entryDto->responseStatus]
                : [];
        });
    }

    /**
     * Prevent sensitive request details from being logged by Telescope.
     */
    protected function hideSensitiveRequestDetails(): void
    {
        if ($this->app->environment('local')) {
            return;
        }

        Telescope::hideRequestParameters(['_token']);

        Telescope::hideRequestHeaders([
            'cookie',
            'x-csrf-token',
            'x-xsrf-token',
        ]);
    }

    /**
     * Register the Telescope gate.
     *
     * This gate determines who can access Telescope in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewTelescope', function () {
            $user = \Auth::user();
            return in_array($user->email, config('telescope.admin_emails', []), true);
        });
    }
}
