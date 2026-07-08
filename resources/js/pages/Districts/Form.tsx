import { useForm } from "@inertiajs/react";
import { Loader2 } from "lucide-react";
import ErrorMessage from "@/components/admin/form/ErrorMessage";
import FormLabel from "@/components/admin/form/FormLabel";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Checkbox } from "@/components/ui/checkbox";

interface District {
    id: number;
    name: string;
    code: string | null;
    status: boolean;
}

interface Props { district?: District; }

export default function DistrictForm({ district }: Props) {
    const { data, setData, post, processing, errors } = useForm({
        name: district?.name || "",
        code: district?.code || "",
        status: district ? district.status : true,
        _method: district ? "put" : undefined,
    });

    const submit = (e: React.FormEvent) => {
        e.preventDefault();
        if (district) {
            post(route("districts.update", district.id), {
                forceFormData: true,
            });
        } else {
            post(route("districts.store"));
        }
    };

    return (
        <form onSubmit={submit} className="space-y-8 p-6 rounded-xl border shadow-sm w-1/2 max-w-125">
            <div className="grid grid-cols-1 gap-6">
                <div className="space-y-4">
                    <div className="space-y-1">
                        <FormLabel required>District Name</FormLabel>
                        <Input value={data.name} onChange={e => setData("name", e.target.value)} placeholder="Dhaka" />
                        <ErrorMessage message={errors.name} />
                    </div>

                    <div className="space-y-1">
                        <FormLabel>Code</FormLabel>
                        <Input value={data.code} onChange={e => setData("code", e.target.value)} placeholder="DHK" />
                        <ErrorMessage message={errors.code} />
                    </div>

                    <div className="flex items-center space-x-2">
                        <Checkbox id="status" checked={data.status} onCheckedChange={(checked) => setData("status", !!checked)} />
                        <label htmlFor="status" className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Active</label>
                        <ErrorMessage message={errors.status} />
                    </div>
                </div>
            </div>

            <div className="flex justify-end gap-3 pt-6 border-t">
                <Button variant="ghost" type="button" onClick={() => window.history.back()}>Cancel</Button>
                <Button type="submit" disabled={processing} className="px-8">
                    {processing ? <Loader2 className="w-4 h-4 animate-spin mr-2" /> : null}
                    {district ? "Save Changes" : "Create District"}
                </Button>
            </div>
        </form>
    );
}
