export interface Role {
    id: number;
    name: string;
    name_ar: string;
    guard_name: string;
    created_at: string;
    permissions: Permission[];
}
export interface Permission {
    id: number;
    name: string;
    name_ar: string;
    guard_name: string;
    created_at: string;
    updated_at: string;
}

export interface Brand {
    id: number;
    name: string;
    name_ar: string;
    name_en: string;
    created_at: string;
    updated_at: string;
}
export interface CarModel {
    id: number;
    brand_id: number;
    name: string;
    name_ar: string;
    name_en: string;
    year_range: number[];
    year_range_formatted: string;
    brand: Brand;
    created_at: string;
}
