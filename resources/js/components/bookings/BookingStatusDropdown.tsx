import React, { useState } from 'react';
import { useForm, usePage, router } from '@inertiajs/react';
import { Booking } from '@/types/cargo';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Badge } from '@/components/ui/badge';
import { toast } from 'sonner';
import { Loader2 } from 'lucide-react';
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogFooter, DialogDescription } from '@/components/ui/dialog';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

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

const NEXT_STATUSES: Record<string, string[]> = {
    pending: ['received_in_china', 'cancelled'],
    received_in_china: ['in_transit', 'cancelled'],
    in_transit: ['arrived_in_bd', 'cancelled'],
    arrived_in_bd: ['customs_cleared'],
    customs_cleared: ['ready_for_delivery'],
    ready_for_delivery: ['delivered'],
    delivered: [],
    cancelled: [],
};

const ROLE_PERMISSIONS: Record<string, string[]> = {
    'Super Admin': [
        'pending',
        'received_in_china',
        'in_transit',
        'arrived_in_bd',
        'customs_cleared',
        'ready_for_delivery',
        'delivered',
        'cancelled',
    ],
    'China Warehouse Manager': ['received_in_china', 'in_transit', 'cancelled'],
    'BD Warehouse Manager': ['arrived_in_bd', 'customs_cleared', 'ready_for_delivery', 'delivered'],
};

export default function BookingStatusDropdown({ booking }: Props) {
    const { auth } = usePage().props as any;
    const userRoles = auth.user?.roles || [];
    const isCustomer = auth.guard === 'customer';

    const [isModalOpen, setIsModalOpen] = useState(false);
    const [pendingStatus, setPendingStatus] = useState<string | null>(null);

    const { data, setData, patch, processing, reset } = useForm({
        status: '',
        total_weight: booking.total_weight || '',
        unit_price: booking.unit_price || '',
        total_price: booking.total_price || '',
        comment: '',
    });

    const currentStatus = booking.status;
    const allowedNext = NEXT_STATUSES[currentStatus] || [];

    const userAllowedStatuses = userRoles.reduce((acc: string[], role: string) => {
        return [...acc, ...(ROLE_PERMISSIONS[role] || [])];
    }, []);

    const filteredOptions = allowedNext.filter((status) => userAllowedStatuses.includes(status));

    const handleStatusChange = (newStatus: string) => {
        setPendingStatus(newStatus);
        setData((prevData) => {
            const nextData = {
                ...prevData,
                status: newStatus,
                comment: '',
            };
            if (newStatus === 'received_in_china' || (newStatus === 'delivered' && auth.user?.roles?.includes('Super Admin'))) {
                if (booking.category) {
                    const method = booking.method?.toLowerCase();
                    const price = method === 'sea' ? booking.category.price_start : booking.category.price_end;
                    nextData.unit_price = price;
                    nextData.total_price = Number(price) * Number(booking.total_weight || 0);
                }
            }
            return nextData;
        });
        setIsModalOpen(true);
    };

    const submitStatusChange = (status: string, additionalData = {}) => {
        router.patch(route('bookings.update-status', booking.id), {
            status,
            ...additionalData
        }, {
            onSuccess: () => {
                toast.success('Status updated successfully');
                setIsModalOpen(false);
                reset();
            },
            onError: () => toast.error('Failed to update status'),
        });
    };

    const handleModalSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        const isReceivedInChina = data.status === 'received_in_china';
        const isSuperAdminDelivered = data.status === 'delivered' && auth.user?.roles?.includes('Super Admin');
        const showExtraFields = isReceivedInChina || isSuperAdminDelivered;

        if (showExtraFields) {
            submitStatusChange(data.status, {
                total_weight: data.total_weight,
                unit_price: data.unit_price,
                total_price: data.total_price,
                comment: data.comment,
            });
        } else {
            submitStatusChange(data.status, {
                comment: data.comment,
            });
        }
    };

    if (isCustomer || filteredOptions.length === 0) {
        return <Badge variant="outline">{STATUS_LABELS[currentStatus] || currentStatus}</Badge>;
    }

    const isReceivedInChina = data.status === 'received_in_china';
    const isSuperAdminDelivered = data.status === 'delivered' && auth.user?.roles?.includes('Super Admin');
    const showExtraFields = isReceivedInChina || isSuperAdminDelivered;

    return (
        <div className="flex items-center gap-2">
            <Select disabled={processing} value={currentStatus} onValueChange={handleStatusChange}>
                <SelectTrigger className="w-[180px] h-8 text-xs">
                    <SelectValue />
                </SelectTrigger>
                <SelectContent>
                    <SelectItem value={currentStatus} disabled>
                        {STATUS_LABELS[currentStatus]}
                    </SelectItem>
                    {filteredOptions.map((status) => (
                        <SelectItem key={status} value={status}>
                            {STATUS_LABELS[status]}
                        </SelectItem>
                    ))}
                </SelectContent>
            </Select>
            {processing && <Loader2 className="w-4 h-4 animate-spin text-muted-foreground" />}

            <Dialog open={isModalOpen} onOpenChange={setIsModalOpen}>
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>Update Booking Details</DialogTitle>
                        <DialogDescription>
                            Please provide the necessary details for the <strong>{STATUS_LABELS[data.status]}</strong> status.
                        </DialogDescription>
                    </DialogHeader>
                    <form onSubmit={handleModalSubmit} className="space-y-4 py-4">
                        {showExtraFields && (
                            <>
                                <div className="space-y-2">
                                    <Label htmlFor="total_weight">Total Weight (Kg)</Label>
                                    <Input
                                        id="total_weight"
                                        type="number"
                                        step="0.01"
                                        value={data.total_weight}
                                        onChange={(e) => setData('total_weight', e.target.value)}
                                        required
                                    />
                                </div>
                                <div className="grid grid-cols-2 gap-4">
                                    <div className="space-y-2">
                                        <Label htmlFor="unit_price">Unit Price (Category: {booking.category?.name})</Label>
                                        <div className="text-[10px] text-muted-foreground mb-1">
                                            Sea: {booking.category?.price_start} | Air: {booking.category?.price_end}
                                        </div>
                                        <Input
                                            id="unit_price"
                                            type="number"
                                            step="0.01"
                                            value={data.unit_price}
                                            onChange={(e) => {
                                                const val = e.target.value;
                                                setData((prev) => ({
                                                    ...prev,
                                                    unit_price: val,
                                                    total_price: Number(val) * Number(booking.total_weight || 0)
                                                }));
                                            }}
                                            required
                                        />
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="total_price">Total Price</Label>
                                        <div className="text-[10px] text-muted-foreground mb-1">
                                            Calc: {data.unit_price} * {booking.total_weight}
                                        </div>
                                        <Input
                                            id="total_price"
                                            type="number"
                                            step="0.01"
                                            value={data.total_price}
                                            onChange={(e) => setData('total_price', e.target.value)}
                                            required
                                        />
                                    </div>
                                </div>
                            </>
                        )}
                        <div className="space-y-2">
                            <Label htmlFor="comment">Note / Comment</Label>
                            <Input
                                id="comment"
                                value={data.comment}
                                onChange={(e) => setData('comment', e.target.value)}
                                placeholder="Optional notes about this status change"
                                autoFocus
                            />
                        </div>
                        <DialogFooter>
                            <Button type="button" variant="outline" onClick={() => setIsModalOpen(false)}>Cancel</Button>
                            <Button type="submit" disabled={processing}>
                                {processing && <Loader2 className="mr-2 h-4 w-4 animate-spin" />}
                                Update Status
                            </Button>
                        </DialogFooter>
                    </form>
                </DialogContent>
            </Dialog>
        </div>
    );
}
