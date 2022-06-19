<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords {
    protected static string $resource = PostResource::class;

    protected function isTablePaginationEnabled(): bool {
        return true;
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [15, 30, 100];
    }
}
