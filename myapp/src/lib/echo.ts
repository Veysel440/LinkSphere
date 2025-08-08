"use client";
import Echo from "laravel-echo";
import Pusher from "pusher-js";

export function createEcho(userId?: number) {
    if (!userId) return null;

    (window as any).Pusher = Pusher;

    const key    = process.env.NEXT_PUBLIC_PUSHER_KEY!;
    const wsHost = process.env.NEXT_PUBLIC_PUSHER_HOST ?? "localhost";
    const wsPort = Number(process.env.NEXT_PUBLIC_PUSHER_PORT ?? 6001);
    const forceTLS = (process.env.NEXT_PUBLIC_PUSHER_TLS ?? "false") === "true";

    const echo = new Echo({
        broadcaster: "pusher",
        key,
        wsHost,
        wsPort,
        forceTLS,
        enabledTransports: ["ws", "wss"],
        withCredentials: true,
    });

    return echo;
}
