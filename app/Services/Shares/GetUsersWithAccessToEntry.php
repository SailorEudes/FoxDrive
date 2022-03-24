<?php

namespace App\Services\Shares;

use App\FileEntry;
use App\User;
use Illuminate\Database\Eloquent\Collection;

class GetUsersWithAccessToEntry
{
    /**
     * @var FileEntry
     */
    private $entry;

    /**
     * @param FileEntry $entry
     */
    public function __construct(FileEntry $entry)
    {
        $this->entry = $entry;
    }

    /**
     * @param int $entryId
     * @return Collection|User[]
     */
    public function execute($entryId)
    {
        return $this->entry->with('users')->find($entryId)->users;
    }
}
