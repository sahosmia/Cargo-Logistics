import { Head } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Breadcrumb, BreadcrumbItem, BreadcrumbLink, BreadcrumbList, BreadcrumbPage, BreadcrumbSeparator } from '@/components/ui/breadcrumb';

interface Contact {
    id: number;
    name: string;
    email: string;
    message: string;
    created_at: string;
}

interface Props {
    contacts: {
        data: Contact[];
        links: any[];
        total: number;
        current_page: number;
    };
}

export default function Index({ contacts }: Props) {
    return (
        <AppLayout>
            <Head title="Contacts" />
            
            <div className="flex flex-col gap-4 p-4">
                <Breadcrumb>
                    <BreadcrumbList>
                        <BreadcrumbItem>
                            <BreadcrumbLink href={route('dashboard')}>Dashboard</BreadcrumbLink>
                        </BreadcrumbItem>
                        <BreadcrumbSeparator />
                        <BreadcrumbItem>
                            <BreadcrumbPage>Contacts</BreadcrumbPage>
                        </BreadcrumbItem>
                    </BreadcrumbList>
                </Breadcrumb>

                <div className="rounded-md border bg-card text-card-foreground shadow-sm">
                    <div className="p-6">
                        <h3 className="text-lg font-semibold leading-none tracking-tight mb-4">Contact Submissions</h3>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Date</TableHead>
                                    <TableHead>Name</TableHead>
                                    <TableHead>Email</TableHead>
                                    <TableHead>Message</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {contacts.data.length > 0 ? (
                                    contacts.data.map((contact) => (
                                        <TableRow key={contact.id}>
                                            <TableCell className="whitespace-nowrap">
                                                {new Date(contact.created_at).toLocaleDateString()}
                                            </TableCell>
                                            <TableCell className="font-medium">{contact.name}</TableCell>
                                            <TableCell>{contact.email}</TableCell>
                                            <TableCell className="max-w-md truncate" title={contact.message}>
                                                {contact.message}
                                            </TableCell>
                                        </TableRow>
                                    ))
                                ) : (
                                    <TableRow>
                                        <TableCell colSpan={4} className="h-24 text-center">
                                            No contact submissions found.
                                        </TableCell>
                                    </TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
