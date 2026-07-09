export interface Role {
    id: number;
    name: string;
    guard_name: string;
    permissions?: Permission[];
}

export interface Permission {
    id: number;
    name: string;
    guard_name: string;
}

export interface Category {
    id: number;
    name: string;
    price_start: string | number;
    price_end: string | number;
}

export interface District {
    id: number;
    name: string;
}

export interface Booking {
    id: number;
    user_id: number;
    item_name: string;
    category_id: number;
    method: string;
    tracking: string[];
    total_carton: number;
    total_quantity: number;
    total_weight: string;
    sensitive_goods: boolean;
    delivery_method: string;
    district_id: number;
    address: string;
    note: string | null;
    status: string;
    created_at: string;
    updated_at: string;
    category?: Category;
    district?: District;
    user?: User;
    histories?: BookingHistory[];
}

export interface BookingHistory {
    id: number;
    booking_id: number;
    status: string;
    changed_by: number | null;
    comment: string | null;
    created_at: string;
    user?: User;
}

export interface User {
    id: number;
    name: string;
    email: string;
    phone_number: string | null;
    role: string;
    roles?: Role[];
    permissions?: string[];
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface Auth {
    user: User | null;
    guard: 'admin' | 'customer';
}
