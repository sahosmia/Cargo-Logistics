import AppLayout from '@/layouts/app-layout';
import { Head } from '@inertiajs/react';

export default function Index({ categories }: any) {
    return (
        <AppLayout breadcrumbs={[{ title: 'Categories', href: route('categories.index') }]}>
            <Head title="Categories" />
            <div className="p-6 text-xl font-bold">Categories Page (Placeholder)</div>
            <pre>{JSON.stringify(categories, null, 2)}</pre>
        </AppLayout>
    );
}
