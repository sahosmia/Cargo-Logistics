import { TableRowActions } from '@/components/table/TableRowActions';
import type { Column } from '@/types';

interface CategoryType {
    id: number;
    name: string;
    sea_price_start: string;
    sea_price_end: string;
    air_price_start: string;
    air_price_end: string;
}

const columns: Column<CategoryType>[] = [
    {
        header: 'Name',
        accessor: (item) => <span className="font-medium">{item.name}</span>,
    },
    {
        header: 'Sea Price Range',
        accessor: (item) => (
            <span className="text-sm">
                {item.sea_price_start && item.sea_price_end
                    ? `${item.sea_price_start} - ${item.sea_price_end}`
                    : 'N/A'}
            </span>
        ),
    },
    {
        header: 'Air Price Range',
        accessor: (item) => (
            <span className="text-sm">
                {item.air_price_start && item.air_price_end
                    ? `${item.air_price_start} - ${item.air_price_end}`
                    : 'N/A'}
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
                hideView
            />
        ),
        className: 'w-[7%]',
    },
];

export { columns };
