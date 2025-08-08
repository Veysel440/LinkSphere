"use client";
import { useForm } from "react-hook-form";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import MediaUploader from "./MediaUploader";

const schema = z.object({
    type: z.enum(["text","image","video","file"]),
    content: z.string().max(1000).optional(),
    media_ids: z.array(z.number()).optional(),
    tags: z.array(z.string()).optional(),
});

export default function PostComposer({ onSubmit }:{ onSubmit:(p:any)=>void }) {
    const { register, handleSubmit, setValue, watch, formState:{errors} } =
        useForm({ resolver: zodResolver(schema), defaultValues:{ type:"text" } });

    return (
        <form onSubmit={handleSubmit(onSubmit)} className="rounded-xl border p-3 space-y-2">
            <select className="border p-2 rounded" {...register("type")}>
                <option value="text">Metin</option>
                <option value="image">Görsel</option>
                <option value="video">Video</option>
                <option value="file">Dosya</option>
            </select>
            <textarea className="w-full border p-2 rounded" placeholder="Ne düşünüyorsun?" {...register("content")} />
            <MediaUploader onUploaded={(id)=> {
                const current = watch("media_ids") || [];
                setValue("media_ids", [...current, id]);
            }} />
            <button className="px-4 py-2 bg-black text-white rounded">Paylaş</button>
            {errors.content && <p className="text-sm text-red-500">{String(errors.content.message)}</p>}
        </form>
    );
}
