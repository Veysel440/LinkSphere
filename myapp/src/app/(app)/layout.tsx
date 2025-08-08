import QueryProvider from "../providers/QueryProvider";
import EchoProvider from "../providers/EchoProvider";

export default function AppLayout({ children }: { children: React.ReactNode }) {
    return (
        <QueryProvider>
            <EchoProvider>
                <div className="min-h-screen flex">
                    {/* <Sidebar/> */}
                    <main className="flex-1">{children}</main>
                </div>
            </EchoProvider>
        </QueryProvider>
    );
}
