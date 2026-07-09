import { useForm } from "@inertiajs/react";
import { Loader2 } from "lucide-react";
import ErrorMessage from "@/components/admin/form/ErrorMessage";
import FormLabel from "@/components/admin/form/FormLabel";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Checkbox } from "@/components/ui/checkbox";
import type { Role, Permission } from "@/types/cargo";

interface Props {
    role?: Role;
    permissions: Permission[];
}

export default function RoleForm({ role, permissions }: Props) {
    const { data, setData, post, processing, errors } = useForm({
        name: role?.name || "",
        permissions: role?.permissions?.map(p => p.name) || [] as string[],
        _method: role ? "put" : undefined,
    });

    const submit = (e: React.FormEvent) => {
        e.preventDefault();
        if (role) {
            post(route("roles.update", role.id), {
                forceFormData: true,
            });
        } else {
            post(route("roles.store"));
        }
    };

    const togglePermission = (permissionName: string) => {
        const current = [...data.permissions];
        const index = current.indexOf(permissionName);
        if (index > -1) {
            current.splice(index, 1);
        } else {
            current.push(permissionName);
        }
        setData("permissions", current);
    };

    const groupedPermissions = permissions.reduce((acc: Record<string, Permission[]>, permission) => {
        let group = "Other";
        const name = permission.name.toLowerCase();

        if (name.includes("booking") || name.includes("status")) {
            if (name.includes("china") || name.includes("measure") || name.includes("price")) group = "China Warehouse";
            else if (name.includes("bd") || name.includes("payment") || name.includes("delivery")) group = "BD Warehouse";
            else group = "Booking Management";
        } else if (name.includes("user") || name.includes("role")) {
            group = "User Management";
        } else if (name.includes("setting")) {
            group = "Settings";
        }

        if (!acc[group]) acc[group] = [];
        acc[group].push(permission);
        return acc;
    }, {});

    const groupOrder = ["Booking Management", "China Warehouse", "BD Warehouse", "User Management", "Settings", "Other"];

    return (
        <form onSubmit={submit} className="space-y-8 p-6 rounded-xl border shadow-sm max-w-4xl">
            <div className="space-y-4">
                <div className="space-y-1">
                    <FormLabel required>Role Name</FormLabel>
                    <Input value={data.name} onChange={e => setData("name", e.target.value)} placeholder="e.g. Manager" />
                    <ErrorMessage message={errors.name} />
                </div>

                <div className="space-y-6">
                    <FormLabel>Permissions</FormLabel>

                    <div className="space-y-6">
                        {groupOrder.map((group) => {
                            const groupPermissions = groupedPermissions[group];
                            if (!groupPermissions || groupPermissions.length === 0) return null;

                            return (
                                <div key={group} className="space-y-3">
                                    <h3 className="text-sm font-semibold text-muted-foreground border-b pb-1 uppercase tracking-wider">
                                        {group}
                                    </h3>
                                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        {groupPermissions.map((permission) => (
                                            <div key={permission.id} className="flex items-center space-x-2">
                                                <Checkbox
                                                    id={`permission-${permission.id}`}
                                                    checked={data.permissions.includes(permission.name)}
                                                    onCheckedChange={() => togglePermission(permission.name)}
                                                />
                                                <label
                                                    htmlFor={`permission-${permission.id}`}
                                                    className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 capitalize cursor-pointer"
                                                >
                                                    {permission.name}
                                                </label>
                                            </div>
                                        ))}
                                    </div>
                                </div>
                            );
                        })}
                    </div>

                    <ErrorMessage message={errors.permissions} />
                </div>
            </div>

            <div className="flex justify-end gap-3 pt-6 border-t">
                <Button variant="ghost" type="button" onClick={() => window.history.back()}>Cancel</Button>
                <Button type="submit" disabled={processing} className="px-8">
                    {processing ? <Loader2 className="w-4 h-4 animate-spin mr-2" /> : null}
                    {role ? "Save Changes" : "Create Role"}
                </Button>
            </div>
        </form>
    );
}
