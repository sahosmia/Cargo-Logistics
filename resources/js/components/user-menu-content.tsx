import { Link, router } from '@inertiajs/react';
import { LogOut, Settings } from 'lucide-react';
import {
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
} from '@/components/ui/dropdown-menu';
import { UserInfo } from '@/components/user-info';
import { useMobileNavigation } from '@/hooks/use-mobile-navigation';
import type { User } from '@/types';

type Props = {
    user: User;
};

export function UserMenuContent({ user }: Props) {
    const cleanup = useMobileNavigation();

    const handleLogout = () => {
        cleanup();
        router.flushAll();
    };

    return (
        <>
            <DropdownMenuLabel className="p-0 font-normal">
                <div className="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                    <UserInfo user={user} showEmail={true} />
                </div>
            </DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuGroup>
                <DropdownMenuItem asChild>
                    <Link
                        className="block w-full cursor-pointer"
                        href={route('profile.edit')}
                        prefetch
                        onClick={cleanup}
                    >
                        <Settings className="mr-2" />
                        Settings
                    </Link>
                </DropdownMenuItem>
            </DropdownMenuGroup>
            <DropdownMenuSeparator />
            {user.role === 'customer' ? (
                <>
                    <form id="customer-logout-form" action={route('customer.logout')} method="POST" style={{ display: 'none' }}>
                        <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''} />
                    </form>
                    <DropdownMenuItem asChild>
                        <button
                            type="button"
                            className="block w-full cursor-pointer text-left"
                            onClick={(e) => {
                                e.preventDefault();
                                cleanup();
                                const form = document.getElementById('customer-logout-form') as HTMLFormElement;
                                if (form) {
                                    form.submit();
                                }
                            }}
                            data-test="logout-button"
                        >
                            <span className="flex items-center">
                                <LogOut className="mr-2 h-4 w-4" />
                                Log out
                            </span>
                        </button>
                    </DropdownMenuItem>
                </>
            ) : (
                <DropdownMenuItem asChild>
                    <Link
                        className="block w-full cursor-pointer"
                        href={route('logout')}
                        method="post"
                        as="button"
                        onClick={handleLogout}
                        data-test="logout-button"
                    >
                        <LogOut className="mr-2" />
                        Log out
                    </Link>
                </DropdownMenuItem>
            )}
        </>
    );
}
