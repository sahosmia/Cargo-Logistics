import AppLayout from '@/layouts/app-layout';
import { Head } from '@inertiajs/react';

export default function Index({ districts }: any) {
    return (
        <AppLayout breadcrumbs={[{ title: 'Districts', href: route('districts.index') }]}>
            <Head title="Districts" />
            <div className="p-6 text-xl font-bold">Districts Page (Placeholder)</div>
            <pre>{JSON.stringify(districts, null, 2)}</pre>
        </AppLayout>
    );
}
