"use client";
import { ReactNode, useEffect, useMemo } from "react";
import { createEcho } from "@/lib/echo";
import { useAuthStore } from "@/store/useAuthStore";

export default function EchoProvider({ children }: { children: ReactNode }) {
    const user = useAuthStore((s) => s.user);

    const echo = useMemo(() => createEcho(user?.id), [user?.id]);

    useEffect(() => {
        if (!echo || !user?.id) return;

        const notif = echo
            .private(`notifications.${user.id}`)
            .listen("NotificationSent", (e: any) => {
            });

        const chat = echo
            .private(`private-chat.${user.id}`)
            .listen("MessageSent", (e: any) => {
            });

        return () => {
            try {
                notif.stopListening("NotificationSent");
                chat.stopListening("MessageSent");
                echo.disconnect?.();
            } catch (_) {}
        };
    }, [echo, user?.id]);

    return <>{children}</>;
}
