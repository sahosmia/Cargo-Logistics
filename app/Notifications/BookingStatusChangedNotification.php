<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Mail\BookingStatusChangedMail;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingStatusChangedNotification extends Notification
{
    use Queueable;

    public function __construct(public Booking $booking) {}

    /**
     * Get the notification channels.
     */
    public function via($notifiable): array
    {
        $channels = [];
        if (! empty($notifiable->email)) {
            $channels[] = 'mail';
        }
        if (! empty($notifiable->phone_number)) {
            $channels[] = SmsChannel::class;
        }

        return $channels;
    }

    /**
     * Send email via BookingStatusChangedMail.
     */
    public function toMail($notifiable)
    {
        return (new BookingStatusChangedMail($this->booking))
            ->to($notifiable->email);
    }

    /**
     * Get the SMS representation of the notification.
     */
    public function toSms($notifiable): string
    {
        $identifier = $this->booking->shipping_mark ?: '#'.$this->booking->id;

        $statusEnum = \App\Enums\BookingStatus::tryFrom($this->booking->status);
        $statusLabel = $statusEnum ? $statusEnum->label() : ucfirst(str_replace('_', ' ', $this->booking->status));

        return "Dear {$notifiable->name}, the status of your cargo booking (Mark: {$identifier}) has been updated to '{$statusLabel}'. TechPickly Premium Logistics.";
    }
}
