import AppLayout from "@/layouts/app-layout";
import { Head } from "@inertiajs/react";
import DistrictForm from "./Form";

export default function Edit({ district }: { district: any }) {
    return (
        <AppLayout breadcrumbs={[{ title: "Districts", href: route("districts.index") }, { title: "Edit", href: "#" }]}>
            <Head title="Edit District" />

            <div className="p-6">
                <h1 className="text-xl font-bold mb-4">Edit District</h1>
                <DistrictForm district={district} />
            </div>
        </AppLayout>
    );
}
