import AppLayout from "@/layouts/app-layout";
import { Head } from "@inertiajs/react";
import CategoryForm from "./Form";

export default function Edit({ category }: { category: any }) {
    return (
        <AppLayout breadcrumbs={[{ title: "Categories", href: route("categories.index") }, { title: "Edit", href: "#" }]}>
            <Head title="Edit Category" />

            <div className="p-6">
                <h1 className="text-xl font-bold mb-4">Edit Category</h1>
                <CategoryForm category={category} />
            </div>
        </AppLayout>
    );
}
