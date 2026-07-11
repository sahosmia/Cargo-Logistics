import { Head, useForm } from '@inertiajs/react';
import { Building2, Mail, Phone, MapPin, Settings2, Image as ImageIcon, ShieldCheck, Globe, MessageSquare, FileText, LayoutList, UserCheck } from 'lucide-react';
import { useState } from 'react';
import FormLabel from '@/components/admin/form/FormLabel';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/app-layout';
import type { SettingsForm, SettingType } from '@/types';

interface Props {
    settings: SettingType;
}

const BREADCRUMBS = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Global Settings', href: '#' },
];

const PAGINATION_OPTIONS = ['5', '10', '20', '50', '100'];

export default function Index({ settings }: Props) {
    const { data, setData, post, processing, errors } = useForm<SettingsForm>({
        site_logo: null,
        favicon: null,
        hero_banner: null,
        app_name: (settings.app_name as string) || '',
        email: (settings.email as string) || '',
        phone: (settings.phone as string) || '',
        address: (settings.address as string) || '',
        website_url: (settings.website_url as string) || '',
        warehouses: (settings.warehouses as string) || '',
        office_hours: (settings.office_hours as string) || '',

        paginated_quantity: (settings.paginated_quantity as string) || '10',
    });

    const [previews, setPreviews] = useState({
        site_logo: settings.site_logo ? `/storage/${settings.site_logo}` : null,
        favicon: settings.favicon ? `/storage/${settings.favicon}` : null,
        hero_banner: settings.hero_banner ? `/storage/${settings.hero_banner}` : null,
    });

    const handleFileChange = (key: keyof SettingsForm, e: React.ChangeEvent<HTMLInputElement>) => {
        const file = e.target.files?.[0];
        if (file) {
            setData(key, file);
            setPreviews((prev) => ({ ...prev, [key]: URL.createObjectURL(file) }));
        }
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('admin.settings.update'));
    };

    return (
        <AppLayout breadcrumbs={BREADCRUMBS}>
            <Head title="Global Settings" />

            <div className="flex-1 space-y-6 p-4 md:p-8">
                <div className="flex items-center justify-between">
                    <h2 className="text-3xl font-bold tracking-tight">Global Settings</h2>
                </div>

                <form onSubmit={handleSubmit} className="space-y-8">
                    {/* General Settings */}
                    <Card>
                        <CardHeader>
                            <div className="flex items-center gap-2">
                                <Settings2 className="h-5 w-5 text-muted-foreground" />
                                <CardTitle>General Settings</CardTitle>
                            </div>
                            <CardDescription>
                                Configure basic application information and branding.
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="space-y-6">
                            <div className="grid gap-6 md:grid-cols-2">
                                <div className="space-y-2">
                                    <FormLabel required>Application Name</FormLabel>
                                    <Input
                                        value={data.app_name}
                                        onChange={(e) => setData('app_name', e.target.value)}
                                        placeholder="Enter application name"
                                    />
                                    <InputError message={errors.app_name} />
                                </div>

                            </div>

                            <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                                {/* site Logo */}
                                <div className="space-y-2">
                                    <FormLabel>Site Logo</FormLabel>
                                    <div className="flex flex-col gap-4">
                                        <div className="relative h-32 w-full overflow-hidden rounded-lg border bg-muted flex items-center justify-center">
                                            {previews.site_logo ? (
                                                <img
                                                    src={previews.site_logo}
                                                    alt="Logo preview"
                                                    className="max-h-full max-w-full object-contain"
                                                />
                                            ) : (
                                                <ImageIcon className="h-10 w-10 text-muted-foreground" />
                                            )}
                                        </div>
                                        <Input
                                            type="file"
                                            accept="image/*"
                                            onChange={(e) => handleFileChange('site_logo', e)}
                                        />
                                        <InputError message={errors.site_logo} />
                                    </div>
                                </div>

                                {/* Favicon */}
                                <div className="space-y-2">
                                    <FormLabel>Favicon</FormLabel>
                                    <div className="flex flex-col gap-4">
                                        <div className="relative h-32 w-full overflow-hidden rounded-lg border bg-muted flex items-center justify-center">
                                            {previews.favicon ? (
                                                <img
                                                    src={previews.favicon}
                                                    alt="Favicon preview"
                                                    className="h-10 w-10 object-contain"
                                                />
                                            ) : (
                                                <ImageIcon className="h-10 w-10 text-muted-foreground" />
                                            )}
                                        </div>
                                        <Input
                                            type="file"
                                            accept="image/*"
                                            onChange={(e) => handleFileChange('favicon', e)}
                                        />
                                        <InputError message={errors.favicon} />
                                    </div>
                                </div>

                                {/* Hero Banner */}
                                <div className="space-y-2">
                                    <FormLabel>Home Page Hero Banner</FormLabel>
                                    <div className="flex flex-col gap-4">
                                        <div className="relative h-32 w-full overflow-hidden rounded-lg border bg-muted flex items-center justify-center">
                                            {previews.hero_banner ? (
                                                <img
                                                    src={previews.hero_banner}
                                                    alt="Hero banner preview"
                                                    className="max-h-full max-w-full object-contain"
                                                />
                                            ) : (
                                                <ImageIcon className="h-10 w-10 text-muted-foreground" />
                                            )}
                                        </div>
                                        <Input
                                            type="file"
                                            accept="image/*"
                                            onChange={(e) => handleFileChange('hero_banner', e)}
                                        />
                                        <InputError message={errors.hero_banner} />
                                    </div>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    {/* Contact & Links */}
                    <Card>
                        <CardHeader>
                            <div className="flex items-center gap-2">
                                <Building2 className="h-5 w-5 text-muted-foreground" />
                                <CardTitle>Contact & Links</CardTitle>
                            </div>
                            <CardDescription>
                                Set the contact details and web links for branding and reports.
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="space-y-6">
                            <div className="grid gap-6 md:grid-cols-2">
                                <div className="space-y-2">
                                    <FormLabel>
                                        <div className="flex items-center gap-1">
                                            <Mail className="h-3 w-3" />
                                            Support Email
                                        </div>
                                    </FormLabel>
                                    <Input
                                        type="email"
                                        value={data.email}
                                        onChange={(e) => setData('email', e.target.value)}
                                        placeholder="contact@company.com"
                                    />
                                    <InputError message={errors.email} />
                                </div>

                                <div className="space-y-2">
                                    <FormLabel>
                                        <div className="flex items-center gap-1">
                                            <Phone className="h-3 w-3" />
                                            Phone Number
                                        </div>
                                    </FormLabel>
                                    <Input
                                        value={data.phone}
                                        onChange={(e) => setData('phone', e.target.value)}
                                        placeholder="+1 (555) 000-0000"
                                    />
                                    <InputError message={errors.phone} />
                                </div>

                                <div className="space-y-2">
                                    <FormLabel>
                                        <div className="flex items-center gap-1">
                                            <Globe className="h-3 w-3" />
                                            Website URL
                                        </div>
                                    </FormLabel>
                                    <Input
                                        type="url"
                                        value={data.website_url}
                                        onChange={(e) => setData('website_url', e.target.value)}
                                        placeholder="https://www.example.com"
                                    />
                                    <InputError message={errors.website_url} />
                                </div>

                                <div className="space-y-2">
                                    <FormLabel>
                                        <div className="flex items-center gap-1">
                                            <Building2 className="h-3 w-3" />
                                            Warehouses
                                        </div>
                                    </FormLabel>
                                    <Input
                                        value={data.warehouses}
                                        onChange={(e) => setData('warehouses', e.target.value)}
                                        placeholder="Guangzhou, Hongkong, Dubai"
                                    />
                                    <InputError message={errors.warehouses} />
                                </div>

                                <div className="space-y-2">
                                    <FormLabel>
                                        <div className="flex items-center gap-1">
                                            <ShieldCheck className="h-3 w-3" />
                                            Office Hours
                                        </div>
                                    </FormLabel>
                                    <Input
                                        value={data.office_hours}
                                        onChange={(e) => setData('office_hours', e.target.value)}
                                        placeholder="Sat - Thurs: 09.30 AM - 06.30 PM"
                                    />
                                    <InputError message={errors.office_hours} />
                                </div>

                                {/* <div className="space-y-2">
                                    <FormLabel>
                                        <div className="flex items-center gap-1">
                                            <MessageSquare className="h-3 w-3" />
                                            Support WhatsApp (Mobile number)
                                        </div>
                                    </FormLabel>
                                    <Input
                                        value={data.support_whatsapp}
                                        onChange={(e) => setData('support_whatsapp', e.target.value)}
                                        placeholder="01911-561554"
                                    />
                                    <InputError message={errors.support_whatsapp} />
                                </div> */}
                            </div>

                            <div className="space-y-2">
                                <FormLabel>
                                    <div className="flex items-center gap-1">
                                        <MapPin className="h-3 w-3" />
                                        Default Corporate Address
                                    </div>
                                </FormLabel>
                                <Textarea
                                    value={data.address}
                                    onChange={(e) => setData('address', e.target.value)}
                                    placeholder="Enter full corporate address"
                                    rows={2}
                                />
                                <InputError message={errors.address} />
                            </div>



                             {/* <div className="grid gap-6 md:grid-cols-3"> */}
                                {/* Office 1 */}
                                {/* <div className="space-y-3 border-r pr-4">
                                    <div className="space-y-1">
                                        <FormLabel>Office 1 Name</FormLabel>
                                        <Input
                                            value={data.office_name_1}
                                            onChange={(e) => setData('office_name_1', e.target.value)}
                                            placeholder="Elephant Road Branch"
                                        />
                                    </div>
                                    <div className="space-y-1">
                                        <FormLabel>Office 1 Address</FormLabel>
                                        <Textarea
                                            value={data.office_address_1}
                                            onChange={(e) => setData('office_address_1', e.target.value)}
                                            placeholder="Address line..."
                                            rows={3}
                                        />
                                    </div>
                                </div> */}

                                {/* Office 2 */}
                                {/* <div className="space-y-3 border-r px-4">
                                    <div className="space-y-1">
                                        <FormLabel>Office 2 Name</FormLabel>
                                        <Input
                                            value={data.office_name_2}
                                            onChange={(e) => setData('office_name_2', e.target.value)}
                                            placeholder="Corporate Office"
                                        />
                                    </div>
                                    <div className="space-y-1">
                                        <FormLabel>Office 2 Address</FormLabel>
                                        <Textarea
                                            value={data.office_address_2}
                                            onChange={(e) => setData('office_address_2', e.target.value)}
                                            placeholder="Address line..."
                                            rows={3}
                                        />
                                    </div>
                                </div> */}

                                {/* Office 3 */}
                                {/* <div className="space-y-3 pl-4">
                                    <div className="space-y-1">
                                        <FormLabel>Office 3 Name</FormLabel>
                                        <Input
                                            value={data.office_name_3}
                                            onChange={(e) => setData('office_name_3', e.target.value)}
                                            placeholder="Service Centre"
                                        />
                                    </div>
                                    <div className="space-y-1">
                                        <FormLabel>Office 3 Address</FormLabel>
                                        <Textarea
                                            value={data.office_address_3}
                                            onChange={(e) => setData('office_address_3', e.target.value)}
                                            placeholder="Address line..."
                                            rows={3}
                                        />
                                    </div>
                                </div> */}
                            {/* </div> */}
                        </CardContent>
                    </Card>




                    {/* System Configurations */}
                    <Card>
                        <CardHeader>
                            <div className="flex items-center gap-2">
                                <Settings2 className="h-5 w-5 text-muted-foreground" />
                                <CardTitle>System Configurations</CardTitle>
                            </div>
                            <CardDescription>
                                Technical settings for application behavior.
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="space-y-6">
                            <div className="max-w-xs space-y-2">
                                <FormLabel required>Default Paginated Quantity</FormLabel>
                                <Select
                                    value={String(data.paginated_quantity)}
                                    onValueChange={(value) => setData('paginated_quantity', value)}
                                >
                                    <SelectTrigger>
                                        <SelectValue placeholder="Select quantity" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        {PAGINATION_OPTIONS.map((option) => (
                                            <SelectItem key={option} value={option}>
                                                {option}
                                            </SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                                <p className="text-xs text-muted-foreground">
                                    Number of records shown per page in tables.
                                </p>
                                <InputError message={errors.paginated_quantity} />
                            </div>
                        </CardContent>
                    </Card>

                    <div className="flex justify-end gap-4">
                        <Button type="submit" disabled={processing}>
                            {processing ? 'Saving Changes...' : 'Save Settings'}
                        </Button>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
