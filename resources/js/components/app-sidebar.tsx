import { Link, usePage } from '@inertiajs/react';
import {
    LayoutDashboard,
    UserCog,
    Settings,
    Grid2X2,
    MapPin
} from 'lucide-react';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import type { NavItem } from '@/types';
import AppLogo from './app-logo';


export function AppSidebar() {

    const { auth } = usePage().props;
    const userRole = auth.user.role;



    const mainNavItems: NavItem[] = [
        { title: 'Dashboard', href: route('dashboard'), icon: LayoutDashboard },
        {
            title: 'Categories',
            href: route('categories.index'),
            icon: Grid2X2,
        },
        {
            title: 'Districts',
            href: route('districts.index'),
            icon: MapPin,
        },
        {
            title: 'Users',
            href: route('users.index'),
            icon: UserCog,
            // hidden: userRole !== 'super_admin'
        },
        {
            title: 'Global Settings',
            href: route('admin.settings.index'),
            icon: Settings,
            // hidden: userRole !== 'super_admin'
        },


    ];

    const visibleNavItems = mainNavItems.filter(item => !item.hidden);

    return (
        <Sidebar collapsible="icon" variant="sidebar">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href={route('dashboard')} prefetch={false}>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={visibleNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
