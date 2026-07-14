import { Head, useForm, usePage, Link } from '@inertiajs/react';
import { LoaderCircle, Plane, Ship, ShieldCheck, Compass, Anchor, Mail, KeyRound, Globe, Users } from 'lucide-react';
import { FormEventHandler } from 'react';

import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

interface LoginForm {
    email: string;
    password: string;
    remember: boolean;
}

interface LoginProps {
    status?: string;
    canResetPassword: boolean;
}

export default function Login({ status, canResetPassword }: LoginProps) {
    const { props } = usePage<{ settings?: { app_name?: string; logo?: string } }>();
    const { settings } = props;
    const appName = settings?.app_name || 'Techpickly';
    const logoUrl = settings?.logo || '/images/techpickly-transparent-logo.png';

    const { data, setData, post, processing, errors, reset } = useForm<LoginForm>({
        email: '',
        password: '',
        remember: false,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('login'), {
            onFinish: () => reset('password'),
        });
    };

    return (
        <div className="min-h-screen bg-slate-50 grid lg:grid-cols-12 overflow-hidden text-slate-800">
            <Head title="Admin Log in" />

            {/* Left Side: Modern Eye-Catching Operations Control Panel Sidebar (Slightly lighter gradients) */}
            <div className="hidden lg:flex lg:col-span-5 relative flex-col justify-between p-10 overflow-hidden bg-[#262262]">
                {/* Background decorative patterns / ocean & air elements */}
                <div className="absolute inset-0 bg-gradient-to-br from-[#262262] via-[#262262]/95 to-[#171443] opacity-95 z-0" />

                {/* Light particles representing status, air routes, and sea tracks */}
                <div className="absolute top-1/3 right-1/4 w-96 h-96 rounded-full bg-red-400/10 blur-3xl animate-pulse" />
                <div className="absolute bottom-1/3 left-1/4 w-80 h-80 rounded-full bg-blue-400/10 blur-3xl animate-pulse" />

                <div className="relative z-10">
                    <a href={route('home')} className="inline-flex items-center gap-2">
                        <div className="bg-white p-2.5 rounded-xl border border-white/10 shadow-sm">
                            <img src={logoUrl} alt={appName} className="h-10 w-auto object-contain" />
                        </div>
                    </a>
                </div>

                {/* Logistics Control Room Content */}
                <div className="relative z-10 my-auto space-y-8 text-white">
                    <div className="space-y-4">
                        <span className="px-3 py-1 text-xs font-semibold tracking-wider text-white uppercase bg-white/15 rounded-full border border-white/15 inline-block">
                            Operations Control Panel
                        </span>
                        <h2 className="text-4xl font-extrabold tracking-tight leading-tight">
                            Global Air & Sea Cargo Management
                        </h2>
                        <p className="text-slate-200 text-base max-w-md">
                            Welcome to the admin hub. Manage cargo tracking, linear status life cycles, warehouse updates, and shipping pricing strategies.
                        </p>
                    </div>

                    <div className="grid gap-6 border-t border-white/10 pt-8">
                        <div className="flex items-start gap-4">
                            <div className="p-3 bg-white/10 text-white rounded-xl border border-white/10">
                                <Globe className="h-6 w-6" />
                            </div>
                            <div>
                                <h4 className="font-bold text-white">Global Hub Routing</h4>
                                <p className="text-sm text-slate-300">Manage connections across international borders from China warehouses directly to Bangladesh.</p>
                            </div>
                        </div>

                        <div className="flex items-start gap-4">
                            <div className="p-3 bg-white/10 text-white rounded-xl border border-white/10">
                                <Ship className="h-6 w-6" />
                            </div>
                            <div>
                                <h4 className="font-bold text-white">Vessel & Flight Schedulers</h4>
                                <p className="text-sm text-slate-300">Control active shipments, manifest creation, and multi-piece cargo status assignments.</p>
                            </div>
                        </div>

                        <div className="flex items-start gap-4">
                            <div className="p-3 bg-white/10 text-white rounded-xl border border-white/10">
                                <Users className="h-6 w-6" />
                            </div>
                            <div>
                                <h4 className="font-bold text-white">Role-Based Gateways</h4>
                                <p className="text-sm text-slate-300">Granular Spatie permissions for Super Admins, China Warehouse Managers, and BD Managers.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="relative z-10 flex items-center justify-between text-xs text-slate-300 border-t border-white/10 pt-6">
                    <div className="flex items-center gap-1.5">
                        <Compass className="h-4 w-4 text-[#ED1C24]" />
                        <span>Operations Command Center</span>
                    </div>
                    <span>© {new Date().getFullYear()} {appName}</span>
                </div>
            </div>

            {/* Right Side: Elegant Admin Login Card */}
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
                                Secure Portal Access
                            </h3>
                            <p className="text-slate-500 text-sm">
                                Enter your registered email and credentials to manage the shipping portal.
                            </p>
                        </div>
                    </div>

                    <div className="bg-white border border-slate-200/80 rounded-2xl p-6 sm:p-8 shadow-xl space-y-6">
                        <form className="space-y-5" onSubmit={submit}>
                            <div className="space-y-2">
                                <Label htmlFor="email" className="text-sm font-semibold text-slate-700">
                                    Operator Email
                                </Label>
                                <div className="relative flex items-center">
                                    <div className="absolute left-3.5 text-slate-400">
                                        <Mail className="h-4 w-4" />
                                    </div>
                                    <Input
                                        id="email"
                                        type="email"
                                        required
                                        autoFocus
                                        tabIndex={1}
                                        autoComplete="email"
                                        value={data.email}
                                        onChange={(e) => setData('email', e.target.value)}
                                        placeholder="email@example.com"
                                        className="pl-11 bg-slate-50 border-slate-200 text-slate-800 placeholder-slate-400 focus:border-[#262262] focus:ring-1 focus:ring-[#262262] rounded-xl h-11"
                                    />
                                </div>
                                <InputError message={errors.email} className="text-red-500 text-xs mt-1" />
                            </div>

                            <div className="space-y-2">
                                <Label htmlFor="password" className="text-sm font-semibold text-slate-700">
                                    Password Key
                                </Label>
                                <div className="relative flex items-center">
                                    <div className="absolute left-3.5 text-slate-400">
                                        <KeyRound className="h-4 w-4" />
                                    </div>
                                    <Input
                                        id="password"
                                        type="password"
                                        required
                                        tabIndex={2}
                                        autoComplete="current-password"
                                        value={data.password}
                                        onChange={(e) => setData('password', e.target.value)}
                                        placeholder="Enter secure password"
                                        className="pl-11 bg-slate-50 border-slate-200 text-slate-800 placeholder-slate-400 focus:border-[#262262] focus:ring-1 focus:ring-[#262262] rounded-xl h-11"
                                    />
                                </div>
                                <InputError message={errors.password} className="text-red-500 text-xs mt-1" />
                            </div>

                            <div className="flex items-center justify-between">
                                <div className="flex items-center space-x-3">
                                    <Checkbox
                                        id="remember"
                                        name="remember"
                                        tabIndex={3}
                                        checked={data.remember}
                                        onCheckedChange={(checked) => setData('remember', checked === true)}
                                        className="border-slate-300 bg-slate-50 text-[#ED1C24] focus:ring-[#ED1C24]"
                                    />
                                    <Label htmlFor="remember" className="text-xs text-slate-500 cursor-pointer">
                                        Remember current session
                                    </Label>
                                </div>
                            </div>

                            <Button
                                type="submit"
                                className="w-full bg-[#ED1C24] hover:bg-[#D01E2A] text-white font-bold h-11 rounded-xl shadow-md transition-all hover:scale-[1.01] active:scale-[0.99] flex items-center justify-center gap-2"
                                tabIndex={4}
                                disabled={processing}
                            >
                                {processing ? (
                                    <LoaderCircle className="h-5 w-5 animate-spin" />
                                ) : (
                                    <Compass className="h-4 w-4" />
                                )}
                                Enter Control Hub
                            </Button>
                        </form>
                    </div>

                    {/* Back to Home Navigation & Mutual Links */}
                    <div className="flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-4 pt-4 border-t border-slate-100">
                        <a href={route('home')} className="hover:text-slate-600 transition-colors flex items-center gap-1">
                            <Anchor className="h-3 w-3 text-[#ED1C24]" />
                            <span>Return to Home</span>
                        </a>
                        <div className="flex items-center gap-3">
                            <Link href={route('customer.login')} className="hover:text-slate-600 transition-colors font-medium text-[#262262]">Client Portal</Link>
                            <span className="text-slate-200">•</span>
                            <a href={route('contact')} className="hover:text-slate-600 transition-colors">Support Center</a>
                        </div>
                    </div>
                </div>
            </div>

            {status && <div className="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-sm font-medium text-green-700 bg-white border border-green-200 px-4 py-2 rounded-xl z-20 shadow-lg">{status}</div>}
        </div>
    );
}
