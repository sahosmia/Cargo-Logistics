import type { Column } from '@/types';
import BookingStatusDropdown from '@/components/bookings/BookingStatusDropdown';
import BookingDetailsDialog from '@/components/bookings/BookingDetailsDialog';

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
        accessor: (item) => <BookingDetailsDialog booking={item} />,
    },
    {
        header: 'Date',
        accessor: (item) => new Date(item.created_at).toLocaleDateString(),
    },
];
