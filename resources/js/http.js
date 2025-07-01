import axios from "axios";

const http = axios.create({
    baseURL: import.meta.env.VITE_API_URL,
    timeout: 25000,
});

function successRequest(config) {
    const token = localStorage.getItem("token");
    if (token && token !== "") {
        config.headers = {
            ...config.headers,
            Authorization: `Bearer ${token}`,
        };
    }

    return config;
}

function successResponse(config) {
    return config;
}

function errorRequest(error) {
    return Promise.reject(error);
}

http.interceptors.request.use(successRequest);
http.interceptors.response.use(successResponse, errorRequest);

export default http;
