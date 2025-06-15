<?php
namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class NewOrderNotification extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $user = DB::table('users')->where('id', $this->order->user_id)->first();

        return (new MailMessage)
            ->subject('New Order Placed')
            ->line('A new order has been placed by user ID: ' . $user->first_name . ' ' . $user->last_name)
            ->action('View Order', url(route('customer.order.view', $this->order->id)))
            ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Order #{$this->orderId} status changed to {$this->status}.",
            'url'     => route('admin.order.view', $this->orderId),
            'icon'    => $this->status == 'delivered' ? '✅' : '📦',
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
