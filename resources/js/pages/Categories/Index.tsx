import { Head } from '@inertiajs/react';
import CommonTable from '@/components/admin/CommonTable';
import Heading from '@/components/admin/heading';
import AppLayout from '@/layouts/app-layout';
import type { PaginationType, SortOption } from '@/types';
import { columns } from './Columns';

interface Props {
    categories: PaginationType<any>;
}

export default function CategoryIndex({ categories }: Props) {
    const breadcrumbs = [
        { title: 'Dashboard', href: route('dashboard') },
        { title: 'Categories', href: route('categories.index') },
    ];

    const sortOptions: SortOption[] = [
        { label: 'Newest First', sort: 'created_at', direction: 'desc' },
        { label: 'Name (A-Z)', sort: 'name', direction: 'asc' },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Categories" />

            <div className="flex flex-col flex-1 h-full gap-4 p-4 overflow-x-auto rounded-xl">
                <Heading
                    title={`Categories (${categories.total})`}
                    description="Manage your categories and their price ranges."
                />

                <CommonTable
                    data={categories}
                    columns={columns}
                    create_route="categories.create"
                    routeName="categories.index"
                    sortOptions={sortOptions}
                    bulkDeleteRoute="categories.bulkDestroy"
                    entityName="Category"
                />
            </div>
        </AppLayout>
    );
}
