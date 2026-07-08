import AppLayout from "@/layouts/app-layout";
import { Head } from "@inertiajs/react";
import CategoryForm from "./Form";

export default function Create() {
    return (
        <AppLayout breadcrumbs={[{ title: "Categories", href: route("categories.index") }, { title: "Create", href: route("categories.create") }]}>
            <Head title="Create Category" />

            <div className="p-6">
                <h1 className="text-xl font-bold mb-4">Create Category</h1>
                <CategoryForm />
            </div>
        </AppLayout>
    );
}
