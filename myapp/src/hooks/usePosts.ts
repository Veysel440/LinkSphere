import { api } from "@/lib/axios";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";

export function useFeed(limit=20){
    return useQuery({
        queryKey:["feed",limit],
        queryFn: async ()=>{
            const { data } = await api.get(`/api/posts?limit=${limit}`);
            return data; 
        }
    });
}

export function useCreatePost(){
    const qc = useQueryClient();
    return useMutation({
        mutationFn: async (payload:any)=>{
            const { data } = await api.post("/api/posts", payload);
            return data;
        },
        onSuccess:()=> qc.invalidateQueries({queryKey:["feed"]})
    });
}
