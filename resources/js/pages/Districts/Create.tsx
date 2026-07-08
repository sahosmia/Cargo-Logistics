import AppLayout from "@/layouts/app-layout";
import { Head } from "@inertiajs/react";
import DistrictForm from "./Form";

export default function Create() {
    return (
        <AppLayout breadcrumbs={[{ title: "Districts", href: route("districts.index") }, { title: "Create", href: route("districts.create") }]}>
            <Head title="Create District" />

            <div className="p-6">
                <h1 className="text-xl font-bold mb-4">Create District</h1>
                <DistrictForm />
            </div>
        </AppLayout>
    );
}
