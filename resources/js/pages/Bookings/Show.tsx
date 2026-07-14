import { Head, usePage, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { Booking, BookingHistory } from '@/types/cargo';
import { Badge } from '@/components/ui/badge';
import { Separator } from '@/components/ui/separator';
import { Button } from '@/components/ui/button';
import { ArrowLeft, Package, Truck, User, MapPin, ClipboardList, Info, Clock, FileText } from 'lucide-react';
import BookingStatusDropdown from '@/components/bookings/BookingStatusDropdown';

interface Props {
    booking: Booking;
}

const STATUS_LABELS: Record<string, string> = {
    pending: 'Pending / Requested',
    received_in_china: 'Received in China',
    in_transit: 'In Transit (Ship/Air)',
    arrived_in_bd: 'Arrived in BD',
    customs_cleared: 'Customs Cleared',
    ready_for_delivery: 'Ready for Delivery',
    delivered: 'Delivered',
    cancelled: 'Cancelled',
};

export default function BookingShow({ booking }: Props) {
    const { auth } = usePage<any>().props;
    const isCustomer = auth.guard === 'customer';

    const breadcrumbs = [
        { title: 'Dashboard', href: route('dashboard') },
        { title: 'Bookings', href: route('bookings.index') },
        { title: `Booking Details`, href: '#' },
    ];

    const histories = booking.histories || [];
    const sortedHistories = [...histories].sort((a, b) => new Date(b.created_at).getTime() - new Date(a.created_at).getTime());

    const getActorLabel = (history: BookingHistory) => {
        if (!history.user) return 'System';
        const role = history.user.role ? history.user.role.replace('_', ' ').toUpperCase() : 'USER';
        return `${history.user.name} (${role})`;
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Booking: ${booking.item_name}`} />

            <div className="flex flex-col flex-1 h-full gap-6 p-4 md:p-6 overflow-y-auto max-w-7xl mx-auto w-full">
                {/* Back button and title */}
                <div className="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div className="flex items-center gap-3">
                        <Button
                            variant="outline"
                            size="icon"
                            onClick={() => window.history.back()}
                            className="h-9 w-9"
                        >
                            <ArrowLeft className="h-4 w-4" />
                        </Button>
                        <div>
                            <h1 className="text-2xl font-bold tracking-tight text-foreground flex items-center gap-2">
                                <Package className="h-6 w-6 text-primary" />
                                Booking: {booking.item_name}
                            </h1>
                            <p className="text-sm text-muted-foreground">
                                View shipment status, pricing, details, and chronological timeline.
                            </p>
                        </div>
                    </div>

                    <div className="flex flex-wrap items-center gap-3">
                        <Button variant="outline" size="sm" asChild className="gap-2 text-primary hover:text-primary h-9">
                            <Link href={route('bookings.invoice', booking.id)}>
                                <FileText className="h-4 w-4" />
                                <span>View/Print Invoice</span>
                            </Link>
                        </Button>

                        {/* Status dropdown if admin/staff */}
                        {!isCustomer && (
                            <div className="flex items-center gap-2 bg-muted/50 p-2 rounded-lg border border-border">
                                <span className="text-xs font-semibold text-muted-foreground uppercase tracking-wider px-1">Update Status:</span>
                                <BookingStatusDropdown booking={booking} />
                            </div>
                        )}
                    </div>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    {/* Left & Center Columns: Booking details */}
                    <div className="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                        {/* Status & Basic Info */}
                        <div className="bg-card border border-border rounded-xl p-5 shadow-sm space-y-4">
                            <div className="flex items-center gap-2 border-b border-border pb-3">
                                <Info className="h-4 w-4 text-primary" />
                                <h3 className="font-semibold text-foreground">Overview</h3>
                            </div>
                            <div className="space-y-3">
                                <div className="flex justify-between items-center">
                                    <span className="text-sm text-muted-foreground">Status:</span>
                                    <Badge variant="secondary">{STATUS_LABELS[booking.status] || booking.status}</Badge>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-sm text-muted-foreground">Shipping Mark:</span>
                                    <span className="text-sm font-bold font-mono text-primary">{booking.shipping_mark || 'N/A'}</span>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-sm text-muted-foreground">Method:</span>
                                    <span className="text-sm font-medium">{booking.method}</span>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-sm text-muted-foreground">Tracking No:</span>
                                    <div className="flex flex-col items-end gap-1">
                                        {booking.tracking.map((t, i) => (
                                            <Badge key={i} variant="outline" className="text-[10px]">{t}</Badge>
                                        ))}
                                    </div>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-sm text-muted-foreground">Booking Date:</span>
                                    <span className="text-sm font-medium">{new Date(booking.created_at).toLocaleDateString()}</span>
                                </div>
                            </div>
                        </div>

                        {/* Customer Info */}
                        <div className="bg-card border border-border rounded-xl p-5 shadow-sm space-y-4">
                            <div className="flex items-center gap-2 border-b border-border pb-3">
                                <User className="h-4 w-4 text-primary" />
                                <h3 className="font-semibold text-foreground">Customer Details</h3>
                            </div>
                            <div className="space-y-3">
                                <div className="flex justify-between">
                                    <span className="text-sm text-muted-foreground">Name:</span>
                                    <span className="text-sm font-medium">{booking.user?.name || 'N/A'}</span>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-sm text-muted-foreground">Phone:</span>
                                    <span className="text-sm font-medium">{booking.user?.phone_number || 'N/A'}</span>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-sm text-muted-foreground">Email:</span>
                                    <span className="text-sm font-medium">{booking.user?.email || 'N/A'}</span>
                                </div>
                            </div>
                        </div>

                        {/* Item Details */}
                        <div className="bg-card border border-border rounded-xl p-5 shadow-sm space-y-4">
                            <div className="flex items-center gap-2 border-b border-border pb-3">
                                <ClipboardList className="h-4 w-4 text-primary" />
                                <h3 className="font-semibold text-foreground">Item Specification</h3>
                            </div>
                            <div className="space-y-3">
                                <div className="flex justify-between">
                                    <span className="text-sm text-muted-foreground">Category:</span>
                                    <span className="text-sm font-medium">{booking.category?.name || 'N/A'}</span>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-sm text-muted-foreground">Total Carton:</span>
                                    <span className="text-sm font-medium">{booking.total_carton}</span>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-sm text-muted-foreground">Total Quantity:</span>
                                    <span className="text-sm font-medium">{booking.total_quantity}</span>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-sm text-muted-foreground">Total Weight:</span>
                                    <span className="text-sm font-medium font-mono text-primary">{booking.total_weight} KG</span>
                                </div>
                                {booking.sensitive_goods && (
                                    <div className="flex justify-center pt-2">
                                        <Badge variant="destructive" className="animate-pulse">Sensitive Goods</Badge>
                                    </div>
                                )}
                            </div>
                        </div>

                        {/* Delivery Info */}
                        <div className="bg-card border border-border rounded-xl p-5 shadow-sm space-y-4">
                            <div className="flex items-center gap-2 border-b border-border pb-3">
                                <Truck className="h-4 w-4 text-primary" />
                                <h3 className="font-semibold text-foreground">Delivery & Pricing</h3>
                            </div>
                            <div className="space-y-3">
                                <div className="flex justify-between">
                                    <span className="text-sm text-muted-foreground">Delivery Method:</span>
                                    <span className="text-sm font-medium">{booking.delivery_method}</span>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-sm text-muted-foreground">District:</span>
                                    <span className="text-sm font-medium">{booking.district?.name || 'N/A'}</span>
                                </div>
                                <Separator className="my-2" />
                                <div className="flex justify-between">
                                    <span className="text-sm text-muted-foreground">Unit Price:</span>
                                    <span className="text-sm font-medium">{booking.unit_price ? `${booking.unit_price} Tk` : 'TBD'}</span>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-sm text-muted-foreground">Total Price:</span>
                                    <span className="text-sm font-bold text-primary">{booking.total_price ? `${booking.total_price} Tk` : 'TBD'}</span>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-sm text-muted-foreground">Payment:</span>
                                    <Badge variant={booking.payment_status === 'paid' ? 'default' : 'destructive'} className="capitalize">
                                        {booking.payment_status}
                                    </Badge>
                                </div>
                            </div>
                        </div>

                        <div className="md:col-span-2 bg-card border border-border rounded-xl p-5 shadow-sm space-y-4">
                            <div className="flex items-center gap-2 border-b border-border pb-3">
                                <MapPin className="h-4 w-4 text-primary" />
                                <h3 className="font-semibold text-foreground">Address & Notes</h3>
                            </div>
                            <div className="space-y-3">
                                <div>
                                    <span className="text-xs text-muted-foreground uppercase font-bold tracking-wider">Delivery Address:</span>
                                    <p className="text-sm mt-1">{booking.address}</p>
                                </div>
                                {booking.note && (
                                    <div className="pt-2">
                                        <span className="text-xs text-muted-foreground uppercase font-bold tracking-wider">Special Notes:</span>
                                        <p className="text-sm mt-1 text-orange-600 dark:text-orange-400 italic">"{booking.note}"</p>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>

                    {/* Right Column: Status History Timeline */}
                    <div className="lg:col-span-1 bg-card border border-border rounded-xl p-5 shadow-sm space-y-4">
                        <div className="flex items-center gap-2 border-b border-border pb-3">
                            <Clock className="h-4 w-4 text-primary" />
                            <h3 className="font-semibold text-foreground">Status History & Timeline</h3>
                        </div>
                        <div className="bg-muted/30 p-4 rounded-lg border border-border">
                            {sortedHistories.length === 0 ? (
                                <p className="text-sm text-muted-foreground text-center py-8">No status history found.</p>
                            ) : (
                                <div className="relative border-l border-muted-foreground/30 pl-4 ml-2 space-y-6">
                                    {sortedHistories.map((history) => {
                                        const dateObj = new Date(history.created_at);
                                        const formattedDate = dateObj.toLocaleDateString(undefined, {
                                            month: 'short',
                                            day: 'numeric',
                                            year: 'numeric'
                                        });
                                        const formattedTime = dateObj.toLocaleTimeString(undefined, {
                                            hour: '2-digit',
                                            minute: '2-digit'
                                        });
                                        return (
                                            <div key={history.id} className="relative">
                                                {/* Dot */}
                                                <span className="absolute -left-[21px] top-1.5 flex h-2.5 w-2.5 items-center justify-center rounded-full bg-primary ring-4 ring-background" />

                                                <div className="flex flex-col gap-1">
                                                    <div className="flex items-center justify-between gap-2 flex-wrap">
                                                        <span className="text-sm font-semibold text-foreground">
                                                            {STATUS_LABELS[history.status] || history.status}
                                                        </span>
                                                        <span className="text-[11px] text-muted-foreground bg-muted px-1.5 py-0.5 rounded font-mono">
                                                            {formattedDate} {formattedTime}
                                                        </span>
                                                    </div>
                                                    <div className="text-xs text-muted-foreground flex items-center gap-1">
                                                        <span className="font-medium text-foreground/70">By:</span> {getActorLabel(history)}
                                                    </div>
                                                    {history.comment && (
                                                        <div className="text-xs text-foreground/80 bg-background/50 border border-border/50 p-2 rounded mt-1 italic">
                                                            "{history.comment}"
                                                        </div>
                                                    )}
                                                </div>
                                            </div>
                                        );
                                    })}
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
