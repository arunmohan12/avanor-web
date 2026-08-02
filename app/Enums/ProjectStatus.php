<?php



namespace App\Enums;

enum ProjectStatus: string
{
    case OFF_PLAN = 'Off Plan';
    case READY = 'Ready';

    public function label(): string
    {
        return $this->value;
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $status) => [
                $status->value => $status->label(),
            ])
            ->toArray();
    }
}