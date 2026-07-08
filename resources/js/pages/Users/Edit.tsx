import { Head } from "@inertiajs/react";
import AppLayout from "@/layouts/app-layout";
import UserForm from "./form";
import { User } from "@/types";



interface Props {
    user: User;
}

export default function Edit({ user }: Props) {
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

                <UserForm user={user} />
            </div>
        </AppLayout>
    );
}
