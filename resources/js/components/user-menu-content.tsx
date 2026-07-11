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
                <DropdownMenuItem asChild>
                    <form
                        action={route('customer.logout')}
                        method="POST"
                        className="w-full"
                        onSubmit={handleLogout}
                    >
                        <input
                            type="hidden"
                            name="_token"
                            value={
                                document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                            }
                        />
                        <button
                            type="submit"
                            className="flex w-full cursor-pointer items-center rounded-sm px-2 py-1.5 text-sm outline-hidden transition-colors hover:bg-accent hover:text-accent-foreground data-disabled:pointer-events-none data-disabled:opacity-50"
                            data-test="logout-button"
                        >
                            <LogOut className="mr-2 h-4 w-4" />
                            Log out
                        </button>
                    </form>
                </DropdownMenuItem>
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
