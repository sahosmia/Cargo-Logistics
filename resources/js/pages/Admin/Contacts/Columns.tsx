import type { Column } from '@/types';

interface ContactType {
    id: number;
    name: string;
    email: string;
    message: string;
    created_at: string;
}

const columns: Column<ContactType>[] = [
    {
        header: 'Date',
        accessor: (item) => (
            <span className="whitespace-nowrap">
                {new Date(item.created_at).toLocaleDateString()}
            </span>
        ),
    },
    {
        header: 'Name',
        accessor: (item) => <span className="font-medium">{item.name}</span>,
    },
    {
        header: 'Email',
        accessor: (item) => <span>{item.email}</span>,
    },
    {
        header: 'Message',
        accessor: (item) => (
            <div className="max-w-md truncate" title={item.message}>
                {item.message}
            </div>
        ),
    },
];

export { columns };
