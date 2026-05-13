<?php

declare(strict_types=1);

namespace App\Filament\Resources\BugReports\Pages;

use App\Filament\Resources\BugReports\BugReportResource;
use Filament\Resources\Pages\ManageRecords;

class ManageBugReports extends ManageRecords
{
    protected static string $resource = BugReportResource::class;
}
