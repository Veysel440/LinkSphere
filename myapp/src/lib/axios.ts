import axios from "axios";

export const api = axios.create({
    baseURL: process.env.NEXT_PUBLIC_API_URL,
    withCredentials: true,
});

let csrfReady = false;
async function ensureCsrf() {
    if (!csrfReady) {
        await api.get("/sanctum/csrf-cookie");
        csrfReady = true;
    }
}

api.interceptors.request.use(async (config) => {
    if (config.method && ["post","put","patch","delete"].includes(config.method)) {
        await ensureCsrf();
    }
    return config;
});

api.interceptors.response.use(
    (r)=>r,
    (err)=>{
        return Promise.reject(err);
    }
);
