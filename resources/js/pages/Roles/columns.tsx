import { Badge } from "@/components/ui/badge";
import { EditResourceButton, DeleteResourceButton } from "@/components/shared/resource-actions";
import { Role } from "@/types/cargo";
import { Column } from "@/types";

export const columns: Column<Role>[] = [
    {
        header: "Name",
        accessor: (item) => (
            <div className="font-medium text-foreground">{item.name}</div>
        ),
    },
    {
        header: "Permissions",
        accessor: (item) => (
            <div className="flex flex-wrap gap-1 max-w-md">
                {item.permissions?.map((p) => (
                    <Badge key={p.id} variant="secondary" className="text-[10px] capitalize">
                        {p.name}
                    </Badge>
                ))}
                {(!item.permissions || item.permissions.length === 0) && (
                    <span className="text-muted-foreground text-xs">No permissions</span>
                )}
            </div>
        ),
    },
    {
        header: "Actions",
        accessor: (item) => (
            <div className="flex gap-2">
                <EditResourceButton href={route("roles.edit", item.id)} />
                <DeleteResourceButton
                    id={item.id}
                    routeName="roles.index"
                    label="Role"
                />
            </div>
        ),
    },
];
