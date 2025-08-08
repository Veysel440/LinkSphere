"use client";
import { useState } from "react";
import { api } from "@/lib/axios";

export default function MediaUploader({ onUploaded }:{ onUploaded:(id:number)=>void }) {
    const [loading,setLoading] = useState(false);
    async function onFile(e: React.ChangeEvent<HTMLInputElement>) {
        const file = e.target.files?.[0];
        if(!file) return;
        const fd = new FormData();
        fd.append("file", file);
        setLoading(true);
        try {
            const { data } = await api.post("/api/media/upload", fd, { headers:{ "Content-Type":"multipart/form-data" }});
            onUploaded(data.id);
        } finally { setLoading(false); }
    }
    return (
        <label className="inline-flex items-center gap-2 cursor-pointer">
            <input type="file" className="hidden" onChange={onFile} />
            <span className="px-3 py-1 border rounded">{loading ? "Yükleniyor..." : "Medya Ekle"}</span>
        </label>
    );
}
