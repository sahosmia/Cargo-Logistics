import { Link } from "@inertiajs/react";
import { SquarePen, Trash2 } from "lucide-react";
import { AlertDialogDestructive } from "@/components/admin/AlertDialogDestructive";
import { Button } from "@/components/ui/button";
import { handleDelete } from "@/utils/table";

interface DeleteButtonProps {
    id: number | string;
    routeName: string;
    label?: string;
    redirectTo?: string;
}

export function DeleteResourceButton({ id, routeName, label = "Item", redirectTo }: DeleteButtonProps) {
    return (
        <AlertDialogDestructive
            title={`Delete ${label}?`}
            description={`This action cannot be undone. All data associated with this ${label.toLowerCase()} will be permanently removed.`}
            onConfirm={() => handleDelete(id, routeName, { redirectTo })}
        >
            <Button variant="destructive">
                <Trash2 className="w-4 h-4 mr-2" /> Delete
            </Button>
        </AlertDialogDestructive>
    );
}

interface EditButtonProps {
    href: string;
    label?: string;
}

export function EditResourceButton({ href, label = "Edit" }: EditButtonProps) {
    return (
        <Button variant="outline" asChild>
            <Link href={href}>
                <SquarePen className="w-4 h-4 mr-2" /> {label}
            </Link>
        </Button>
    );
}
