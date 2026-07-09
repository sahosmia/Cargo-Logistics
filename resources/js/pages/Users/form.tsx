import { useForm } from "@inertiajs/react";
import { Loader2 } from "lucide-react";
import ErrorMessage from "@/components/admin/form/ErrorMessage";
import FormLabel from "@/components/admin/form/FormLabel";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import type { User, Role } from "@/types/cargo";

interface Props {
    user?: User;
    roles: Role[];
}

export default function UserForm({ user, roles }: Props) {

const { data, setData, post, processing, errors } = useForm({
name: user?.name || "",
email: user?.email || "",
phone_number: user?.phone_number || "",
role: (user?.roles && user.roles.length > 0) ? user.roles[0].name : (user?.role || ""),
password: "",
_method: user ? "put" : undefined,
});

// --- Handlers ---

const submit = (e: React.FormEvent) => {
e.preventDefault();
if (user) {
post(route("users.update", user.id), {
forceFormData: true,
});
} else {
post(route("users.store"));
}
};

return (
<form onSubmit={submit} className="space-y-8 p-6 rounded-xl border shadow-sm w-1/2 max-w-125">

    {/* Section 1: Basic Information */}
    <div className="grid grid-cols-1 gap-6">
        <div className="space-y-4">
            <div className="space-y-1">
                <FormLabel required>User Role</FormLabel>
                <Select value={data.role} onValueChange={val=> setData("role", val)}>
                    <SelectTrigger className={errors.role ? "border-destructive" : "" }>
                        <SelectValue placeholder="Select a role" />
                    </SelectTrigger>
                    <SelectContent>
                        {roles.map((role) => (
                            <SelectItem key={role.id} value={role.name}>
                                {role.name}
                            </SelectItem>
                        ))}
                    </SelectContent>
                </Select>
                <ErrorMessage message={errors.role} />
            </div>
            <div className="space-y-1">
                <FormLabel required>Full Name</FormLabel>
                <Input value={data.name} onChange={e=> setData("name", e.target.value)} placeholder="John Doe" />
                <ErrorMessage message={errors.name} />
            </div>

            <div className="space-y-1">
                <FormLabel>Phone</FormLabel>
                <Input value={data.phone_number || ''} onChange={e=> setData("phone_number", e.target.value)} placeholder="01XXXXXXXXX" />
                <ErrorMessage message={errors.phone_number} />
            </div>

            <div className="space-y-1">
                <FormLabel required>Email Address</FormLabel>
                <Input type="email" value={data.email} onChange={e=> setData("email", e.target.value)}
                placeholder="john@example.com" />
                <ErrorMessage message={errors.email} />
            </div>


            <div className="space-y-1">
                <FormLabel required={!user}>Password</FormLabel>
                <Input type="password" value={data.password} onChange={e=> setData("password", e.target.value)}
                placeholder="" />
                <ErrorMessage message={errors.password} />
            </div>


        </div>


    </div>

    {/* Submit */}
    <div className="flex justify-end gap-3 pt-6 border-t">
        <Button variant="ghost" type="button" onClick={()=> window.history.back()}>Cancel</Button>
        <Button type="submit" disabled={processing} className="px-8">
            {processing ?
            <Loader2 className="w-4 h-4 animate-spin mr-2" /> : null}
            {user ? "Save Changes" : "Create User"}
        </Button>
    </div>
</form>
);
}
