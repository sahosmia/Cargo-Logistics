import { useForm } from "@inertiajs/react";
import { Loader2 } from "lucide-react";
import ErrorMessage from "@/components/admin/form/ErrorMessage";
import FormLabel from "@/components/admin/form/FormLabel";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";

interface Category {
    id: number;
    name: string;
    sea_price_start: string;
    sea_price_end: string;
    air_price_start: string;
    air_price_end: string;
}

interface Props { category?: Category; }

export default function CategoryForm({ category }: Props) {
    const { data, setData, post, processing, errors } = useForm({
        name: category?.name || "",
        sea_price_start: category?.sea_price_start || "",
        sea_price_end: category?.sea_price_end || "",
        air_price_start: category?.air_price_start || "",
        air_price_end: category?.air_price_end || "",
        _method: category ? "put" : undefined,
    });

    const submit = (e: React.FormEvent) => {
        e.preventDefault();
        if (category) {
            post(route("categories.update", category.id), {
                forceFormData: true,
            });
        } else {
            post(route("categories.store"));
        }
    };

    return (
        <form onSubmit={submit} className="space-y-8 p-6 rounded-xl border shadow-sm w-1/2 max-w-125">
            <div className="grid grid-cols-1 gap-6">
                <div className="space-y-4">
                    <div className="space-y-1">
                        <FormLabel required>Category Name</FormLabel>
                        <Input value={data.name} onChange={e => setData("name", e.target.value)} placeholder="Electronics" />
                        <ErrorMessage message={errors.name} />
                    </div>

                    <div className="grid grid-cols-2 gap-4">
                        <div className="space-y-1">
                            <FormLabel>Sea Price Min</FormLabel>
                            <Input type="number" step="0.01" value={data.sea_price_start} onChange={e => setData("sea_price_start", e.target.value)} placeholder="0.00" />
                            <ErrorMessage message={errors.sea_price_start} />
                        </div>

                        <div className="space-y-1">
                            <FormLabel>Sea Price Max</FormLabel>
                            <Input type="number" step="0.01" value={data.sea_price_end} onChange={e => setData("sea_price_end", e.target.value)} placeholder="0.00" />
                            <ErrorMessage message={errors.sea_price_end} />
                        </div>
                    </div>

                    <div className="grid grid-cols-2 gap-4">
                        <div className="space-y-1">
                            <FormLabel>Air Price Min</FormLabel>
                            <Input type="number" step="0.01" value={data.air_price_start} onChange={e => setData("air_price_start", e.target.value)} placeholder="0.00" />
                            <ErrorMessage message={errors.air_price_start} />
                        </div>

                        <div className="space-y-1">
                            <FormLabel>Air Price Max</FormLabel>
                            <Input type="number" step="0.01" value={data.air_price_end} onChange={e => setData("air_price_end", e.target.value)} placeholder="0.00" />
                            <ErrorMessage message={errors.air_price_end} />
                        </div>
                    </div>
                </div>
            </div>

            <div className="flex justify-end gap-3 pt-6 border-t">
                <Button variant="ghost" type="button" onClick={() => window.history.back()}>Cancel</Button>
                <Button type="submit" disabled={processing} className="px-8">
                    {processing ? <Loader2 className="w-4 h-4 animate-spin mr-2" /> : null}
                    {category ? "Save Changes" : "Create Category"}
                </Button>
            </div>
        </form>
    );
}
