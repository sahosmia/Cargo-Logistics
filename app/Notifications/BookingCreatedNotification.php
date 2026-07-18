<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Mail\BookingCreatedMail;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingCreatedNotification extends Notification
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
     * Send email via BookingCreatedMail.
     */
    public function toMail($notifiable)
    {
        return (new BookingCreatedMail($this->booking))
            ->to($notifiable->email);
    }

    /**
     * Get the SMS representation of the notification.
     */
    public function toSms($notifiable): string
    {
        $identifier = $this->booking->shipping_mark ?: '#'.$this->booking->id;
        $itemName = $this->booking->item_name;

        return "Dear {$notifiable->name}, your cargo booking (Mark: {$identifier}) for '{$itemName}' has been successfully created. TechPickly Premium Logistics.";
    }
}
