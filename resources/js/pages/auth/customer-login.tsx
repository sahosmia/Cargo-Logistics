import { Head, useForm } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import { FormEventHandler, useEffect, useState } from 'react';

import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/auth-layout';

interface CustomerLoginForm {
    phone_number: string;
    otp: string;
    remember: boolean;
}

export default function CustomerLogin() {
    const [step, setStep] = useState<'phone' | 'otp'>('phone');
    const [countdown, setCountdown] = useState(0);
    const [isCounting, setIsCounting] = useState(false);

    const { data, setData, post, processing, errors, reset, clearErrors } = useForm<CustomerLoginForm>({
        phone_number: '',
        otp: '',
        remember: false,
    });

    useEffect(() => {
        let timer: NodeJS.Timeout;
        if (isCounting && countdown > 0) {
            timer = setInterval(() => {
                setCountdown((prev) => prev - 1);
            }, 1000);
        } else if (countdown === 0) {
            setIsCounting(false);
        }
        return () => clearInterval(timer);
    }, [isCounting, countdown]);

    const startCountdown = () => {
        setCountdown(60);
        setIsCounting(true);
    };

    const requestOTP: FormEventHandler = (e) => {
        e.preventDefault();
        clearErrors();

        post(route('customer.login.otp'), {
            preserveState: true,
            onSuccess: () => {
                setStep('otp');
                startCountdown();
            },
        });
    };

    const handleResend = () => {
        if (isCounting) return;

        clearErrors();
        post(route('customer.login.otp'), {
            preserveState: true,
            onSuccess: () => startCountdown(),
        });
    };

    const verifyOTP: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('customer.login.verify'), {
            onFinish: () => reset('otp'),
        });
    };

    return (
        <AuthLayout title="Customer Login" description={step === 'phone' ? "Enter your phone number to receive an OTP" : "Enter the 6-digit code sent to your phone"}>
            <Head title="Customer Login" />

            {step === 'phone' ? (
                <form className="flex flex-col gap-6" onSubmit={requestOTP}>
                    <div className="grid gap-6">
                        <div className="grid gap-2">
                            <Label htmlFor="phone_number">Phone Number</Label>
                            <Input
                                id="phone_number"
                                type="tel"
                                required
                                autoFocus
                                value={data.phone_number}
                                onChange={(e) => setData('phone_number', e.target.value)}
                                placeholder="e.g. 0123456789"
                            />
                            <InputError message={errors.phone_number} />
                        </div>

                        <Button type="submit" className="w-full" disabled={processing}>
                            {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                            Request OTP
                        </Button>
                    </div>
                </form>
            ) : (
                <form className="flex flex-col gap-6" onSubmit={verifyOTP}>
                    <div className="grid gap-6">
                        <div className="grid gap-2">
                            <Label htmlFor="otp">One-Time Password (OTP)</Label>
                            <Input
                                id="otp"
                                type="text"
                                required
                                autoFocus
                                value={data.otp}
                                onChange={(e) => setData('otp', e.target.value)}
                                placeholder="Enter 6-digit code"
                                maxLength={6}
                            />
                            <InputError message={errors.otp} />
                        </div>

                        <Button type="submit" className="w-full" disabled={processing}>
                            {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                            Verify & Login
                        </Button>

                        <div className="flex flex-col gap-2">
                            <button
                                type="button"
                                className="text-sm text-center text-muted-foreground hover:underline disabled:opacity-50 disabled:no-underline"
                                onClick={handleResend}
                                disabled={isCounting || processing}
                            >
                                {isCounting ? `Resend OTP in ${countdown}s` : 'Resend OTP'}
                            </button>

                            <button
                                type="button"
                                className="text-sm text-center text-muted-foreground hover:underline"
                                onClick={() => {
                                    setStep('phone');
                                    setCountdown(0);
                                    setIsCounting(false);
                                }}
                            >
                                Change phone number
                            </button>
                        </div>
                    </div>
                </form>
            )}
        </AuthLayout>
    );
}
