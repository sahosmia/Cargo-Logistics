import { Head, useForm, usePage, Link } from '@inertiajs/react';
import { LoaderCircle, Plane, Ship, ShieldCheck, Compass, Anchor, Phone } from 'lucide-react';
import { FormEventHandler, useEffect, useState } from 'react';

import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

interface CustomerLoginForm {
    phone_number: string;
    email: string;
    otp: string;
    remember: boolean;
}

export default function CustomerLogin() {
    const [step, setStep] = useState<'phone' | 'otp'>('phone');
    const [countdown, setCountdown] = useState(0);
    const [isCounting, setIsCounting] = useState(false);

    const { props } = usePage<{ flash: { message?: string; otp?: string }; settings?: { app_name?: string; logo?: string } }>();
    const { flash, settings } = props;
    const appName = settings?.app_name || 'Techpickly';
    const logoUrl = settings?.logo || '/images/techpickly-transparent-logo.png';

    const { data, setData, post, processing, errors, reset, clearErrors } = useForm<CustomerLoginForm>({
        phone_number: '',
        email: '',
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
        <div className="min-h-screen bg-slate-50 grid lg:grid-cols-12 overflow-hidden text-slate-800">
            <Head title="Customer Login" />

            {/* Left Side: Modern Eye-Catching Shipping Logistics Sidebar (Slightly lighter gradients) */}
            <div className="hidden lg:flex lg:col-span-5 relative flex-col justify-between p-10 overflow-hidden bg-[#262262]">
                {/* Background decorative patterns / ocean & air elements */}
                <div className="absolute inset-0 bg-gradient-to-br from-[#262262] via-[#262262]/95 to-[#171443] opacity-95 z-0" />

                {/* Light particles representing wind/sky and waves */}
                <div className="absolute top-1/4 left-1/3 w-96 h-96 rounded-full bg-blue-400/10 blur-3xl animate-pulse" />
                <div className="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full bg-red-400/10 blur-3xl animate-pulse" />

                <div className="relative z-10">
                    <a href={route('home')} className="inline-flex items-center gap-2">
                        <div className="bg-white p-2.5 rounded-xl border border-white/10 shadow-sm">
                            <img src={logoUrl} alt={appName} className="h-10 w-auto object-contain" />
                        </div>
                    </a>
                </div>

                {/* Animated logistics content */}
                <div className="relative z-10 my-auto space-y-8 text-white">
                    <div className="space-y-4">
                        <span className="px-3 py-1 text-xs font-semibold tracking-wider text-white uppercase bg-white/15 rounded-full border border-white/15 inline-block">
                            Premium Cargo Services
                        </span>
                        <h2 className="text-4xl font-extrabold tracking-tight leading-tight">
                            Connecting China & Bangladesh Seamlessly
                        </h2>
                        <p className="text-slate-200 text-base max-w-md">
                            Access our advanced portal to schedule shipments, trace delivery statuses, and manage your billing instantly.
                        </p>
                    </div>

                    <div className="grid gap-6 border-t border-white/10 pt-8">
                        <div className="flex items-start gap-4">
                            <div className="p-3 bg-white/10 text-white rounded-xl border border-white/10">
                                <Plane className="h-6 w-6" />
                            </div>
                            <div>
                                <h4 className="font-bold text-white">Express Air Freight</h4>
                                <p className="text-sm text-slate-300">Door-to-door delivery with industry-leading speed & absolute safety.</p>
                            </div>
                        </div>

                        <div className="flex items-start gap-4">
                            <div className="p-3 bg-white/10 text-white rounded-xl border border-white/10">
                                <Ship className="h-6 w-6" />
                            </div>
                            <div>
                                <h4 className="font-bold text-white">Secure Ocean Shipping</h4>
                                <p className="text-sm text-slate-300">Cost-effective shipping solutions for heavy weights & bulk shipments.</p>
                            </div>
                        </div>

                        <div className="flex items-start gap-4">
                            <div className="p-3 bg-white/10 text-white rounded-xl border border-white/10">
                                <ShieldCheck className="h-6 w-6" />
                            </div>
                            <div>
                                <h4 className="font-bold text-white">Fully Insured & Tracked</h4>
                                <p className="text-sm text-slate-300">Real-time status tracking with a linear status timeline and complete transparency.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="relative z-10 flex items-center justify-between text-xs text-slate-300 border-t border-white/10 pt-6">
                    <div className="flex items-center gap-1.5">
                        <Compass className="h-4 w-4 text-[#ED1C24]" />
                        <span>Navigate Your Logistics</span>
                    </div>
                    <span>© {new Date().getFullYear()} {appName}</span>
                </div>
            </div>

            {/* Right Side: Clean Light-Themed Customer Login Form */}
            <div className="lg:col-span-7 flex flex-col justify-center items-center p-6 sm:p-12 md:p-20 bg-white relative">
                {/* Logistics elements background decoration for light views */}
                <div className="absolute top-0 right-0 w-64 h-64 bg-red-500/5 rounded-full blur-3xl pointer-events-none" />
                <div className="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl pointer-events-none" />

                <div className="w-full max-w-md space-y-8 relative z-10">
                    {/* Header for mobile view logo */}
                    <div className="flex flex-col items-center text-center lg:items-start lg:text-left space-y-4">
                        <a href={route('home')} className="lg:hidden flex items-center justify-center p-2 bg-slate-100 rounded-xl border border-slate-200">
                            <img src={logoUrl} alt={appName} className="h-12 w-auto object-contain" />
                        </a>

                        <div className="space-y-2">
                            <h3 className="text-3xl font-extrabold tracking-tight text-[#262262]">
                                Customer Portal
                            </h3>
                            <p className="text-slate-500 text-sm">
                                {step === 'phone'
                                    ? "Welcome back! Enter your phone number to receive your secure login code."
                                    : "Verification code sent! Enter the 6-digit code to access your dashboard."
                                }
                            </p>
                        </div>
                    </div>

                    <div className="bg-white border border-slate-200/80 rounded-2xl p-6 sm:p-8 shadow-xl space-y-6">
                        {step === 'phone' ? (
                            <form className="space-y-5" onSubmit={requestOTP}>
                                <div className="space-y-2">
                                    <Label htmlFor="phone_number" className="text-sm font-semibold text-slate-700">
                                        Phone Number
                                    </Label>
                                    <div className="relative flex items-center">
                                        <div className="absolute left-3.5 text-slate-400">
                                            <Phone className="h-4 w-4" />
                                        </div>
                                        <Input
                                            id="phone_number"
                                            type="tel"
                                            required
                                            autoFocus
                                            value={data.phone_number}
                                            onChange={(e) => setData('phone_number', e.target.value)}
                                            placeholder="e.g. 01730495650"
                                            className="pl-11 bg-slate-50 border-slate-200 text-slate-800 placeholder-slate-400 focus:border-[#262262] focus:ring-1 focus:ring-[#262262] rounded-xl h-11"
                                        />
                                    </div>
                                    <InputError message={errors.phone_number} className="text-red-500 text-xs mt-1" />
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="email" className="text-sm font-semibold text-slate-700">
                                        Email Address <span className="text-xs text-slate-400 font-normal">(Optional)</span>
                                    </Label>
                                    <div className="relative flex items-center">
                                        <div className="absolute left-3.5 text-slate-400 font-bold">
                                            @
                                        </div>
                                        <Input
                                            id="email"
                                            type="email"
                                            value={data.email}
                                            onChange={(e) => setData('email', e.target.value)}
                                            placeholder="e.g. customer@example.com"
                                            className="pl-11 bg-slate-50 border-slate-200 text-slate-800 placeholder-slate-400 focus:border-[#262262] focus:ring-1 focus:ring-[#262262] rounded-xl h-11"
                                        />
                                    </div>
                                    <InputError message={errors.email} className="text-red-500 text-xs mt-1" />
                                </div>

                                <Button
                                    type="submit"
                                    className="w-full bg-[#ED1C24] hover:bg-[#D01E2A] text-white font-bold h-11 rounded-xl shadow-md transition-all hover:scale-[1.01] active:scale-[0.99] flex items-center justify-center gap-2"
                                    disabled={processing}
                                >
                                    {processing ? (
                                        <LoaderCircle className="h-5 w-5 animate-spin" />
                                    ) : (
                                        <Compass className="h-4 w-4" />
                                    )}
                                    Request Access Code
                                </Button>
                            </form>
                        ) : (
                            <form className="space-y-5" onSubmit={verifyOTP}>
                                {flash.otp && (
                                    <div className="rounded-xl bg-blue-50 border border-blue-200 p-4 text-xs text-blue-800 flex items-center gap-2.5">
                                        <ShieldCheck className="h-5 w-5 text-blue-600 shrink-0" />
                                        <div>
                                            <span className="font-semibold text-slate-700">Sandbox Verification Code:</span> <span className="font-bold font-mono text-slate-800 bg-white px-2 py-0.5 rounded border border-blue-100">{flash.otp}</span>
                                        </div>
                                    </div>
                                )}

                                <div className="space-y-2">
                                    <Label htmlFor="otp" className="text-sm font-semibold text-slate-700">
                                        6-Digit Verification Code (OTP)
                                    </Label>
                                    <div className="relative flex items-center">
                                        <div className="absolute left-3.5 text-slate-400">
                                            <ShieldCheck className="h-4 w-4" />
                                        </div>
                                        <Input
                                            id="otp"
                                            type="text"
                                            required
                                            autoFocus
                                            value={data.otp}
                                            onChange={(e) => setData('otp', e.target.value)}
                                            placeholder="Enter 6-digit code"
                                            maxLength={6}
                                            className="pl-11 bg-slate-50 border-slate-200 text-slate-800 placeholder-slate-400 focus:border-[#262262] focus:ring-1 focus:ring-[#262262] rounded-xl h-11 font-mono tracking-widest text-center text-lg"
                                        />
                                    </div>
                                    <InputError message={errors.otp} className="text-red-500 text-xs mt-1" />
                                </div>

                                <Button
                                    type="submit"
                                    className="w-full bg-[#ED1C24] hover:bg-[#D01E2A] text-white font-bold h-11 rounded-xl shadow-md transition-all hover:scale-[1.01] active:scale-[0.99] flex items-center justify-center gap-2"
                                    disabled={processing}
                                >
                                    {processing ? (
                                        <LoaderCircle className="h-5 w-5 animate-spin" />
                                    ) : (
                                        <Anchor className="h-4 w-4" />
                                    )}
                                    Verify & Start Tracking
                                </Button>

                                <div className="flex flex-col gap-3 pt-2 text-center">
                                    <button
                                        type="button"
                                        className="text-xs text-slate-500 hover:text-slate-800 hover:underline transition-colors disabled:opacity-50 disabled:no-underline"
                                        onClick={handleResend}
                                        disabled={isCounting || processing}
                                    >
                                        {isCounting ? `Resend OTP in ${countdown}s` : 'Resend OTP'}
                                    </button>

                                    <button
                                        type="button"
                                        className="text-xs text-slate-400 hover:text-slate-600 hover:underline transition-colors"
                                        onClick={() => {
                                            setStep('phone');
                                            setCountdown(0);
                                            setIsCounting(false);
                                        }}
                                    >
                                        Change phone number
                                    </button>
                                </div>
                            </form>
                        )}
                    </div>

                    {/* Back to Home Navigation & Mutual Links */}
                    <div className="flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-4 pt-4 border-t border-slate-100">
                        <a href={route('home')} className="hover:text-slate-600 transition-colors flex items-center gap-1">
                            <Anchor className="h-3 w-3 text-[#ED1C24]" />
                            <span>Return to Home</span>
                        </a>
                        <div className="flex items-center gap-3">
                            <Link href={route('login')} className="hover:text-slate-600 transition-colors font-medium text-[#262262]">Admin Portal</Link>
                            <span className="text-slate-200">•</span>
                            <a href={route('contact')} className="hover:text-slate-600 transition-colors">Support Center</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
