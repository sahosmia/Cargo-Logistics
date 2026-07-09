<?php

namespace App\Enums;

enum BookingStatus: string
{
    case Pending = 'pending';
    case ReceivedInChina = 'received_in_china';
    case InTransit = 'in_transit';
    case ArrivedInBD = 'arrived_in_bd';
    case CustomsCleared = 'customs_cleared';
    case ReadyForDelivery = 'ready_for_delivery';
    case Delivered = 'delivered';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending / Requested',
            self::ReceivedInChina => 'Received in China',
            self::InTransit => 'In Transit (Ship/Air)',
            self::ArrivedInBD => 'Arrived in BD',
            self::CustomsCleared => 'Customs Cleared',
            self::ReadyForDelivery => 'Ready for Delivery',
            self::Delivered => 'Delivered',
            self::Cancelled => 'Cancelled',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get the next allowed statuses based on linear lifecycle.
     */
    public function nextStatuses(): array
    {
        return match ($this) {
            self::Pending => [self::ReceivedInChina, self::Cancelled],
            self::ReceivedInChina => [self::InTransit, self::Cancelled],
            self::InTransit => [self::ArrivedInBD, self::Cancelled],
            self::ArrivedInBD => [self::CustomsCleared],
            self::CustomsCleared => [self::ReadyForDelivery],
            self::ReadyForDelivery => [self::Delivered],
            self::Delivered => [],
            self::Cancelled => [],
        };
    }
}
