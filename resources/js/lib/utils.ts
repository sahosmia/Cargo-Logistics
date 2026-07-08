import { type ClassValue, clsx } from 'clsx';
import { twMerge } from 'tailwind-merge';

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

// Add the missing function here:
export function toUrl(path: string) {
    // Your actual URL conversion logic goes here
    return path;
}
