import { usePage } from '@inertiajs/react';
import type { SharedData } from '@/types';
import AppLogoIcon from './app-logo-icon';

export default function AppLogo() {
    const { settings } = usePage<SharedData>().props;
    const rawSettings = settings as any;
    const appName = (rawSettings?.app_name as string) || 'Techpickly';
    let logoUrl = (rawSettings?.sidebar_logo || rawSettings?.logo || rawSettings?.site_logo) as string;

    if (logoUrl && !logoUrl.startsWith('http://') && !logoUrl.startsWith('https://') && !logoUrl.startsWith('/') && !logoUrl.startsWith('data:')) {
        logoUrl = `/storage/${logoUrl}`;
    }

    return (
        <>
            <div className="flex aspect-square size-8 items-center justify-center rounded-md bg-sidebar-primary text-sidebar-primary-foreground overflow-hidden dark:bg-white">
                {logoUrl ? (
                    <img src={logoUrl} alt={appName} className="h-full w-full object-contain" />
                ) : (
                    <AppLogoIcon />
                )}
            </div>
            <div className="ml-1 grid flex-1 text-left text-sm">
                <span className="mb-0.5 truncate leading-tight font-semibold">
                    {appName} Da
                </span>
            </div>
        </>
    );
}
