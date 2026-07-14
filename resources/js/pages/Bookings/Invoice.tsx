import { Head, Link, usePage } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { Booking } from '@/types/cargo';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { ArrowLeft, Printer, CheckCircle2, AlertCircle } from 'lucide-react';

interface Props {
    booking: Booking;
}

export default function BookingInvoice({ booking }: Props) {
    const { settings } = usePage<any>().props;

    const breadcrumbs = [
        { title: 'Dashboard', href: route('dashboard') },
        { title: 'Bookings', href: route('bookings.index') },
        { title: `Invoice`, href: '#' },
    ];

    const appName = settings?.app_name || 'Techpickly';
    const logoUrl = settings?.logo || '/images/techpickly-transparent-logo.png';

    const invoiceNo = booking.shipping_mark || `INV-${booking.id}`;
    const invoiceDate = new Date(booking.created_at).toLocaleDateString(undefined, {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });

    // Formatting currency / numbers
    const formatCurrency = (val: string | number | null) => {
        if (val === null || val === undefined || val === '') return 'TBD';
        const num = typeof val === 'string' ? parseFloat(val) : val;
        return isNaN(num) ? 'TBD' : `${num.toLocaleString()} Tk`;
    };

    const formatRate = (val: string | number | null) => {
        if (val === null || val === undefined || val === '') return 'TBD';
        const num = typeof val === 'string' ? parseFloat(val) : val;
        return isNaN(num) ? 'TBD' : `${num.toLocaleString()} Tk / Kg`;
    };

    const handlePrint = () => {
        window.print();
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Invoice: ${invoiceNo}`} />

            {/* Local Stylesheet to enforce print behavior cleanly */}
            <style dangerouslySetInnerHTML={{ __html: `
                @media print {
                    /* Hide everything except the invoice sheet */
                    aside, nav, header, footer, button, .print\\:hidden, [role="navigation"], [data-sidebar="sidebar"], .app-header {
                        display: none !important;
                    }
                    /* Reset container and body padding */
                    body, html {
                        background: white !important;
                        color: black !important;
                        margin: 0 !important;
                        padding: 0 !important;
                    }
                    main, .app-content, .sidebar-inset {
                        padding: 0 !important;
                        margin: 0 !important;
                        background: transparent !important;
                        border: none !important;
                        box-shadow: none !important;
                    }
                    /* Set page margins */
                    @page {
                        size: A4;
                        margin: 15mm;
                    }
                    /* Print sheet overrides */
                    .print-sheet {
                        width: 100% !important;
                        max-width: 100% !important;
                        margin: 0 !important;
                        padding: 0 !important;
                        border: none !important;
                        box-shadow: none !important;
                        background: transparent !important;
                    }
                    /* Ensure table borders are printed crisp */
                    table {
                        border-collapse: collapse !important;
                    }
                    th, td {
                        border-color: #e2e8f0 !important;
                    }
                }
            `}} />

            <div className="flex flex-col flex-1 h-full gap-6 p-4 md:p-6 overflow-y-auto max-w-4xl mx-auto w-full">
                {/* Actions Toolbar */}
                <div className="flex items-center justify-between gap-4 print:hidden">
                    <Button variant="outline" size="sm" asChild className="gap-2">
                        <Link href={route('bookings.show', booking.id)}>
                            <ArrowLeft className="h-4 w-4" />
                            <span>Back to Details</span>
                        </Link>
                    </Button>

                    <Button onClick={handlePrint} className="gap-2 bg-primary text-primary-foreground">
                        <Printer className="h-4 w-4" />
                        <span>Print Invoice</span>
                    </Button>
                </div>

                {/* Invoice Sheet */}
                <div className="print-sheet bg-card text-card-foreground border border-border rounded-2xl shadow-lg p-6 sm:p-10 space-y-8">
                    {/* Header: Logo and Invoice details */}
                    <div className="flex flex-col md:flex-row md:justify-between md:items-start gap-6 border-b border-border pb-8">
                        <div className="space-y-4">
                            <div className="h-12 w-auto flex items-center">
                                {logoUrl ? (
                                    <img src={logoUrl} alt={appName} className="h-full object-contain max-w-[200px]" />
                                ) : (
                                    <span className="text-xl font-extrabold text-primary">{appName}</span>
                                )}
                            </div>
                            <div className="text-xs text-muted-foreground space-y-1">
                                <p className="font-bold text-foreground">{appName} Cargo</p>
                                <p>Tower 71, Level-8, Near ECB Circle</p>
                                <p>Dhaka Cantonment, Dhaka-1206</p>
                                <p>Phone: 01730-495650 | Email: techpickly@gmail.com</p>
                            </div>
                        </div>

                        <div className="text-left md:text-right space-y-2">
                            <h2 className="text-3xl font-black uppercase tracking-wider text-primary">Invoice</h2>
                            <div className="text-xs space-y-1">
                                <p><span className="text-muted-foreground">Invoice No:</span> <span className="font-mono font-bold text-primary">{invoiceNo}</span></p>
                                <p><span className="text-muted-foreground">Date:</span> <span className="font-medium">{invoiceDate}</span></p>
                                <p><span className="text-muted-foreground">Transport:</span> <span className="font-bold uppercase text-primary">{booking.method} Cargo</span></p>
                                <p><span className="text-muted-foreground">Status:</span> <span className="inline-flex ml-1">
                                    {booking.payment_status === 'paid' ? (
                                        <Badge className="bg-emerald-600 hover:bg-emerald-700 text-white gap-1 py-0.5 px-2">
                                            <CheckCircle2 className="h-3 w-3" /> Paid
                                        </Badge>
                                    ) : (
                                        <Badge variant="destructive" className="gap-1 py-0.5 px-2 animate-pulse">
                                            <AlertCircle className="h-3 w-3" /> Pending
                                        </Badge>
                                    )}
                                </span></p>
                            </div>
                        </div>
                    </div>

                    {/* Customer & Shipment Metadata */}
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-8 bg-muted/40 p-6 rounded-xl border border-border">
                        <div className="space-y-3">
                            <h3 className="text-xs font-bold uppercase tracking-wider text-muted-foreground border-b border-border pb-1">Bill To</h3>
                            <div className="space-y-1">
                                <p className="font-bold text-foreground text-sm">{booking.user?.name || 'Walk-in Customer'}</p>
                                {booking.user?.phone_number && <p className="text-xs text-muted-foreground">Phone: {booking.user.phone_number}</p>}
                                {booking.user?.email && <p className="text-xs text-muted-foreground">Email: {booking.user.email}</p>}
                                <div className="pt-1">
                                    <p className="text-xs text-muted-foreground font-semibold">Delivery Address:</p>
                                    <p className="text-xs text-foreground leading-relaxed">{booking.address}</p>
                                </div>
                            </div>
                        </div>

                        <div className="space-y-3">
                            <h3 className="text-xs font-bold uppercase tracking-wider text-muted-foreground border-b border-border pb-1">Shipment Information</h3>
                            <div className="grid grid-cols-2 gap-2 text-xs">
                                <div>
                                    <p className="text-muted-foreground font-semibold">Shipping Mark:</p>
                                    <p className="font-bold font-mono text-primary text-sm">{booking.shipping_mark || 'N/A'}</p>
                                </div>
                                <div>
                                    <p className="text-muted-foreground font-semibold">Target District:</p>
                                    <p className="font-semibold">{booking.district?.name || 'N/A'}</p>
                                </div>
                                <div>
                                    <p className="text-muted-foreground font-semibold">Total Cartons:</p>
                                    <p className="font-semibold">{booking.total_carton} CTN</p>
                                </div>
                                <div>
                                    <p className="text-muted-foreground font-semibold">Total Quantity:</p>
                                    <p className="font-semibold">{booking.total_quantity} Pcs</p>
                                </div>
                                <div>
                                    <p className="text-muted-foreground font-semibold">Delivery Method:</p>
                                    <p className="font-semibold capitalize">{booking.delivery_method}</p>
                                </div>
                                {booking.sensitive_goods && (
                                    <div className="col-span-2">
                                        <Badge variant="destructive" className="text-[10px] py-0.5">Sensitive Goods</Badge>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>

                    {/* Line Items Table */}
                    <div className="overflow-hidden border border-border rounded-xl">
                        <table className="w-full text-left border-collapse">
                            <thead>
                                <tr className="bg-muted text-muted-foreground text-xs font-bold uppercase border-b border-border">
                                    <th className="py-4 px-4 w-12 text-center">#</th>
                                    <th className="py-4 px-4">Item & Category</th>
                                    <th className="py-4 px-4">Tracking Details</th>
                                    <th className="py-4 px-4 text-center">Weight</th>
                                    <th className="py-4 px-4 text-right">Unit Rate</th>
                                    <th className="py-4 px-4 text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-border text-sm">
                                <tr>
                                    <td className="py-4 px-4 text-center text-muted-foreground">1</td>
                                    <td className="py-4 px-4">
                                        <p className="font-bold text-foreground">{booking.item_name}</p>
                                        <p className="text-xs text-muted-foreground">Category: {booking.category?.name || 'General'}</p>
                                    </td>
                                    <td className="py-4 px-4">
                                        <div className="flex flex-wrap gap-1 max-w-[200px]">
                                            {booking.tracking.map((t, idx) => (
                                                <Badge key={idx} variant="outline" className="text-[10px] py-0 font-mono">
                                                    {t}
                                                </Badge>
                                            ))}
                                        </div>
                                    </td>
                                    <td className="py-4 px-4 text-center font-semibold font-mono">{booking.total_weight} Kg</td>
                                    <td className="py-4 px-4 text-right font-medium">{formatRate(booking.unit_price)}</td>
                                    <td className="py-4 px-4 text-right font-bold text-primary">{formatCurrency(booking.total_price)}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {/* Summary and Terms */}
                    <div className="flex flex-col md:flex-row justify-between items-start gap-8 pt-4">
                        <div className="max-w-md text-xs text-muted-foreground space-y-2">
                            <p className="font-bold text-foreground">Terms & Conditions:</p>
                            <p className="leading-relaxed">
                                1. Shipping charge is calculated based on category-specific pricing per KG and actual weight.
                            </p>
                            <p className="leading-relaxed">
                                2. Customers must pay full shipping and clearance charges before taking delivery.
                            </p>
                            {booking.note && (
                                <div className="bg-orange-50 dark:bg-orange-950/20 text-orange-700 dark:text-orange-400 p-3 rounded-lg border border-orange-200/50 mt-2">
                                    <span className="font-bold">Booking Note:</span> "{booking.note}"
                                </div>
                            )}
                        </div>

                        <div className="w-full md:w-80 bg-muted/20 p-5 rounded-xl border border-border space-y-3 text-sm">
                            <div className="flex justify-between">
                                <span className="text-muted-foreground">Total Weight:</span>
                                <span className="font-bold font-mono">{booking.total_weight} Kg</span>
                            </div>
                            <div className="flex justify-between border-b border-border pb-2">
                                <span className="text-muted-foreground">Rate:</span>
                                <span className="font-semibold">{formatRate(booking.unit_price)}</span>
                            </div>
                            <div className="flex justify-between items-baseline pt-2">
                                <span className="text-base font-bold text-foreground">Total Charge:</span>
                                <span className="text-xl font-black text-primary">{formatCurrency(booking.total_price)}</span>
                            </div>
                        </div>
                    </div>

                    {/* Decorative Footer banner/pattern */}
                    <div className="border-t border-border pt-6 text-center text-xs text-muted-foreground">
                        <p className="font-bold text-primary">{appName} - Your Trusted Global Shipping & Logistics Partner</p>
                        <p className="mt-1">Thank you for shipping with us! For any support, please reach out to our service team.</p>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
