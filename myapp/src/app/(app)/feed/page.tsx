"use client";
import { useFeed, useCreatePost } from "@/hooks/usePosts";
import PostCard from "@/components/PostCard";
import PostComposer from "@/components/PostComposer";

export default function FeedPage(){
    const { data, isLoading } = useFeed();
    const create = useCreatePost();

    return (
        <div className="max-w-2xl mx-auto p-4 space-y-4">
            <PostComposer onSubmit={(p)=>create.mutate(p)} />
            {isLoading ? "Yükleniyor..." : data?.data?.map((p:any)=>(
                <PostCard key={p.id} post={p} />
            ))}
        </div>
    );
}
