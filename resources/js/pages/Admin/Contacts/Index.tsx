import { Head } from '@inertiajs/react';
import CommonTable from '@/components/admin/CommonTable';
import Heading from '@/components/admin/heading';
import AppLayout from '@/layouts/app-layout';
import type { PaginationType, SortOption } from '@/types';
import { columns } from './Columns';

interface Contact {
    id: number;
    name: string;
    email: string;
    message: string;
    created_at: string;
}

interface Props {
    contacts: PaginationType<Contact>;
}

export default function ContactIndex({ contacts }: Props) {
    const breadcrumbs = [
        { title: 'Dashboard', href: route('dashboard') },
        { title: 'Contacts', href: route('admin.contacts.index') },
    ];

    const sortOptions: SortOption[] = [
        { label: 'Newest First', sort: 'created_at', direction: 'desc' },
        { label: 'Name (A-Z)', sort: 'name', direction: 'asc' },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Contacts" />

            <div className="flex flex-col flex-1 h-full gap-4 p-4 overflow-x-auto">
                <Heading
                    title={`Contact Submissions (${contacts.total})`}
                    description="View all form submissions from the Contact Us page."
                />

                <CommonTable
                    data={contacts}
                    columns={columns}
                    routeName="admin.contacts.index"
                    sortOptions={sortOptions}
                    entityName="Contact"
                />
            </div>
        </AppLayout>
    );
}
