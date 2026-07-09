import type { Column } from '@/types';
import { Badge } from '@/components/ui/badge';
import { cn } from '@/lib/utils';

export const columns: Column<any>[] = [
    {
        header: 'Item',
        accessor: (item) => (
            <div className="flex flex-col">
                <span className="font-medium text-foreground">{item.item_name}</span>
                <span className="text-xs text-muted-foreground">{item.method}</span>
            </div>
        ),
    },
    {
        header: 'Category',
        accessor: (item) => item.category?.name || 'N/A',
    },
    {
        header: 'Weight',
        accessor: (item) => `${item.total_weight} Kg`,
    },
    {
        header: 'District',
        accessor: (item) => item.district?.name || 'N/A',
    },
    {
        header: 'Status',
        accessor: (item) => (
            <Badge
                variant="secondary"
                className={cn(
                    "capitalize",
                    item.status === 'pending' && "bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400",
                    item.status === 'received' && "bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400",
                    item.status === 'shipped' && "bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400",
                    item.status === 'delivered' && "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400",
                )}
            >
                {item.status}
            </Badge>
        ),
    },
    {
        header: 'Date',
        accessor: (item) => new Date(item.created_at).toLocaleDateString(),
    },
];
