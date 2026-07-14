import type { Column } from '@/types';
import BookingStatusDropdown from '@/components/bookings/BookingStatusDropdown';
import { Link } from '@inertiajs/react';
import { Eye, FileText } from 'lucide-react';
import { Button } from '@/components/ui/button';

export const columns: Column<any>[] = [
    {
        header: 'Item',
        accessor: (item) => (
            <div className="flex flex-col">
                <span className="font-medium text-foreground">{item.item_name}</span>
                <span className="text-xs text-muted-foreground">{item.method}</span>
            </div>
        ),
    },
    {
        header: 'Shipping Mark',
        accessor: (item) => (
            <span className="font-mono text-xs font-semibold text-primary">
                {item.shipping_mark || 'N/A'}
            </span>
        ),
    },
    {
        header: 'Category',
        accessor: (item) => item.category?.name || 'N/A',
    },
    {
        header: 'Weight',
        accessor: (item) => `${item.total_weight} Kg`,
    },
    {
        header: 'District',
        accessor: (item) => item.district?.name || 'N/A',
    },
    {
        header: 'Status',
        accessor: (item) => <BookingStatusDropdown booking={item} />,
    },
    {
        header: 'Actions',
        accessor: (item) => (
            <div className="flex items-center gap-2">
                <Button variant="outline" size="sm" asChild className="gap-2">
                    <Link href={route('bookings.show', item.id)}>
                        <Eye className="h-4 w-4" />
                        <span>View</span>
                    </Link>
                </Button>
                <Button variant="outline" size="sm" asChild className="gap-2 text-primary hover:text-primary">
                    <Link href={route('bookings.invoice', item.id)}>
                        <FileText className="h-4 w-4" />
                        <span>Invoice</span>
                    </Link>
                </Button>
            </div>
        ),
    },
    {
        header: 'Date',
        accessor: (item) => new Date(item.created_at).toLocaleDateString(),
    },
];
