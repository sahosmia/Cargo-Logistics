import { Head } from '@inertiajs/react';
import CommonTable from '@/components/admin/CommonTable';
import Heading from '@/components/admin/heading';
import AppLayout from '@/layouts/app-layout';
import type { PaginationType, SortOption, FilterOption } from '@/types';
import { columns } from './Columns';

interface Props {
    districts: PaginationType<any>;
}

export default function DistrictIndex({ districts }: Props) {
    const breadcrumbs = [
        { title: 'Dashboard', href: route('dashboard') },
        { title: 'Districts', href: route('districts.index') },
    ];

    const sortOptions: SortOption[] = [
        { label: 'Name (A-Z)', sort: 'name', direction: 'asc' },
        { label: 'Code', sort: 'code', direction: 'asc' },
        { label: 'Newest First', sort: 'created_at', direction: 'desc' },
    ];

    const filters: FilterOption[] = [
        {
            name: 'status',
            label: 'Status',
            type: 'select',
            options: [
                { label: 'Active', value: '1' },
                { label: 'Inactive', value: '0' },
            ]
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Districts" />

            <div className="flex flex-col flex-1 h-full gap-4 p-4 overflow-x-auto rounded-xl">
                <Heading
                    title={`Districts (${districts.total})`}
                    description="Manage districts and regions."
                />

                <CommonTable
                    data={districts}
                    columns={columns}
                    create_route="districts.create"
                    routeName="districts.index"
                    sortOptions={sortOptions}
                    filters={filters}
                    bulkDeleteRoute="districts.bulkDestroy"
                    entityName="District"
                />
            </div>
        </AppLayout>
    );
}
