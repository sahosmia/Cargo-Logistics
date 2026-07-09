import { Head } from "@inertiajs/react";
import AppLayout from "@/layouts/app-layout";
import RoleForm from "./form";
import { Permission } from "@/types/cargo";

export default function Create({ permissions }: { permissions: Permission[] }) {
    return (
        <AppLayout breadcrumbs={[{ title: "Roles", href: route("roles.index") }, { title: "Create", href: route("roles.create") }]}>
            <Head title="Role Create" />

            <div className="p-6">
                <h1 className="text-xl font-bold mb-4">Create Role</h1>
                <RoleForm permissions={permissions} />
            </div>
        </AppLayout>
    );
}
