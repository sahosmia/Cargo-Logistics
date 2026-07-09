import { Head, usePage } from '@inertiajs/react';
import CommonTable from '@/components/admin/CommonTable';
import Heading from '@/components/admin/heading';
import AppLayout from '@/layouts/app-layout';
import type { PaginationType, SortOption } from '@/types';
import { columns } from './Columns';

interface Props {
    bookings: PaginationType<any>;
}

export default function BookingIndex({ bookings }: Props) {
    const { auth } = usePage<any>().props;
    const breadcrumbs = [
        { title: 'Dashboard', href: route('dashboard') },
        { title: 'Bookings', href: route('bookings.index') },
    ];

    const sortOptions: SortOption[] = [
        { label: 'Newest First', sort: 'created_at', direction: 'desc' },
        { label: 'Weight (High-Low)', sort: 'total_weight', direction: 'desc' },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Bookings" />

            <div className="flex flex-col flex-1 h-full gap-4 p-4 overflow-x-auto">
                <Heading
                    title={`Bookings (${bookings.total})`}
                    description="View and manage shipment bookings."
                />

                <CommonTable
                    data={bookings}
                    columns={columns}
                    routeName="bookings.index"
                    sortOptions={sortOptions}
                    entityName="Booking"
                />
            </div>
        </AppLayout>
    );
}
