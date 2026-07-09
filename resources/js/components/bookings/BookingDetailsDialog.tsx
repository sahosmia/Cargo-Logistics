import { Booking } from '@/types/cargo';
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Button } from '@/components/ui/button';
import { Eye, Package, Truck, User, MapPin, ClipboardList, Info } from 'lucide-react';
import { Badge } from '@/components/ui/badge';
import { Separator } from '@/components/ui/separator';

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

export default function BookingDetailsDialog({ booking }: Props) {
    return (
        <Dialog>
            <DialogTrigger asChild>
                <Button variant="outline" size="sm" className="gap-2">
                    <Eye className="h-4 w-4" />
                    <span>View</span>
                </Button>
            </DialogTrigger>
            <DialogContent className="max-w-2xl max-h-[90vh] overflow-y-auto">
                <DialogHeader>
                    <DialogTitle className="flex items-center gap-2 text-xl">
                        <Package className="h-5 w-5 text-primary" />
                        Booking Details: {booking.item_name}
                    </DialogTitle>
                </DialogHeader>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-6 py-4">
                    {/* Status & Basic Info */}
                    <div className="space-y-4">
                        <div className="flex items-center gap-2">
                            <Info className="h-4 w-4 text-muted-foreground" />
                            <h3 className="font-semibold">Overview</h3>
                        </div>
                        <div className="bg-muted/50 p-4 rounded-lg space-y-3">
                            <div className="flex justify-between items-center">
                                <span className="text-sm text-muted-foreground">Status:</span>
                                <Badge variant="secondary">{STATUS_LABELS[booking.status] || booking.status}</Badge>
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
                    <div className="space-y-4">
                        <div className="flex items-center gap-2">
                            <User className="h-4 w-4 text-muted-foreground" />
                            <h3 className="font-semibold">Customer Details</h3>
                        </div>
                        <div className="bg-muted/50 p-4 rounded-lg space-y-3">
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
                    <div className="space-y-4">
                        <div className="flex items-center gap-2">
                            <ClipboardList className="h-4 w-4 text-muted-foreground" />
                            <h3 className="font-semibold">Item Specification</h3>
                        </div>
                        <div className="bg-muted/50 p-4 rounded-lg space-y-3">
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
                    <div className="space-y-4">
                        <div className="flex items-center gap-2">
                            <Truck className="h-4 w-4 text-muted-foreground" />
                            <h3 className="font-semibold">Delivery & Pricing</h3>
                        </div>
                        <div className="bg-muted/50 p-4 rounded-lg space-y-3">
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

                    <div className="md:col-span-2 space-y-4">
                        <div className="flex items-center gap-2">
                            <MapPin className="h-4 w-4 text-muted-foreground" />
                            <h3 className="font-semibold">Address & Notes</h3>
                        </div>
                        <div className="bg-muted/50 p-4 rounded-lg space-y-3">
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
            </DialogContent>
        </Dialog>
    );
}
