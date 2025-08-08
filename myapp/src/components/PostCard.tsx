"use client";
import { api } from "@/lib/axios";
import { useMutation, useQueryClient } from "@tanstack/react-query";

export default function PostCard({ post }:{ post:any }) {
    const qc = useQueryClient();
    const like = useMutation({
        mutationFn: async ()=> api.post(`/api/posts/${post.id}/like`),
        onSuccess:()=> qc.invalidateQueries({queryKey:["feed"]})
    });
    return (
        <div className="border rounded-xl p-3 space-y-2">
            <div className="flex items-center gap-2">
                <img src={post.user.avatar} className="w-8 h-8 rounded-full" />
                <b>{post.user.name}</b>
            </div>
            <div>{post.content}</div>
            {Array.isArray(post.media) && post.media.map((m:any)=>(
                <img key={m.id} src={m.url} className="rounded-lg" />
            ))}
            <div className="flex items-center gap-4 text-sm opacity-80">
                <button onClick={()=>like.mutate()}>👍 {post.like_count}</button>
                <span>💬 {post.comment_count}</span>
                <span>↗ {post.share_count}</span>
            </div>
        </div>
    );
}
