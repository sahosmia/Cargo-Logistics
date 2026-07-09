import { Head } from "@inertiajs/react";
import AppLayout from "@/layouts/app-layout";
import { columns } from "./columns";
import { Role } from "@/types/cargo";
import { PaginationType } from "@/types";
import CommonTable from "@/components/admin/CommonTable";
import Heading from "@/components/admin/heading";

interface Props {
    roles: PaginationType<Role>;
}

export default function Index({ roles }: Props) {
    const breadcrumbs = [
        { title: 'Dashboard', href: route('dashboard') },
        { title: 'Roles', href: route('roles.index') },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Roles" />

            <div className="flex flex-col flex-1 h-full gap-4 p-4 overflow-x-auto">
                <Heading
                    title={`Roles (${roles.total})`}
                    description="Manage application roles and permissions."
                />

                <CommonTable
                    data={roles}
                    columns={columns}
                    create_route="roles.create"
                    routeName="roles.index"
                    entityName="Role"
                />
            </div>
        </AppLayout>
    );
}
