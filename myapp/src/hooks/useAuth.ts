import { useAuthStore } from "@/store/useAuthStore";
import { api } from "@/lib/axios";
import { useQuery } from "@tanstack/react-query";

export function useAuth() {
    const { user, setUser, logout } = useAuthStore();
    useQuery({
        queryKey: ["me"],
        queryFn: async ()=> {
            const { data } = await api.get("/api/user/profile");
            setUser({ id: data.id, name: data.name, avatar: data.profile?.avatar });
            return data;
        },
        staleTime: 60_000,
    });
    const login = async (email:string, password:string)=>{
        await api.post("/login",{ email,password });
    };
    const signout = async ()=>{
        await api.post("/logout"); logout();
    };
    return { user, login, signout };
}
