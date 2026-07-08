import { TableRowActions } from '@/components/table/TableRowActions';
import { Badge } from '@/components/ui/badge';
import type { Column } from '@/types';

interface DistrictType {
    id: number;
    name: string;
    code: string | null;
    status: boolean;
}

const columns: Column<DistrictType>[] = [
    {
        header: 'Name',
        accessor: (item) => <span className="font-medium">{item.name}</span>,
    },
    {
        header: 'Code',
        accessor: (item) => <span className="text-sm">{item.code || 'N/A'}</span>,
    },
    {
        header: 'Status',
        accessor: (item) => (
            <Badge variant={item.status ? 'default' : 'secondary'}>
                {item.status ? 'Active' : 'Inactive'}
            </Badge>
        ),
    },
    {
        header: '',
        accessor: (item) => (
            <TableRowActions
                item={item}
                resource="districts"
                label="District"
                hideView
            />
        ),
        className: 'w-[7%]',
    },
];

export { columns };
