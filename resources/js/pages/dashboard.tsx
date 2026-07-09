import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import { LayoutDashboard, Package, Clock, CheckCircle2, Truck } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

interface Booking {
    id: number;
    item_name: string;
    method: string;
    status: string;
    total_weight: string;
    created_at: string;
    category?: { name: string };
    district?: { name: string };
    user?: { name: string };
}

interface Stats {
    total_bookings: number;
    pending_bookings: number;
    received_bookings: number;
    shipped_bookings: number;
    delivered_bookings: number;
    recent_bookings: Booking[];
}

export default function Dashboard() {
    const { stats, auth } = usePage<{ stats: Stats; auth: { user: any } }>().props;

    const cards = [
        { title: 'Total Bookings', value: stats.total_bookings, icon: Package, color: 'text-blue-600', bg: 'bg-blue-100' },
        { title: 'Pending', value: stats.pending_bookings, icon: Clock, color: 'text-yellow-600', bg: 'bg-yellow-100' },
        { title: 'Received', value: stats.received_bookings, icon: CheckCircle2, color: 'text-green-600', bg: 'bg-green-100' },
        { title: 'Shipped', value: stats.shipped_bookings, icon: Truck, color: 'text-purple-600', bg: 'bg-purple-100' },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-6 p-4">
                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    {cards.map((card) => (
                        <div key={card.title} className="bg-card p-6 rounded-xl border border-border shadow-sm flex items-center gap-4">
                            <div className={`${card.bg.replace('bg-', 'bg-').replace('-100', '-100 dark:bg-opacity-10')} p-3 rounded-lg`}>
                                <card.icon className={`size-6 ${card.color}`} />
                            </div>
                            <div>
                                <p className="text-sm font-medium text-muted-foreground">{card.title}</p>
                                <p className="text-2xl font-bold text-foreground">{card.value}</p>
                            </div>
                        </div>
                    ))}
                </div>

                <div className="bg-card rounded-xl border border-border shadow-sm overflow-hidden">
                    <div className="p-6 border-b border-border flex items-center justify-between">
                        <h3 className="font-bold text-foreground">Recent Bookings</h3>
                    </div>
                    <div className="overflow-x-auto">
                        <table className="w-full text-left text-sm">
                            <thead className="bg-muted/50 text-muted-foreground font-medium">
                                <tr>
                                    <th className="px-6 py-3">Item</th>
                                    {auth.user.role !== 'customer' && <th className="px-6 py-3">Customer</th>}
                                    <th className="px-6 py-3">Category</th>
                                    <th className="px-6 py-3">Method</th>
                                    <th className="px-6 py-3">Status</th>
                                    <th className="px-6 py-3">Date</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-border text-foreground">
                                {stats.recent_bookings.length > 0 ? (
                                    stats.recent_bookings.map((booking) => (
                                        <tr key={booking.id} className="hover:bg-muted/50 transition-colors">
                                            <td className="px-6 py-4 font-medium text-foreground">{booking.item_name}</td>
                                            {auth.user.role !== 'customer' && <td className="px-6 py-4">{booking.user?.name}</td>}
                                            <td className="px-6 py-4">{booking.category?.name}</td>
                                            <td className="px-6 py-4">{booking.method}</td>
                                            <td className="px-6 py-4">
                                                <span className={`px-2.5 py-0.5 rounded-full text-xs font-medium capitalize
                                                    ${booking.status === 'pending' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' :
                                                      booking.status === 'delivered' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' :
                                                      'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400'}`}>
                                                    {booking.status}
                                                </span>
                                            </td>
                                            <td className="px-6 py-4 text-muted-foreground">
                                                {new Date(booking.created_at).toLocaleDateString()}
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan={auth.user.role === 'customer' ? 5 : 6} className="px-6 py-10 text-center text-muted-foreground">
                                            No bookings found.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
