import { TableRowActions } from '@/components/table/TableRowActions';
import type { Column } from '@/types';

interface CategoryType {
    id: number;
    name: string;
    price_start: string;
    price_end: string;
}

const columns: Column<CategoryType>[] = [
    {
        header: 'Name',
        accessor: (item) => <span className="font-medium">{item.name}</span>,
    },
    {
        header: 'Price Range',
        accessor: (item) => (
            <span className="text-sm">
                {item.price_start} - {item.price_end}
            </span>
        ),
    },
    {
        header: '',
        accessor: (item) => (
            <TableRowActions
                item={item}
                resource="categories"
                label="Category"
            />
        ),
        className: 'w-[7%]',
    },
];

export { columns };
