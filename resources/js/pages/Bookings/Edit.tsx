import { Head, useForm, Link } from '@inertiajs/react';
import { ArrowLeft, Save, Plus, Trash2 } from 'lucide-react';
import FormLabel from '@/components/admin/form/FormLabel';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';
import { Checkbox } from '@/components/ui/checkbox';
import AppLayout from '@/layouts/app-layout';

interface Props {
    booking: any;
    categories: { id: number; name: string }[];
    districts: { id: number; name: string }[];
}

export default function Edit({ booking, categories, districts }: Props) {
    const breadcrumbs = [
        { title: 'Dashboard', href: '/dashboard' },
        { title: 'Bookings', href: '/dashboard/bookings' },
        { title: 'Edit Booking', href: '#' },
    ];

    // Ensure tracking is loaded as an array of strings
    const initialTracking = Array.isArray(booking.tracking)
        ? booking.tracking
        : typeof booking.tracking === 'string'
        ? JSON.parse(booking.tracking)
        : [''];

    const { data, setData, put, processing, errors } = useForm({
        method: booking.method || 'air',
        tracking: initialTracking,
        item_name: booking.item_name || '',
        category_id: String(booking.category_id) || '',
        total_carton: String(booking.total_carton) || '1',
        total_quantity: String(booking.total_quantity) || '1',
        total_weight: String(booking.total_weight) || '1.0',
        sensitive_goods: !!booking.sensitive_goods,
        delivery_method: booking.delivery_method || 'courier',
        district_id: String(booking.district_id) || '',
        address: booking.address || '',
        note: booking.note || '',
    });

    const handleAddTracking = () => {
        setData('tracking', [...data.tracking, '']);
    };

    const handleRemoveTracking = (index: number) => {
        if (data.tracking.length > 1) {
            const newTracking = [...data.tracking];
            newTracking.splice(index, 1);
            setData('tracking', newTracking);
        }
    };

    const handleTrackingChange = (index: number, value: string) => {
        const newTracking = [...data.tracking];
        newTracking[index] = value;
        setData('tracking', newTracking);
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        put(route('bookings.update', booking.id));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Booking" />

            <div className="flex-1 space-y-6 p-4 md:p-8 max-w-4xl mx-auto">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-2">
                        <Button variant="outline" size="sm" asChild>
                            <Link href={route('bookings.index')}>
                                <ArrowLeft className="h-4 w-4 mr-1" />
                                Back
                            </Link>
                        </Button>
                        <h2 className="text-3xl font-bold tracking-tight">Edit Booking</h2>
                    </div>
                </div>

                <form onSubmit={handleSubmit} className="space-y-8">
                    <Card>
                        <CardHeader>
                            <CardTitle>Shipment Specifications</CardTitle>
                            <CardDescription>
                                Modify specifications for shipping mark {booking.shipping_mark || `#${booking.id}`}.
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="space-y-6">
                            <div className="grid gap-6 md:grid-cols-2">
                                {/* Method */}
                                <div className="space-y-2">
                                    <FormLabel required>Shipping Method</FormLabel>
                                    <Select
                                        value={data.method}
                                        onValueChange={(value) => setData('method', value)}
                                    >
                                        <SelectTrigger>
                                            <SelectValue placeholder="Select Method" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="air">Air Shipping</SelectItem>
                                            <SelectItem value="sea">Sea Cargo</SelectItem>
                                        </SelectContent>
                                    </Select>
                                    <InputError message={errors.method} />
                                </div>

                                {/* Category */}
                                <div className="space-y-2">
                                    <FormLabel required>Category</FormLabel>
                                    <Select
                                        value={data.category_id}
                                        onValueChange={(value) => setData('category_id', value)}
                                    >
                                        <SelectTrigger>
                                            <SelectValue placeholder="Select Category" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {categories.map((c) => (
                                                <SelectItem key={c.id} value={String(c.id)}>
                                                    {c.name}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                    <InputError message={errors.category_id} />
                                </div>

                                {/* Item Name */}
                                <div className="space-y-2 md:col-span-2">
                                    <FormLabel required>Item Name</FormLabel>
                                    <Input
                                        value={data.item_name}
                                        onChange={(e) => setData('item_name', e.target.value)}
                                        placeholder="e.g. Electric Kettle"
                                    />
                                    <InputError message={errors.item_name} />
                                </div>

                                {/* Total Carton */}
                                <div className="space-y-2">
                                    <FormLabel required>Total Carton</FormLabel>
                                    <Input
                                        type="number"
                                        value={data.total_carton}
                                        onChange={(e) => setData('total_carton', e.target.value)}
                                        min="1"
                                    />
                                    <InputError message={errors.total_carton} />
                                </div>

                                {/* Total Quantity */}
                                <div className="space-y-2">
                                    <FormLabel required>Total Quantity</FormLabel>
                                    <Input
                                        type="number"
                                        value={data.total_quantity}
                                        onChange={(e) => setData('total_quantity', e.target.value)}
                                        min="1"
                                    />
                                    <InputError message={errors.total_quantity} />
                                </div>

                                {/* Total Weight */}
                                <div className="space-y-2">
                                    <FormLabel required>Total Weight (KG)</FormLabel>
                                    <Input
                                        type="number"
                                        step="0.01"
                                        value={data.total_weight}
                                        onChange={(e) => setData('total_weight', e.target.value)}
                                        min="0.01"
                                    />
                                    <InputError message={errors.total_weight} />
                                </div>

                                {/* Sensitive Goods */}
                                <div className="flex items-center space-x-2 pt-8">
                                    <Checkbox
                                        id="sensitive_goods"
                                        checked={data.sensitive_goods}
                                        onCheckedChange={(checked) => setData('sensitive_goods', !!checked)}
                                    />
                                    <label
                                        htmlFor="sensitive_goods"
                                        className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                    >
                                        Sensitive Goods / Battery Included
                                    </label>
                                    <InputError message={errors.sensitive_goods} />
                                </div>
                            </div>

                            {/* Tracking Numbers */}
                            <div className="space-y-4 border-t pt-6">
                                <div className="flex items-center justify-between">
                                    <FormLabel required>Tracking Numbers</FormLabel>
                                    <Button type="button" variant="outline" size="sm" onClick={handleAddTracking} className="gap-1">
                                        <Plus className="h-4 w-4" /> Add Tracking
                                    </Button>
                                </div>
                                <div className="space-y-3">
                                    {data.tracking.map((trackVal, index) => (
                                        <div key={index} className="flex gap-2 items-center">
                                            <Input
                                                value={trackVal}
                                                onChange={(e) => handleTrackingChange(index, e.target.value)}
                                                placeholder={`Tracking Number #${index + 1}`}
                                            />
                                            {data.tracking.length > 1 && (
                                                <Button
                                                    type="button"
                                                    variant="ghost"
                                                    size="icon"
                                                    onClick={() => handleRemoveTracking(index)}
                                                    className="text-destructive hover:bg-destructive/10 shrink-0"
                                                >
                                                    <Trash2 className="h-4 w-4" />
                                                </Button>
                                            )}
                                        </div>
                                    ))}
                                    <InputError message={errors.tracking} />
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader>
                            <CardTitle>Delivery & Logistics Info</CardTitle>
                            <CardDescription>
                                Set the destination and doorstep distribution parameters.
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="space-y-6">
                            <div className="grid gap-6 md:grid-cols-2">
                                {/* Delivery Method */}
                                <div className="space-y-2">
                                    <FormLabel required>Delivery Method</FormLabel>
                                    <Select
                                        value={data.delivery_method}
                                        onValueChange={(value) => setData('delivery_method', value)}
                                    >
                                        <SelectTrigger>
                                            <SelectValue placeholder="Select Delivery Mode" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="office_pickup">Office Pickup</SelectItem>
                                            <SelectItem value="courier">Courier Doorstep Delivery</SelectItem>
                                        </SelectContent>
                                    </Select>
                                    <InputError message={errors.delivery_method} />
                                </div>

                                {/* District */}
                                <div className="space-y-2">
                                    <FormLabel required>District</FormLabel>
                                    <Select
                                        value={data.district_id}
                                        onValueChange={(value) => setData('district_id', value)}
                                    >
                                        <SelectTrigger>
                                            <SelectValue placeholder="Select District" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {districts.map((d) => (
                                                <SelectItem key={d.id} value={String(d.id)}>
                                                    {d.name}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                    <InputError message={errors.district_id} />
                                </div>

                                {/* Delivery Address */}
                                <div className="space-y-2 md:col-span-2">
                                    <FormLabel required>Full Delivery Address</FormLabel>
                                    <Textarea
                                        value={data.address}
                                        onChange={(e) => setData('address', e.target.value)}
                                        placeholder="Enter the full doorstep delivery address"
                                        rows={2}
                                    />
                                    <InputError message={errors.address} />
                                </div>

                                {/* Note */}
                                <div className="space-y-2 md:col-span-2">
                                    <FormLabel>Note / Special Instruction (Optional)</FormLabel>
                                    <Textarea
                                        value={data.note}
                                        onChange={(e) => setData('note', e.target.value)}
                                        placeholder="Any packing or delivery instructions..."
                                        rows={2}
                                    />
                                    <InputError message={errors.note} />
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <div className="flex justify-end gap-4">
                        <Button type="button" variant="outline" asChild>
                            <Link href={route('bookings.index')}>
                                Cancel
                            </Link>
                        </Button>
                        <Button type="submit" disabled={processing} className="gap-1">
                            <Save className="h-4 w-4" />
                            {processing ? 'Saving...' : 'Save Booking'}
                        </Button>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
