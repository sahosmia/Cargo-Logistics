import { useForm, usePage } from '@inertiajs/react'; // Form-এর জায়গায় useForm ইম্পোর্ট করুন
import { useRef } from 'react';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { type SharedData } from '@/types';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

export default function DeleteUser() {
    const { auth } = usePage<SharedData>().props;
    const passwordInput = useRef<HTMLInputElement>(null);

    // Inertia useForm হুক ব্যবহার করুন
    const {
        data,
        setData,
        delete: destroy,
        processing,
        errors,
        reset,
        clearErrors,
    } = useForm({
        password: '',
    });

    const deleteUser = (e: React.FormEvent) => {
        e.preventDefault();

        // লারাভেলের প্রোফাইল ডিলিট করার সঠিক রাউট নামটি এখানে বসান (যেমন: profile.destroy)
        destroy(route('profile.destroy'), {
            preserveScroll: true,
            onSuccess: () => reset(),
            onError: () => passwordInput.current?.focus(),
        });
    };

    return (
        <div className="space-y-6">
            <Heading
                variant="small"
                title="Delete account"
                description="Delete your account and all of its resources"
            />
            <div className="space-y-4 rounded-lg border border-red-100 bg-red-50 p-4 dark:border-red-200/10 dark:bg-red-700/10">
                <div className="relative space-y-0.5 text-red-600 dark:text-red-100">
                    <p className="font-medium">Warning</p>
                    <p className="text-sm">
                        Please proceed with caution, this cannot be undone.
                    </p>
                </div>

                <Dialog>
                    <DialogTrigger asChild>
                        <Button
                            variant="destructive"
                            data-test="delete-user-button"
                        >
                            Delete account
                        </Button>
                    </DialogTrigger>
                    <DialogContent>
                        <DialogTitle>
                            Are you sure you want to delete your account?
                        </DialogTitle>
                        <DialogDescription>
                            Once your account is deleted, all of its resources
                            and data will also be permanently deleted.
                            {auth.guard !== 'customer' && " Please enter your password to confirm you would like to permanently delete your account."}
                        </DialogDescription>

                        {/* স্ট্যান্ডার্ড HTML Form এবং ওন-সাবমিট হ্যান্ডলার */}
                        <form onSubmit={deleteUser} className="space-y-6">
                            {auth.guard !== 'customer' && (
                                <div className="grid gap-2">
                                    <Label
                                        htmlFor="password"
                                        className="sr-only"
                                    >
                                        Password
                                    </Label>

                                    <Input
                                        id="password"
                                        type="password"
                                        name="password"
                                        ref={passwordInput}
                                        value={data.password}
                                        onChange={(e) => setData('password', e.target.value)}
                                        placeholder="Password"
                                        autoComplete="current-password"
                                    />

                                    <InputError message={errors.password} />
                                </div>
                            )}

                            <DialogFooter className="gap-2">
                                <DialogClose asChild>
                                    <Button
                                        type="button"
                                        variant="secondary"
                                        onClick={() => {
                                            reset();
                                            clearErrors();
                                        }}
                                    >
                                        Cancel
                                    </Button>
                                </DialogClose>

                                <Button
                                    type="submit"
                                    variant="destructive"
                                    disabled={processing}
                                    data-test="confirm-delete-user-button"
                                >
                                    Delete account
                </Button>
                            </DialogFooter>
                        </form>
                    </DialogContent>
                </Dialog>
            </div>
        </div>
    );
}
