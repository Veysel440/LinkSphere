import { create, type StateCreator } from "zustand";

export type AuthUser = { id: number; name: string; avatar?: string } | null;

type AuthState = {
    user: AuthUser;
    setUser: (u: AuthUser) => void;
    logout: () => void;
};

const createAuthStore: StateCreator<AuthState> = (set) => ({
    user: null,
    setUser: (u: AuthUser) => set({ user: u }),
    logout: () => set({ user: null }),
});

export const useAuthStore = create<AuthState>(createAuthStore);
