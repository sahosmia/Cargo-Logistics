<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Status Updated</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
        }
        .header {
            background-color: #262262;
            padding: 32px 24px;
            text-align: center;
            border-bottom: 3px solid #ED1C24;
        }
        .header h1 {
            color: #ffffff;
            font-size: 24px;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.5px;
        }
        .header p {
            color: #cbd5e1;
            font-size: 14px;
            margin: 8px 0 0 0;
            font-weight: 500;
        }
        .content {
            padding: 40px 32px;
        }
        .status-badge {
            display: inline-block;
            background-color: #ED1C24;
            color: #ffffff;
            font-weight: bold;
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 24px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 700;
            color: #171443;
            margin-top: 0;
            margin-bottom: 12px;
        }
        .message-body {
            font-size: 15px;
            line-height: 1.6;
            color: #475569;
            margin-bottom: 32px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 32px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }
        .details-table th, .details-table td {
            padding: 12px 16px;
            text-align: left;
            font-size: 14px;
        }
        .details-table th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 700;
            width: 35%;
            border-bottom: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
        }
        .details-table td {
            color: #1e293b;
            font-weight: 500;
            border-bottom: 1px solid #e2e8f0;
        }
        .details-table tr:last-child th, .details-table tr:last-child td {
            border-bottom: none;
        }
        .btn-container {
            text-align: center;
            margin-bottom: 32px;
        }
        .btn {
            display: inline-block;
            background-color: #262262;
            color: #ffffff !important;
            font-weight: bold;
            font-size: 14px;
            padding: 14px 28px;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        .btn:hover {
            background-color: #171443;
        }
        .footer {
            background-color: #f8fafc;
            padding: 24px 32px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }
        .footer p {
            font-size: 12px;
            color: #64748b;
            margin: 0 0 8px 0;
            line-height: 1.5;
        }
        .footer p:last-child {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div style="padding: 24px 0; background-color: #f8fafc;">
        <div class="container">
            <!-- Brand Header -->
            <div class="header">
                <h1>TechPickly Premium Logistics</h1>
                <p>Global Cargo Solutions: China to Bangladesh</p>
            </div>

            <!-- Content Area -->
            <div class="content">
                @php
                    $statusEnum = \App\Enums\BookingStatus::tryFrom($booking->status);
                    $statusLabel = $statusEnum ? $statusEnum->label() : ucfirst(str_replace('_', ' ', $booking->status));
                @endphp

                <div style="text-align: center;">
                    <span class="status-badge">{{ $statusLabel }}</span>
                </div>

                <h2 class="greeting">Hello {{ $booking->user->name }},</h2>
                <p class="message-body">
                    We wanted to let you know that the status of your cargo booking has been updated to <strong>{{ $statusLabel }}</strong>. Our logistics teams are working hard to ensure safe and timely delivery.
                </p>

                <h3 style="font-size: 15px; font-weight: 700; color: #171443; margin-top: 0; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Booking Details</h3>
                <table class="details-table">
                    <tr>
                        <th>Shipping Mark</th>
                        <td><strong>{{ $booking->shipping_mark ?: 'Not Assigned' }}</strong></td>
                    </tr>
                    <tr>
                        <th>Item Name</th>
                        <td>{{ $booking->item_name }}</td>
                    </tr>
                    <tr>
                        <th>Method</th>
                        <td>{{ $booking->method === 'air' ? 'Air Shipping' : 'Sea Cargo' }}</td>
                    </tr>
                    <tr>
                        <th>Actual Weight</th>
                        <td>{{ $booking->total_weight }} KG</td>
                    </tr>
                    <tr>
                        <th>District</th>
                        <td>{{ $booking->district?->name ?: 'Not Specified' }}</td>
                    </tr>
                    @if(!empty($booking->delivery_method))
                    <tr>
                        <th>Delivery Mode</th>
                        <td>{{ $booking->delivery_method }}</td>
                    </tr>
                    @endif
                </table>

                <div class="btn-container">
                    <a href="{{ url('/dashboard/bookings') }}" class="btn">View Booking on Dashboard</a>
                </div>

                <p class="message-body" style="font-size: 13px; margin-bottom: 0;">
                    If you have any questions or require support regarding this updates, please do not hesitate to contact our operations helpline.
                </p>
            </div>

            <!-- Brand Footer -->
            <div class="footer">
                <p>&copy; {{ date('Y') }} TechPickly Premium Logistics. All rights reserved.</p>
                <p>Dhaka, Bangladesh | Support Hotline: {{ settings('phone') }}</p>
            </div>
        </div>
    </div>
</body>
</html>
