<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class UserCodeService
{
    /**
     * Generate a unique public user code for the given role.
     */
    public function generateForRole(?int $roleId, ?User $user = null): string
    {
        $prefix = $this->resolvePrefix($roleId);
        $year = now()->format('y');

        return DB::transaction(function () use ($prefix, $year): string {
            for ($attempt = 0; $attempt < 20; $attempt++) {
                $latestNumber = User::query()
                    ->where('user_code', 'like', $year . '-' . $prefix . '-%')
                    ->get()
                    ->map(function (User $record): int {
                        preg_match('/^(\d{2})-([A-Z]{2})-(\d{4})$/', (string) $record->user_code, $matches);

                        return $matches ? (int) $matches[3] : 0;
                    })
                    ->max() ?? 0;

                $candidate = sprintf('%s-%s-%04d', $year, $prefix, $latestNumber + 1);

                if (! User::query()->where('user_code', $candidate)->exists()) {
                    return $candidate;
                }
            }

            throw new RuntimeException('Unable to generate a unique user code.');
        });
    }

    /**
     * Resolve the public prefix from the selected role.
     */
    public function resolvePrefix(?int $roleId): string
    {
        return match ((int) ($roleId ?? 3)) {
            1 => 'AD',
            2 => 'FC',
            3 => 'LN',
            default => 'LN',
        };
    }
}
