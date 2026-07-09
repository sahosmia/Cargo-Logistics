import { Head } from "@inertiajs/react";
import AppLayout from "@/layouts/app-layout";
import UserForm from "./form";
import { User, Role } from "@/types/cargo";



interface Props {
    user: User;
    roles: Role[];
}

export default function Edit({ user, roles }: Props) {
    return (
        <AppLayout
            breadcrumbs={[
                { title: "Users", href: route("users.index") },
                { title: "Edit User", href: route("users.edit", user.id) }
            ]}
        >

            <Head title="User Edit" />

            <div className="p-6">
                <h1 className="text-xl font-bold tracking-tight mb-4">Edit User</h1>

                <UserForm user={user} roles={roles} />
            </div>
        </AppLayout>
    );
}
