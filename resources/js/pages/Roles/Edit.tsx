import { Head } from "@inertiajs/react";
import AppLayout from "@/layouts/app-layout";
import RoleForm from "./form";
import { Role, Permission } from "@/types/cargo";

interface Props {
    role: Role;
    permissions: Permission[];
}

export default function Edit({ role, permissions }: Props) {
    return (
        <AppLayout
            breadcrumbs={[
                { title: "Roles", href: route("roles.index") },
                { title: "Edit Role", href: route("roles.edit", role.id) }
            ]}
        >
            <Head title="Role Edit" />

            <div className="p-6">
                <h1 className="text-xl font-bold tracking-tight mb-4">Edit Role</h1>
                <RoleForm role={role} permissions={permissions} />
            </div>
        </AppLayout>
    );
}
