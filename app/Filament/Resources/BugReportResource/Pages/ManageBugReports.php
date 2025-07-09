<?php

declare(strict_types=1);

namespace App\Filament\Resources\BugReportResource\Pages;

use App\Filament\Resources\BugReportResource;
use Filament\Resources\Pages\ManageRecords;

class ManageBugReports extends ManageRecords
{
    protected static string $resource = BugReportResource::class;
}
